<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      单据模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

declare (strict_types=1);

namespace erp\model\order;

class orderModel
{
    const POST_STATUS_WAIT = 1;     //过账状态：1待过账
    const POST_STATUS_OK = 2;       //过账状态：2已过账
    const POST_STATUS_REFUND = 3;   //过账状态：3已驳回

    const PAY_STATUS_WAIT = 1;      //支付状态：1待支付
    const PAY_STATUS_OK = 2;        //支付状态：2已支付
    const PAY_STATUS_REFUND = 3;    //支付状态：3已退款

    const ORDER_STATUS_LOSE = 1;    //单据状态：1未结算
    const ORDER_STATUS_SUCCESS = 2; //单据状态：2已结算
    const ORDER_STATUS_CANCELING = 3;//单据状态：3结算中
    const ORDER_STATUS_CANCEL = 4;  //单据状态：4已撤销

    /**
     * @description 进货业务
     */
    const ORDER_TYPE_STOCK = 101;         //单据类型：1.进货单  （向供应商提前预定，商品还未入库）
    const ORDER_TYPE_STOCK_IN = 102;      //单据类型：2.进货入库单 （从供应商处进货，过账后库存、金额将变化）
    const ORDER_TYPE_STOCK_REFUND = 103;  //单据类型：3.进货退货单 （把商品退还给供应商）
    const ORDER_TYPE_STOCK_PAY = 104;     //单据类型：4.进货付款单 （向供应商预付贷款、付款、结算欠款等）

    /**
     * @description 销售业务
     */
    const ORDER_TYPE_SALE = 201;          //单据类型：5.销售订单  （向客户提前预定商品，商品还未出库）
    const ORDER_TYPE_WHOLESALE = 202;     //单据类型：6.批发单  （向批发客户销售、过账后库存、金额等将变化）
    const ORDER_TYPE_RETAIL = 203;        //单据类型：7.零售单  （向零售客户销售、过账后库存、金额等将变化）
    const ORDER_TYPE_SALE_REFUND = 204;   //单据类型：8.销售退货单 （客户把商品退给我）
    const ORDER_TYPE_SALE_GATHERING = 205;//单据类型：9.销售收款单   （向客户预收贷款、收款、结算欠款等）

    /**
     * @description 库存业务
     */
    const ORDER_TYPE_STOREHOUSE_CHECK = 301;         //单据类型：10.库存盘点单 （盘点商品的实际库存，且可做盈亏处理）
    const ORDER_TYPE_STOREHOUSE_ALLOCATION = 302;    //单据类型：11.调拨单   （如：把商品从A仓库调到B仓库）
    const ORDER_TYPE_STOREHOUSE_DISMOUNTING = 303;   //单据类型：12.拆装单   （商品之间的组合拆分）
    const ORDER_TYPE_STOREHOUSE_OTHER_STOCK = 304;   //单据类型：13.其他入库单 （除正常正常进货外的进货商品，如商家的赠品等）
    const ORDER_TYPE_STOREHOUSE_OTHER_OUT = 305;     //单据类型：14.其他出库单  （除正常销售外的其他出库，如送给客户赠品等）
    const ORDER_TYPE_STOREHOUSE_COST_CHANGE = 306;   //单据类型：15.成本调整单  （修改、调整店仓内商品的成本价）
    const ORDER_TYPE_STOREHOUSE_STOCK_CHANGE = 307;  //单据类型：16.库存调整单  （修改、调整店仓内商品的库存数量）
}
