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

namespace erp\validate\order;

use erp\validate\baseValidate;

class orderTypeStockInValidate extends baseValidate
{
    protected $name = 'order';

    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [
        'id|进货入库单' => 'require|number|max:20',
        'storehouse_id|仓库信息' => 'require|number|max:20',
        'storehouse_position_id|仓库仓位信息' => 'number|max:20',
        'remark|备注信息' => 'max:255',
    ];

    /**
     * @param $value
     * @return bool|string
     */
    public function checkGoods($value)
    {
        $goods = json_decode($value, true);
        if (empty($goods)) {
            return '商品信息缺失';
        }
        $validate = orderGoodsValidate::getInstance()->sceneAdd();
        foreach ($goods as $good) {
            $validate->check($goods);
        }
        return true;
    }

    /**
     * @return orderTypeStockInValidate
     */
    public function sceneCreate()
    {
        return $this->only(['storehouse_id', 'storehouse_position_id', 'remark']);
    }
}
