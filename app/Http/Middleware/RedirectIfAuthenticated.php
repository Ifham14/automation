<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;

class RedirectIfAuthenticated
{

    // public function handle($request, Closure $next)
    // {
    //     try {
    //         // Check if the token is present and valid
    //         if ($user = JWTAuth::parseToken()->authenticate()) {
    //             // If valid token, redirect to dashboard
    //             return redirect('/');
    //         }
    //     } catch (Exception $e) {
    //         // If there's an error (token not valid, expired, etc.), proceed with the request
    //     }

    //     return $next($request);
    // }

    // public function handle($request, Closure $next)
    // {
    //     if (auth()->check()) {
    //         \Log::info('User is already authenticated.');
    //         return redirect('/'); // or any other route
    //     }

    //     \Log::info('User is not authenticated, proceeding to login.');
    //     return $next($request);
    // }


    public function handle($request, Closure $next)
    {
        try {
            if ($user = JWTAuth::parseToken()->authenticate()) {
                return redirect('/');
            }
        } catch (Exception $e) {
            // Proceed with the request if there's an error
        }
        return $next($request);
    }
}
