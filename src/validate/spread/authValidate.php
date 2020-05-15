<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      平台授权验证层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */
declare (strict_types = 1);

namespace erp\validate\spread;

use erp\validate\baseValidate;

class authValidate extends baseValidate
{
    protected $name = 'spread_manager';

    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [
        'spread_id|平台信息' => 'require|number|max:20',
        'username|登录账户' => 'require|max:32',
        'password|登录密码' => 'require|max:32',
    ];

    /**
     * @return authValidate
     */
    public function sceneLogin()
    {
        return $this->only(['spread_id', 'username', 'password']);
    }
}
