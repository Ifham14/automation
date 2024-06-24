<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Support\Facades\Cookie;

class JwtMiddleware extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->cookie('token');
            if ($token) {
                $user = JWTAuth::setToken($token)->authenticate();
                if (!$user) {
                    return redirect()->route('login')->with('error', 'User not found');
                }
            } else {
                return redirect()->route('login')->with('error', 'Token not provided');
            }
        } catch (TokenExpiredException $e) {
            return redirect()->route('login')->with('error', 'Token expired');
        } catch (TokenInvalidException $e) {
            return redirect()->route('login')->with('error', 'Token invalid');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Token error: ' . $e->getMessage());
        }

        return $next($request);
    }
}
