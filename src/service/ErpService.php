<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      公用方法
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\service;

use erp\facade\Erp;
use think\Service;
use erp\command\logic;
use erp\command\Validate;
use erp\command\WithModel;
use erp\command\Menu;

class ErpService extends Service
{
    /**
     * 注册服务
     */
    public function register()
    {
        $langPath = Erp::getErpLangPath();
        // 加载中文语言包
        $this->app->lang->load($langPath.'zh-cn.php', 'zh-cn');
        // 加载英文语言包
        $this->app->lang->load($langPath.'en-us.php', 'en-us');
        // 输入变量默认过滤
        $this->app->request->filter(['trim', 'htmlspecialchars', 'addslashes', 'strip_tags']);
    }

    /**
     * 执行服务
     */
    public function boot()
    {
        // 注册系统任务指令
        $this->commands([
            logic::class,
            Validate::class,
            WithModel::class,
            Menu::class,
        ]);
    }
}