<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckActivity
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
        if (Auth::user()->active != 1)
        {
            return response()->json([
                'success'   => false,
                'data'      => (object)[],
                'message'   => __("messages.Unauthenticated", [], $request->header('lang')),
                'validator' => (object)[],
            ], 401);
        }

        return $next($request);
    }
}
