<?php

namespace app\common;

/**
 * 对内接口
 * 成功码 2000 开始
 * 错误码 1000 开始 小于 2000
 * 类型、状态等 从 1 开始 小于 100
 *
 * Class Code
 * @package App\Extensions
 */
class Code
{
    const SUCCESS       = 200; // 成功
    const NO_PERMISSION = 403; // 无权访问此接口
    const FAIL_TO_PARAM = 422; // 参数错误

    const FAIL_TO_ADD          = 1001; // 添加失败
    const FAIL_TO_DELETE       = 1002; // 删除失败
    const FAIL_TO_EDIT         = 1003; // 修改失败
    const FAIL_TO_SELECT       = 1004; // 查询失败
    const NO_THIS_USER         = 1005; // 用户不存在
    const NO_THIS_KEY          = 1017; // key不存在
    const NO_THIS_OPTION       = 1018; // 无此请求方法
    const KEY_NOT_EXISTS       = 1054; // 键名不能为空
    const EMPTY_ONLINE_ACCOUNT = 1055; // 暂无管理员在线

    const ZERO  = 0;
    const ONE   = 1;
    const TWO   = 2;
    const THREE = 3;
    const FOUR  = 4;
    const SIX   = 6;

    const REDIS_TYPE_STR  = 1;
    const REDIS_TYPE_SET  = 2;
    const REDIS_TYPE_LIST = 3;
    const REDIS_TYPE_HASH = 5;

    const KEY_ALL    = 1;
    const KEY_PREFIX = 2;
    const KEY_SUFFIX = 3;

    //设备类型
    const EQUIPMENT_PC  = 1; // PC
    const EQUIPMENT_WAP = 2; // WAP
    const EQUIPMENT_APP = 3; // APP

    const YES = 1; // 是
    const NO  = 2; // 否

    const IS_SUCCESSFUL = 1; // 成功
    const IS_FAILURE    = 2; // 失败

    const ENABLED_STATUS  = 1; // 启用
    const DISABLED_STATUS = 2; // 停用

    // 会员在线状态
    const ONLINE  = 1; // 在线
    const OFFLINE = 2; // 离线

}