<?php


namespace App\Http\Controllers\API;

use Validator;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;

class UserController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Post(
        path: "/api/register",
        summary: "Registration of platform users",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: "object",
                required: ["name", "email", "password", "password_confirmation", "age", "phone_number", "city_id", "role"],
                properties: [
                    new OA\Property(property: "name", type: "string", description: "User name, max 255 characters", example: "Michael Remo"),
                    new OA\Property(property: "email", type: "string", description: "User email, must be unique", example: "michaelremo@example.com"),
                    new OA\Property(property: "password", type: "string", description: "User password, at least 8 characters with mixed cases, numbers, and symbols", example: "Km!2mkaj#1sawd"),
                    new OA\Property(property: "password_confirmation", type: "string", description: "Password confirmation", example: "Km!2mkaj#1sawd"),
                    new OA\Property(property: "age", type: "string", format: "date", description: "User's date of birth in format YYYY-MM-DD", example: "1990-05-15"),
                    new OA\Property(property: "phone_number", type: "string", description: "Phone number in format +1234567890", pattern: "^[0-9\\s\\-\\+\\(\\)]*$", example: "+48600600600"),
                    new OA\Property(property: "city_id", type: "integer", description: "ID of the user's city", example: 1),
                    new OA\Property(property: "role", type: "string", enum: ["volunteer", "deprived person"], description: "Role of the user", example: "volunteer")
                ]
            )
        ),
        tags: ["Users"],
        responses: [
            new OA\Response(
                response: Response::HTTP_CREATED,
                description: "User registered successfully",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "User registered successfully."),
                        new OA\Property(property: "token", type: "string", example: "your-token-here")
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: "Validation errors"),
            new OA\Response(response: Response::HTTP_BAD_REQUEST, description: "Invalid role specified"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server error")
        ]
    )]
    
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'age' => 'required|date',
            'phone_number' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'city_id' => 'required',
            'role' => ['required', Rule::in(['volunteer', 'deprived person'])],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $role = Role::where('name', $validated['role'])->first();
        if (!$role) {
            return response()->json(['message' => 'Invalid role specified.'], Response::HTTP_BAD_REQUEST);
        }
        $validated['role_id'] = $role->id;
        unset($validated['role']);
        $user = User::create($validated);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'User registered successfully.'], Response::HTTP_CREATED)
                         ->cookie('token', $token, 60 * 24, '/', null, false, true, false);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Post(
        path: "/api/login",
        summary: "Login of platform users",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: "object",
                required: ["email", "password"],
                properties: [
                    new OA\Property(property: "email", type: "string", format: "email", description: "User email", example: "michaelremo@example.com"),
                    new OA\Property(property: "password", type: "string", description: "User password, minimum 8 characters", example: "Mk!@mkanj$3mk2")
                ]
            )
        ),
        tags: ["Users"],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "User logged in successfully",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Logged in successfully")
                    ]
                ),
                headers: [
                    new OA\Header(
                        header: "Set-Cookie",
                        description: "HTTP-only cookie containing the authentication token",
                        schema: new OA\Schema(type: "string", example: "token=your-token; HttpOnly; Max-Age=1440; Path=/; SameSite=Lax")
                    )
                ]
            ),
            new OA\Response(
                response: Response::HTTP_UNAUTHORIZED,
                description: "Invalid credentials",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Invalid credentials")
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: "Validation errors",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "The email field is required."),
                        new OA\Property(property: "errors", type: "object")
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error"
            )
        ]
    )]
    
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            $cookie = cookie(
                'token',
                $token,
                60 * 24, 
                '/',
                null,
                false, 
                true, 
                false, 
                'Lax' 
            );
        
            $roleName = $user->role->name;

            return response()
                ->json([
                    'message' => 'Logged in successfully',
                    'user' => [
                        'name' => $user->name, 
                        'email' => $user->email,
                        'role' => $roleName,
                    ]
                ])
                ->withCookie($cookie);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }


    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Post(
        path: "/api/logout",
        summary: "Logout of platform users",
        tags: ["Users"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "User logged out successfully."),
        ]
    )]
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully.'], Response::HTTP_OK);
    }


    /**
     * Verify the authenticity of the token.
     */
    #[OA\Get(
        path: "/api/verifiedToken",
        summary: "Verify token validity",
        description: "Checks if the provided token in the cookie is valid and returns the authenticated user's information.",
        tags: ["Authentication"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Token is valid",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Token is valid"),
                        new OA\Property(
                            property: "user",
                            type: "object",
                            properties: [
                                new OA\Property(property: "name", type: "string", example: "John Doe"),
                                new OA\Property(property: "email", type: "string", format: "email", example: "johndoe@example.com"),
                                new OA\Property(property: "role", type: "string", example: "volunteer")
                            ]
                        )
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_UNAUTHORIZED,
                description: "Invalid or expired token",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Invalid or expired token")
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error"
            )
        ]
    )]
    public function verifiedToken (Request $request): JsonResponse
    {
            $user = Auth::user();
            $roleName = $user->role->name;
            return response()
                ->json([
                'message' => 'Token is valid',
                'user' => [
                        'name' => $user->name, 
                        'email' => $user->email,
                        'role' => $roleName,
                ]
            ]);
    }
}