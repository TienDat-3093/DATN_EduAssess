<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginHandle(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user) {
                if ($user['status_id'] == 2) {
                    return redirect()->route('admin.login')->with('alert', 'Tài khoản đã bị khóa');
                } else {
                    return redirect()->route('dashboard.index');
                }
            }
        }
        return redirect()->route('admin.login')->with('alert', 'Access denied!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function getLoginUser()
    {
        if (Auth::check()) {
            $username = Auth::user()->username;
            return $username;
        }
    }
}
