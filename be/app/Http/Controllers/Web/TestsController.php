<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Tests;
use App\Models\QuestionsAdmin;
use App\Models\QuestionTypes;
use App\Models\Topics;
use App\Models\Levels;
use App\Models\Tags;

class TestsController extends Controller
{
    public function index(){
        $listTests = Tests::withTrashed()->get();
        return view('/test/index',compact('listTests'));
    }
    public function create(){
        $listLevels = Levels::all();
        $listTopics = Topics::all();
        $listTags = Tags::all();
        $listTypes = QuestionTypes::all();
        $listQuestions = QuestionsAdmin::all();
        return view('/test/create', compact('listTopics','listLevels','listTypes','listQuestions','listTags'));
    }
    public function searchQuestion(Request $request)
    {
        $topic_id = $request->input('topic_id');
        $level_id = $request->input('level_id');
        $listTypes = QuestionTypes::all();
        $listTopics = Topics::all();
        $listLevels = Levels::all();
        $listQuestions = QuestionsAdmin::when($topic_id != 0, function ($query) use ($topic_id) {
            return $query->where('topic_id', $topic_id)->orderBy('level_id');
        })
        ->when($level_id != 0, function ($query) use ($level_id) {
            return $query->where('level_id', $level_id)->orderBy('topic_id');
        })
        ->when($topic_id == 0 && $level_id == 0, function ($query) {
            return $query;
        })
        ->get();
        return view('test/results', compact('listTopics','listLevels','listTypes','listQuestions'));
    }
    public function createHandle(TestsRequest $request){
        $test = new Tests();
        $test->name = $request->name;
        $test->question_data = json_encode($request->question_data);
        $test->topic_data = json_encode(array_unique($request->topic_data));
        $test->tag_data = json_encode($request->tag_data);
        $test->done_count = 0;
        $test->privacy = 0;
        $test->user_id = Auth::id();
        $test->save();
        return redirect()->route('test.index')->with('alert','Successfully created');
    }
    public function deleteHandle($id){
        $test = Tests::withTrashed()->find($id);
        if (!$test) {
            return redirect()->route('test.index')->with('error','test not found');
        }
        if($test->trashed()){
            $test->restore();
            return redirect()->route('test.index')->with('alert','Successfully restored');
        }
        else{
            $test->delete();
            return redirect()->route('test.index')->with('alert','Successfully deleted');
        }
    }
}
