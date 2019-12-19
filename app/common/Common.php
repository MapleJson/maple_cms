<?php

declare (strict_types = 1);

namespace app\common;

class Common
{
    /**
     * 获取在线人数
     *
     * @param string $siteId
     *
     * @return int
     */
    public static function getOnlineUserCountBySite(string $siteId)
    {
        $onlineUsers = Redis::hGetAll(getRedis('frontUserInfo'));
        if (empty($onlineUsers)) {
            return 0;
        }
        $siteUsers = [];
        foreach ($onlineUsers as $key => $onlineUser) {
            if (json_decode($onlineUser, true)['site_id'] === $siteId) {
                $siteUsers[] = $key;
            }
        }
        unset($onlineUsers);

        return count(array_filter($siteUsers));
    }

    /**
     * 管理员在线总数
     *
     * @param string $siteId
     *
     * @return array
     */
    public static function getOnlineAccountCountBySite(string $siteId)
    {
        $onlineAdmins = Redis::hGetAll(getRedis('adminUserInfo'));
        if (empty($onlineAdmins)) {
            return [];
        }
        $siteAdmins = [];
        foreach ($onlineAdmins as $key => $admin) {
            if (json_decode($admin, true)['site_id'] === $siteId) {
                $siteAdmins[] = $key;
            }
        }
        unset($onlineAdmins);

        return array_filter($siteAdmins);

    }
}