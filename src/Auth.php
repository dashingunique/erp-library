<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      授权驱动类
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

declare(strict_types=1);

namespace erp;

use think\Manager;

class Auth extends Manager
{
    /**
     * @var string 命名空间
     */
    protected $namespace = '\\erp\\library\\auth\\';

    /**
     * 验证器驱动类
     * @param  string  $name
     * @return mixed
     */
    public function auth(string $name)
    {
        return $this->driver(lcfirst($name));
    }

    /**
     * 默认驱动
     * @return string|null
     */
    public function getDefaultDriver()
    {
        return null;
    }

    /**
     * 获取驱动参数
     * @param $name
     * @return array
     */
    protected function resolveParams($name): array
    {
        return [];
    }
}
