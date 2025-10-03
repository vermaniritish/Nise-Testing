<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAuth as UserAuthModal;
use App\Models\Admin\Activities;


class FrontendAuth extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, ...$guards)
    {
        $userId = UserAuthModal::getLoginId();
        // Activities::log($request, $adminId);

        if($userId)
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('user.login');
        }
    }
}
