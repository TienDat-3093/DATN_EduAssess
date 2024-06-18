<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicsRequest;
use Illuminate\Http\Request;

use App\Models\Topics;

class TopicsController extends Controller
{
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
