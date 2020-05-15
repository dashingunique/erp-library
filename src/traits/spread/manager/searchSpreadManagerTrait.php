<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\traits\spread\manager;

use think\db\Query;

trait searchSpreadManagerTrait
{
    /**
     * 平台管理员搜索器
     * @param Query $query
     * @param mixed $value
     * @param array $data
     */
    public function searchManagerIdAttr(Query $query, $value, $data)
    {
        if (!empty($value)) {
            $query->where('manager_id', $value);
        }
    }

}
