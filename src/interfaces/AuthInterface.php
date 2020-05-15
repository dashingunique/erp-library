<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      授权接口
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\interfaces;

interface AuthInterface
{
    /**
     * 登录
     * @param array $param
     * @return mixed
     */
    public function login(array $param);

    /**
     * 注册
     * @param array $param
     * @return mixed
     */
    public function register(array $param);

    /**
     * 退出登录
     * @return mixed
     */
    public function loginOut();

    /**
     * 注销账户
     * @return mixed
     */
    public function cancellation();
}