<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\traits\spread;

use think\Model;

trait spreadAuthTrait
{
    /**
     * @var int $spreadId 平台id
     */
    protected $spreadId = 0;

    /**
     * @var Model $spreadInfo 平台信息
     */
    protected $spreadInfo;


    /**
     * @param Model $spreadInfo
     * @return $this
     */
    public function setSpreadInfo(Model $spreadInfo)
    {
        $this->spreadInfo = $spreadInfo;
        return $this;
    }

    /**
     * @return Model
     */
    public function getSpreadInfo(): Model
    {
        return $this->spreadInfo;
    }

    /**
     * @param int $spreadId
     * @return spreadAuthTrait
     */
    public function setSpreadId(int $spreadId)
    {
        $this->spreadId = $spreadId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSpreadId(): int
    {
        return $this->spreadId;
    }
}