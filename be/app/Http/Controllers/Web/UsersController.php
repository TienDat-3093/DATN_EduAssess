<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
    public function createHandle(UsersRequest $request)
    {
        if($request->password!=$request->re_password)
            return redirect()->route('user.index')->with('alert', "Password doesn't match!");
        $user = new Users();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->password = Hash::make($request->password);
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = now()->format('YmdHis')  . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('img/users', $fileName);
            $user->image = $path;
        }
        $user->save();
        return redirect()->route('user.index')->with('alert', 'Successfully created!');
    }
    public function getUser($id){
        $user = Users::find($id);
        return $user;
    }
    public function editHandle(Request $request, $id)
    {
        $user = Users::find($id);
        $user->username = $request->username;
        $user->date_of_birth = $request->date_of_birth;
        if ($request->hasFile("image")) {
            if($user->image){
            $img = $user->image;
                if (Storage::exists($img)) {
                    Storage::delete($img);
                }
            }
            $file = $request->file("image");
            $fileName = now()->format('YmdHis')  . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('img/users', $fileName);
            $user->image = $path;
        }
        $user->save();
        return redirect()->route('user.index')->with('alert', 'Successfully edited!');
    }
    public function delete($id)
    {
        $user = Users::find($id);
        if (!$user) {
            return redirect()->route('user.index')->with('error','User not found');
        }
        if($user->status == 0){
            $user->status = 1;
            $user->save();
            return redirect()->route('user.index')->with('alert','Successfully restored');
        }
        else{
            $user->status = 0;
            $user->save();
            return redirect()->route('user.index')->with('alert','Successfully deleted');
        }
    }
}
