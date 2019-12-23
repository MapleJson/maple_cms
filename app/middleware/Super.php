<?php
declare (strict_types = 1);

namespace app\middleware;

use app\common\Code;

class Super
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
        if (!$request->isSuper) {
            return response('无此权限', Code::NO_PERMISSION);
        }
        return $next($request);
    }
}
