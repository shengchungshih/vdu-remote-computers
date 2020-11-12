<?php

namespace App\Http\Middleware;

use App\Http\Services\PermissionService;
use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if (PermissionService::checkIfUserHasPermission($permission)) {
            return $next($request);
        }

        return abort(403);
    }
}
