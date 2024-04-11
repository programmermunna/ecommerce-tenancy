<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserResource;
use App\Services\LoginTokenService;
use App\Services\RegisterService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use RegisterService, LoginTokenService;

    /**
     * user register
     * @param App\Http\Requests\Api\RegisterRequest $request
     * 
     * @return json
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $this->createUser($data);
        $response['message'] = 'Successfully Registered! Now, Login!';
        return new SuccessResource($response);
    }

    /**
     * user login
     * @param App\Http\Requests\Api\LoginRequest $request
     * 
     * @return json
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        return $this->loginToken($credentials);
    }

    /**
     * authenticate user information
     * @param Illuminate\Http\Request $request
     * 
     * @return json
     */
    public function user(Request $request)
    {
        $response['data'] = new UserResource($request->user());
        return new SuccessResource($response);
    }

    /**
     * authenticate user logout (token delete)
     * @param Illuminate\Http\Request $request
     * 
     * @return json
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response['message'] = 'Successfully Logout!';
        return new SuccessResource($response);
    }
}