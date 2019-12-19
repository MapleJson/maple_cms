<?php
declare (strict_types = 1);

namespace app\model\manage;

use think\Model;

/**
 * @mixin Model
 */
class AgSiteRole extends Model
{
    protected $connection = 'manage';

    protected $schema = [
        'id'         => 'int',
        'site_id'    => 'string',
        'quanxian'   => 'string',
        'g_quanxian' => 'string',
    ];

    /**
     * @param string $siteId
     *
     * @return array
     */
    public static function getRoleBySite(string $siteId)
    {
        $role = self::where('site_id', $siteId)->value('quanxian');

        return array_filter(array_unique(explode(',', $role ?: '')));
    }
}
