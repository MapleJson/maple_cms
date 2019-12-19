<?php
declare (strict_types = 1);

namespace app\model\manage;

use think\Model;

/**
 * @mixin Model
 */
class SiteInfo extends Model
{
    protected $connection = 'manage';

    protected $schema = [
        'id'              => 'int',
        'index_id'        => 'string',
        'site_id'         => 'string',
        'fc_module'       => 'string',
        'video_module'    => 'string',
        'site_name'       => 'string',
        'site_admin_user' => 'string',
        'add_date'        => 'datetime',
        'site_skype'      => 'string',
        'site_qq'         => 'string',
        'site_tel'        => 'string',
        'site_code'       => 'string',
        'site_linkman'    => 'string',
        'site_domain'     => 'string',
        'site_bakdomain'  => 'string',
        'company'         => 'string',
        'site_ip'         => 'string',
        'site_state'      => 'string',
        'site_title'      => 'string',
        'admin_url'       => 'string',
        'agent_url'       => 'string',
        'water_id'        => 'int',
        'wap_url'         => 'string',
        'domain_num'      => 'int',
        'package_id'      => 'int',
        'module'          => 'string',
        'dz_module'       => 'string',
        'remark'          => 'string',
        'line_id'         => 'int1',
        'sp_module'       => 'string',
        'online_date'     => 'datetime',
        'category_id'     => 'int',
        'remarks'         => 'string',
        'qp_module'       => 'string',
        'is_https'        => 'int',
    ];
}
