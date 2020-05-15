<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\traits;

trait instanceTrait
{
    /**
     * 单例模式申明
     * instances
     * @var array
     */
    private static $instances;
    
    /**
     *获取相对应的单例
     * get instance
     * @param mixed $param
     * @return static
     */
    public static function getInstance(...$param)
    {
        $className = get_called_class();

        if (empty(self::$instances[$className])) {
            self::$instances[$className] = new static(...$param);
        }

        return self::$instances[$className];
    }
}