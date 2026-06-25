<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSingleSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {

            $admin = Auth::guard('admin')->user();

            if ($admin->session_id !== session()->getId()) {

                Auth::guard('admin')->logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/admin/login')
                    ->withErrors([
                        'message' => 'Your account was logged in from another device.'
                    ]);
            }
        }

        return $next($request);
    }
}