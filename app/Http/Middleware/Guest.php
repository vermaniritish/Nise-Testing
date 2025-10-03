<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin\Activities;
use App\Libraries\General;
use App\Models\Admin\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        $today = Carbon::today()->toDateString();

        $exists = Visitor::where('ip_address', $ip)
            ->whereDate('visit_date', $today)
            ->exists();

        if (!$exists) {
            Visitor::insert([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'visit_date' => $today,
            ]);
        }

        $lang = request()->session()->get('locale');
        if($lang && $lang == 'hi')
            App::setLocale('hi');
        else
            App::setLocale('en');
        
        return $next($request)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', '*')
        ->header('Access-Control-Allow-Credentials', true)
        ->header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization')
        ->header('Accept', 'application/json');;
    }
}
