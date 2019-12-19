<?php
/**
 * 所有项目公共语言包
 */

use app\common\Code;

return [

    Code::SUCCESS               => 'SUCCESS',
    Code::BET_SUCCESS           => '下注成功',
    Code::LOGIN_SUCCESS         => '登陆成功',
    Code::OK                    => 'OK！',
    Code::EDIT_SUCCESS          => '修改成功',
    Code::AUDIT_SUCCESS         => '审核成功',
    Code::BALANCE_SUCCESS       => '结算成功',
    Code::DELETE_SUCCESS        => '删除成功',
    Code::ADD_SUCCESS           => '添加成功',
    Code::ENTER_SUCCESS         => '录入成功',
    Code::MAINTENANCE_SUCCESS   => '维护操作成功',
    Code::CANCEL_SUCCESS        => '设置成功',
    Code::MATCH_CREATE_SUCCESS  => '赛事生成成功',
    Code::EXEC_SUCCESS          => '执行成功',
    Code::GET_INFO_SUCCESS      => '获取登陆信息成功',
    Code::KICKING_LINE_SUCCESS  => '会员踢线成功',
    Code::EDIT_PASSWORD_SUCCESS => '修改密码成功',
    Code::NORMAL                => '正常',

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
    'accountStatus'     => [
        Code::ACCOUNT_TO_ENABLE        => "<font style='color: green'>启用</font>",
        Code::ACCOUNT_IN_USING         => "<font style='color: blue'>使用中</font>",
        Code::ACCOUNT_TO_DISABLE       => "<font style='color: red'>封停</font>",
        Code::ACCOUNT_FAIL_TO_PASSWORD => "<font style='color: rebeccapurple'>密码错误</font>",
    ],
    'settleStatus'      => [
        Code::UNSETTLED => '未结算',
        Code::SETTLED   => '已结算',
        Code::LOCK      => '锁定',
    ],
    'jsStatus'          => [
        Code::UNSETTLED => '未结算',
        Code::SETTLED   => '已结算',
        Code::LOCK      => '锁定',
    ],
    'moneyType'         => [
        Code::DEPOSIT_TYPE    => '存入',
        Code::WITHDRAWAL_TYPE => '取出',
    ],
    'cashType'          => [
        Code::CASH_TYPE_BET        => '下注',
        Code::CASH_TYPE_PAYOUT     => '派彩',
        Code::CASH_TYPE_TRANS_IN   => '额度转入',
        Code::CASH_TYPE_TRANS_OUT  => '额度转出',
        Code::CASH_TYPE_DEPOSIT    => '人工存款',
        Code::CASH_TYPE_WITHDRAWAL => '人工取款',
        Code::CASH_NOTE_CANCEL     => '取消结算注单',
    ],
    'sportsType'        => [
        Code::SPORTS_UNITARY         => '体育单式',
        Code::SPORTS_SERIES_OF_CLOSE => '体育串关',
    ],
    'ballType'          => [
        Code::SINGLE_FOOTBALL     => '足球单式',
        Code::SOCCER_BALL         => '足球滚球',
        Code::SINGLE_BASKETBALL   => '篮球单式',
        Code::BASKETBALL_BALL     => '篮球滚球',
        Code::SINGLE_VOLLEYBALL   => '排球单式',
        Code::SINGLE_TENNIS       => '网球单式',
        Code::SINGLE_BASEBALL     => '棒球单式',
        Code::FOOTBALL_FIRST_HALF => '足球上半场',
    ],
    'handicap'          => [
        Code::HANDICAP_HONGKONG  => '香港盘',
        Code::HANDICAP_MALAYSIA  => '马来盘',
        Code::HANDICAP_INDONESIA => '印尼盘',
        Code::HANDICAP_EA        => '欧美盘',
    ],
    'orderStatus'       => [
        Code::UNTREATED       => '未处理',
        Code::WIN             => '赢',
        Code::LOSE_DS         => '输',
        Code::INVALID_BET_DS  => '无效',
        Code::HALF_WIN_DS     => '赢一半',
        Code::HALF_LOSE_DS    => '输一半',
        Code::INVALID_BALL    => '进球无效',
        Code::RED_CARD_CANCEL => '红卡取消',
        Code::TIE_BET_DS      => '和局',
    ],
    'noteStatus'        => [
        Code::UNTREATED       => '未处理',
        Code::WIN             => '赢',
        Code::LOSE_DS         => '输',
        Code::INVALID_BET_DS  => '无效',
        Code::HALF_WIN_DS     => '赢一半',
        Code::HALF_LOSE_DS    => '输一半',
        Code::INVALID_BALL    => '进球无效',
        Code::RED_CARD_CANCEL => '红卡取消',
        Code::TIE_BET_DS      => '和局',
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
    'isFormal'          => [
        Code::IS_FORMAL => '正式',
        Code::TEST_PLAY => '试玩',
        Code::WITH_PLAY => '带完',
    ],
    'equipmentType'     => [
        Code::EQUIPMENT_PC  => 'PC',
        Code::EQUIPMENT_WAP => 'WAP',
        Code::EQUIPMENT_APP => 'APP',
    ],
];