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

namespace erp\validate\supplier;

use erp\validate\baseValidate;

class supplierCategoryValidate extends baseValidate
{
    protected $name = 'supplier_category';

    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id|供应商分类信息' => 'require|number|max:11',
        'name|分类名称' => 'require|checkUnique'
    ];
}
