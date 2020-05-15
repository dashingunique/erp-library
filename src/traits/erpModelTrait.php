<?php


namespace erp\traits;

use Closure;
use think\helper\Str;

trait erpModelTrait
{
    /**
     * @var int 页码数
     */
    protected $page;

    /**
     * @var int 每页显示条数
     */
    protected $size;

    /**
     * @var string 排序方式
     */
    protected $orderDesc = 'create_time desc';

    /**
     * @var array
     */
    protected $hiddenField = [];

    /**
     * 全局新增之前插入参数
     * @var string[]
     */
    protected $globalInfix = [];

    /**
     * 获取表字段信息
     * @return array
     */
    public function getSchema(): array
    {
        if (!empty($this->schema)) {
            return $this->schema;
        }
        $query = $this->db();
        $table = $this->table ? $this->table . $this->suffix : $query->getTable();

        return $query->getConnection()->getTableFields($table);
    }

    /**
     * 添加插入前数据
     * @access public
     * @param array|string|Closure $infix 在插入之前新增的参数
     * @param array                $args  参数
     * @return $this
     */
    public function infix($infix, ...$args)
    {
        // 查询范围的第一个参数始终是当前查询对象
        array_unshift($args, $this);

        if ($infix instanceof Closure) {
            call_user_func_array($infix, $args);
            return $this;
        }

        if (is_string($infix)) {
            $infix = explode(',', $infix);
        }
        if ($this) {
            // 检查模型类的查询范围方法
            foreach ($infix as $name) {
                $method = 'infix' . Str::studly(trim($name));
                if (method_exists($this, $method)) {
                    call_user_func_array([$this, $method], $args);
                }
            }
        }
        return $this;
    }
}