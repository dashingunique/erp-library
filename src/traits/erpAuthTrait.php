<?php

namespace erp\traits;

use think\Model;

trait erpAuthTrait
{
    /**
     * 登录角色信息
     * @var
     */
    protected Model $authInfo;

    /**
     * @var bool 是否登录
     */
    protected bool $isLogin = false;

    /**
     * @var int 登录类型
     */
    protected int $loginTerminal = 0;

    /**
     * @var int 来源id
     */
    protected int $fromId = 0;

    /**
     * 设置是否登录
     * @return void
     */
    public function setIsLogin(): void
    {
        $this->isLogin = true;
    }

    /**
     * @return bool
     */
    public function getIsLogin(): bool
    {
        return $this->isLogin;
    }

    /**
     * 设置授权用户信息
     * @param Model $authInfo
     * @return void
     */
    public function setAuthInfo(Model $authInfo): void
    {
        $this->authInfo = $authInfo;
    }

    /**
     * 获取授权用户信息
     * @return Model
     */
    public function getAuthInfo(): Model
    {
        return $this->authInfo;
    }

    /**
     * @param int $fromId 来源id
     */
    public function setFromId(int $fromId): void
    {
        $this->fromId = $fromId;
    }

    /**
     * @return int 获取来源id
     */
    public function getFromId(): int
    {
        return $this->fromId;
    }

    /**
     * @param  int  $auth
     * @return void 设置登录权限
     */
    public function setLoginTerminal(int $auth): void
    {
        $this->loginTerminal = $auth;
    }

    /**
     * @return int 获取登录权限
     */
    public function getLoginTerminal(): int
    {
        return $this->loginTerminal;
    }

    /**
     * 设置授权信息
     * @param Model $authInfo
     * @return mixed
     */
    abstract public function setAfterAuthInfo(Model $authInfo);
}