<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class VerifyTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $cookieToken = $request->cookie('token');
        $bearerToken = $request->bearerToken();

        $token = $cookieToken ?? $bearerToken;

        if (!$token) {
            return response()->json(['message' => 'Unauthorized - No token provided'], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $decodedToken = urldecode($token);
            $tokenParts = explode('|', $decodedToken);

            if (count($tokenParts) !== 2) {
                return response()->json(['message' => 'Invalid token format'], Response::HTTP_UNAUTHORIZED);
            }

            [$tokenId, $tokenValue] = $tokenParts;

            $tokenModel = PersonalAccessToken::find($tokenId);

            if (!$tokenModel) {
                return response()->json(['message' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
            }

            if (!hash_equals($tokenModel->token, hash('sha256', $tokenValue))) {
                return response()->json(['message' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
            }

            $user = $tokenModel->tokenable;
            Auth::setUser($user);
            
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token verification failed'], Response::HTTP_UNAUTHORIZED);
        }
    }
}