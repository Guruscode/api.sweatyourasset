<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */


     public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json([
                'status' => false,
                'error' => 'Unauthorized',
            ], 401);
        }

        return $this->createNewToken($token);
    }
   /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'email' => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }


        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function editProfile(Request $request, $id)
{

        // Retrieve the authenticated user
        $user = auth()->user();

    // Check if the user is authorized to edit the profile
    if ($user->id != $id) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'phone_number' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'fail',
            'errors' => $validator->errors()
        ], 422);
    }



    // Update the user's profile with the validated data
    $user->update($validator->validated());
   // Check if the authenticated user is authorized to edit the profile
   if ($user->id !== auth()->id()) {
    return response()->json(['error' => 'Unauthorized'], 403);
}

    return response()->json([
        'status' => true,
        'message' => 'User profile updated successfully',
        'user' => $user
    ]);
}

      /**
     * View user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $user = Auth::user();

        return response()->json([
            'status' => true,
            'user' => $user,
        ]);
    }


    public function changePassword(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => 'fail',
                'error' => 'Current password is incorrect'
            ], 401);
        }

        // Update the user's password
        $user->update([
            ['password' => bcrypt($request->password)]
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully',
        ]);
    }


    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token){
        return response()->json([
            'status' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 120,
            'user' => auth()->user()
        ]);
    }
}
