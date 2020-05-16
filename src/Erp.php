<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      公用方法类
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

declare(strict_types=1);

namespace erp;

use erp\facade\SymfonyFile;
use erp\library\Node;


class Erp
{
    /**
     * @var string 十贰erp根目录
     */
    protected string $erpPath = __DIR__;

    /**
     * 获取应用导航数据
     * @param  string  $app
     * @return array
     * @throws \ReflectionException
     */
    public function getGrant(string $app = ''): array
    {
        $config = app()->config->get('erp');
        $path = !empty($app) ? $config['menu_cache_path'].$app.DIRECTORY_SEPARATOR.'menu.php' : $config['menu_cache_path'].'menu.php';
        if (file_exists($path)) {
            $menu = include $path;
        } else {
            $node = Node::getInstance();
            $menu = $node->getAppMenuData($app.'/controller');
        }
        return $menu;
    }

    /**
     * 获取erp的路径
     * @return string
     */
    public function getErpPath(): string
    {
        return $this->erpPath;
    }

    /**
     * 获取十贰erp语言包路径
     * @return string
     */
    public function getErpLangPath(): string
    {
        return $this->erpPath.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR;
    }
}