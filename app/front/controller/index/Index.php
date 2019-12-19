<?php

declare(strict_types = 1);

namespace app\front\controller\index;

use app\Controller;

class Index extends Controller
{
    public function index()
    {
        return 'front';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
