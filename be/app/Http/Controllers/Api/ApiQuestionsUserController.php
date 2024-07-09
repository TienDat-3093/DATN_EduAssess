<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionUser;
use App\Models\QuestionsAdmin;
use App\Models\Topics;
use App\Models\Levels;
use App\Models\Tags;
use App\Models\QuestionTypes;
use App\Models\AnswersAdmin;
use App\Models\AnswersUser;
use App\Models\Tests;
use Illuminate\Support\Facades\Storage;
use Monolog\Level;

class ApiQuestionsUserController extends Controller
{

    public function index(Request $request)
    {


        $userId = $request->query('userId');

        $listQuestions = 0;

        $listQuestions = QuestionUser::where('user_id', '=', $userId)->withTrashed()->get();

        foreach ($listQuestions as $question) {
            $question->question_url = asset($question->question_img);
            $level = Levels::where('id', $question->level_id)->first();
            $topic = Topics::where('id', $question->topic_id)->first();
            $type = QuestionTypes::where('id', $question->question_type_id)->first();
            $question->level = $level;
            $question->topic = $topic;
            $question->type = $type;
        }
        $listLevels = Levels::whereNull('deleted_at')->get();
        $listTopics = Topics::whereNull('deleted_at')->get();
        $listTypes = QuestionTypes::whereNull('deleted_at')->get();
        $listTags = Tags::whereNull('deleted_at')->get();
        $processed = [];
        $processed[] = [
            'questions' => $listQuestions,
            'topics' => $listTopics,
            'levels' => $listLevels,
            'types' => $listTypes,
            'tags' => $listTags,
        ];
        if (!empty($processed)) {
            return response()->json([
                'success' => true,
                'data' => $processed,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Không có câu hỏi',
        ]);
    }
    public function filter(Request $request)
    {
        $levelIds = $request->query('levelIds');
        $topicIds = $request->query('topicIds');
        $userId = $request->query('userId');
        $query = QuestionUser::where('user_id', $userId);

        if (!empty($levelIds)) {
            $levelIdsArray = explode(',', $levelIds);
            $query->whereIn('level_id', $levelIdsArray);
        }

        if (!empty($topicIds)) {
            $topicIdsArray = explode(',', $topicIds);
            $query->whereIn('topic_id', $topicIdsArray);
        }
        $listQuestions = $query->withTrashed()->get();
        foreach ($listQuestions as $question) {
            $question->question_url = asset($question->question_img);
            $question->level = Levels::find($question->level_id);
            $question->topic = Topics::find($question->topic_id);
            $question->type = QuestionTypes::find($question->question_type_id);
        }
        $listLevels = Levels::whereNull('deleted_at')->get();
        $listTopics = Topics::whereNull('deleted_at')->get();
        $listTypes = QuestionTypes::whereNull('deleted_at')->get();
        $processed = [];
        $processed[] = [
            'questions' => $listQuestions,
            'topics' => $listTopics,
            'levels' => $listLevels,
            'types' => $listTypes,
        ];

        if (!empty($processed)) {
            return response()->json([
                'success' => true,
                'data' => $processed,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không có câu hỏi',
        ]);
    }
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');
        $userId = $request->query('userId');
        $adminRole = $request->query('adminRole');


        $query = QuestionUser::where('user_id', '=', $userId);

        $query->where('question_text', 'like', "%$keyword%");
        $listQuestions = $query->withTrashed()->get();
        foreach ($listQuestions as $question) {
            $question->question_url = asset($question->question_img);
            $level = Levels::where('id', $question->level_id)->first();
            $topic = Topics::where('id', $question->topic_id)->first();
            $type = QuestionTypes::where('id', $question->question_type_id)->first();
            $question->level = $level;
            $question->topic = $topic;
            $question->type = $type;
        }

        $listLevels = Levels::whereNull('deleted_at')->get();
        $listTopics = Topics::whereNull('deleted_at')->get();
        $listTypes = QuestionTypes::whereNull('deleted_at')->get();
        $processed = [];
        $processed[] = [
            'questions' => $listQuestions,
            'topics' => $listTopics,
            'levels' => $listLevels,
            'types' => $listTypes,
        ];

        if (!empty($processed)) {
            return response()->json([
                'success' => true,
                'data' => $processed,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không có câu hỏi',
        ]);
    }
    public function show(Request $request)
    {
        $questionId = $request->query('questionId');
        $userId = $request->query('userId');

        $answers = [];
        if ($questionId) {

            $question = QuestionUser::where('user_id', '=', $userId)->withTrashed()->find($questionId);
            $answer = AnswersUser::where('question_user_id', '=', $questionId)->first();

            if ($answer) {
                $answerData = json_decode($answer->answer_data);
                foreach ($answerData as $answer) {
                    $answer->answer_url = asset($answer->img);
                    $answers[] = $answer;
                }

                $question->answers = $answers;
            }

            $question->question_url = asset($question->question_img);
            $questionArray = $question->toArray();

            if (!empty($question)) {
                return response()->json([
                    'success' => true,
                    'data' => $questionArray,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Không có câu hỏi',
            ]);
        }
    }
    public function create(Request $request)
    {
        $formData = $request->all();
        $data = $formData['formData'];

        if ($data['adminRole'] == "0") {
            $question = new QuestionUser();
        } else {
            $question = new QuestionsAdmin();
        }
        $question->question_text = $data['questionText'];

        if (isset($data["questionImage"])) {
            $file = $data["questionImage"];
            $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('img/questions', $fileName);
            $question->question_img = $path;
        }

        $question->user_id = $data['user'];
        $question->question_type_id = $data['type'];
        $question->level_id = $data['level'];
        $question->topic_id = $data['topic'];
        $question->save();

        if ($data['adminRole'] == "0") {
            $answer = new AnswersUser();
            $answer->question_user_id = $question->id;
        } else {
            $answer = new AnswersAdmin();
            $answer->question_admin_id = $question->id;
        }

        $answers = [];
        $i = 0;


        foreach ($data["answers"] as $index => $item) {

            $i++;
            $text = $item["answerText"];
            $is_correct = $item["answerCorrect"] === 'true' ? 1 : 0;
            if (isset($item["answerImage"])) {
                $file = $item["answerImage"];
                $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('img/answers', $fileName);

                $answers["answer_$i"] = [
                    'text' => $text,
                    'img' => $path,
                    'is_correct' => $is_correct
                ];
            } else {
                $answers["answer_$i"] = [
                    'text' => $text,
                    'img' => null,
                    'is_correct' => $is_correct

                ];
            }
        }

        $answersString = json_encode($answers);

        $answer->answer_data = $answersString;

        $answer->save();
        return response()->json([
            'success' => true,
            'message' => "Thêm thành công"
        ]);
    }
    public function edit(Request $request)
    {

        $formData = $request->all();
        $data = $formData['formData'];


        $question = QuestionUser::find($data['questionId']);

        $question->question_text = $data['questionText'];



        if (isset($data["questionImage"])) {
            if (is_uploaded_file($data["questionImage"])) {
                $file = $data["questionImage"];
                $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('img/questions', $fileName);
                $question->question_img = $path;
            } else {
                $question->question_img = $data["questionImage"];
            }
        }


        $question->user_id = $data['user'];
        $question->question_type_id = $data['type'];
        $question->level_id = $data['level'];
        $question->topic_id = $data['topic'];
        $question->save();



        AnswersUser::where('question_user_id', $data['questionId'])->delete();
        $answer = new AnswersUser();
        $answer->question_user_id = $data['questionId'];


        $answers = [];
        $i = 0;


        foreach ($data["answers"] as $index => $item) {

            $i++;
            $text = $item["answerText"];
            $is_correct = $item["answerCorrect"] === 'true' ? 1 : 0;

            if (isset($item["answerImage"])) {
                if (is_uploaded_file($item["answerImage"])) {
                    $file = $item["answerImage"];
                    $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('img/answers', $fileName);
                } else {
                    $path = $item["answerImage"];
                }
                $answers["answer_$i"] = [
                    'text' => $text,
                    'img' => $path,
                    'is_correct' => $is_correct
                ];
            } else {
                $answers["answer_$i"] = [
                    'text' => $text,
                    'img' => null,
                    'is_correct' => $is_correct

                ];
            }
        }


        $answersString = json_encode($answers);

        $answer->answer_data = $answersString;

        $answer->save();
        return response()->json([
            'success' => true,
            'message' => "Cập nhật câu hỏi thành công"
        ]);
    }

    public function delete(Request $request)
    {
        $formData = $request->all();
        $data = $formData["formData"];

        $question = QuestionUser::withTrashed()->find($data['questionId']);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => "Không có câu hỏi"
            ]);
        }

        if ($question->trashed()) {
            $topic = Topics::withTrashed()->find($question->topic_id);
            return response()->json([
                'success' => true,
                'message' =>$topic::trashed()
            ]);
            if($topic && $topic::trashed())
            {
                return response()->json([
                    'success' => false,
                    'message' => "Không thể khôi phục, chủ đề không tồn tại"
                ]);
            }
            $question->restore();
            return response()->json([
                'success' => true,
                'message' => "Khôi phục thành công"
            ]);
        } else {
            $tests = Tests::select('question_user')->get();

            foreach ($tests as $test) {
                if ($test !== NULL && $test->question_user !==null) {

                    if (in_array($question->id, json_decode($test->question_user))) {
                        $message = "Câu hỏi đang được sử dụng không thể xóa ";
                        return response()->json([
                            'success' => false,
                            'message' =>  $message,
                        ]);
                    }
                }
            }

            $question->delete();
            return response()->json([
                'success' => true,
                'message' => "Câu hỏi đã xóa thành công"
            ]);
        }
    }
}
