<?php
declare (strict_types = 1);

namespace app\middleware;

use app\common\Redis;

class Auth
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @param  string        $project
     *
     * @return \think\Response
     */
    public function handle($request, \Closure $next, string $project)
    {
        session_start();
        $check = $this->{$project . 'Auth'}($request);
        if ($check instanceof \think\Response) {
            return $check;
        }

        return $next($request)->cookie('last_time', (string)time(), 36000);
    }

    /**
     * 客户后台验证登陆
     *
     * @param \think\Request $request
     *
     * @return \think\Response|bool
     */
    private function adminAuth($request)
    {
        $redirect = '<script>alert("请重新登录!!");top.parent.location.href="' .
            url('login.index')->domain($request->host())->build() .
            '";</script>';
        // session 不存在时跳转登陆页
        if (!session('?login_name_1') || !session('?adminid')) {
            return redirect(url('login.index')->build());
        }
        // 域名不匹配时跳转登陆页
        if (session('?admin_domain')) {
            if (!in_array($request->host(), explode(',', session('admin_domain')))) {
                session(null);
                return response($redirect);
            }
        }
        // 锁屏状态
        if (session('lock_screen')) {
            return redirect('http://' . $request->host() . '/lock.html');
        }
        // redis中找不到对应信息时跳转登陆页
        $admin = Redis::hGet(getRedis('adminUserInfo'), session('adminid'));
        if (empty($admin)) {
            return response($redirect);
        }
        // session_id 不存在或不匹配时跳转登陆页
        if (!session('?ssid') || json_decode($admin, true)['sid'] != session('ssid')) {
            session(null);
            return response($redirect);
        }
        unset($redirect);
        // 验证登录成功，将站点ID设置为常量,避免项目使用时多次读取session
        defined('SITE_ID') ?: define('SITE_ID', session('site_id'));
        // 向控制器传入参数，是否是超管
        if (session('quanxian') === 'sadmin') {
            $request->isSuper = true;
        } else {
            $request->isSuper = false;
        }
        // 更新管理员|子账号在线信息
        $this->redisAdminUpdateUser();
        return true;
    }

    /**
     * 客户后台更新 管理员|子账号 在线
     */
    private function redisAdminUpdateUser()
    {
        $admin['site_id']      = session('site_id');
        $admin['time']         = time();
        $admin['uid']          = session('adminid');
        $admin['sid']          = session('ssid');
        $admin['lastingLogin'] = session('lastingLogin');
        if (!empty($admin['uid'])) {
            Redis::hset(getRedis('adminUserInfo'), $admin['uid'], json_encode($admin));
            if ($admin['lastingLogin'] == 1) {
                response()->cookie('uid', $admin['uid'], 43200);//如果选持久登录就设置12小时
            } else {
                response()->cookie('uid', $admin['uid'], 3600);
            }
        }
    }

    /**
     * 前台验证登陆
     *
     * @param \think\Request $request
     *
     * @return \think\Response|bool
     */
    private function frontAuth($request)
    {
        return true;
    }

    /**
     * 代理后台验证登陆
     *
     * @param \think\Request $request
     *
     * @return \think\Response|bool
     */
    private function agentAuth($request)
    {
        return true;
    }

    /**
     * 总后台验证登陆
     *
     * @param \think\Request $request
     *
     * @return \think\Response|bool
     */
    private function manageAuth($request)
    {
        return true;
    }
}
