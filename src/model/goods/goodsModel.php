<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      商品模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

declare (strict_types = 1);

namespace erp\model\goods;

class goodsModel
{
    const STATE_UP = 1;             //商品状态：1上架中
    const STATE_DOWN = 2;           //商品状态：2下架中

    const IS_HOT = 1;               //是否热销：1是
    const NOT_HOT = 2;              //是否热销：2否

    const IS_NEW = 1;               //是否新品：1是
    const NOT_NEW = 2;              //是佛新品：2否

    const IS_RECOMMEND = 1;         //是否推荐：1是
    const NOT_RECOMMEND = 2;        //是否推荐：2否
}
