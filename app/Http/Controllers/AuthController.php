<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>  Hash::make($request->input('password')),
        ]);
        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return \response(['error' => 'invalid credentials', 'request' => $request->only('email', 'password'), Auth::attempt($credentials)], Response::HTTP_UNAUTHORIZED);
        }

        /**  @var User $user */
        $user = Auth::user();
        $jwt = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $jwt, 60 * 24);
        return \response([
            'jwt' => $jwt,
        ])->withCookie($cookie);
    }
    public function user(Request $request)
    {
        $user = $request->user();
        return $user;
    }

    public function logout(Request $request)
    {
        $cookie = Cookie::forget('jwt');
        // $request->user()->currentAccessToken()->delete();
        $request->user()->tokens()->delete();
        return response(['message' => 'success'])->withCookie(($cookie));
    }
    public function updateInfo(Request $request)
    {
        $user = $request->user();

        $user->update($request->only('name', 'email'));
        return response($user, Response::HTTP_ACCEPTED);
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);
        return response($user, Response::HTTP_ACCEPTED);
    }
}
