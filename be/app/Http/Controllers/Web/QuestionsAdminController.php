<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\QuestionsRequest;

use App\Models\QuestionsAdmin;
use App\Models\QuestionTypes;
use App\Models\Levels;
use App\Models\Topics;
use App\Models\AnswersAdmin;
use Illuminate\Support\Facades\Auth;

class QuestionsAdminController extends Controller
{
    public function index()
    {
        $listTopics = Topics::all();
        $listLevels = Levels::all();
        $listTypes = QuestionTypes::all();
        $listQuestions = QuestionsAdmin::withTrashed()->get();
        return view('question/index', compact('listTopics', 'listLevels', 'listTypes', 'listQuestions'));
    }

    public function create(Request $request)
    {
        /* dd($request->all()); */
        $question = new QuestionsAdmin();
        $question->user_id = Auth::user()->id;
        $question->question_text = $request->create_questionText;

        if ($request->hasFile('create_questionImg')) {
            $file = $request->file('create_questionImg');
            $fileName = now()->format('YmdHis')  . '_' . $file->getClientOriginalName();
            $path = $request->file('create_questionImg')->storeAs('img', $fileName);
            $question->question_img = $path;
        }
        $question->level_id = $request->create_level;
        $question->topic_id = $request->create_topic;
        $question->question_type_id = $request->create_typeRadio;
        $question->save();

        $answer = new AnswersAdmin();

        $answer->question_admin_id = $question->id;
        $answers = [];
        $i = 0;
        foreach ($request->create_answerText as $index => $text) {
            $i++;
            $answerText = $text;

            $is_correct = isset($request->create_answers[$index]) && $request->create_answers[$index] ? 1 : 0;

            if ($request->hasFile("create_answerImg.$index")) {
                $file = $request->file("create_answerImg.$index");
                $fileName = now()->format('YmdHis')  . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('img/answers', $fileName);


                $answers["answer_$i"] = [
                    'text' => $answerText,
                    'img' => $fileName,
                    'is_correct' => $is_correct
                ];
            } else {
                $answers["answer_$i"] = [
                    'text' => $answerText,
                    'img' => null,
                    'is_correct' => $is_correct
                ];
            }
        }

        $answersString = json_encode($answers);

        $answer->answer_data = $answersString;
        $answer->save();
        return redirect()->route('question.index')->with('alert', 'Successfully created');
    }

    public function edit($id)
    {
        $question = QuestionsAdmin::find($id);
        $answers = AnswersAdmin::where('question_admin_id', $id)->get();
        return response()->json(['data' => $question, 'answer' => $answers]);
    }

    public function editHandle(Request $request, $id)
    {

        $question = QuestionsAdmin::find($id);

        if (!empty($question)) {
            $question->user_id = Auth::user()->id;
            $question->question_text = $request->edit_questionText;

            if ($request->hasFile('edit_questionImg')) {
                $file = $request->file('edit_questionImg');
                $fileName = now()->format('YmdHis')  . '_' . $file->getClientOriginalName();
                $path = $request->file('edit_questionImg')->storeAs('img', $fileName);
                $question->question_img = $path;
            }
            $question->level_id = $request->edit_level;
            $question->topic_id = $request->edit_topic;
            $question->question_type_id = $request->edit_typeRadio;
            $question->save();
            AnswersAdmin::where('question_admin_id', $id)->delete();
            $answer =new AnswersAdmin();


            $answer->question_admin_id = $question->id;
            $answers = [];
            $i = 0;
            foreach ($request->edit_answerText as $index => $text) {
                $i++;
                $answerText = $text;

                $is_correct = isset($request->edit_answers[$index]) && $request->edit_answers[$index] ? 1 : 0;

                if ($request->hasFile("edit_answerImg.$index")) {
                    $file = $request->file("edit_answerImg.$index");
                    $fileName = now()->format('YmdHis')  . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('img/answers', $fileName);


                    $answers["answer_$i"] = [
                        'text' => $answerText,
                        'img' => $fileName,
                        'is_correct' => $is_correct
                    ];
                } else {
                    $answers["answer_$i"] = [
                        'text' => $answerText,
                        'img' => null,
                        'is_correct' => $is_correct
                    ];
                }
            }

            $answersString = json_encode($answers);

            $answer->answer_data = $answersString;
            $answer->save();


            return redirect()->route('question.index')->with('alert', 'Successfully edited');
        }
    }
    public function deleteHandle($id){
        $question = QuestionsAdmin::withTrashed()->find($id);
        if (!$question) {
            return redirect()->route('question.index')->with('error','Tag not found');
        }
        if($question->trashed()){
            $question->restore();
            return redirect()->route('question.index')->with('alert','Successfully restored');
        }
        else{
            $question->delete();
            return redirect()->route('question.index')->with('alert','Successfully deleted');
        }
    }
}
