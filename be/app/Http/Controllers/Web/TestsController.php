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
        $listTags = Tags::all();
        return view('/test/index',compact('listTests','listTags'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('data');
        $listTests = Tests::withTrashed()->where('name', 'like', "%$keyword%")->get();
        return view('test/results', compact('listTests'));
    }
    public function edit(Request $request,$id){
        if(!$request->tag_data)
            return redirect()->route('test.index')->withError("Tags can't be empty");
        $test = Tests::withTrashed()->find($id);
        $test->tag_data = json_encode(array_unique($request->tag_data));
        $test->save();
        return redirect()->route('test.index')->with('alert','Successfully edited');
    }
    public function getTags($id){
        $test = Tests::withTrashed()->find($id);
        $tag_data = $test->tag_data;
        return response()->json(['tag_data' => $tag_data]);
    }
    public function detail($id){
        $test = Tests::withTrashed()->find($id);
        $question_ids = json_decode($test->question_data);
        $listQuestions = QuestionsAdmin::whereIn('id', $question_ids)->get();
        return view('/test/details',compact('listQuestions'));
    }
    public function create(){
        $listLevels = Levels::all();
        $listTopics = Topics::all();
        $listTags = Tags::all();
        $listTypes = QuestionTypes::all();
        return view('/test/create', compact('listTopics','listLevels','listTypes','listTags'));
    }
    public function getQuestion(Request $request)
    {
        $topic_id = $request->has('topic_id') ? $request->input('topic_id') : null;
        $level_id = $request->has('level_id') ? $request->input('level_id') : null;
        $amount_question = $request->input('amount_question');
        $selected_questions = $request->input('selected_questions', []);
        $message = '';
        if($topic_id != null && $level_id != null){
            $listQuestions = QuestionsAdmin::when($topic_id != 0, function ($query) use ($topic_id) {
                return $query->where('topic_id', $topic_id)->orderBy('level_id');
            })
            ->when($level_id != 0, function ($query) use ($level_id) {
                return $query->where('level_id', $level_id)->orderBy('topic_id');
            })
            ->when($topic_id == 0 && $level_id == 0, function ($query) {
                return $query;
            })
            ->when(!empty($selected_questions), function ($query) use ($selected_questions){
                return $query->whereNotIn('id', $selected_questions);
            })
            ->inRandomOrder()
            ->take($amount_question)
            ->get();
            if ($listQuestions->count() < $amount_question) {
                if($listQuestions->count() == 0)
                    $message = 'No more questions available to be added. ';
                else
                $message = 'Not enough questions available. Added ' . $listQuestions->count() . ' new questions. ';
            }else{
                $message = 'Added ' . $listQuestions->count() . ' new questions. ';
            }
            if(!empty($selected_questions)){
            $selectedQuestions = QuestionsAdmin::whereIn('id', $selected_questions)->get();
            $listQuestions = $listQuestions->concat($selectedQuestions);
            }
        }else{
            // dd($selected_questions);
            $listQuestions = QuestionsAdmin::whereIn('id', $selected_questions)->get();
        }
        $listQuestions = $listQuestions->sortBy('id');
        $message = $message . ' Currently has ' . $listQuestions->count() . ' questions.';
        return view('/test/create_results', compact('listQuestions'))->with('message', $message);
    }
    public function createHandle(TestsRequest $request){
        $test = new Tests();
        $test->name = $request->name;
        $test->question_data = json_encode(array_unique($request->question_data));
        $topic_data = QuestionsAdmin::whereIn('id', $request->question_data)
        ->distinct('topic_id')
        ->pluck('topic_id')
        ->toArray();
        $test->topic_data = json_encode(array_unique($topic_data));
        $test->tag_data = json_encode(array_unique($request->tag_data));
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
