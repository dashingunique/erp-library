<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      授权模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\model;

class authModel
{
    const AUTH_CUSTOM = 16;             //顾客
    const AUTH_SUPPLIER = 8;            //供应商
    const AUTH_SHOP = 4;                //店铺
    const AUTH_SPREAD = 2;              //平台
    const AUTH_ADMIN = 1;               //管理员
    

    /**
     * @return string[] 角色类型描述
     */
    public static function authDesc()
    {
        return [
            self::AUTH_ADMIN => '系统管理员',
            self::AUTH_SPREAD => '平台管理员',
            self::AUTH_SHOP => '店铺管理员',
            self::AUTH_SUPPLIER => '平台供应商',
            self::AUTH_CUSTOM => '平台客户',
        ];
    }
}
