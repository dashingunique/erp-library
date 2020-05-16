<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      Filesystem组件为文件系统提供基本功能。(symfony)
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\facade;

use Symfony\Component\Filesystem\Filesystem;
use think\Facade;
use Traversable;

/**
 * @method void copy(string $originFile, string $targetFile, bool $overwriteNewerFiles = false) static 用于拷贝文件。如果目标已经存在，则文件只在源文件的修改日期晚于目标文件时才拷贝。这个行为可以被第三个布尔值参数所覆盖:
 * @method void mkdir($dirs, int $mode = 0777) static 创建一个目录。在POSIX文件系统上，目录默认被创建为 0777 模式。你可以使用第二个参数来设置自己的mode：
 * @method bool exists(mixed $files) static 检查所有的文件/目录是否存在，如果找不到就返回 false :
 * @method void touch($files, int $time = null, int $atime = null) 对一个文件设置访问和修改时间。默认使用当前时间。你可以通过第二个参数设置成你自己的。第三个参数是访问时间：
 * @method void remove(mixed $files) 可以轻松地删除文件, symlinks, 目录等等:
 * @method void chmod($files, int $mode, int $umask = 0000, bool $recursive = false) 用于改变文件的mode（安全模式）。第四个参数是一个布尔值的递归选项:
 * @method void chown($files, $user, bool $recursive = false) static 用于改变文件的owner（创建者）。第三个参数是一个布尔值的递归选项:
 * @method void chgrp($files, $group, bool $recursive = false) static 用于改变一个文件的群组。第三个参数是一个布尔值的递归选项:
 * @method void rename(string $origin, string $target, bool $overwrite = false) static 用于对文件和目录重命名:
 * @method bool isReadable(string $filename) static 检测文件是否存在是否可读
 * @method void symlink(string $originDir, string $targetDir, bool $copyOnWindows = false) static 创建符号链接或复制目录
 * @method void hardlink(string $originFile, $targetFiles) static 创建一个硬链接，或几个硬链接到一个文件中。
 * @method void readlink(string $path, bool $canonicalize = false) static 解决了路径链接
 * @method string makePathRelative(string $endPath, string $startPath) static 鉴于现有的路径，将其转换为相对于给定的起始路径的路径
 * @method void mirror(string $originDir, string $targetDir, Traversable $iterator = null, array $options = []) static 镜像了一个目录:
 * @method bool isAbsolutePath(string $file) static 如果给定的是绝对路径的话；否则返回 false :
 * @method string tempnam(string $dir, string $prefix) static 创建一个自定义流包装支持的临时文件
 * @method void dumpFile(string $filename, $content) static 内容转储到一个文件中
 * @method void appendToFile(string $filename, $content) static 内容附加到现有文件
 */
class SymfonyFile extends Facade
{
    /**
     *  获取当前Facade对应类名
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {
        return Filesystem::class;
    }
}