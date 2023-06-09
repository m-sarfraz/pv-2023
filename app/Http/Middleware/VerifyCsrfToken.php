<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'login',
    ];
    public function handle($request, Closure $next)
    {
        if ($request->route()->named('logout')) {
            if (!Auth::check() || Auth::guard()->viaRemember()) {
                $this->except[] = route('logout');
            }
        }

        return parent::handle($request, $next);
    }
}
