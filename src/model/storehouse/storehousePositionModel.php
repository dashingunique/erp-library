<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      仓库仓位模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

declare (strict_types=1);

namespace erp\model\storehouse;

class storehousePositionModel
{
    const IS_DEFAULT = 1;       //是否默认仓位 1默认 2不是默认
    const NO_DEFAULT = 2;       //是否默认仓位 1默认 2不是默认

    const STATE_OK = 1;         //状态：1正常
    const STATE_BAN = 2;        //状态：2禁用
}
