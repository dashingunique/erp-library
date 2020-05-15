<?php
declare (strict_types=1);

namespace erp\controller;

use app\BaseController;
use think\App;

class BaseAppController extends BaseController
{
    /**
     * @var string 应用名称
     */
    protected string $appName;

    /**
     * BaseAppController constructor.
     * @param  App  $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->appName = $app->http->getName();
    }

    /**
     * 获取应用名称
     * @return string
     */
    public function getAppName(): string
    {
        return $this->appName;
    }
}