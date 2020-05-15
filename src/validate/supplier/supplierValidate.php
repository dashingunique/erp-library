<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      验证层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */
declare (strict_types=1);

namespace erp\validate\supplier;

use erp\validate\baseValidate;

class supplierValidate extends baseValidate
{
    protected $name = 'supplier';

    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [
        'id|供应商信息' => 'require|number|max:20',
        'category_id|分类信息' => 'require|number|max:11',
        'name|供应商名称' => 'require|max:20|checkUnique',
        'contact|联系人' => 'require|max:20',
        'mobile|手机号' => 'require|mobile|checkUnique',
        'tel|电话号码' => 'require|max:32',
        'email|邮箱地址' => 'require|email|max:150|checkUnique',
        'qq|QQ' => 'number|max:11',
        'province|省份信息' => 'require|number|max:11',
        'city|市区信息' => 'require|number|max:11',
        'district|地区信息' => 'require|number|max:11',
        'street|街道信息' => 'require|number|max:11',
        'address|详细地址' => 'require|max:150',
        'taxpayer|纳税人识别号' => 'require|max:50',
        'opening_bank|开户行' => 'require|max:50',
        'bank_account|开户行账号' => 'require|max:50',
        'added_rate|增值税税率' => 'require|max:3',
    ];
}
