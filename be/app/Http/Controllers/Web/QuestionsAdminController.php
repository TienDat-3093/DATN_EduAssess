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
use App\Models\Tests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\ExportQuestionsAdmin;
use App\Imports\ImportQuestionsAdmin;
use App\Exports\ExportAnswersAdmin;
use App\Imports\ImportAnswersAdmin;
use Maatwebsite\Excel\Facades\Excel;

class QuestionsAdminController extends Controller
{
    public function importQuestions(Request $re)
    {
        if($re->hasFile('importQuestions_file') && $re->hasFile('importAnswers_file')){
            $questionsFile = $re->file('importQuestions_file');
            $answersFile = $re->file('importAnswers_file');
            $questionsExtension = strtolower($questionsFile->getClientOriginalExtension());
            $answersExtension = strtolower($answersFile->getClientOriginalExtension());
            if ($questionsExtension == 'xlsx' && $answersExtension == 'xlsx' ) {
                try {
                    Excel::import(new ImportQuestionsAdmin, $questionsFile);
                    Excel::import(new ImportAnswersAdmin, $answersFile);
                    return redirect()->back()->with('alert', "Import successful");
                } catch (\Exception $e) {
                    return redirect()->back()->with('alert', "Import failed. If your files are correct please make sure ['topics','users','levels','question_types'] have been imported!". $e->getMessage());
                }
            } else {
                return redirect()->back()->with('alert', "Invalid file format. Please upload .xlsx files.");
            }
        }
        return redirect()->back()->with('alert', "Missing files!");
    }
    public function exportQuestions()
    {
        return Excel::download(new ExportQuestionsAdmin, 'questionsadmin.xlsx');
    }
    public function exportAnswers()
    {
        return Excel::download(new ExportAnswersAdmin, 'answersadmin.xlsx');
    }
    public function index(Request $request){
        $topic_id = $request->input('topics_id');
        $level_id = $request->input('levels_id');
        if ($topic_id || $level_id) {
            return $this->search($request);
        }
        $listTopics = Topics::all();
        $listLevels = Levels::all();
        $listTypes = QuestionTypes::all();
        $listQuestions = QuestionsAdmin::withTrashed()->get();
        return view('question/index', compact('listTopics', 'listLevels', 'listTypes', 'listQuestions'));
    }
    public function search(Request $request)
    {
        $topic_id = $request->input('topics_id');
        $level_id = $request->input('levels_id');
        $listTypes = QuestionTypes::all();
        $listTopics = Topics::all();
        $listLevels = Levels::all();
        $listQuestions = QuestionsAdmin::withTrashed()->when($topic_id != 0, function ($query) use ($topic_id) {
            return $query->where('topic_id', $topic_id)->orderBy('level_id');
        })
        ->when($level_id != 0, function ($query) use ($level_id) {
            return $query->where('level_id', $level_id)->orderBy('topic_id');
        })
        ->when($topic_id == 0 && $level_id == 0, function ($query) {
            return $query;
        })
        ->get();
        return view('question/index', compact('listTopics','listLevels','listTypes','listQuestions'));
    }
    public function create(Request $request)
    {
        // dd($request->all());
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
        // dd($request->all());
        $question = QuestionsAdmin::find($id);

        if (!empty($question)) {
            $question->user_id = Auth::user()->id;
            $question->question_text = $request->edit_questionText;

            // Xử lý hình ảnh của câu hỏi
            if ($request->hasFile('edit_questionImg')) {
                // Thêm hình ảnh mới
                $file = $request->file('edit_questionImg');
                $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('img', $fileName);
                // Xóa hình ảnh cũ nếu có
                if (!empty($question->question_img) && Storage::exists($question->question_img)) {
                    Storage::delete($question->question_img);
                }
                $question->question_img = $path;
            }
            if(Tests::isQuestionUsedInTests($id)){
                if($question->level_id != $request->edit_level || $question->topic_id != $request->edit_topic){
                    return redirect()->route('question.index')->with('alert','Question is already in use! Cannot change level or topic!');
                }
            }
            $question->level_id = $request->edit_level;
            $question->topic_id = $request->edit_topic;
            $question->question_type_id = $request->edit_typeRadio;
            $question->save();
            //Lấy các data của ảnh cũ và bỏ vào 1 mảng
            $oldImgArray = [];
            $answersAdmin = AnswersAdmin::where('question_admin_id', $id)->first();
            if($answersAdmin !== null){
                $old_answer_data = json_decode($answersAdmin->answer_data);
                foreach ($old_answer_data as $answer) {
                    if (isset($answer->img)) {
                        $oldImgArray[] = $answer->img;
                    }
                }
            }
            AnswersAdmin::where('question_admin_id', $id)->delete();
            $answer = new AnswersAdmin();
            $answer->question_admin_id = $question->id;
            $answers = [];
            $i = 0;
            foreach ($request->edit_answerText as $index => $text) {
                $i++;
                $answerText = $text;
                $is_correct = isset($request->edit_answers[$index]) && $request->edit_answers[$index] ? 1 : 0;
                if ($request->hasFile("edit_answerImg.$index")) {
                    $file = $request->file("edit_answerImg.$index");
                    $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
                    // Thêm hình ảnh mới
                    $path = $file->storeAs('img/answers', $fileName);
                    // Xóa hình ảnh cũ tương ứng nếu có
                    $answers["answer_$i"] = [
                        'text' => $answerText,
                        'img' => $fileName,
                        'is_correct' => $is_correct
                    ];
                } else {
                    //Xóa ảnh trong array các ảnh cũ
                    if(isset($request->edit_answerImg[$index])){
                        $index = array_search($request->edit_answerImg[$index], $oldImgArray);
                        if ($index !== false) {
                            unset($oldImgArray[$index]);
                        }
                    }
                    $answers["answer_$i"] = [
                        'text' => $answerText,
                        'img' => (isset($request->edit_answerImg[$index]) ? $request->edit_answerImg[$index] : null),
                        'is_correct' => $is_correct
                    ];
                }
            }
            //Xóa các ảnh cũ không cần
            foreach ($oldImgArray as $img){
                if (Storage::exists('img/answers/' . $img))
                        Storage::delete('img/answers/' . $img);
            }
            $answersString = json_encode($answers);
            $answer->answer_data = $answersString;
            $answer->save();
            return redirect()->route('question.index')->with('alert', 'Successfully edited');
        }
    }
    public function deleteHandle($id)
    {
        $question = QuestionsAdmin::withTrashed()->find($id);
        if (!$question) {
            return redirect()->route('question.index')->with('error', 'Question not found');
        }
        if ($question->trashed()) {
            $topic = Topics::withTrashed()->find($question->topic_id);
            if($topic->trashed()){
                return redirect()->route('question.index')->with('alert', "Question's topic has been deleted, cannot restore");
            }
            $question->restore();
            return redirect()->route('question.index')->with('alert', 'Successfully restored');
        } else {
            if(Tests::isQuestionUsedInTests($id)){
                return redirect()->route('question.index')->with('alert','Question is already in use!');
            }
            $question->delete();
            return redirect()->route('question.index')->with('alert', 'Successfully deleted');
        }
    }
}
