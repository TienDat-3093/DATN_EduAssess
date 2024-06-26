<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use Illuminate\Http\Request;
use App\Exports\ExportTags;
use App\Imports\ImportTags;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Tags;
use App\Models\Tests;

class TagsController extends Controller
{
    public function importTags(Request $re)
    {
        if($re->hasFile('importTags_file')){
            $tagsFile = $re->file('importTags_file');
            $tagsExtension = strtolower($tagsFile->getClientOriginalExtension());
            if ($tagsExtension == 'xlsx') {
                try {
                    Excel::import(new ImportTags, $tagsFile);
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
    public function exportTags() 
    {
        return Excel::download(new ExportTags, 'tags.xlsx');
    }
    public function index(){
        $listTags = Tags::withTrashed()->get();
        return view('/tag/index',compact('listTags'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('data');
        $listTags = Tags::withTrashed()->where('name', 'like', "%$keyword%")->get();
        return view('tag/results', compact('listTags'));
    }
    public function createHandle(TagsRequest $request){
        $tag = new Tags();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tag.index')->with(['success' => true, 'alert' => 'Successfully created']);
    }
    public function editHandle(TagsRequest $request, $id){
        $tag = Tags::find($id);
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tag.index')->with(['success' => true, 'alert' => 'Successfully edited']);
    }
    public function deleteHandle($id){
        $tag = Tags::withTrashed()->find($id);
        if (!$tag) {
            return redirect()->route('tag.index')->with(['success' => false, 'alert' => 'Tag not found']);
        }
        if($tag->trashed()){
            $tag->restore();
            return redirect()->route('tag.index')->with(['success' => true, 'alert' => 'Successfully restored']);
        }
        else{
            if(Tests::isTagUsedInTests($id)){
                return redirect()->route('tag.index')->with(['success' => false, 'alert' => 'Tag is already in use!']);
            }
            $tag->delete();
            return redirect()->route('tag.index')->with(['success' => true, 'alert' => 'Successfully deleted']);
        }
    }
}
