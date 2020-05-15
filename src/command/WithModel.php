<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      关联模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\command;

use erp\library\ClassMap;
use Exception;
use think\console\Command;
use think\console\input\Option;
use think\console\Output;
use think\helper\Str;
use think\Model;
use ReflectionClass;
use ReflectionMethod;
use think\model\Relation;
use Throwable;

class WithModel extends Command
{
    protected array $dirs = [];

    protected array $ignore = [];

    protected array $properties = [];

    protected array $methods = [];

    /** @var ReflectionClass */
    protected ReflectionClass $reflection;

    protected $config;

    public function __construct()
    {
        parent::__construct();
        $this->config = config('erp');
    }

    protected function configure()
    {
        $this->setName("erp:logic-help")
            ->addOption('dir', 'D', Option::VALUE_OPTIONAL | Option::VALUE_IS_ARRAY, '模型文件路径', [])
            ->addOption('ignore', 'I', Option::VALUE_OPTIONAL, '需要忽略的文件信息', '');
    }

    public function handle()
    {
        $this->dirs = array_merge([], $this->input->getOption('dir'));

        $ignore = $this->input->getOption('ignore');

        $this->generateHelp($ignore);
    }

    /**
     * 生成erp所需的模型助手信息
     * @param  string  $ignore
     */
    public function generateHelp($ignore = "")
    {
        $models = ClassMap::getInstance()->getDirsMap($this->dirs);

        $ignore = explode(',', $ignore);

        foreach (array_keys($models) as $name) {
            if (in_array($name, $ignore)) {
                if ($this->output->getVerbosity() >= Output::VERBOSITY_VERBOSE) {
                    $this->output->comment("Ignoring model '$name'");
                }
                continue;
            }

            $this->properties = [];
            $this->methods = [];

            if (class_exists($name)) {
                try {
                    $this->generate($name);
                    $ignore[] = $name;
                } catch (Exception $exception) {
                    $this->output->error("Exception: ".$exception->getMessage()."\nCould not analyze class $name.");
                }
            }
        }
    }

    /**
     * 生成注释
     * @param $name
     * @throws \ReflectionException
     */
    public function generate($name)
    {
        $this->reflection = new ReflectionClass($name);

        if (!$this->reflection->isSubclassOf(Model::class)) {
            return;
        }

        if ($this->output->getVerbosity() >= Output::VERBOSITY_VERBOSE) {
            $this->output->comment("Loading model '{$name}'");
        }

        if (!$this->reflection->isInstantiable()) {
            // 忽略接口和抽象类
            return;
        }

        $model = new $name;

        $this->getPropertiesFromMethods($model);
        if (!is_dir($this->config['with_cache_path'])) {
            mkdir($this->config['with_cache_path'], 0755, true);
        }
        if (!is_dir($this->config['get_cache_path'])) {
            mkdir($this->config['get_cache_path'], 0755, true);
        }
        //触发事件
        $this->app->event->trigger($this);
    }

    /**
     * 自动生成获取器和修改器以及关联对象的属性信息
     */
    protected function getPropertiesFromMethods($model)
    {
        $methods = $this->reflection->getMethods(ReflectionMethod::IS_PUBLIC);
        $with = [];
        $get = [];
        foreach ($methods as $method) {
            if ($method->getDeclaringClass()->getName() == $this->reflection->getName()) {
                $methodName = $method->getName();
                if (Str::startsWith($methodName, 'search') && Str::endsWith(
                        $methodName,
                        'Attr'
                    ) && 'getAttr' !== $methodName) {
                    //获取器
                    $name = Str::snake(substr($methodName, 6, -4));
                    array_push($get, $name);
                } elseif (empty($method->getNumberOfRequiredParameters())) {
                    $name = Str::snake($methodName);
                    $ignoreFile = [
                        'morph_to',
                        'get_with_model',
                        'set_auto_with',
                        'get_with_where',
                        'get_schema',
                        'get_auth_info',
                        'get_spread_info'
                    ];
                    if (!in_array($name, $ignoreFile)) {
                        //关联对象
                        try {
                            $return = $method->invoke($model);
                            if ($return instanceof Relation) {
                                $name = Str::snake($methodName);
                                if ($name !== 'morph_to') {
                                    array_push($with, $name);
                                }
                            }
                        } catch (Exception $e) {
                        } catch (Throwable $e) {
                        }
                    }
                }
            }
        }
        if (!empty($with)) {
            $withContent = '<?php '.PHP_EOL.'return '.var_export($with, true).';';
            file_put_contents($this->config['with_cache_path'].$model->getTable().'.php', $withContent);
            $this->output->info('create with file'.$this->config['with_cache_path'].$model->getTable().'.php success');
        }
        if (!empty($get)) {
            $getContent = '<?php '.PHP_EOL.'return '.var_export($get, true).';';
            file_put_contents($this->config['get_cache_path'].$model->getTable().'.php', $getContent);
            $this->output->info('create get file'.$this->config['get_cache_path'].$model->getTable().'.php success');
        }
    }
}
