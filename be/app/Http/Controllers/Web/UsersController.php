<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //Authentication
    public function dashboard()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login');
    }
    public function loginHandle(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 1 ])){
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

    //Manage
    public function index()
    {
        $listUsers = Users::orderBy('is_admin', 'desc')->get();
        return view('user/index', compact('listUsers'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('data');
        $listUsers = Users::where('username', 'like', "%$keyword%")
                        ->orderBy('is_admin', 'desc')
                        ->get();
        return view('user/results', compact('listUsers'));
    }
    public function createHandle(CreateUserRequest $request)
    {
        $user = new Users();
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->save();
        return redirect()->route('user.index')->with('alert', 'Thêm tài khoản user thành công');
    }
    public function editHandle(CreateUserRequest $request, $id)
    {
        $user = Users::find($id);
        if (empty($user)) {
            return redirect()->route('user.index')->with('alert', 'Tài khoản user không tồn tại');
        }
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->save();

        return redirect()->route('user.index')->with('alert', 'Cập nhật tài khoản user thành công');
    }
    public function delete($id)
    {
        $user = Users::find($id);
        if (!$user) {
            return redirect()->route('user.index')->with('error','Topic not found');
        }
        if($user->trashed()){
            $user->restore();
            return redirect()->route('user.index')->with('alert','Successfully restored');
        }
        else{
            $user->delete();
            return redirect()->route('user.index')->with('alert','Successfully deleted');
        }
    }
}
