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

declare(strict_types=1);

namespace erp\library\auth;

use app\spread\logic\spread\spreadManagerApplyCancellationLogic;
use app\spread\logic\spread\spreadManagerLogic;
use erp\exceptions\ErpAuthException;
use erp\exceptions\ErpException;
use erp\interfaces\AuthInterface;
use erp\model\codeModel;
use erp\model\manager\spreadManagerMiddlewareModel;
use erp\model\spread\spreadModel;
use thans\jwt\facade\JWTAuth;
use think\Model;

class Spread implements AuthInterface
{
    /**
     * @var Model
     */
    protected Model $auth;

    /**
     * spreadAuth constructor.
     */
    public function __construct()
    {
        $this->auth = spreadManagerLogic::getInstance();
    }

    /**
     * 授权登录信息
     * @return array|\think\Model|null
     * @throws ErpAuthException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function authInfo()
    {
        $jwt = JWTAuth::auth();
        $authInfo = $this->auth
            ->with(['spread', 'manager'])
            ->where($this->auth->getPk(), $jwt['from_id'])
            ->hidden(['password', 'password_hash'])
            ->find();
        $this->checkAuthInfo($authInfo);
        return $authInfo;
    }

    /**
     * 登录
     * @param  array  $param
     * @return mixed|string
     * @throws ErpAuthException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function login(array $param)
    {
        $manager = $this->auth->manager()->withSearch(['username'], $param)->find();
        if (empty($manager)) {
            throw new ErpAuthException('平台管理员信息不存在，请稍后再试', codeModel::NO_AUTH);
        }
        $param['manager_id'] = $manager['id'];
        $authInfo = $this->auth->with(['spread', 'manager'])->withSearch(['spread_id', 'manager_id'], $param)->find();
        $this->checkAuthInfo($authInfo);
        if (!shellPassword($param['password'], $authInfo['password'])) {
            throw new ErpAuthException('密码输入错误', codeModel::AUTH_FAIL);
        }
        $token = JWTAuth::builder(['from_id' => $authInfo['id']]);
        JWTAuth::setToken($token);
        return $token;
    }

    /**
     * 平台管理员注册
     * @param array $param
     * @return mixed|void
     * @throws ErpException
     */
    public function register(array $param)
    {
        throw new ErpException('平台管理员由系统管理员指定');
    }

    /**
     * 退出登录
     * @return bool|mixed
     * @throws ErpException
     */
    public function loginOut()
    {
        $token = JWTAuth::getToken();
        if (!JWTAuth::invalidate($token)) {
            throw new ErpException('退出登录失败，请稍后再试');
        }
        return true;
    }

    /**
     * 平台管理员注销
     * @return mixed|void
     * @throws ErpException
     */
    public function cancellation()
    {
        $authInfo = $this->authInfo();
        $applyData = [
            'spread_id' => $authInfo['spread_id'],
            'manager_id' => $authInfo['manager_id'],
        ];
        if (!spreadManagerApplyCancellationLogic::getInstance()->save($applyData)) {
            recordError('申请注销失败，请稍后再试');
            return false;
        }
        return true;
    }

    /**
     * 验证授权信息
     * @param $authInfo
     * @throws ErpAuthException
     */
    private function checkAuthInfo($authInfo)
    {
        if (empty($authInfo)) {
            throw new ErpAuthException(lang('you are not spread manager'), codeModel::NO_AUTH);
        }
        if ($authInfo['state'] !== spreadManagerMiddlewareModel::STATE_OK) {
            throw new ErpAuthException('您已被禁用或状态异常，请联系管理员', codeModel::AUTH_FAIL);
        }
        if (empty($authInfo['spread'])) {
            throw new ErpAuthException('平台信息不存在或已被删除，请稍后再试', codeModel::AUTH_FAIL);
        }
        if ($authInfo['spread']['state'] !== spreadModel::STATE_OK) {
            throw new ErpAuthException('平台信息异常，请稍后再试', codeModel::AUTH_FAIL);
        }
    }
}