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
declare (strict_types = 1);

namespace erp\validate;

class roleValidate extends baseValidate
{
    /**
     * @var string
     */
    protected string $name = 'role';

    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'id|角色信息' => 'require|number|max:11',
        'name|角色名称' => 'require|number|max:20',
        'parent_id|上级角色信息' => 'number|max:11',
        'remark|备注信息' => 'max:150',
    ];
}
