<?php
declare (strict_types = 1);

namespace app\model\pri;

use think\Model;

/**
 * @mixin Model
 */
class SiteNotice extends Model
{
    protected $connection = 'private';

    /**
     * 获取多条重要通知数据和客户通知
     *
     * @param string $siteId
     *
     * @return array
     */
    public static function getNoticeBySite(string $siteId)
    {
        try {
            $notices = self::where(['notice_state' => 1, 'notice_newtype' => 0])
                ->whereIn('notice_newstate', [1, 3])
                ->whereIn('notice_cate', [6, 8])
                ->order('id', 'DESC')
                ->select()
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }

        $siteNotice = [];
        foreach ($notices as $notice) {
            if ((string)$notice['sid'] !== '0') {
                if (in_array($siteId, explode(',', $notice['sid']), true)) {
                    array_push($siteNotice, $notice);
                }
            }
        }
        unset($notices);

        return $siteNotice;
    }

}
