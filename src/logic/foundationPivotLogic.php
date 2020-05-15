<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\logic;

use erp\exceptions\ErpException;
use erp\model\commonModel;
use erp\traits\erpAuthTrait;
use erp\traits\erpModelEventTrait;
use erp\traits\erpModelTrait;
use erp\traits\searchTrait;
use think\db\Query;
use think\facade\Validate;
use think\Model;
use think\model\concern\SoftDelete;
use think\model\Pivot;
use erp\traits\instanceTrait;
use think\model\relation\MorphTo;
use think\Paginator;

class foundationPivotLogic extends Pivot
{
    use SoftDelete;

    //软删除

    use instanceTrait;

    //获取模型的单例

    use erpAuthTrait;

    //获取搜全信息

    use erpModelEventTrait;

    //获取模型关联的数据

    use searchTrait;

    //搜索器

    use erpModelTrait;

    //模型额外属性

    /**
     * @var string 默认软删除字段
     */
    protected $deleteTime = 'delete_time';

    /**
     * @var int 默认软删除时间
     */
    protected $defaultSoftDelete = 0;

    /**
     * @var bool 是否自动写入时间戳
     */
    protected $autoWriteTimestamp = true;

    /**
     * 初始化
     * foundationLogic constructor.
     * @param  array  $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->page = request()->param('page/d', commonModel::DEFAULT_PAGE);
        $this->size = request()->param('size/d', commonModel::DEFAULT_SIZE);
        if (request()->getIsLogin()) {
            $authInfo = request()->getAuthInfo();
            $this->setAfterAuthInfo($authInfo);
        }
    }

    /**
     * 关键词搜索器
     * @inheritDoc
     */
    public function searchKeywordAttr(Query $query, $value, array $data)
    {
        if (!empty($value)) {
            if (!empty($value)) {
                if (Validate::is($value, 'mobile')) {
                    $query->where('mobile', $value);
                } elseif (Validate::is($value, 'email')) {
                    $query->where('email', $value);
                } else {
                    $query->where('login', $value);
                }
            }
        }
    }

    /**
     * @param  int  $id
     * @param  int  $state
     * @return bool
     * @throws ErpException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function switchState(int $id, int $state): bool
    {
        $info = $this->failException()->find($id);
        if (!$info->save()) {
            throw new ErpException('切换状态失败,请稍后再试');
        }
        return true;
    }

    /**
     * 删除数据信息
     * @param  int  $id  数据id
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \Exception
     */
    public function deleteInfo(int $id)
    {
        $info = $this->find($id);
        if (empty($info)) {
            throw new ErpException('信息不存在或已被删除');
        }
        if (!$info->delete()) {
            throw new ErpException('删除信息失败，请稍候再试');
        }
        return true;
    }

    /**
     * 设置授权信息
     * @param $authInfo
     * @return mixed
     */
    protected function setAfterAuthInfo(Model $authInfo)
    {
        $this->setAuthInfo($authInfo);
        $this->setFromId($authInfo['id']);
        $this->setIsLogin();
        return $this;
    }

    /**
     * 获取数据的列表信息
     * @param  array  $param
     * @return array
     * @throws \ReflectionException
     * @throws \think\db\exception\DbException
     */
    public function getListOfPage(array $param = [])
    {
        $result = [
            'page' => $this->page,
            'count' => commonModel::DEFAULT_COUNT,
            'last_page' => commonModel::DEFAULT_LAST_PAGE,
            'data' => [],
        ];

        $data = $this->listByPaginate($param);

        $result['page'] = $data->currentPage();
        $result['count'] = $data->total();
        $result['last_page'] = $data->lastPage();
        $result['data'] = $data->items();

        return $result;
    }

    /**
     * 获取分页器数据
     * @param  array  $param
     * @return Paginator
     * @throws \think\db\exception\DbException
     * @throws \ReflectionException
     */
    public function listByPaginate(array $param = [])
    {
        return $this
            ->with($this->getWithWhere())
            ->withSearch($this->searchFields, $param)
            ->hidden($this->hiddenField)
            ->order($this->orderDesc)
            ->paginate($this->size);
    }

    /**
     * 获取列表信息
     * @param  array  $param
     * @return array|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \ReflectionException
     */
    public function getList(array $param = []): array
    {
        $data = $this
            ->with($this->getWithWhere())
            ->withSearch($this->searchFields, $param)
            ->hidden($this->hiddenField)
            ->order($this->orderDesc)
            ->select();
        if (empty($data)) {
            return [];
        }
        return $data->toArray();
    }

    /**
     * 获取信息
     * @param  array  $param
     * @return array|Model|null
     * @throws \ReflectionException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getInfo(array $param = [])
    {
        return $this
            ->with($this->getWithWhere())
            ->withSearch($this->searchFields, $param)
            ->failException()
            ->find();
    }

    /**
     * 新增前置操作
     * @param  self  $model
     * @return mixed|void
     */
    public static function onBeforeInsert(self $model)
    {
        $globalScope = $model->globalInfix;
        $model->infix($globalScope);
    }
}