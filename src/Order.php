<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      订单逻辑层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp;

use erp\exceptions\ErpException;
use think\App;
use think\Manager;

abstract class Order extends Manager
{
    /**
     * @var array 初始化参数
     */
    protected array $params = [];

    /**
     * @var array|mixed|null
     */
    protected $config;

    /**
     * Order constructor.
     * @param  App  $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->config = $app->config->get('documents');
    }

    /**
     * @param  mixed  ...$params
     * @return $this
     */
    public function setParams(...$params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * 获取驱动参数
     * @param $name
     * @return array
     */
    protected function resolveParams($name): array
    {
        return $this->params;
    }

    /**
     * 默认驱动
     * @return string|null
     */
    public function getDefaultDriver()
    {
        return null;
    }

    /**
     * 订单驱动类
     * @param  int  $type
     * @return mixed
     */
    abstract public function order(int $type);

    /**
     * @param $type
     * @return bool
     * @throws ErpException
     */
    protected function orderAuthority(int $type)
    {
        if (empty($this->config[$type])) {
            throw new ErpException("订单[$type]类型不存在，请稍后再试");
        }
        if (request()->loginTerminal & $this->config[$type]['auth']) {
            return true;
        }
//        throw new ErpException("没有[".$this->config[$type]['title']."]订单权限");
    }
}