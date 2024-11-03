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
        // Log::info('VerifyTokenMiddleware triggered.');

        // download token from cookies
        $cookieToken = $request->cookie('token');
        // Log::info('Cookie token: ' . ($cookieToken ?? 'null'));

        // download token from bearertoken
        $bearerToken = $request->bearerToken();
        // Log::info('Bearer token: ' . ($bearerToken ?? 'null'));

        // use token from cookies or bearer token
        $token = $cookieToken ?? $bearerToken;

        if (!$token) {
            // Log::error('No token found in request');
            return response()->json(['message' => 'Unauthorized - No token provided'], Response::HTTP_UNAUTHORIZED);
        }

        try {
            // decoded token
            $decodedToken = urldecode($token);
            $tokenParts = explode('|', $decodedToken);

            if (count($tokenParts) !== 2) {
                // Log::error('Invalid token format');
                return response()->json(['message' => 'Invalid token format'], Response::HTTP_UNAUTHORIZED);
            }

            [$tokenId, $tokenValue] = $tokenParts;

            // find token in database
            $tokenModel = PersonalAccessToken::find($tokenId);

            if (!$tokenModel) {
                // Log::error('Token not found in database');
                return response()->json(['message' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
            }

            // Sprawdź czy hash się zgadza
            if (!hash_equals($tokenModel->token, hash('sha256', $tokenValue))) {
                // Log::error('Token hash mismatch');
                return response()->json(['message' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
            }

            // Ustaw użytkownika
            $user = $tokenModel->tokenable;
            Auth::setUser($user);
            
            // Log::info('User authenticated successfully', ['user_id' => $user->id]);

            return $next($request);
        } catch (\Exception $e) {
            // Log::error('Token verification error: ' . $e->getMessage());
            return response()->json(['message' => 'Token verification failed'], Response::HTTP_UNAUTHORIZED);
        }
    }
}