<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      底层授权类
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\middleware;

use erp\Auth;
use Closure;
use erp\model\authModel;
use erp\Request;
use think\Response;

class AuthMiddleware
{
    /**
     * @param  Request  $request
     * @param  Closure  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next)
    {
        $Auth = new Auth(app());
        $authInfo = $Auth->auth(app()->http->getName())
            ->authInfo();
        $request->setLoginTerminal(authModel::AUTH_SPREAD);
        $request->setAfterAuthInfo($authInfo);
        return $next($request);
    }
}