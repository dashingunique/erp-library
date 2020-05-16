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

namespace erp\facade;

use erp\Erp as baseErp;
use think\Facade;

/**
 * @method array getGrant(string $app = '') static 获取应用导航数据
 */
class Erp extends Facade
{
    protected static function getFacadeClass()
    {
        return baseErp::class;
    }
}