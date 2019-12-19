<?php
declare (strict_types = 1);

namespace app\model\video;

use think\Model;

/**
 * @mixin Model
 */
class VideoNote extends Model
{
    public $connection = 'video';
}
