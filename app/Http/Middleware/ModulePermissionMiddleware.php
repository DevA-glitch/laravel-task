<?php

namespace App\Http\Middleware;

use App\CentralLogics\Helpers;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModulePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $module): Response
    {
        if (Helpers::module_permission_check($module)) {
            return $next($request);
        }
        return abort(403, 'Access Denied');
    }
}