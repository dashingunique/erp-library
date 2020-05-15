<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      商品验证层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */
declare (strict_types=1);

namespace erp\validate\goods;

use erp\validate\baseValidate;

class goodsValidate extends baseValidate
{
    protected $name = 'goods';

    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [
        'id|商品信息' => 'require|number|max:22',
        'supplier_id|供应商' => 'require|number|max:22',
        'storehouse_id|仓库信息' => 'require|number|max:22',
        'storehouse_position_id|仓库仓位信息' => 'number|max:22',
        'brand_id|品牌信息' => 'number|max:22',
        'goods_name|商品名称' => 'require|max:100|checkUnique',
        'unit|单位' => 'require|max:20|chsAlpha',
        'cost_price|成本价' => 'require|float|max:11',
        'purchase_price|采购价' => 'require|float|egt:cost_price|max:11',
        'trade_price|批发价' => 'require|float|egt:cost_price|max:11',
        'price|销售价' => 'require|float|egt:cost_price|max:11',
        'stock|库存' => 'number|max:11',
        'thumb|商品主图' => 'require|max:255',
        'remark|商品备注' => 'max:255',
        'state|商品状态' => 'require|number|in:1,2',
        'is_top|置顶' => 'require|number|in:1,2',
        'is_hot|热销' => 'require|number|in:1,2',
        'is_recommend|推荐' => 'require|number|in:1,2',
    ];
}
