<?php
declare (strict_types = 1);

namespace app\model\manage;

use think\Model;

/**
 * @mixin Model
 */
class AllRoleRecord extends Model
{
    protected $connection = 'manage';

    protected $schema = [
        'id'              => 'int',
        'pid'             => 'int',
        'name'            => 'string',
        'role_name'       => 'string',
        'url'             => 'string',
        'target'          => 'string',
        'class_type'      => 'int',
        'icon_class_name' => 'string',
    ];

    /**
     * @param array $permission
     *
     * @return array
     */
    public static function getMenuNameByPermission(array $permission)
    {
        try {
            return self::where('class_type', 1)
                ->whereIn('role_name', $permission)
                ->order('id', 'ASC')
                ->select()
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
}
