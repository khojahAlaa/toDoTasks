<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admain
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
            $admainRole= Auth::user()->role()->pluck('title');
            if( $admainRole->contains('admain'))
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
