<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      商品品牌验证层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */
declare (strict_types = 1);

namespace erp\validate\goods;

use erp\validate\baseValidate;

class brandValidate extends baseValidate
{
    /**
     * @var string
     */
    protected $name = 'goods_brand';

    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [
        'id|品牌信息' => 'require|number|max:22',
        'name|品牌名称' => 'require|max:50|checkUnique',
        'images|品牌图标' => 'max:150',
        'ad|品牌广告图' => 'max:150',
    ];
}
