<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Attempting to log in');
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:5',
        ]);
        $credentials = $request->only('email', 'password');
        try {
            $token = JWTAuth::attempt($credentials);
            Log::info('Generated token here: ' . $token);

            if (!$token) {
                setAlert('danger', 'Invalid credentials');
                return redirect()->back();
            }
            // Set the token in an HTTP-only cookie
            // $cookie = cookie('token', $token, 600, null, null, false, true); // 600 minutes expiration
             $cookie = Cookie::make('token', $token, 800);

            Log::info('Cookie details: ' . $cookie);
            return redirect()->intended('/')->cookie($cookie);
        } catch (JWTException $e) {
            setAlert('danger', 'Could not create token');
            Log::error('JWT Authentication Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:5',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        setAlert('success', 'Registration successful. Please login.');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        $token = $request->header('Authorization');
        try {
            JWTAuth::invalidate($token);
            return response()->json(['success' => 'User logged out successfully']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }

    public function getUser(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json(compact('user'));
    }
}
