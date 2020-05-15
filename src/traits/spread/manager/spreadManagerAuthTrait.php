<?php

namespace erp\traits\spread\manager;

use think\Model;

trait spreadManagerAuthTrait
{
    /**
     * @var int $managerId 管理员id
     */
    protected int $managerId = 0;

    /**
     * @var Model $managerInfo 管理员信息
     */
    protected Model $managerInfo;

    /**
     * @param Model $managerInfo
     */
    public function setManagerInfo(Model $managerInfo): void
    {
        $this->managerInfo = $managerInfo;
    }

    /**
     * @param int $managerId
     */
    public function setManagerId(int $managerId): void
    {
        $this->managerId = $managerId;
    }

    /**
     * @return int
     */
    public function getManagerId(): int
    {
        return $this->managerId;
    }

    /**
     * @return Model
     */
    public function getManagerInfo(): Model
    {
        return $this->managerInfo;
    }
}
