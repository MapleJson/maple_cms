<?php

declare (strict_types = 1);

namespace app\admin\validate;

/**
 * 自定义某方法接受的参数验证不通过时的提示信息
 * 其常量名需和Rule类保持一致
 * Class Message
 * @package app\admin\validate
 */
class Message
{
    public static $changePwdDo = [
        'password.require' => '密码必填',
        'password.min'     => '密码最少6位',
        'password.confirm' => '两次密码不一致',
    ];
}