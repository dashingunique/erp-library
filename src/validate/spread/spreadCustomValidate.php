<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      平台客户验证层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */
declare (strict_types = 1);

namespace erp\validate\spread;

use erp\validate\baseValidate;

class spreadCustomValidate extends baseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'custom_id|客户信息' => 'require|number|max:20',
    ];

    /**
     * @return spreadCustomValidate
     */
    public function sceneSave()
    {
        return $this->only(['custom_id']);
    }
}
