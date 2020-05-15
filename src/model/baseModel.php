<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      基础模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\model;

class baseModel
{
    /**
     * 状态：1启用
     */
    const STATE_OK = 1;

    /**
     * 状态：2禁用
     */
    const STATE_BAN = 2;

    /**
     * 权限角色：1总后台
     */
    const AUTHORITY_ADMIN = 1;

    /**
     * 权限角色：2平台
     */
    const AUTHORITY_SPREAD = 2;

    /**
     * 权限角色：4店铺
     */
    const AUTHORITY_SHOP = 4;

    /**
     * 权限角色：8供应商
     */
    const AUTHORITY_SUPPLIER = 8;

    /**
     * 权限角色：16客户
     */
    const AUTHORITY_CUSTOM = 16;

    /**
     * 审核状态：1待审核
     */
    const AUDITED_WAIT = 1;

    /**
     * 审核状态：2审核通过
     */
    const AUDITED_APPROVED = 2;

    /**
     * 审核状态：3审核不通过
     */
    const AUDITED_FAILED = 3;

    /**
     * HashIds加盐
     * @var string
     */
    const HASH_ID_SALT = "erp2019010101";

    /**
     * 权限角色
     * @return string[]
     */
    public static function authority(): array
    {
        return [
            self::AUTHORITY_ADMIN => lang('authority admin'),
            self::AUTHORITY_SPREAD => lang('authority spread'),
            self::AUTHORITY_SHOP => lang('authority shop'),
            self::AUTHORITY_SUPPLIER => lang('authority supplier'),
            self::AUTHORITY_CUSTOM => lang('authority custom'),
        ];
    }

    /**
     * 状态描述
     * @return array
     */
    public static function state(): array
    {
        return [
            self::STATE_OK => lang('enable'),
            self::STATE_BAN => lang('disable'),
        ];
    }

    /**
     * 审核描述
     * @return array
     */
    public static function audited(): array
    {
        return [
            self::AUDITED_WAIT => lang('audited wait'),
            self::AUDITED_APPROVED => lang('audited approved'),
            self::AUDITED_FAILED => lang('audited failed'),
        ];
    }
}