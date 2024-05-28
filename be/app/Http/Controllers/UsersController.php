<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login');
    }
    public function loginHandle(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 1 ])) {
            $user = Auth::user();
            if ($user) {
                return redirect()->route('dashboard.index');
            }
        }
        return redirect()->route('login')->with('alert', 'Access denied!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    // public function getLoginUser()
    // {
    //     if (Auth::check()) {
    //         $username = Auth::user()->username;
    //         return $username;
    //     }
    // }
}
