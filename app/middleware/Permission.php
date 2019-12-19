<?php
declare (strict_types = 1);

namespace app\middleware;

class Permission
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return \think\Response
     */
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
}
