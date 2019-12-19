<?php

declare(strict_types = 1);

namespace app\admin\controller\index;

use app\admin\model\SysAdmin;
use app\common\Code;
use app\Controller;
use app\model\pri\WebConfig;

class Login extends Controller
{
    public function index()
    {
        return view('login/login', [
            'siteName' => WebConfig::getSiteNameByHost($this->request->host())
        ]);
    }

    public function login()
    {
        return 'login success';
    }

    public function changePwd()
    {
        return view('login/changePwd', [
            'loginName' => session('login_name_1')
        ]);
    }

    public function changePwdDo()
    {
        $post = self::post(__FUNCTION__);
        if (SysAdmin::changePassword($post['password'], SITE_ID, (int)session('adminid'))) {
            return $this->responsePopup(Code::EDIT_SUCCESS);
        }
        return $this->responsePopup(Code::FAIL_TO_EDIT, false);
    }
}
