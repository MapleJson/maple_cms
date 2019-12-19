<?php

declare (strict_types = 1);

namespace app\admin\validate;

/**
 * 自定义某方法接受的参数验证规则
 * 其常量名需和Message类保持一致
 * Class Rule
 * @package app\admin\validate
 */
class Rule
{
    public static $changePwdDo = [
        'password' => 'require|min:6|confirm',
    ];
}