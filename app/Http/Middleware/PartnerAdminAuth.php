<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\PartnerAdmin\PartnerAdminAuth as PartnerAdminAuthModal;


class PartnerAdminAuth extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            return $next($request);
        }
        return redirect()->route('mobile.form');
    }
}
