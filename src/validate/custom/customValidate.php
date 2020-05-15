<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      客户验证层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */
declare (strict_types=1);

namespace erp\validate\custom;

use erp\model\spread\spreadModel;
use erp\validate\baseValidate;

class customValidate extends baseValidate
{
    protected $name = 'custom';

    protected $pk = 'id';

    protected $uniqueWhere = [
        'spread_id' => spreadModel::STATE_OK,
    ];

    /**
     * @var array
     */
    protected $rule = [
        'id|客户信息' => 'require|number|max:20',
        'mobile|手机号码' => 'require|mobile|checkUnique',
        'email|邮箱地址' => 'require|email|max:150|checkUnique',
        'sex|性别' => 'require|number',
        'birthday|生日' => 'date',
        'login|登录账户' => 'require|unique:custom',
        'true_name|真实姓名' => 'require|max:24',
        'nickname|昵称' => 'max:24',
        'url|个人网址' => 'max:100',
        'avatar|头像地址' => 'max:255',
        'signature|个性签名' => 'max:255',
        'qq|QQ' => 'number|max:12',
        'wx|微信号' => 'max:32',
        'remark|备注信息' => 'max:255',
    ];
}
