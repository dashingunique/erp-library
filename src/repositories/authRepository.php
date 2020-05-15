<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      授权信息仓库
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\repositories;

use erp\model\codeModel;
use thans\jwt\facade\JWTAuth;
use erp\exceptions\ErpAuthException;
use erp\interfaces\AuthInterface;
use erp\traits\instanceTrait;

class authRepository implements AuthInterface
{
    use instanceTrait;

    /**
     * @var object 逻辑层对象
     */
    protected $logic;

    protected $auth;

    /**
     * authRepository constructor.
     * @throws ErpAuthException
     */
    public function __construct()
    {
        $config = config('auth');
        if (!isset($config['logic'])) {
            throw new ErpAuthException('用户身份验证错误', codeModel::NO_AUTH);
        }
        $this->logic = $config['logic']::getInstance();
    }

    public function authInfo()
    {
        return $this->logic->authInfo();
    }

    /**
     * @return mixed
     * @throws ErpAuthException
     */
    public function authorize()
    {
        try {
            $tokenData = JWTAuth::auth();
        }catch (\Throwable $exception) {
            throw new ErpAuthException('登录已过期,请重新登录');
        }
        return $this->logic->authorize($tokenData);
    }

    /**
     * 登录
     * @param array $param
     * @return mixed
     */
    public function login(array $param)
    {
        return $this->logic->login($param);
    }

    /**
     * 注册
     * @param array $param
     * @return mixed
     */
    public function register(array $param)
    {
        return $this->logic->register($param);
    }

    /**
     * 退出登录
     * @return mixed
     */
    public function loginOut()
    {
        return $this->logic->loginOut();
    }

    /**
     * 注销用户
     * @return mixed
     */
    public function cancellation()
    {
        return $this->logic->cancellation();
    }
}
