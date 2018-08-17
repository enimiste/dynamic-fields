<?php

namespace App\Http\Middleware;

use Closure;

class UserScope
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
        if(auth()->check()){
            $userId = auth()->user()->id;
            \App\TagList::addGlobalScope(new \App\Scopes\AuthUser($userId));
        }
        return $next($request);
    }
}
