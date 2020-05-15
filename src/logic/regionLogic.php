<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      （平台端）地区逻辑层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\logic;

use think\facade\Db;

class regionLogic extends foundationLogic
{
    /**
     * @var string 数据表名
     */
    protected $name = 'region';

    /**
     * @var string 数据表主键
     */
    protected $pk = 'id';

    /**
     * @var array
     */
    protected $config = [
        //查询缓存秒数，false为不缓存
        'cache' => 20140210,
        //查询字段，可选项：id,name,parent_id,initial,pinyin,citycode,adcode,lng_lat
        'field' => '*',
        //排序，默认为adcode正序
        'order' => 'adcode asc',
    ];

    /**
     * 获取地区
     * @param int $parentId
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getRegion($parentId = 0)
    {
        return $this
            ->where('parent_id', $parentId)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }

    /**
     * 获取省份
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getProvince()
    {
        return $this
            ->where('level', 1)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }

    /**
     * 获取城市
     * @param $parentId
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getCity($parentId)
    {
        return $this
            ->where('parent_id', $parentId)
            ->where('level', 2)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }

    /**
     * 获取地区
     * @param $parentId
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getDistrict($parentId)
    {
        return $this
            ->where('parent_id', $parentId)
            ->where('level', 3)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }

    /**
     * 获取街道
     * @param $parentId
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getStreet($parentId)
    {
        return $this
            ->where('parent_id', $parentId)
            ->where('level', 4)
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }

    /**
     * 搜索地址
     * @param     $keywords
     * @param int $parentId
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchRegion($keywords, $parentId = 0)
    {
        return $this
            ->where('parent_id', $parentId)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }

    /**
     * 搜索省份
     * @param $keywords
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchProvince($keywords)
    {
        return $this
            ->where('level', 1)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }

    /**
     * 搜索城市
     * @param     $keywords
     * @param int $parentId
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchCity($keywords, $parentId = 0)
    {
        return $this
            ->where('level', 2)
            ->where('parent_id', $parentId)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }

    /**
     * 搜索地区
     * @param     $keywords
     * @param int $parentId
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchDistrict($keywords, $parentId = 0)
    {
        return $this
            ->where('level', 3)
            ->where('parent_id', $parentId)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }

    /**
     * 搜索街道
     * @param     $keywords
     * @param int $parentId
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchStreet($keywords, $parentId = 0)
    {
        return $this
            ->where('level', 4)
            ->where('parent_id', $parentId)
            ->whereLike('name|initial|pinyin', '%' . $keywords . '%')
            ->field($this->config['field'])
            ->cache($this->config['cache'])
            ->order($this->config['order'])
            ->select();
    }
}