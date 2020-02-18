<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class myMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        if (Auth::guest()){
            return redirect()->route('login');
        }
        else{
            if ($role != null){
                if (!$request->user()->hasAnyRole(explode("|",$role))){
                    return redirect()->route('error');
                }
            }
        }
        return $next($request);
    }
}
