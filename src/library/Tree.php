<?php

namespace erp\library;

use erp\traits\instanceTrait;

/**
 * @author crazymus < QQ:291445576 >
 * @des PHP生成树形结构,无限多级分类
 */
class Tree
{
    use instanceTrait;

    /**
     * 主键名称.
     * @var string
     */
    private string $primary = 'id';

    /**
     * 父键名称.
     * @var string
     */
    private string $parentId = 'parent_id';

    /**
     * 子节点名称.
     * @var string
     */
    private string $child = 'child';

    /**
     * Tree constructor.
     * @param  string  $primary
     * @param  string  $parentId
     * @param  string  $child
     */
    public function __construct($primary = '', $parentId = '', $child = '')
    {
        if (!empty($primary)) {
            $this->primary = $primary;
        }
        if (!empty($parentId)) {
            $this->parentId = $parentId;
        }
        if (!empty($child)) {
            $this->child = $child;
        }
    }

    /**
     * 一维数据数组生成数据树
     * @param  array  $list
     * @return array
     */
    public function arrToTree(array $list): array
    {
        list($tree, $map) = [[], []];
        foreach ($list as $item) {
            $map[$item[$this->primary]] = $item;
        }
        foreach ($list as $item) {
            if (isset($item[$this->parentId]) && isset($map[$item[$this->parentId]])) {
                $map[$item[$this->parentId]][$this->child][] = &$map[$item[$this->primary]];
            } else {
                $tree[] = &$map[$item[$this->primary]];
            }
        }
        unset($map);
        return $tree;
    }

    /**
     * @param  array  $list
     * @return array
     */
    public function arrToTable(array $list)
    {
        $tree = [];
        foreach ($this->arrToTree($list) as $attr) {
            $attr[$this->child] = isset($attr[$this->child]) ? $attr[$this->child] : [];
            $sub = $attr[$this->child];
            unset($attr[$this->child]);
            $tree[] = $attr;
            if (!empty($sub)) {
                $tree = array_merge($tree, $this->arrToTable($sub));
            }
        }
        return $tree;
    }
}