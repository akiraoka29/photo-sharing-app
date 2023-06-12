<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\ApiController;
use App\Http\Request\FormLoginRequest;
use App\Http\Request\FormRegisterRequest;

use App\Enum\Message;
use App\Models\User;

class AuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(FormLoginRequest $request)
    {
        try {
            // Set Credentials
            $credentials = $request->only('email', 'password');
            $token = Auth::attempt($credentials);

            if (!$token) {
                return $this->sendResponse(401, Message::UNAUTHORIZED);
            }

            $user = Auth::user();

            return $this->sendResponse(200, 'Success.', [
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer'
                ]
            ]);
        } catch(Exception $e) {
            return $this->sendException($e);
        }
    }

    public function register(FormRegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            $token = Auth::login($user);

            return $this->sendResponse(200, 'Success.', [
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer'
                ]
            ]);
        } catch(Exception $e) {
            return $this->sendException($e);
        }
    }
}
