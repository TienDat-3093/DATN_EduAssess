<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\UsersRequest;

class ApiUsersController extends Controller
{
    public function register()
    {
        $request = request()->only(['username', 'email', 'date_of_birth', 'password', 'avatar']);

        /* return response()->json(['message' => $request]); */
        $user = new Users();
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->date_of_birth = $request['date_of_birth'];


        if (request()->hasFile('avatar')) {
            $file = request()->file('avatar');
            $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('img/users', $fileName);
            $user->image = $path;
        }

        $user->save();
        return response()->json(['message' => 'Register successful']);
    }


    public function login()
    {

        $credentials = request(['email', 'password']);

        $user = Users::where('email', $credentials['email'])->first();

        if (!$user || $user->status != 1) {
            return response()->json(['error' => 'Unauthorized - User is inactive'], 401);
        }
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized - Invalid credentials'], 401);
        }

        /* Cache::put('api_token_' . auth('api')->user()->id, $token, 1440); */
        //Cache khong het han
        Cache::forever('api_token_' . auth('api')->user()->id, $token);

        return $this->respondWithToken($token);
    }


    public function profile()
    {
        return response()->json(Auth::guard('api')->user());
    }


    /* public function logout()
    {
        $user = auth('api')->user();

        if ($user) {

            Cache::forget('api_token_' . $user->id);

            Auth::guard('api')->logout();


            $isLogout = !Auth::guard('api')->check();

            if ($isLogout) {
                return response()->json(['message' => 'Successfully logged out'], 200);
            } else {
                return response()->json(['message' => 'Logged out but user is still logged in'], 500);
            }
        } else {
            return response()->json(['message' => 'No user is currently logged in'], 400);
        }
    } */
    public function logout()
    {
        try {
            $user = auth('api')->user();

            if ($user) {
                // Log user details


                // Invalidate the token
                Cache::forget('api_token_' . $user->id);
                JWTAuth::invalidate(JWTAuth::getToken());

                return response()->json(['message' => 'Successfully logged out'], 200);
            }
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred during logout'], 500);
        }
    }


    public function refresh()
    {

        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
