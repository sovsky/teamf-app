<?php


namespace App\Http\Controllers\API;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\API\BaseController as BaseController;

#[OA\Post(
    path: "/api/register",
    summary: "Registration of platform users",
    requestBody: new RequestBody(required: true,
            content: new MediaType(mediaType: "application/json",
            schema: new Schema(required: ["name", "email", "password", "password_confirm", "age", "phone_number", "city"],
                    properties: [
                        new Property(property: 'name', description: "User name must be max 255 characters", type: "string"),
                        new Property(property: 'email', description: "User email must be unique", type: "string"),
                        new Property(property: 'password', description: "User password, at least 8 characters with mixed cases, numbers, and symbols", type: "string"),
                        new OA\Property(property: 'password_confirm', description: "User password confirmation", type: "string"),
                        new Property(property: 'age', description: "User age mus be a date type, in example: 1990-01-01", type: "datetime"),
                        new Property(property: 'phone_number', description: "User phone number in the format +1234567890", type: "string", pattern: "^[0-9\\s\\-\\+\\(\\)]*$"),
                        new OA\Property(property: 'city', description: "User city must be max 100 characters", type: "string"),
                    ]))),
    tags: ["Users"],
    responses: [
        new OA\Response(response: Response::HTTP_CREATED, description: "User register successfully."),
        new OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: "Unprocessable entity"),
        new OA\Response(response: Response::HTTP_BAD_REQUEST, description: "Bad Request"),
        new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
    ]
)]

#[OA\Post(
    path: "/api/login",
    summary: "Login of platform users",
    requestBody: new OA\RequestBody(required: true,
            content: new OA\MediaType(mediaType: "application/x-www-form-urlencoded",
            schema: new OA\Schema(required: [ "email", "password"],
                    properties: [
                        new OA\Property(property: 'email', description: "User email", type: "string"),
                        new OA\Property(property: 'password', description: "User password", type: "string"),
                    ]))),
    tags: ["Users"],
    responses: [
        new OA\Response(response: Response::HTTP_CREATED, description: "User login successfully."),
        new OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: "Unprocessable entity"),
        new OA\Response(response: Response::HTTP_BAD_REQUEST, description: "Bad Request"),
        new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
    ]
)]


class UserController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
    {
        // Validate fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'age' => 'required|date',
            'phone_number' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'city' => 'required|string|max:100'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        // Generating a token and setting it in an HTTP-only cookie
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'User registered successfully.'], Response::HTTP_CREATED)
                         ->cookie('token', $token, 60 * 24, '/', null, false, true, false);
    }

    public function login(Request $request): JsonResponse
    {
        // Field validation
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['message' => 'User logged in successfully.'], Response::HTTP_OK)
                             ->cookie('token', $token, 60 * 24, '/', null, false, true, false);
        }

        return $this->sendError('Unauthorized', ['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        return response()->json(['message' => 'User logged out successfully.'], Response::HTTP_OK);
    }

}