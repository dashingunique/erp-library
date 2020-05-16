<?php

use think\Response;
use think\exception\HttpResponseException;
use erp\model\codeModel;
use erp\model\commonModel;
use Ramsey\Uuid\Uuid;
use erp\facade\Erp;

// 这是系统自动生成的公共文件
if (!function_exists('apiReturn')) {
    /**
     * 返回提示信息
     * @access protected
     * @param mixed $code 错误码
     * @param mixed $msg 提示信息,若要指定错误码,可以传数组,格式为['code'=>您的错误码,'msg'=>'您的错误消息']
     * @param mixed $data 返回的数据
     * @param array $header 发送的Header信息
     * @return void
     */
    function apiReturn(int $code = codeModel::OK, string $msg = 'success', $data = [], array $header = [])
    {
        if (is_array($msg)) {
            $code = $msg['code'];
            $msg = $msg['msg'];
        }
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];

        $type = 'json';
        $header['Access-Control-Allow-Origin'] = '*';
        $header['Access-Control-Allow-Headers'] = 'X-Requested-With,Content-Type,XX-Device-Type,XX-Token,XX-Api-Version,XX-Wxapp-AppId';
        $header['Access-Control-Allow-Methods'] = 'GET,POST,PATCH,PUT,DELETE,OPTIONS';
        $response = Response::create($result, $type)->header($header);
        throw new HttpResponseException($response);
    }
}

if (!function_exists('apiError')) {
    /**
     * 返回错误信息
     * @access protected
     * @param mixed $msg 提示信息,若要指定错误码,可以传数组,格式为['code'=>您的错误码,'msg'=>'您的错误消息']
     * @param mixed $data 返回的数据
     * @param array $header 发送的Header信息
     * @return void
     */
    function apiError($msg = 'failed', $data = [], array $header = [])
    {
        $result = [
            'code' => codeModel::ERROR,
            'msg' => $msg,
            'data' => $data,
        ];

        $type = 'json';
        $header['Access-Control-Allow-Origin'] = '*';
        $header['Access-Control-Allow-Headers'] = 'X-Requested-With,Content-Type,XX-Device-Type,XX-Token,XX-Api-Version,XX-Wxapp-AppId';
        $header['Access-Control-Allow-Methods'] = 'GET,POST,PATCH,PUT,DELETE,OPTIONS';
        $response = Response::create($result, $type)->header($header);
        throw new HttpResponseException($response);
    }
}

if (!function_exists('apiSuccess')) {
    /**
     * 返回成功信息
     * @access protected
     * @param mixed $msg 提示信息,若要指定错误码,可以传数组,格式为['code'=>您的错误码,'msg'=>'您的错误消息']
     * @param mixed $data 返回的数据
     * @param array $header 发送的Header信息
     * @return void
     */
    function apiSuccess($msg = 'success', $data = [], array $header = [])
    {
        $result = [
            'code' => codeModel::OK,
            'msg' => $msg,
            'data' => $data,
        ];

        $type = 'json';
        $header['Access-Control-Allow-Origin'] = '*';
        $header['Access-Control-Allow-Headers'] = 'X-Requested-With,Content-Type,XX-Device-Type,XX-Token,XX-Api-Version,XX-Wxapp-AppId';
        $header['Access-Control-Allow-Methods'] = 'GET,POST,PATCH,PUT,DELETE,OPTIONS';
        $response = Response::create($result, $type)->header($header);
        throw new HttpResponseException($response);
    }
}

if (!function_exists('apiPaginate')) {
    /**
     * 分页
     * @time 2019年12月06日
     * @param array $list 分页数据内容
     * @return void
     */
    function apiPaginate(array $list)
    {
        $result = [
            'code' => codeModel::OK,
            'msg' => 'success',
            'data' => [
                'page' => $list['page'] ?? commonModel::DEFAULT_PAGE,
                'count' => $list['count'] ?? commonModel::DEFAULT_TOTAL,
                'last_page' => $list['last_page'] ?? commonModel::DEFAULT_LAST_PAGE,
                'data' => $list['data'] ?: [],
            ],
        ];

        $type = 'json';
        $header['Access-Control-Allow-Origin'] = '*';
        $header['Access-Control-Allow-Headers'] = 'X-Requested-With,Content-Type,XX-Device-Type,XX-Token,XX-Api-Version,XX-Wxapp-AppId';
        $header['Access-Control-Allow-Methods'] = 'GET,POST,PATCH,PUT,DELETE,OPTIONS';
        $response = Response::create($result, $type)->header($header);
        throw new HttpResponseException($response);
    }
}

if (!function_exists('filterEmoji')) {

    // 过滤掉emoji表情
    function filterEmoji($str)
    {
        $str = preg_replace_callback(    //执行一个正则表达式搜索并且使用一个回调进行替换
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $str);
        return $str;
    }
}

