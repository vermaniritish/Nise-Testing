<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SessionTimeout
{
    protected $timeout = 1800; // 30 min

    public function handle($request, Closure $next)
    {
        if (session()->has('last_activity')) {

            $inactiveTime =
                time() - session('last_activity');

            if ($inactiveTime > $this->timeout) {

                Auth::logout();

                session()->flush();

                return redirect('/login')
                    ->with('error',
                        'Session expired.');
            }
        }

        session([
            'last_activity' => time()
        ]);

        return $next($request);
    }
}