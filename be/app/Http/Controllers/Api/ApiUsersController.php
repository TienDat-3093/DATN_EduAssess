<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Users;

class ApiUsersController extends Controller
{


    public function login()
    {

        $credentials = request(['email', 'password']);
        $user = Users::where('email',$credentials['email'])->first();
        if(!$user || $user->status != 1)
        {
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


    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }


    public function logout()
    {
        $user = auth('api')->user();

        // Xóa token khỏi cache
        Cache::forget('api_token_' . $user->id);
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
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
