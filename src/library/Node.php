<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      节点拓展类
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

declare(strict_types=1);

namespace erp\library;

use Exception;
use erp\traits\instanceTrait;
use think\app\MultiApp;
use think\console\Output;
use think\helper\Str;
use ReflectionClass;
use ReflectionMethod;

class Node
{
    use instanceTrait;

    /**
     * 配置信息
     * @var array
     */
    protected $config;

    /**
     * @var array 查找的文件夹名称
     */
    protected array $dirs;

    /**
     * @var array 忽略的类文件
     */
    protected array $ignores;

    /**
     * Node constructor.
     * @param  array  $dirs
     * @param  array  $ignores
     */
    public function __construct(array $dirs = [], array $ignores = [])
    {
        $this->dirs = $dirs;
        $this->ignores = $ignores;
        $this->config = app()->config->get('erp');
    }

    /**
     * 控制器方法扫描处理
     * @param  string  $dir
     * @return array
     * @throws \ReflectionException
     */
    public function getMethods(string $dir)
    {
        static $data = [];
        foreach (ClassMap::getInstance()->getDirMap($dir) as $class => $path) {
            $reflectionClass = new ReflectionClass($class);
            $classname = ucfirst($reflectionClass->getName());
            $data[$class] = $this->_parseComment($reflectionClass->getDocComment(), $classname);
            foreach ($reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                $metName = Str::snake($method->getName());
                if (in_array(Str::camel($metName), $this->ignores)) {
                    continue;
                }
                try {
                    $methodComment = $this->_parseComment($method->getDocComment(), $metName, $classname);
                    if (empty($methodComment)) {
                        continue;
                    }
                    $data["{$class}\\{$metName}"] = $methodComment;
                } catch (Exception $exception) {
                    continue;
                }
            }
        }
        return $data;
    }

    /**
     * 解析硬节点属性
     * @param  string  $comment
     * @param  string  $default
     * @param  string  $parent
     * @return array
     */
    private function _parseComment(string $comment, $default = '', $parent = '')
    {
        $text = strtr($comment, "\n", ' ');
        $title = preg_replace('/^\/\*\s*\*\s*\*\s*(.*?)\s*\*.*?$/', '$1', $text);
        if (strstr($title, 'constructor')) {
            return [];
        }
        foreach (['@auth', '@menu', '@login'] as $find) {
            if (stripos($title, $find) === 0) {
                $title = $default;
            }
        }
        return [
            'title' => $title ? $title : $default,
            'parent' => $parent,
            'is_auth' => intval(preg_match('/@auth\s*true/i', $text)),
            'is_menu' => intval(preg_match('/@menu\s*true/i', $text)),
            'is_login' => intval(preg_match('/@login\s*true/i', $text)),
        ];
    }

    /**
     * 获取授权节点列表
     * @param  Output  $output
     * @throws \ReflectionException
     */
    public function generateMenu(Output $output)
    {
        foreach ($this->dirs as $dir) {
            $menu = $this->getAppMenuData($dir);
            $this->generateAppMenu($dir, $menu);
            $output->info('create menu file '.$dir.' success');
        }
    }

    /**
     * 生成对应应用的导航数据
     * @param $dir
     * @param  array  $menu
     */
    public function generateAppMenu($dir, array $menu): void
    {
        list($app) = explode('/', $dir);
        $data = '<?php '.PHP_EOL.'return '.var_export($menu, true).';';
        if (!is_dir($this->config['menu_cache_path'])) {
            mkdir($this->config['menu_cache_path'], 0755, true);
        }
        $path = $this->config['menu_cache_path'].'menu.php';
        if (class_exists(MultiApp::class)) {
            if (!is_dir($this->config['menu_cache_path'].$app.DIRECTORY_SEPARATOR)) {
                mkdir($this->config['menu_cache_path'].$app.DIRECTORY_SEPARATOR, 0755, true);
            }
            $path = $this->config['menu_cache_path'].$app.DIRECTORY_SEPARATOR.'menu.php';
        }
        file_put_contents($path, $data);
    }

    /**
     * 获取应用的导航节点
     * @param $dir
     * @return mixed
     * @throws \ReflectionException
     */
    public function getAppMenuData($dir)
    {
        list($nodes, $pNodes, $methods) = [[], [], $this->getMethods($dir)];
        foreach ($methods as $node => $method) {
            list($count, $pNode) = [substr_count($node, '\\'), substr($node, 0, strripos($node, '\\'))];
            if ($count === 4 && !empty($method['is_auth'])) {
                in_array($pNode, $pNodes) or array_push($pNodes, $pNode);
                $nodes[$node] = ['node' => $node, 'title' => $method['title'], 'pNode' => $pNode];
            } elseif ($count === 3 && in_array($pNode, $pNodes)) {
                $nodes[$node] = ['node' => $node, 'title' => $method['title'], 'pNode' => $pNode];
            }
        }
        foreach (array_keys($nodes) as $key) {
            foreach ($methods as $node => $method) {
                if (stripos($key, "{$node}\\") !== false) {
                    $pNode = substr($node, 0, strripos($node, '\\'));
                    $nodes[$node] = ['node' => $node, 'title' => $method['title'], 'pNode' => $pNode];
                    $nodes[$pNode] = ['node' => $pNode, 'title' => $pNode, 'pNode' => ''];
                }
            }
        }
        return Tree::getInstance('node', 'pNode', '_sub_')->arrToTree($nodes);
    }
}