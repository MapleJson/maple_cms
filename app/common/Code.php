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

    const LOGIN_SUCCESS         = 2000; // 登录成功
    const OK                    = 2001; // 解锁成功
    const EDIT_SUCCESS          = 2002; // 修改成功
    const AUDIT_SUCCESS         = 2003; // 审核成功
    const BALANCE_SUCCESS       = 2004; // 结算成功
    const DELETE_SUCCESS        = 2005; // 删除成功
    const ADD_SUCCESS           = 2006; // 添加成功
    const ENTER_SUCCESS         = 2007; // 录入成功
    const MAINTENANCE_SUCCESS   = 2008; // 维护操作成功
    const CANCEL_SUCCESS        = 2009; // 设置成功
    const MATCH_CREATE_SUCCESS  = 2010; // 赛事生成成功
    const EXEC_SUCCESS          = 2011; // 执行成功
    const GET_INFO_SUCCESS      = 2012; // 获取登陆信息成功
    const KICKING_LINE_SUCCESS  = 2013; // 会员踢线成功
    const EDIT_PASSWORD_SUCCESS = 2014; // 修改密码成功
    const BET_SUCCESS           = 2015; // 下注成功
    const NORMAL                = 2016; // 正常

    const FAIL_TO_ADD          = 1001; // 添加失败
    const FAIL_TO_DELETE       = 1002; // 删除失败
    const FAIL_TO_EDIT         = 1003; // 修改失败
    const FAIL_TO_SELECT       = 1004; // 查询失败
    const NO_THIS_USER         = 1005; // 用户不存在
    const NO_THIS_KEY          = 1017; // key不存在
    const NO_THIS_OPTION       = 1018; // 无此请求方法
    const KEY_NOT_EXISTS       = 1054; // 键名不能为空
    const EMPTY_ONLINE_ACCOUNT = 1055; // 暂无管理员在线

    //盘口
    const HANDICAP_HONGKONG  = 1; // 香港盘
    const HANDICAP_MALAYSIA  = 2; // 马来盘
    const HANDICAP_INDONESIA = 3; // 印尼盘
    const HANDICAP_EA        = 4; // 欧美盘

    //球类类型
    const SINGLE_FOOTBALL     = 1; // 足球单式
    const SOCCER_BALL         = 2; // 足球滚球
    const SINGLE_BASKETBALL   = 3; // 篮球单式
    const BASKETBALL_BALL     = 4; // 篮球滚球
    const SINGLE_VOLLEYBALL   = 5; // 排球单式
    const SINGLE_TENNIS       = 6; // 网球单式
    const SINGLE_BASEBALL     = 7; // 棒球单式
    const FOOTBALL_FIRST_HALF = 8; // 足球上半场

    //注单状态
    const UNTREATED       = 1; // 未处理
    const WIN             = 2; // 赢
    const LOSE_DS         = 3; // 单式输
    const INVALID_BET_DS  = 4; // 无效注单
    const HALF_WIN_DS     = 5; // 赢一半
    const HALF_LOSE_DS    = 6; // 输一半
    const INVALID_BALL    = 7; // 其他无效 进球无效
    const RED_CARD_CANCEL = 8; // 红卡取消
    const TIE_BET_DS      = 9; // 单式和局

    const UNSETTLED = 1; // 未结算
    const SETTLED   = 2; // 已结算
    const LOCK      = 3; // 结算中

    const ZERO  = 0;
    const ONE   = 1;
    const TWO   = 2;
    const THREE = 3;
    const FOUR  = 4;
    const SIX   = 6;

    // 会员现金记录表类型
    const CASH_TYPE_BET        = 1; // 下注
    const CASH_TYPE_PAYOUT     = 2; // 派彩
    const CASH_TYPE_TRANS_IN   = 3; // 额度转入
    const CASH_TYPE_TRANS_OUT  = 4; // 额度转出
    const CASH_TYPE_DEPOSIT    = 5; // 人工存款
    const CASH_TYPE_WITHDRAWAL = 6; // 人工取款
    const CASH_NOTE_CANCEL     = 11; // 取消结算注单

    //皇冠采集账号状态
    const ACCOUNT_TO_ENABLE        = 1; // 账号启用
    const ACCOUNT_IN_USING         = 2; // 账号使用中
    const ACCOUNT_TO_DISABLE       = 3; // 账号封停
    const ACCOUNT_FAIL_TO_PASSWORD = 4; // 账号密码错误

    const REDIS_TYPE_STR  = 1;
    const REDIS_TYPE_SET  = 2;
    const REDIS_TYPE_LIST = 3;
    const REDIS_TYPE_HASH = 5;

    const KEY_ALL    = 1;
    const KEY_PREFIX = 2;
    const KEY_SUFFIX = 3;

    const MATCH_FOOTBALL   = 1; // 足球
    const MATCH_BASKETBALL = 2; // 篮球
    const MATCH_TENNIS     = 3; // 网球
    const MATCH_VOLLEYBALL = 4; // 排球
    const MATCH_BASEBALL   = 5; // 棒球

    //设备类型
    const EQUIPMENT_PC  = 1; // PC
    const EQUIPMENT_WAP = 2; // WAP
    const EQUIPMENT_APP = 3; // APP

    //赛事类型-结算串关专用
    const FOOTBALL      = 1; // 足球
    const BASKETBALL    = 2; // 篮球
    const FOOTBALL_HALF = 3; // 足球上半场

    const DEPOSIT_TYPE    = 1; // 存入
    const WITHDRAWAL_TYPE = 2; // 取出

    const YES = 1; // 是
    const NO  = 2; // 否

    const BUCKLE_TRANS  = 1; // 额度转换模式
    const BUCKLE_WALLET = 2; // 钱包模式

    const DEPOSIT    = 1; // 入款
    const WITHDRAWAL = 2; // 出款

    const IS_SUCCESSFUL = 1; // 成功
    const IS_FAILURE    = 2; // 失败

    const IS_FORMAL = 1; // 正式账号
    const TEST_PLAY = 2; // 试玩账号
    const WITH_PLAY = 3; // 带玩账号

    const ENABLED_STATUS  = 1; // 启用
    const DISABLED_STATUS = 2; // 停用

    const SPORTS_UNITARY         = 1; // 单式
    const SPORTS_SERIES_OF_CLOSE = 2; // 串关

    // 会员在线状态
    const ONLINE  = 1; // 在线
    const OFFLINE = 2; // 离线

}