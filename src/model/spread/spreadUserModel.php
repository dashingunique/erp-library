<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      平台管理员模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

declare (strict_types=1);

namespace erp\model\spread;

use think\Model;

class spreadUserModel
{
    const STATE_OK = 1;                 //状态：启用
    const STATE_NO_AUTH = 2;            //状态：未认证
    const STATE_FORBIDDEN = 3;          //状态：禁用

    const IS_MASTER = 1;                //是否是管理员：1是
    const NO_MASTER = 2;                //是否是管理员：2不是
}
