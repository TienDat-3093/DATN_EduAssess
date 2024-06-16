<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    //Manage User
    public function index()
    {
        if(Auth::user()->id !== 1)
            return redirect()->route('dashboard.index')->with('alert', 'No permission!');
        $listUsers = Users::where('is_admin', 1)->get();
        return view('admin/index', compact('listUsers'));
    }

    public function search(Request $request)
    {
        if(Auth::user()->id !== 1)
            return redirect()->route('dashboard.index')->with('alert', 'No permission!');
        $keyword = $request->input('data');
        $listUsers = Users::where('username', 'like', "%$keyword%")
                        ->where('is_admin', 1)
                        ->get();
        return view('admin/results', compact('listUsers'));
    }
    public function createHandle(UsersRequest $request)
    {
        if(Auth::user()->id !== 1)
            return redirect()->route('dashboard.index')->with('alert', 'No permission!');
        $user = new Users();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->is_admin = 1;
        $user->password = Hash::make($request->password);
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = now()->format('YmdHis')  . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('img/users', $fileName);
            $user->image = $path;
        }
        $user->save();
        return redirect()->route('admin.index')->with('alert', 'Successfully created!');
    }
    public function getUser($id){
        if(Auth::user()->id !== 1)
            return redirect()->route('dashboard.index')->with('alert', 'No permission!');
        $user = Users::where('is_admin', 1)->find($id);
        return $user;
    }
    public function editHandle(Request $request, $id)
    {
        if(Auth::user()->id !== 1)
            return redirect()->route('dashboard.index')->with('alert', 'No permission!');
        $user = Users::where('is_admin', 1)->find($id);
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
        return redirect()->route('admin.index')->with('alert', 'Successfully edited!');
    }
    public function delete($id)
    {
        if(Auth::user()->id !== 1)
            return redirect()->route('dashboard.index')->with('alert', 'No permission!');
        if($id == 1){
            return redirect()->route('admin.index')->with('alert','Can not delete the lead admin!');
        }
        $user = Users::where('is_admin', 1)->find($id);
        if (!$user) {
            return redirect()->route('admin.index')->with('alert','User not found');
        }
        if($user->status == 0){
            $user->status = 1;
            $user->save();
            return redirect()->route('admin.index')->with('alert','Successfully restored');
        }
        else{
            $user->status = 0;
            $user->save();
            return redirect()->route('admin.index')->with('alert','Successfully deleted');
        }
    }
}