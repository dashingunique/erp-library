<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      （平台端）地区控制器
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\controller;

use app\Request;
use erp\logic\regionLogic;

class RegionController
{
    protected $region;

    public function __construct()
    {
        $this->region = regionLogic::getInstance();
    }

    /**
     * 获取地区
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getRegion(Request $request)
    {
        $parentId = $request->param('parent_id/d', 0);
        apiSuccess('success', $this->region->getRegion($parentId));
    }

    /**
     * 获取省份
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getProvince()
    {
        apiSuccess('success', $this->region->getProvince());
    }

    /**
     * 获取城市
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getCity(Request $request)
    {
        $parentId = $request->param('parent_id/d', 0);
        apiSuccess('success', $this->region->getCity($parentId));
    }

    /**
     * 获取地区
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getDistrict(Request $request)
    {
        $parentId = $request->param('parent_id/d', 0);
        apiSuccess('success', $this->region->getDistrict($parentId));
    }

    /**
     * 获取街道
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getStreet(Request $request)
    {
        $parentId = $request->param('parent_id/d', 0);
        apiSuccess('success', $this->region->getStreet($parentId));
    }

    /**
     * 搜索地址
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchRegion(Request $request)
    {
        $parentId = $request->param('parent_id/d', 0);
        $keywords = $request->param('keywords/s', '');
        apiSuccess('success', $this->region->searchRegion($keywords, $parentId));
    }

    /**
     * 搜索省份
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchProvince(Request $request)
    {
        $keywords = $request->param('keywords/s', '');
        apiSuccess('success', $this->region->searchProvince($keywords));
    }

    /**
     * 搜索城市
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchCity(Request $request)
    {
        $parentId = $request->param('parent_id/d', 0);
        $keywords = $request->param('keywords/s', '');
        apiSuccess('success', $this->region->searchCity($keywords, $parentId));
    }

    /**
     * 搜索地区
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchDistrict(Request $request)
    {
        $parentId = $request->param('parent_id/d', 0);
        $keywords = $request->param('keywords/s', '');
        apiSuccess('success', $this->region->searchDistrict($keywords, $parentId));
    }

    /**
     * 搜索街道
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function searchStreet(Request $request)
    {
        $parentId = $request->param('parent_id/d', 0);
        $keywords = $request->param('keywords/s', '');
        apiSuccess('success', $this->region->searchStreet($keywords, $parentId));
    }
}