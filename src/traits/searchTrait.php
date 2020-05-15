<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\traits;

use think\db\Query;

trait searchTrait
{
    /**
     * @var array 指定搜索器
     */
    protected $searchFields = [];

    /**
     * 主键搜索器
     * @param Query $query
     * @param mixed $value
     * @param array $data
     */
    public function searchIdAttr(Query $query, $value, $data)
    {
        if (!empty($value)) {
            $query->where($this->getPk(), $value);
        }
    }

    /**
     * 平台搜索器
     * @param Query $query
     * @param mixed $value
     * @param array $data
     */
    public function searchSpreadIdAttr(Query $query, $value, $data)
    {
        if (!empty($value)) {
            $query->where('spread_id', $value);
        }
    }

    /**
     * 创建时间搜索器
     * @param Query $query
     * @param mixed $value
     * @param array $data
     */
    public function searchCreateTime(Query $query, $value, $data)
    {
        if (!empty($data['start_time']) && !empty($data['end_time'])) {
            $query->whereBetweenTime('create_time', $data['start_time'], $data['end_time']);
        } else {
            if (!empty($data['start_time'])) {
                $query->whereTime('create_time', '>=', $data['start_time']);
            }
            if (!empty($data['end_time'])) {
                $query->whereTime('create_time', '<=', $data['end_time']);
            }
        }
    }

    /**
     * 状态搜索器
     * @param Query $query
     * @param mixed $value
     * @param array $data
     */
    public function searchStateAttr(Query $query, $value, array $data)
    {
        if (!empty($value)) {
            $query->where('state', $value);
        }
    }

    /**
     * @param Query $query
     * @param mixed $value
     * @param array $data
     */
    public function searchCreateTimeAttr(Query $query, $value, array $data)
    {
        if (!empty($data['start_time']) && !empty($data['end_time'])) {
            $query->whereBetweenTime($this->createTime, $data['start_time'], $data['end_time']);
        } else {
            if (!empty($data['start_time'])) {
                $query->whereTime($this->createTime, '>=', $data['start_time']);
            }
            if (!empty($data['end_time'])) {
                $query->whereTime($this->createTime, '<=', $data['start_time']);
            }
        }
    }

    /**
     * 品牌搜索器
     * @param Query $query
     * @param mixed $value
     * @param array $data
     */
    public function searchBrandIdAttr(Query $query, $value, array $data)
    {
        if (!empty($value)) {
            $query->where('brand_id', $value);
        }
    }

    /**
     * 仓库搜索器
     * @param Query $query
     * @param mixed $value
     * @param array $data
     */
    public function searchStorehouseIdAttr(Query $query, $value, array $data)
    {
        if (!empty($value)) {
            $query->where('storehouse_id', $value);
        }
    }

    /**
     * 仓库仓位搜索器
     * @param Query $query
     * @param mixed $value
     * @param array $data
     */
    public function searchStorehousePositionIdAttr(Query $query, $value, array $data)
    {
        if (!empty($value)) {
            $query->where('storehouse_position_id', $value);
        }
    }

    /**
     * 上级搜索器
     * @param Query $query
     * @param       $value
     * @param array $data
     */
    public function searchParentIdAttr(Query $query, $value, array $data)
    {
        if (!empty($value)) {
            $query->where('parent_id', $value);
        }
    }

    /**
     * 关键词搜索器
     * @param Query $query
     * @param mixed $value
     * @param array $data
     * @return mixed
     */
    public abstract function searchKeywordAttr(Query $query, $value, array $data);
}