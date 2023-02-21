<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register api
     *
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request, UserService $userService)
    {
        $userService->create($request->validated());

        return $this->respondSuccess(['message' => 'User register successfully.']);
    }

    /**
     * Login api
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) return $this->respondError('Login or pass are incorrect.', 401);

            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['message'] =  'User login successfully.';

            return $this->respondSuccess($success);



    }
}
