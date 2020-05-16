<?php

namespace erp;

// 应用请求对象类
use erp\traits\erpAuthTrait;
use think\Model;
use think\Request as BaseRequest;

class Request extends BaseRequest
{
    use erpAuthTrait;

    /**
     * @inheritDoc
     * @param  Model  $authInfo
     * @return Request
     */
    public function setAfterAuthInfo(Model $authInfo)
    {
        $this->setAuthInfo($authInfo);
        $this->setIsLogin();
        return $this;
    }
}
