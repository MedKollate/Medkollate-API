<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        $credentials = $request->only('email', 'password');

        $user = Auth::guard('api')->getProvider()->retrieveByCredentials($credentials);

        if ($user && Auth::guard('api')->getProvider()->validateCredentials($user, $credentials)) {
            $token = $user->createToken('auth_token')->plainTextToken;

            $response = [
                'user' => $user,
                'access_token' => $token
            ];

            return response($response, 201);
        }

        return response(['message' => 'Invalid credentials'], 401);
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $token = Auth::user()->createToken('auth_token')->plainTextToken;

            $response = [
                'user' => Auth::user(),
                'access_token' => $token
            ];

            return response($response, 201);
        } else {
            // Authentication failed
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('api')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
