<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function importUsers(Request $re)
    {
        if($re->hasFile('importUsers_file')){
            $usersFile = $re->file('importUsers_file');
            $usersExtension = strtolower($usersFile->getClientOriginalExtension());
            if ($usersExtension == 'xlsx') {
                try {
                    Excel::import(new ImportUsers, $usersFile);
                    return redirect()->back()->with(['success' => true, 'alert' => "Import successful"]);
                } catch (\Exception $e) {
                    if (isset($e->errorInfo) && $e->errorInfo[1] == 1062) { // Error code for duplicate entry in MySQL
                        return redirect()->back()->with(['success' => false, 'alert' => "Import failed! File contains duplicate entries which violates constraints."]);
                    } else{
                        return redirect()->back()->with(['success' => false, 'alert' => "Import failed! Please check if your files are correct.".$e->getMessage()]);
                    }
                }
            } else {
                return redirect()->back()->with(['success' => false, 'alert' => "Invalid file format. Please upload .xlsx files."]);
            }
        }
        return redirect()->back()->with(['success' => false, 'alert' => "Missing files!"]);
    }
    public function exportUsers() 
    {
        return Excel::download(new ExportUsers, 'users.xlsx');
    }
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
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1 ])){
            $user = Auth::user();
            if($user->admin_role == 0){
                Auth::logout();
                return redirect()->route('login')->with(['success' => false, 'alert' => 'No admin permission!']);
            }
            if ($user) {
                    return redirect()->route('dashboard.index');
                }
            }
        return redirect()->route('login')->with(['success' => false, 'alert' => 'Access denied!']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function editProfile(UsersRequest $request, $id)
    {
        if(Auth::user()->id != $id)
            return back()->with('alert', 'Incorrect user id!');
        $user = Users::find($id);
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('alert', 'Incorrect password!');
        }
        $user->displayname = $request->displayname;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->password = Hash::make($request->password);
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
        return redirect()->route('user.index')->with(['success' => true, 'alert' => 'Successfully edited!']);
    }
    // public function getLoginUser()
    // {
    //     if (Auth::check()) {
    //         $displayname = Auth::user()->displayname;
    //         return $displayname;
    //     }
    // }

    //Manage User
    public function index()
    {
        $listUsers = Users::where('admin_role', 0)->get();
        return view('user/index', compact('listUsers'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('data');
        $listUsers = Users::where(function ($query) use ($keyword) {
            $query->where('displayname', 'like', "%$keyword%")
                  ->orWhere('email', 'like', "%$keyword%");
        })
        ->where('admin_role', '==', 0)
        ->get();
        return view('user/results', compact('listUsers'));
    }
    public function createHandle(UsersRequest $request)
    {
        $user = new Users();
        $user->displayname = $request->displayname;
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
        return redirect()->route('user.index')->with(['success' => true, 'alert' => 'Successfully created!']);
    }
    public function getUser($id){
        $user = Users::where('admin_role', 0)->find($id);
        return $user;
    }
    public function editHandle(Request $request, $id)
    {
        $user = Users::where('admin_role', 0)->find($id);
        $user->displayname = $request->displayname;
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
        return redirect()->route('user.index')->with(['success' => true, 'alert' => 'Successfully edited!']);
    }
    public function delete($id)
    {
        $user = Users::where('admin_role', 0)->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with(['success' => false, 'alert' => 'User not found']);
        }
        if($user->status == 0){
            $user->status = 1;
            $user->save();
            return redirect()->route('user.index')->with(['success' => true, 'alert' => 'Successfully unlocked']);
        }
        else{
            $user->status = 0;
            $user->save();
            return redirect()->route('user.index')->with(['success' => true, 'alert' => 'Successfully locked']);
        }
    }
}
