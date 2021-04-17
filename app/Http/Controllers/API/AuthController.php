<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Requests\Auth\AuthLoginRequest;
// use App\Http\Requests\Auth\AuthRegisterRequest;



class AuthController extends Controller
{
    protected function respondWithToken($token, $expires_at)
    {
        return [
            'access_token' => $token->plainTextToken,
            'token_type' => 'bearer',
            'expires_at' => $expires_at->toDateTimeString()
        ];
    }

    public function register(Request $request)
    {
        $user = $this->create($request->all());
        $this->guard()->login($user);
        return response()->json([
            'user' => $user,
            'message' => 'registration successful'
        ], 200);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function guard()
    {
        return Auth::guard();
    }


    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (!$request['remember_me']) {
                $expires_at = Carbon::now()->addYear(); // ->addHour();
            } else {
                $expires_at = Carbon::now()->addWeeks(1);
            }
            $authuser = auth()->user();
            $authuser->update(['expires_at' => $expires_at]);
            $token = $authuser->createToken('personal access');
            return response()->json(['message' => 'user authenticated', 'data' => $this->respondWithToken($token, $expires_at)], 200);
        } else {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out.', 'isLoggedOut' => true], 200);
    }
}
