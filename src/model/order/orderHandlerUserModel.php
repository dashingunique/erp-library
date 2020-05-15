<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      单据模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

declare (strict_types=1);

namespace erp\model\order;

class orderHandlerUserModel
{
    const ROLE_OPERATOR = 1;            //单据角色类型：1操作员(制单员)
    const ROLE_EXAMINE = 2;             //单据角色类型：2审批人
    const ROLE_VERIFY = 4;              //单据角色类型：4验证人
    const ROLE_APPLY = 8;               //单据角色类型：8审核人

    /**
     * @return string[] 单据操作角色说明
     */
    public static function roleDesc()
    {
        return [
            self::ROLE_OPERATOR => '创建',
            self::ROLE_EXAMINE => '审批',
            self::ROLE_VERIFY => '验证',
            self::ROLE_APPLY => '审核',
        ];
    }
}
