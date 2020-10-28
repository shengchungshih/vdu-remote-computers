<?php

namespace App\Http\Middleware;

use Closure;
use Zefy\LaravelSSO\LaravelSSOBroker;
use Illuminate\Support\Facades\Cookie;

class SSOAutoLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $broker = new LaravelSSOBroker();
        $user = $broker->getUserInfo();

        if (isset($user['data'])) {
            if (auth()->guest() || auth()->user()->id != $user['data']['id']) {
                auth()->loginUsingId($user['data']['id']);
            }
        } elseif (!auth()->guest()) {
            auth()->logout();
            return response()->redirectTo($request->url());
        } elseif (isset($user['error']) &&
            strpos($user['error'], 'There is no saved session data associated with the broker session id.') !== false) {
            return redirect('/')->withCookie(Cookie::forget('sso_token_payments'));
        }
        return $next($request);
    }
}
