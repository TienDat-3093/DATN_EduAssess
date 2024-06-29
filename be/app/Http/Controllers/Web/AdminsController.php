<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Exports\ExportAdmins;
use App\Imports\ImportAdmins;
use Maatwebsite\Excel\Facades\Excel;

class AdminsController extends Controller
{
    public function importAdmins(Request $re)
    {
        if($re->hasFile('importAdmins_file')){
            $adminsFile = $re->file('importAdmins_file');
            $adminsExtension = strtolower($adminsFile->getClientOriginalExtension());
            if ($adminsExtension == 'xlsx') {
                try {
                    Excel::import(new ImportAdmins, $adminsFile);
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
        return redirect()->back()->with(['success'=> false, 'alert' => "Missing files!"]);
    }
    public function exportAdmins() 
    {
        return Excel::download(new ExportAdmins, 'admins.xlsx');
    }
    //Manage User
    public function index()
    {
        if(Auth::user()->admin_role < 2)
            return redirect()->route('dashboard.index')->with(['success' => false, 'alert' => 'No permission!']);
        $listUsers = Users::where('admin_role','!=', 0)->get();
        return view('admin/index', compact('listUsers'));
    }

    public function search(Request $request)
    {
        if(Auth::user()->admin_role < 2)
            return redirect()->route('dashboard.index')->with(['success' => false, 'alert' => 'No permission!']);
        $keyword = $request->input('data');
        $listUsers = Users::where(function ($query) use ($keyword) {
            $query->where('displayname', 'like', "%$keyword%")
                  ->orWhere('email', 'like', "%$keyword%");
        })
        ->where('admin_role', '!=', 0)
        ->get();
        return view('admin/results', compact('listUsers'));
    }
    public function createHandle(UsersRequest $request)
    {
        if(Auth::user()->admin_role < 2)
            return redirect()->route('dashboard.index')->with(['success' => false, 'alert' => 'No permission!']);
        $user = new Users();
        $user->displayname = $request->displayname;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->admin_role = 1;
        $user->password = Hash::make($request->password);
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = now()->format('YmdHis')  . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('img/users', $fileName);
            $user->image = $path;
        }
        $user->save();
        return redirect()->route('admin.index')->with(['success' => true, 'alert' => 'Successfully created!']);
    }
    public function getUser($id){
        if(Auth::user()->admin_role < 2)
            return redirect()->route('dashboard.index')->with(['success' => false, 'alert' => 'No permission!']);
        $user = Users::where('admin_role', '!=', 0)->find($id);
        return $user;
    }
    public function editHandle(Request $request, $id)
    {
        if(Auth::user()->admin_role < 2)
            return redirect()->route('dashboard.index')->with(['success' => false, 'alert' => 'No permission!']);
        if(Auth::user()->id == $id)
            return redirect()->route('admin.index')->with(['success' => false, 'alert' => 'Can not edit self with management board!']);
        $user = Users::where('admin_role', '!=', 0)->find($id);
        if(Auth::user()->admin_role <= $user->admin_role){
            return redirect()->route('admin.index')->with(['success' => false, 'alert' =>'Can not edit other same or higher rank admins!']);
        }
        $user = Users::where('admin_role', '!=', 0)->find($id);
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
        return redirect()->route('admin.index')->with(['success' => true, 'alert' => 'Successfully edited!']);
    }
    public function delete($id)
    {
        if(Auth::user()->admin_role < 2)
            return redirect()->route('dashboard.index')->with(['success' => false, 'alert' => 'No permission!']);
        if(Auth::user()->id == $id)
            return redirect()->route('admin.index')->with(['success' => false, 'alert' => 'Can not lock self!']);
        $user = Users::where('admin_role', '!=', 0)->find($id);
        if(Auth::user()->admin_role <= $user->admin_role){
            return redirect()->route('admin.index')->with(['success' => false, 'alert' => 'Can not unlock/lock other same or higher rank admins!']);
        }
        if (!$user) {
            return redirect()->route('admin.index')->with(['success' => false, 'alert' => 'User not found']);
        }
        if($user->status == 0){
            $user->status = 1;
            $user->save();
            return redirect()->route('admin.index')->with(['success' => true, 'alert' => 'Successfully unlocked']);
        }
        else{
            $user->status = 0;
            $user->save();
            return redirect()->route('admin.index')->with(['success' => true, 'alert' => 'Successfully locked']);
        }
    }
}