<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      菜单导向
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\command;

use erp\library\Node;
use think\console\Command;
use think\console\input\Option;

class Menu extends Command
{
    /**
     * @var array
     */
    protected array $dirs = [];

    protected function configure()
    {
        $this->setName("erp:Menu")
            ->addOption('dir', 'D', Option::VALUE_OPTIONAL | Option::VALUE_IS_ARRAY, '模型文件路径', [])
            ->addOption('ignore', 'I', Option::VALUE_OPTIONAL, '需要忽略的文件', '');
    }

    /**
     * @throws \ReflectionException
     */
    public function handle()
    {
        $this->dirs = array_merge([], $this->input->getOption('dir'));
        $ignore = $this->input->getOption('ignore');
        $this->generateMenu($ignore);
    }

    /**
     * @param  string  $ignore
     * @throws \ReflectionException
     */
    private function generateMenu(string $ignore = '')
    {
        $ignore = explode(',', $ignore);
        Node::getInstance($this->dirs, $ignore)->generateMenu($this->output);
    }
}