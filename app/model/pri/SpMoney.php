<?php
declare (strict_types = 1);

namespace app\model\pri;

use think\Model;

/**
 * @mixin Model
 */
class SpMoney extends Model
{
    protected $connection = 'private';

    /**
     * @param string $siteId
     *
     * @return mixed
     */
    public static function getMoneyBySite(string $siteId)
    {
        return self::where('site_id', $siteId)->value('ty_money');
    }
}
