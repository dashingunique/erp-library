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

namespace erp\validate\order;

use erp\validate\baseValidate;

class orderGoodsValidate extends baseValidate
{
    protected $name = 'order_goods';

    protected $pk = 'order_id';

    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'goods_id|商品信息' => 'require|number|max:20',
        'goods_spec_id|商品规格信息' => 'require|number|max:20',
        'number|商品数量' => 'require|number|max:8',
        'supplier_id|供应商id' => 'require|number|max:20',
        'brand_id|品牌信息' => 'require|max:20',
        'goods_name|商品名称' => 'require|max:150',
        'unit|单位' => 'require|max:20',
        'bar_code|条形码' => 'max:150',
        'purchase_price|采购价格' => 'require|float|max:11',
        'trade_price|批发价格' => 'require|float|max:11',
        'price|销售价格' => 'require|float|max:11',
        'discount|优惠金额' => 'float|max:11',
        'thumb|商品主图' => 'require|max:255',
        'state|商品状态' => 'require|number|max:4',
    ];
}
