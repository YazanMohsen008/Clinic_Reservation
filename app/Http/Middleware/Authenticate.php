<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        //if Request Has JWT cookie then Set Authorization header to
        // Bearer then Token Value
//        if ($jwt = $request->cookie('jwt'))
        $request->headers->set('Authorization', 'Bearer ' . $request->headers->get(("Authorization")));
        $request->headers->set('X-Requested-With', 'XMLHttpRequest');
        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
