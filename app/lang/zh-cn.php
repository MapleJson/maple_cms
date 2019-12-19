<?php
/**
 * 所有项目公共语言包
 */

use app\common\Code;

return [

    Code::SUCCESS               => 'SUCCESS',

    Code::FAIL_TO_ADD          => '添加失败',
    Code::FAIL_TO_DELETE       => '删除失败',
    Code::FAIL_TO_EDIT         => '修改失败',
    Code::FAIL_TO_SELECT       => '查询失败',
    Code::NO_THIS_USER         => '用户不存在',
    Code::NO_THIS_KEY          => 'key不存在',
    Code::NO_THIS_OPTION       => '无此请求方法',
    Code::KEY_NOT_EXISTS       => '键名不能为空',
    Code::EMPTY_ONLINE_ACCOUNT => '暂无管理员在线',


    'status'            => [
        Code::ENABLED_STATUS  => '启用',
        Code::DISABLED_STATUS => '停用',
    ],
    'successfulFailure' => [
        Code::IS_SUCCESSFUL => '成功',
        Code::IS_FAILURE    => '失败',
    ],
    'yesNo'             => [
        Code::YES => '是',
        Code::NO  => '否',
    ],
    'redisType'         => [
        Code::REDIS_TYPE_STR  => 'String',
        Code::REDIS_TYPE_SET  => 'Set',
        Code::REDIS_TYPE_LIST => 'List',
        Code::REDIS_TYPE_HASH => 'Hash',
    ],
    'equipmentType'     => [
        Code::EQUIPMENT_PC  => 'PC',
        Code::EQUIPMENT_WAP => 'WAP',
        Code::EQUIPMENT_APP => 'APP',
    ],
];