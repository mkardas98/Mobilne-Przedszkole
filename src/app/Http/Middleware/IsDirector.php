<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDirector
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
        if(auth()->user()->role == 0){
            return $next($request);
        }

        return redirect('not-access')->with('error',"Nie masz dostępu do tej strony.");

    }
}
