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
        $check = $this->{$project . 'Auth'}($request);
        if ($check instanceof \think\Response) {
            return $check;
        }

        return $next($request)->cookie('lastTime', (string)time(), 36000);
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
        $redirect = '<script>alert("请重新登录!!");location.href="' .
            url('login.index')->domain($request->host())->build() .
            '";</script>';
        // session 不存在时跳转登陆页
        if (!session('?loginName') || !session('?id')) {
            return redirect(url('login.index')->build());
        }
        unset($redirect);
        // 向控制器传入参数，是否是超管
        if (session('role') === 'admin') {
            $request->isSuper = true;
        } else {
            $request->isSuper = false;
        }
        // 更新管理员|子账号在线信息
        if (session('lastingLogin') == 1) {
            response()->cookie('uid', session('id'), 43200);//如果选持久登录就设置12小时
        } else {
            response()->cookie('uid', session('id'), 3600);
        }
        return true;
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
}
