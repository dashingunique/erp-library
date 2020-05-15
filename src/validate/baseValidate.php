<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      基础验证层
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */
declare (strict_types=1);

namespace erp\validate;

use erp\traits\instanceTrait;
use think\helper\Str;
use think\Validate;
use function GuzzleHttp\Psr7\build_query;

class baseValidate extends Validate
{
    use instanceTrait;

    /**
     * @var string 关联数据表名称
     */
    protected string $name;

    /**
     * 数据表主键 复合主键使用数组定义
     * @var string|array
     */
    protected string $pk = 'id';

    /**
     * @var array 数据表字段
     */
    protected array $schemas = [];

    /**
     * @var bool 验证失败抛出异常
     */
    protected $failException = true;

    /**
     * @var array
     */
    protected array $uniqueWhere = [];

    /**
     * @var string[]
     */
    protected $regex = ['tel', "/^([1]\d{10}|([\(（]?0[0-9]{2,3}[）\)]?[-]?)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?)$/"];

    /**
     * @return array
     */
    public function getSchemas()
    {
        if (empty($this->schemas)) {
            $table = config('database.connections.mysql.prefix').$this->getName();
            $this->schemas = $this->db->getTableFields($table);
        }
        return array_values($this->schemas);
    }

    /**
     * @return string 获取当前验证器对应的数据库名称
     */
    public function getName()
    {
        if (empty($this->name)) {
            $name = str_replace('\\', '/', static::class);
            $this->name = Str::snake(basename($name));
            if (strpos($this->name, 'validate')) {
                list($validateName) = explode('validate', $this->name);
                $this->name = Str::snake($validateName);
            }
        }
        return $this->name;
    }

    /**
     * 添加场景
     * @return baseValidate
     */
    public function sceneAdd()
    {
        return $this->only(array_diff($this->getSchemas(), [$this->pk]));
    }

    /**
     * 编辑场景
     * @return baseValidate
     */
    public function sceneEdit()
    {
        return $this->only($this->getSchemas());
    }

    /**
     * 设置自定义的unique方法的其他条件
     * @param  array  $param
     * @example ['state' => 1]
     */
    public function setUniqueWhere($param = []): void
    {
        $this->uniqueWhere = $param;
    }

    /**
     * 获取自定义的unique方法的其他条件
     * @return array
     * @example ['state' => 1]
     */
    public function getUniqueWhere(): array
    {
        return $this->uniqueWhere;
    }

    /**
     * 验证数据是否已经存在数据库中
     * 区别新增和编辑操作，如果是新增判断时候已经存在数据
     * 编辑时验证是否改动当前数据，如果数据改动才验证数据是否已经存在
     * @param  mixed  $value  当前验证字段值
     * @param  mixed  $rule  当前验证字段规则
     * @param  array  $data  当前验证器的数据
     * @param  mixed  $field  当前验证的字段
     * @param  mixed  $title  当前字段标题
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function checkUnique($value, $rule, $data, $field, $title)
    {
        $uniqueRule = $this->getName();
        if (!empty($data[$this->pk])) {
            $info = $this->db->name($this->getName())->failException()->find($this->pk);
            if ($info[$field] !== $value) {
                return true;
            }
        }
        if (!empty($this->uniqueWhere)) {
            $uniqueRule .= ','.build_query($this->uniqueWhere);
        }
        if (!$this->unique($value, $uniqueRule, $data, $field)) {
            $desc = $title ?? '信息';
            return $desc .'已经存在，请确认';
        }
        return true;
    }
}