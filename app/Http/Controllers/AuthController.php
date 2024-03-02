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
    /**
     * Registering a new User.
     *
     * @OA\Post(
     *   path="/api/auth/register",
     *   tags={"Auth"},
     *   @OA\Response(
     *     response=200,
     *     description="Response Successful",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="User created successfully"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="object",
     *           ref="#/components/schemas/User"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Response Error"
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="name",
     *           type="string",
     *           description="The name of User.",
     *           example="John Doe"
     *         ),
     *         @OA\Property(
     *           property="email",
     *           type="string",
     *           description="The email of User.",
     *           example="john@doe.com"
     *         ),
     *         @OA\Property(
     *           property="password",
     *           type="string",
     *           description="The password of User.",
     *           example="@api4devs"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @return array
     */
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

    /**
     * Starts User session.
     *
     * @OA\Post(
     *   path="/api/auth/login",
     *   tags={"Auth"},
     *   @OA\Response(
     *     response=200,
     *     description="Response Successful",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="token",
     *           type="string",
     *           example="access_token"
     *         ),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Response Error"
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="email",
     *           type="string",
     *           description="The email of User.",
     *           example="john@doe.com"
     *         ),
     *         @OA\Property(
     *           property="password",
     *           type="string",
     *           description="The password of User.",
     *           example="@api4devs"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @return array
     */
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

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        }

        $token = $user->createToken('api4devs')->plainTextToken;

        return Response(['token' => $token], Response::HTTP_OK);
    }



    /**
     * Log out of the User session.
     *
     * @OA\Post(
     *   path="/api/auth/logout",
     *   tags={"Auth"},
     *   @OA\Response(
     *     response=200,
     *     description="Response Successful",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="Successfully logged out"
     *         ),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Response Error"
     *   ),
     * )
     *
     * @return array
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return MessageService::ok('Successfully logged out');
    }
}