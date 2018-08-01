<?php

namespace App\Http\Middleware;

use Closure;

class checkPerms
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $perm = $this->getPermission($request);
        if($request->user()->encan($perm) || $request->user()->hasRole('admin')){
            return $next($request);
        }
        return abort(401);
    }

    // 获取当前路由需要的权限
    public  function getPermission($request)
    {
        $actions = $request->route()->getAction();
        if (empty($actions['as'])) {
            abort(900);
        }
        return $actions['as'];
    }
}
