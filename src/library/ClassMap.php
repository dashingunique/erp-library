<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      类的映射类
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\library;

use erp\traits\instanceTrait;
use Symfony\Component\ClassLoader\ClassMapGenerator;

class ClassMap
{
    use instanceTrait;

    /**
     * @param  array  $dirs
     * @return array
     */
    public function getDirsMap(array $dirs)
    {
        $data = [];
        foreach ($dirs as $dir) {
            $data = $this->getDirMap($dir);
        }
        return $data;
    }

    /**
     * 获取指定目录下的所有类
     * @param  string  $dir
     * @return array
     */
    public function getDirMap(string $dir)
    {
        $data = [];
        $dir = app()->getBasePath().$dir;
        if (file_exists($dir)) {
            foreach (ClassMapGenerator::createMap($dir) as $class => $path) {
                $data[$class] = $path;
            }
        }
        return $data;
    }
}