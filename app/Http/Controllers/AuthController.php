<?php

namespace App\Http\Controllers;

use App\Service\MessageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return Response(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // $user->sendEmailVerificationNotification();

        return Response(['message' => 'User created successfully'], Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return Response(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate via email
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        } else {
            // Attempt to authenticate using name
            $user = User::where('name', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return Response(['message' => 'Unauthorized'], 401);
            }
        }

        $token = $user->createToken('api4devs')->plainTextToken;

        return Response(['token' => $token], 200);
    }


    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return MessageService::ok('Successfully logged out');
    }
}
