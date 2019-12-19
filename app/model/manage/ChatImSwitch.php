<?php
declare (strict_types = 1);

namespace app\model\manage;

use think\Model;

/**
 * @mixin Model
 */
class ChatImSwitch extends Model
{
    protected $connection = 'manage';

    /**
     * 查询是否开启聊天im功能
     *
     * @param string $siteId
     *
     * @return mixed
     */
    public static function getChatSwitchBySite(string $siteId)
    {
        return self::where('site_id', $siteId)
            ->where('index_id', 'a')
            ->value('status');
    }
}
