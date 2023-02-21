<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Returns json token
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *   path="/api/register",
     *   tags={"AuthController"},
     *   @OA\Parameter(
     *     name="name",
     *     description="Nom",
     *     required=true,
     *     in="query",
     *       @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="email",
     *     description="Email",
     *     required=true,
     *     in="query",
     *       @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="password",
     *     description="Mot de passe",
     *     required=true,
     *     in="query",
     *       @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="password_confirmed",
     *     description="Confirmation mot de passe",
     *     required=true,
     *     in="query",
     *       @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response="201",
     *     description="Returns json token",
     *     content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="errcode",
     *                         type="integer",
     *                         description="The response code"
     *                     ),
     *                     @OA\Property(
     *                         property="errmsg",
     *                         type="string",
     *                         description="The response message"
     *                     ),
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         description="The response data",
     *                         @OA\Items
     *                     ),
     *                     example={
     *                         "errcode": 1,
     *                         "errmsg": "ok",
     *                         "data": {}
     *                     }
     *                 )
     *             )
     *         }
     *   )
     * )
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:30|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('DuckEat')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }
    /**
     * Returns user infos & json token
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *   path="/api/login",
     *   tags={"AuthController"},
     *
     *   @OA\Parameter(
     *     name="email",
     *     description="Email",
     *     required=true,
     *     in="query",
     *       @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="password",
     *     description="Mot de passe",
     *     required=true,
     *     in="query",
     *       @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Returns user infos & json token",
     *     content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="errcode",
     *                         type="integer",
     *                         description="The response code"
     *                     ),
     *                     @OA\Property(
     *                         property="errmsg",
     *                         type="string",
     *                         description="The response message"
     *                     ),
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         description="The response data",
     *                         @OA\Items
     *                     ),
     *                     example={
     *                         "errcode": 1,
     *                         "errmsg": "ok",
     *                         "data": {}
     *                     }
     *                 )
     *             )
     *         }
     *   )
     * )
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('DuckEat')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    /**
     * Returns string
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *   path="/api/logout",
     *   tags={"AuthController"},
     *   @OA\Response(
     *     response="200",
     *     description="Returns string",
     *     content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="errcode",
     *                         type="integer",
     *                         description="The response code"
     *                     ),
     *                     @OA\Property(
     *                         property="errmsg",
     *                         type="string",
     *                         description="The response message"
     *                     ),
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         description="The response data",
     *                         @OA\Items
     *                     ),
     *                     example={
     *                         "errcode": 1,
     *                         "errmsg": "ok",
     *                         "data": {}
     *                     }
     *                 )
     *             )
     *         }
     *   )
     * )
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json([
            'message' => 'Successfully Loged out'
        ],200);
    }
}
