<?php
/**
 * | Author: paradise <1107842285@qq.com>
 * +----------------------------------------------------------------------
 * | Description: 邮箱信息控制器
 * +----------------------------------------------------------------------
 * Class ${NAME}
 */

namespace erp\command;

use think\console\input\Option;

class Validate extends Make
{
    protected $type = "Validate";

    protected function configure()
    {
        parent::configure();
        $this->setName('erp:validate')
            ->addOption('remark', 'r', Option::VALUE_OPTIONAL, '验证层备注')
            ->setDescription('创建erp系统验证层');
    }

    protected function getStub(): string
    {
        return __DIR__.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'validate.stub';
    }

    protected function getNamespace(string $app): string
    {
        return parent::getNamespace($app).'\\validate';
    }

}