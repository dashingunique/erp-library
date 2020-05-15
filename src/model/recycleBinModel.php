<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      回收站模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\model;

class recycleBinModel extends baseModel
{
    /**
     * 回收站：1加入回收站中
     */
    const RECYCLE_BIN = 1;

    /**
     * 回收站：2数据恢复
     */
    const RECYCLE_RECOVER = 2;

    /**
     * 回收站
     * @return array
     */
    public static function recycle()
    {
        return [
            self::RECYCLE_BIN => lang('recycle bin'),
            self::RECYCLE_RECOVER => lang('data recovery'),
        ];
    }
}
