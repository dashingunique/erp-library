<?php
/**
 * 十贰进销存系统
 * ==========================================================================
 * @link      https://github.com/dashingunique/shier-erp
 * @license   https://github.com/dashingunique/shier-erp/blob/master/LICENSE.txt License
 * @Desc      编码模型
 * ==========================================================================
 * @author    张大宝的程序人生 <1107842285@qq.com>
 */

namespace erp\model;

class codeModel extends baseModel
{
    //逻辑处理类
    const OK = 1000;                 //逻辑成功返回
    const ERROR = 1001;              //逻辑失败返回

    //Auth 验证类
    const NO_AUTH = 2001;            //身份验证错误或登录信息已过期
    const AUTH_FAIL = 2002;          //身份验证失败
    const UNKNOWN_USER = 2003;       //身份信息不存在
    const AUTH_EXPIRE = 2004;        //身份已过期

    //资源请求类
    const REFUSE = 4001;               //服务器拒绝请求
    const NOT_FOUND = 4004;          //未找到相应资源

    /**
     * 返回编码
     * @return array
     */
    public static function code(): array
    {
        return [
            self::OK => lang("response ".self::OK),
            self::ERROR => lang("response ".self::ERROR),
            self::NO_AUTH => lang("response ".self::NO_AUTH),
            self::AUTH_FAIL => lang("response ".self::AUTH_FAIL),
            self::UNKNOWN_USER => lang("response ".self::UNKNOWN_USER),
            self::AUTH_EXPIRE => lang("response ".self::AUTH_EXPIRE),
            self::REFUSE => lang("response ".self::REFUSE),
            self::NOT_FOUND => lang("response ".self::NOT_FOUND),
        ];
    }
}
