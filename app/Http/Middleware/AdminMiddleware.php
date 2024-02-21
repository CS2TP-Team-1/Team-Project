<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            abort(403, 'Unauthorised Action - You must be logged in as an Administrator');
        }
        $user = $request->user();
        if ($user->accountType === 0){
            abort(403, 'Unauthorised Action - You are not an Administrator');
        }


        return $next($request);
    }
}
