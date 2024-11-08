<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Password;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;

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
                            new Property(property: 'name', description: "User name must be max 255 characters", type: "string"),
                            new Property(property: 'email', description: "User email must be unique", type: "string"),
                            new Property(property: 'password', description: "User password, at least 8 characters with mixed cases, numbers, and symbols", type: "string"),
                            new OA\Property(property: 'password_confirm', description: "User password confirmation", type: "string"),
                            new Property(property: 'age', description: "User age mus be a date type, in example: 1990-01-01", type: "datetime"),
                            new Property(property: 'phone_number', description: "User phone number in the format +1234567890", type: "string", pattern: "^[0-9\\s\\-\\+\\(\\)]*$"),
                            new OA\Property(property: 'city', description: "User city must be max 100 characters", type: "string"),
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
            'city' => 'required|string|max:100',
            'picture' => 'nullable|string',
            'is_picture_public' => 'nullable|boolean',
        ]);

        //add admin role
        $role = Role::where('name', 'admin')->first();
        if (!$role) {
            return response()->json(['message' => 'Role "admin" does not exist.'], Response::HTTP_BAD_REQUEST);
        }
        // hashed password
        $validated['password'] = Hash::make($validated['password']);

        // add role_id to validated data
        $validated['role_id'] = $role->id;

        // create user
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
}