if (!function_exists('sensitive_words_filter')) {

    /**
     * 敏感词过滤
     * @param string $str
     * @return string
     */
    function sensitive_words_filter(string $str): string
    {
        if (!$str) return '';
        $file = Erp::getErpPath() . '\\static\\plug\\censorwords\\CensorWords';
        $words = file($file);
        foreach ($words as $word) {
            $word = str_replace(["\r\n", "\r", "\n", "/", "<", ">", "=", " "], '', $word);
            if (!$word) continue;

            $ret = preg_match("/$word/", $str, $match);
            if ($ret) {
                return $match[0];
            }
        }
        return '';
    }
}

if (!function_exists('shellPassword')) {
    /**
     * 密码加密方法
     * @param string $password 输入的密码
     * @param string $hash 储存的hash密码
     * @return bool
     */
    function shellPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}


if (!function_exists('encodeId')) {
    /**
     * hashIds加盐数据id
     * @param int    $id
     * @param string $salt
     * @param int    $length
     * @return string
     */
    function encodeId(int $id, string $salt = commonModel::HASH_ID_SALT, int $length = 8): string
    {
        $hash = new Hashids\Hashids($salt, $length);
        return $hash->encode($id);
    }
}

if (!function_exists('decodeStr')) {
    /**
     * 解密字符串获取id
     * @param string $str
     * @param string $salt
     * @param int    $length
     * @return int
     */
    function decodeStr(string $str, string $salt = commonModel::HASH_ID_SALT, int $length = 8): int
    {
        $hash = new Hashids\Hashids($salt, $length);
        $res = $hash->decode($str);

        if (empty($res)) {
            return 0;
        }

        return $res = count($res) > 1 ? $res : $res[0];
    }
}

if (!function_exists('orderSn')) {
    /**
     * 获取唯一的订单编号
     * @return string
     */
    function orderSn(): string
    {
        $uuid = Uuid::uuid1();
        return $uuid->getInteger();
    }
}

if (!function_exists('friendlyDate')) {
    /**
     * 友好的时间显示
     * @param int    $sTime 待显示的时间
     * @param string $type 类型. normal | mohu | full | ymd | other
     * @param string $alt 已失效
     * @return string
     */
    function friendlyDate($sTime, $type = 'normal')
    {
        if (!$sTime) {
            return '';
        }
        //sTime=源时间，cTime=当前时间，dTime=时间差
        $cTime = time();
        $dTime = $cTime - $sTime;
        $dDay = intval(date("z", $cTime)) - intval(date("z", $sTime));
        //$dDay     =   intval($dTime/3600/24);
        $dYear = intval(date("Y", $cTime)) - intval(date("Y", $sTime));
        //normal：n秒前，n分钟前，n小时前，日期
        if ($type == 'normal') {
            if ($dTime < 60) {
                if ($dTime < 10) {
                    return '刚刚';    //by yangjs
                } else {
                    return intval(floor($dTime / 10) * 10) . "秒前";
                }
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
                //今天的数据.年份相同.日期相同.
            } elseif ($dYear == 0 && $dDay == 0) {
                //return intval($dTime/3600)."小时前";
                return '今天' . date('H:i', $sTime);
            } elseif ($dYear == 0) {
                return date("m月d日 H:i", $sTime);
            } else {
                return date("Y-m-d H:i", $sTime);
            }
        } elseif ($type == 'mohu') {
            if ($dTime < 60) {
                return $dTime . "秒前";
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dDay > 0 && $dDay <= 7) {
                return intval($dDay) . "天前";
            } elseif ($dDay > 7 && $dDay <= 30) {
                return intval($dDay / 7) . '周前';
            } elseif ($dDay > 30) {
                return intval($dDay / 30) . '个月前';
            }
            //full: Y-m-d , H:i:s
        } elseif ($type == 'full') {
            return date("Y-m-d , H:i:s", $sTime);
        } elseif ($type == 'ymd') {
            return date("Y-m-d", $sTime);
        } else {
            if ($dTime < 60) {
                return $dTime . "秒前";
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dYear == 0) {
                return date("Y-m-d H:i:s", $sTime);
            } else {
                return date("Y-m-d H:i:s", $sTime);
            }
        }
        return '';
    }
}

if (!function_exists('erp_app_method')) {
    /**
     * 获取应用名称
     * @param string $name
     * @return string
     */
    function erp_app_method(string $name): string
    {
        switch ($name) {
            case 'spread';
                return '平台端';
                break;
            case 'admin':
                return '总后台';
                break;
            case 'user':
                return '用户端';
                break;
            case 'supplier':
                return '供应商端';
                break;
            default:
                return '';
        }
    }
}

if (!function_exists('arr2tree')) {
    /**
     *
     * @param $list
     * @param  string  $key
     * @param  string  $pkey
     * @param  string  $sub
     * @return array
     */
    function arr2tree($list, $key = 'id', $pkey = 'parent_id', $sub = 'sub')
    {
        list($tree, $map) = [[], []];
        foreach ($list as $item) $map[$item[$key]] = $item;
        foreach ($list as $item) if (isset($item[$pkey]) && isset($map[$item[$pkey]])) {
            $map[$item[$pkey]][$sub][] = &$map[$item[$key]];
        } else $tree[] = &$map[$item[$key]];
        unset($map);
        return $tree;
    }
}