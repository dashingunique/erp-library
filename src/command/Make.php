<?php
/**
 * | Author: paradise <1107842285@qq.com>
 * +----------------------------------------------------------------------
 * | Description: 邮箱信息控制器
 * +----------------------------------------------------------------------
 * Class ${NAME}
 */

namespace erp\command;

use think\console\command\Make as ThinkMake;

class Make extends ThinkMake
{
    protected function getPathName(string $name): string
    {
        $name = str_replace('erp\\', '', $name);
        return dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.ltrim(str_replace('\\',
                '/', $name), '/').'.php';
    }

    protected function getStub(): string
    {
        return __DIR__.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'validate.stub';
    }

    protected function getNamespace(string $app): string
    {
        return 'erp'.($app ? '\\'.$app : '');
    }
}