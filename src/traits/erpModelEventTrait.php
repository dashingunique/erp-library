<?php

namespace erp\traits;

use ReflectionClass;
use ReflectionMethod;
use think\helper\Str;
use think\Model;
use think\model\Relation;

trait erpModelEventTrait
{
    /**
     * @var array 关联信息
     */
    protected $withModel = [];

    /**
     * 获取当前模型关联的模型名称
     * @return array
     * @throws \ReflectionException
     */
    public function getWithModel(): array
    {
        if (empty($this->withModel)) {
            // 读取字段缓存
            $config = config('erp');
            if (!is_dir($config['with_cache_path'])) {
                mkdir($config['with_cache_path'], 0755, true);
            }
            $cacheFile = $config['with_cache_path'].$this->getTable().'.php';
            if ($config['with_cache'] && is_file($cacheFile)) {
                $info = include $cacheFile;
                $this->withModel = array_values($info);
            } else {
                $this->setAutoWith();
                if ($config['with_cache']) {
                    $content = '<?php '.PHP_EOL.'return '.var_export($this->withModel, true).';';
                    file_put_contents($cacheFile, $content);
                }
            }
        }
        return $this->withModel;
    }

    /**
     * 获取查询关联条件
     * @return array
     * @throws \ReflectionException
     */
    public function getWithWhere(): array
    {
        $with = request()->param('with', '', 'trim,htmlspecialchars');
        $whereWith = explode(',', $with);
        return !empty($whereWith) ? array_intersect($whereWith, $this->getWithModel()) : [];
    }

    /**
     * 通过反射获取当前模型关联信息
     * @throws \ReflectionException
     */
    private function setAutoWith(): void
    {
        $reflection = new ReflectionClass($this);
        if ($reflection->isSubclassOf(Model::class) && $reflection->isInstantiable()) {
            $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                $name = Str::snake($method->getName());
                $ignoreFile = [
                    'morph_to',
                    'get_with_model',
                    'set_auto_with',
                    'get_with_where',
                    'get_schema',
                    'get_auth_info',
                    'get_spread_info'
                ];
                if ($method->isPublic() && $method->getNumberOfRequiredParameters() == 0 && !in_array($name,
                        $ignoreFile)) {
                    try {
                        //关联对象
                        $return = $method->invoke($this);
                        if ($return instanceof Relation) {
                            array_push($this->withModel, $name);
                        }
                    } catch (\Exception $e) {
                    } catch (\Throwable $e) {
                    }
                }
            }
        }
    }
}