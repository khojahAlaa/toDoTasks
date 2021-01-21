<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Excutive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check()){
            $excRole= Auth::user()->role()->pluck('title');
            if( $excRole->contains('exc'))
            {
                return $next($request);
            }
            
            else{
                return redirect('/');
                // abort(403);
            } 
        }
        else{
            return redirect('/');
        } 
    }
}
