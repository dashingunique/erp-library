<?php
/**
 * 十贰ERP基础异常类
 */
namespace erp\exceptions;


use erp\model\codeModel;
use think\Exception;
use Throwable;

class ErpException extends Exception
{
    public function __construct($message = "", $code = codeModel::ERROR, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}