<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Model;

/**
 * @mixin Model
 */
class SysAdmin extends Model
{
    protected $connection = 'private';

    protected $pk = 'uid';

    protected $schema = [
        'uid'               => 'int',
        'login_name'        => 'string',
        'login_name_1'      => 'string',
        'login_pwd'         => 'string',
        'quanxian'          => 'string',
        'an_quanxian'       => 'string',
        'about'             => 'string',
        'ip'                => 'string',
        'login_ip'          => 'string',
        'login_address'     => 'string',
        'is_login'          => 'int',
        'updatetime'        => 'int',
        'admin_url'         => 'string',
        'address'           => 'string',
        'onlylogin'         => 'int',
        'ssid'              => 'string',
        'add_date'          => 'datetime',
        'is_delete'         => 'int',
        'login_key'         => 'string',
        'agent_id'          => 'int',
        'index_id'          => 'string',
        'site_id'           => 'string',
        'www'               => 'string',
        'type'              => 'string',
        'error_num'         => 'int',
        'mem_auth'          => 'string',
        'catm_max'          => 'int',
        'online_max'        => 'int',
        'initalization_key' => 'string',
        'role'              => 'string',
        'collection'        => 'string',
        'cz_pss'            => 'string',
        'need_pss'          => 'string',
        'login_white_ip'    => 'string',
        'level_auth'        => 'string',
        'catm_max_out'      => 'int',
        'online_max_out'    => 'int',
        'catm_max_inm'      => 'int',
        'company_max'       => 'int',
        'discount_max'      => 'int',
        'catm_max_outm'     => 'int',
        'sub_money'         => 'decimal'
    ];

    /**
     * 获取在线子账号详情
     *
     * @param string $siteId
     * @param array  $ids
     *
     * @return array
     */
    public static function getOnlineAccountList(string $siteId, array $ids)
    {
        try {
            return self::where('site_id', $siteId)
                ->whereIn('uid', $ids)
                ->select()
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param string $password
     * @param string $siteId
     * @param int    $uid
     *
     * @return SysAdmin
     */
    public static function changePassword(string $password, string $siteId, int $uid)
    {
        return self::where('site_id', $siteId)
            ->where('uid', $uid)
            ->update(['login_pwd' => md5(md5($password))]);
    }
}
