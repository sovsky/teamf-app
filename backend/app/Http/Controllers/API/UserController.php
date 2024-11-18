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
                    new OA\Property(property: "name", type: "string", description: "User name, max 255 characters"),
                    new OA\Property(property: "email", type: "string", description: "User email, must be unique"),
                    new OA\Property(property: "password", type: "string", description: "User password, at least 8 characters with mixed cases, numbers, and symbols"),
                    new OA\Property(property: "password_confirmation", type: "string", description: "Password confirmation"),
                    new OA\Property(property: "age", type: "string", format: "date", description: "User's date of birth in format YYYY-MM-DD"),
                    new OA\Property(property: "phone_number", type: "string", description: "Phone number in format +1234567890", pattern: "^[0-9\\s\\-\\+\\(\\)]*$"),
                    new OA\Property(property: "city_id", type: "integer", description: "ID of the user's city"),
                    new OA\Property(property: "role", type: "string", enum: ["volunteer", "deprived person"], description: "Role of the user")
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
        // Validate fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'age' => 'required|date',
            'phone_number' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'city_id' => 'required',
            'role' => ['required', Rule::in(['volunteer', 'deprived person'])],
        ]);

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Find or create the role
        $role = Role::where('name', $validated['role'])->first();
        if (!$role) {
            return response()->json(['message' => 'Invalid role specified.'], Response::HTTP_BAD_REQUEST);
        }

        // Remove the role from validated data for user creation
        $validated['role_id'] = $role->id;
        unset($validated['role']);

        // Create user with role_id
        $user = User::create($validated);

        // Generating a token and setting it in an HTTP-only cookie
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'User registered successfully.', 'token' => $token], Response::HTTP_CREATED)
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
                    new OA\Property(property: "email", type: "string", format: "email", description: "User email"),
                    new OA\Property(property: "password", type: "string", description: "User password, minimum 8 characters")
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
                60 * 24, // 24 godziny
                '/',
                null,
                false, // secure
                true, // httpOnly
                false, // raw
                'Lax' // sameSite
            );
        
            return response()
                ->json([
                    'message' => 'Logged in successfully',
                    // 'user' => $user,
                    // 'token' => $token,
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
        // Auth::logout();
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully.'], Response::HTTP_OK);
    }
}