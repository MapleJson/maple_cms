<?php
declare (strict_types = 1);

namespace app\model\pri;

use app\common\Redis;
use think\Model;

/**
 * @mixin Model
 */
class WebConfig extends Model
{
    protected $connection = 'private';

    /**
     * 根据域名获取站点名称
     *
     * @param string $url
     *
     * @return mixed
     */
    public static function getSiteNameByHost(string $url)
    {
        return self::whereLike('admin_url', "%{$url}%")
            ->where('index_id', 'a')
            ->value('web_name');
    }

    /**
     * 根据站点ID获取站点名称
     *
     * @param string $siteId
     *
     * @return mixed
     */
    public static function getSiteNameBySite(string $siteId)
    {
        if ($siteName = Redis::hGet(getRedis('siteName'), $siteId)) {
            return $siteName;
        }
        $siteName = self::where('site_id', $siteId)
            ->where('index_id', 'a')
            ->value('web_name');
        Redis::hSet(getRedis('siteName'), $siteId, $siteName);

        return $siteName;
    }
}
