<?php

namespace App\Http\Controllers\API;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\API\BaseController as BaseController;

#[OA\Post(
    path: "/api/register",
    summary: "Registration of platform users",
    requestBody: new RequestBody(required: true,
            content: new MediaType(mediaType: "application/json",
            schema: new Schema(required: ["name", "email", "password", "password_confirm", "age", "phone_number", "city"],
                    properties: [
                        new Property(property: 'name', description: "User name", type: "string"),
                        new Property(property: 'email', description: "User email", type: "string"),
                        new OA\Property(property: 'password', description: "User password", type: "string"),
                        new OA\Property(property: 'password_confirm', description: "User password confirmation", type: "string"),
                        new Property(property: 'age', description: "User age", type: "datetime"),
                        new OA\Property(property: 'phone_number', description: "User phone_number", type: "string"),
                        new OA\Property(property: 'city', description: "User city", type: "string"),
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
            schema: new OA\Schema(required: [ "token", "email", "password"],
                    properties: [
                        new Property(property: 'token', description: "Generated token", type: "string"),
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


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
    {
        //validate fields
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'age' => 'required|date', 
            'phone_number' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10', 
            'city' => 'required|string|max:100'
        ]);
        if ($validator->fails()) {
            $errors = [];

            // error handling for each field
            if ($validator->errors()->has('name')) {
                $errors['name'] = 'Name is required and should be a valid string with a maximum length of 255 characters.';
            }

            if ($validator->errors()->has('email')) {
                $errors['email'] = 'A valid email is required and it must be unique.';
            }

            if ($validator->errors()->has('password')) {
                $errors['password'] = 'Password is required and should have a minimum length of 6 characters.';
            }

            if ($validator->errors()->has('c_password')) {
                $errors['confirm_password'] = 'Confirm password is required and must match the password.';
            }

            if ($validator->errors()->has('age')) {
                $errors['age'] = 'Age is required, must be an date.';
            }

            if ($validator->errors()->has('phone_number')) {
                $errors['phone_number'] = 'Phone number is required, must be at least 10 characters long, and should follow a valid format.';
            }

            if ($validator->errors()->has('city')) {
                $errors['city'] = 'City is required and must be a valid string with a maximum length of 100 characters.';
            }

            return $this->sendError('Validation Error.', $errors);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('AppTeamF')->plainTextToken;
        $success['email'] =  $user->email;
        return $this->sendResponse($success, 'User register successfully.');
    }
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['email'] =  $user->email;

            if (!$success['token']) {
                return $this->sendError('Missing token.', ['error' => 'Missing token.']);
            }
            
            if (!$success['email']) {
                return $this->sendError('Missing name.', ['error' => 'Missing email.']);
            }

            return $this->sendResponse($success, 'User login successfully.');
        }else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}