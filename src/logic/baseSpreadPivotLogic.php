<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      平台基础逻辑层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\logic;

use erp\model\authModel;
use erp\traits\spread\spreadAuthTrait;
use think\db\Query;
use think\Model;

class baseSpreadPivotLogic extends foundationPivotLogic
{
    use spreadAuthTrait;

    /**
     * @param Model $authInfo
     * @return $this|mixed
     */
    protected function setAfterAuthInfo(Model $authInfo)
    {
        parent::setAfterAuthInfo($authInfo);
        $this->setSpreadInfo($authInfo['spread']);
        $this->setSpreadId($authInfo['spread_id']);
        $this->setLoginTerminal(authModel::AUTH_SPREAD);
        return $this;
    }

    // 定义全局的查询范围
    protected $globalScope = ['spread_id'];

    /**
     * 定义全局的新增追加参数
     * @var string[]
     */
    protected $globalInfix = ['spread_id'];

    /**
     * 全局查询参数
     * @param  Query  $query
     */
    public function scopeSpreadId(Query $query)
    {
        if (!empty($this->getSpreadId())) {
            $query->where('spread_id', $this->getSpreadId());
        }
    }

    /**
     * 全局新增时参数
     * @param  Model  $model
     */
    public function infixSpreadId(Model $model)
    {
        if (!empty($this->getSpreadId())) {
            $model->appendData(['spread_id' => $this->getSpreadId()]);
        }
    }
}