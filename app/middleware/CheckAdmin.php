<?php

namespace app\middleware;

use app\Request;

class CheckAdmin
{
    public function handle(Request $request, \Closure $next)
    {
        // 检查是否要登录
        if ($request->controller() === 'admin.Index' && $request->action() === 'login') {
            return $next($request); 
        }

        // 检查是否登录
        if (!session('admin')) {
            // 判断是否是ajax请求
            if ($request->isAjax()) {
                return json(['error' => 403, 'msg' => '请刷新当前页面登录']);
            }
            return redirect('/baidudisk/admin/login');
        }

        return $next($request);
    }
}
