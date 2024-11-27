<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\API\BaseController;

class AdminStatsController extends BaseController
{
    /**
     * Create Admin account api
     */
    #[OA\Post(
        path: "/api/admin/create",
        summary: "Create admin account",
        requestBody: new RequestBody(required: true,
                content: new MediaType(mediaType: "application/json",
                schema: new Schema(required: ["name", "email", "password", "password_confirm", "age", "phone_number", "city"],
                        properties: [
                            new Property(property: 'name', description: "User name must be max 255 characters", type: "string", example: "John Doe"),
                            new Property(property: 'email', description: "User email must be unique", type: "string", example: "johndoe@example.com"),
                            new Property(property: 'password', description: "User password, at least 8 characters with mixed cases, numbers, and symbols", type: "string", example: "Mkanj12mkanj"),
                            new Property(property: 'password_confirm', description: "User password confirmation", type: "string", example: "Mkanj12mkanj"),
                            new Property(property: 'age', description: "User age must be a date type, in example: 1990-01-01", type: "datetime", example: "1990-01-01"),
                            new Property(property: 'phone_number', description: "User phone number in the format +1234567890", type: "string", pattern: "^[0-9\\s\\-\\+\\(\\)]*$", example: "+1234567890"),
                            new Property(property: 'city_id', description: "City_id must be pass with database", type: "int", example: "New York")                            
                        ]))),
        tags: ["Admin"],
        responses: [
            new OA\Response(response: Response::HTTP_CREATED, description: "Admin account registered successfully."),
            new OA\Response(response: Response::HTTP_BAD_REQUEST, description: "Role 'admin' does not exist."),
        ]
    )]

    public function createAdmin(Request $request): JsonResponse {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'age' => 'required|date',
            'phone_number' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'city_id' => 'required|integer|exists:cities,id', 
            'picture' => 'nullable|string',
            'is_picture_public' => 'nullable|boolean',
        ]);
        $role = Role::where('name', 'admin')->first();
        if (!$role) {
            return response()->json(['message' => 'Role "admin" does not exist.'], Response::HTTP_BAD_REQUEST);
        }
        $validated['password'] = Hash::make($validated['password']);
        $validated['role_id'] = $role->id;

        $user = User::create($validated);

        return response()->json(['message' => 'Admin account registered successfully.'], Response::HTTP_CREATED);
    }


     /**
     * Retrieves information about the number of users relative to age
     *
     * @return JsonResponse
     */
    #[OA\Get(
        path: "/api/users-by-age",
        summary: "Retrieves information about the number of users relative to age",
        tags: ["Admin"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "View data"),
            new OA\Response(response: Response::HTTP_BAD_REQUEST, description: "Bad Request"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    public function getUsersByAge()
    {
        // Log::info('getUsersByAge method called');
        // Log::info('Current user: ' . Auth::id());
        $userModel = new User();
        $usersByAge = $userModel->getUsersByAge();
        return response()->json($usersByAge);
    }

    /**
     * Retrieves information about the number of users who are volunteers
     *
     * @return JsonResponse
     */
    #[OA\Get(
        path: "/admin/volunteer-count",
        summary: "Retrieves information about the number of users who are volunteers",
        tags: ["Admin"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "View data"),
            new OA\Response(response: Response::HTTP_BAD_REQUEST, description: "Bad Request"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    public function getVolunteerCount(): JsonResponse
    {
        $volunteerCount = User::where('role_id', 1)->count();
        
        return response()->json(['volunteer_count' => $volunteerCount]);
    }
    
     /**
     * Retrieves information about the number of users who are volunteers
     *
     * @return JsonResponse
     */
    #[OA\Get(
        path: "/admin/deprived-person-count",
        summary: "Retrieves information about the number of users who are people in need",
        tags: ["Admin"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "View data"),
            new OA\Response(response: Response::HTTP_BAD_REQUEST, description: "Bad Request"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    public function getDeprivedPersonCount(): JsonResponse
    {
        $deprivedPersonCount = User::where('role_id', 2)->count();
        
        return response()->json(['deprived_person_count' => $deprivedPersonCount]);
    }

    /**
     * Removes the user based on their ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    #[OA\Delete(
        path: "/api/users/{id}",
        summary: "Delete a user",
        tags: ["Admin"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "ID of the user to delete",
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "User deleted successfully."),
            new OA\Response(response: Response::HTTP_NOT_FOUND, description: "User not found"),
        ]
    )]
    public function deleteUser($id) {
        $user = User::find($id);

        if(!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfuly'],  Response::HTTP_OK);
    }  
    
    /**
     * Retrieves all users by their role.
     *
     * @param string $roleName The name of the role to filter users by.
     * @return JsonResponse
     */
    #[OA\Get(
        path: "/api/admin/role/{roleName}",
        summary: "Get users by role",
        tags: ["Admin"],
        parameters: [
            new OA\Parameter(
                name: "roleName",
                in: "path",
                required: true,
                description: "The name of the role to filter users by.",
                schema: new OA\Schema(type: "string")
            )
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK, 
                description: "Successfully retrieved users by role.",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(
                            property: "users",
                            type: "array",
                            items: new OA\Items(
                                type: "object",
                                properties: [
                                    new OA\Property(property: "id", type: "integer", example: 5),
                                    new OA\Property(property: "email", type: "string", example: "testusers12@example.com"),
                                    new OA\Property(property: "email_verified_at", type: "string", format: "date-time", example: null),
                                    new OA\Property(property: "name", type: "string", example: "User2"),
                                    new OA\Property(property: "age", type: "string", format: "date-time", example: "1995-05-01"),
                                    new OA\Property(property: "phone_number", type: "string", example: "48123456789"),
                                    new OA\Property(property: "picture", type: "string", nullable: true, example: null),
                                    new OA\Property(property: "is_picture_public", type: "boolean", example: false),
                                    new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-11-17"),
                                    new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-11-17"),
                                    new OA\Property(property: "role_id", type: "integer", example: 2),
                                    new OA\Property(property: "city_id", type: "integer", example: 1)
                                ]
                            )
                        )
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND, 
                description: "Role not found.",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Role not found.")
                    ]
                )
            )
        ]
    )]

    public function getUsersByRole(string $roleName): JsonResponse
    {
        $role = Role::where('name', $roleName)->first();
    
        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }
    
        $users = User::where('role_id', $role->id)
                ->select('name', 'email', 'password', 'age', 'phone_number')
                ->get();
    
        return response()->json([
            'users' => $users
        ]);
    }

     /**
     * Verify the authenticity of the token.
     */
    #[OA\Get(
        path: "/api/verifiedAdminToken",
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
                                new OA\Property(property: "role", type: "string", example: "admin")
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

            if($roleName != 'admin') {
                return response()->json(['error' => "You don't have access"], 403);
            }
         
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
