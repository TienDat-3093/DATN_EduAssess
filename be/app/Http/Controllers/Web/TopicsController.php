<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicsRequest;
use Illuminate\Http\Request;
use App\Exports\ExportTopics;
use App\Imports\ImportTopics;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Topics;

class TopicsController extends Controller
{
    public function importTopics(Request $re)
    {
        if($re->hasFile('importTopics_file')){
            $topicsFile = $re->file('importTopics_file');
            $topicsExtension = strtolower($topicsFile->getClientOriginalExtension());
            if ($topicsExtension == 'xlsx') {
                try {
                    Excel::import(new ImportTopics, $topicsFile);
                    return redirect()->back()->with('alert', "Import successful");
                } catch (\Exception $e) {
                    return redirect()->back()->with('alert', "Import failed! Please check if your files are correct.".$e->getMessage());
                }
            } else {
                return redirect()->back()->with('alert', "Invalid file format. Please upload .xlsx files.");
            }
        }
        return redirect()->back()->with('alert', "Missing files!");
    }
    public function exportTopics() 
    {
        return Excel::download(new ExportTopics, 'topics.xlsx');
    }
    public function index(){
        $listTopics = Topics::withTrashed()->get();
        return view('/topic/index',compact('listTopics'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('data');
        $listTopics = Topics::withTrashed()->where('name', 'like', "%$keyword%")->get();
        return view('topic/results', compact('listTopics'));
    }
    public function createHandle(TopicsRequest $request){
        $topic = new Topics();
        $topic->name = $request->name;
        $topic->save();
        return redirect()->route('topic.index')->with('alert','Successfully created');
    }
    public function editHandle(TopicsRequest $request, $id){
        $topic = Topics::find($id);
        $topic->name = $request->name;
        $topic->save();
        return redirect()->route('topic.index')->with('alert','Successfully edited');
    }
    public function deleteHandle($id){
        $topic = Topics::withTrashed()->find($id);
        if (!$topic) {
            return redirect()->route('topic.index')->with('error','Topic not found');
        }
        if($topic->trashed()){
            $topic->restore();
            return redirect()->route('topic.index')->with('alert','Successfully restored');
        }
        else{
            $topic->delete();
            return redirect()->route('topic.index')->with('alert','Successfully deleted');
        }
    }
}
