<?php


namespace App\Http\Middleware;

use Closure, Illuminate\Support\Facades\Session, Illuminate\Support\Facades\Auth;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!Session::has('applocale'))
        {
            Session::put('applocale', 'lt');
        }

        app()->setLocale(Session::get('applocale'));

        return $next($request);
    }
}
