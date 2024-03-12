<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccess
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
        if(Auth::check()){
            if(Auth::user()->role===Roles::where('name','admin')->first()->id){
                return $next($request);
            }
             if(Auth::user()->role===Roles::where('name','office')->first()->id){
                return $next($request);
            }
             if(Auth::user()->role===Roles::where('name','production')->first()->id){
                return $next($request);
            }
             if(Auth::user()->role===Roles::where('name','dispatch')->first()->id){
                return $next($request);
            }
             if(Auth::user()->role===Roles::where('name','accountant')->first()->id){
                return $next($request);
            }
        }
        return abort(403,'Access Denied');
    }
}
