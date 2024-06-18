<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
            $userLogin = Auth::user();
            $checkRole = User::where('id', $userLogin->id)
                ->whereHas('userType', function ($query){
                    $query->whereIn('name',[User::ROLE_ADMIN]);
                })->first();

            if (empty($checkRole)) return redirect()->route('get_admin.login');

            return $next($request);
        }

        return redirect()->route('get_admin.login');
    }
}
