<?php
declare (strict_types = 1);

namespace app\model\im;

use think\Model;

/**
 * @mixin Model
 */
class Group extends Model
{
    public $connection = 'pk_im';
}
