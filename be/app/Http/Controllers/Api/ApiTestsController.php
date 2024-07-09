<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tests;
use App\Models\QuestionsAdmin;
use App\Models\QuestionUser;
use App\Models\Topics;
use App\Models\Tags;
use App\Models\Users;
use App\Models\AnswersAdmin;
use App\Models\AnswersUser;
use App\Models\QuestionTypes;
use App\Models\Levels;
use Faker\Core\Number;
use IntlChar;
use PhpParser\Node\Stmt\TryCatch;

class ApiTestsController extends Controller
{
    public function index()
    {
        $listTests = Tests::whereNull('deleted_at')->where('privacy','!==',1)->get();

        if ($listTests) {
            foreach ($listTests as $test) {
                $test->test_url = asset($test->test_img);
                $topicIds = json_decode($test->topic_data);
                $tagIds = json_decode($test->tag_data);
                $topics = [];
                $tags = [];

                $user = Users::find($test->user_id);
                $test->user = $user;
                if (!empty($topicIds)) {
                    foreach ($topicIds as $topicId) {
                        $topic = Topics::find($topicId);
                        if ($topic) {
                            $topics[] = $topic;
                        }
                    }
                }

                if (!empty($tagIds)) {
                    foreach ($tagIds as $tagId) {
                        $tag = Tags::find($tagId);
                        if ($tag) {
                            $tags[] = $tag;
                        }
                    }
                }
                $test->topics = $topics;
                $test->tags = $tags;
            }
        }

        if (!empty($listTests)) {
            return response()->json([
                'success' => true,
                'data' => $listTests,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Don't have test",
        ]);
    }

    public function show($id)
    {
        $test = Tests::whereNull('deleted_at')->find($id);
        $test->test_url = asset($test->test_img);
        if (!empty($test)) {
            $user = Users::where("user_id", $test->user_id);
            if ($user) {
                $test->user = $user;
            }

            $topicIds = json_decode($test->topic_data);
            $tagIds = json_decode($test->tag_data);
            if (!empty($test->question_admin)) {
                $questionIds = json_decode($test->question_admin);
                $is_admin = 1;
            }
            if (!empty($test->question_user)) {
                $questionIds = json_decode($test->question_user);
                $is_admin = 0;
            }

            $tags = [];
            $topics = [];
            $questions = [];

            if (!empty($topicIds)) {
                foreach ($topicIds as $topicId) {
                    $topic = Topics::find($topicId);
                    $topics[] = $topic;
                }
            }
            if (!empty($tagIds)) {
                foreach ($tagIds as $tagId) {
                    $tag = Tags::find($tagId);
                    $tags[] = $tag;
                }
            }

            if (!empty($questionIds)) {
                foreach ($questionIds as $questionId) {
                    if ($is_admin == 1) {
                        $questionAdmin = QuestionsAdmin::find($questionId);
                        $questionType = QuestionTypes::find($questionAdmin->question_type_id);

                        $answerAdmin = AnswersAdmin::where('question_admin_id', $questionId)->first();
                        if (!empty($answerAdmin)) {
                            $answers = json_decode($answerAdmin->answer_data);
                            foreach ($answers as $answer) {
                                $answer->answer_url = asset($answer->img);
                            }
                        }

                        $questionAdmin->type = $questionType;
                        $questionAdmin->answers = $answers;

                        $questions[] = $questionAdmin;

                        $questionAdmin->question_url = asset($questionAdmin->question_img);
                    } else {

                        $questionUser = QuestionUser::find($questionId);
                        $questionType = QuestionTypes::find($questionUser->question_type_id);

                        $answerUser = AnswersUser::where('question_user_id', $questionId)->first();
                        if (!empty($answerUser)) {

                            $answers = json_decode($answerUser->answer_data);

                            foreach ($answers as $answer) {
                                $answer->answer_url = asset($answer->img);
                            }
                        }

                        $questionUser->type = $questionType;
                        $questionUser->answers = $answers;
                        $answers = '';

                        $questions[] = $questionUser;

                        $questionUser->question_url = asset($questionUser->question_img);
                    }
                }
            }

            $test->tags = $tags;
            $test->topics = $topics;
            $test->questions = $questions;

            if (!empty($test)) {
                return response()->json([
                    'success' => true,
                    'data' => $test,
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => "Không có bài kiểm tra",
            ]);
        }
    }



    public function indexUser(Request $request)
    {

        $userId = $request->query('userId');

        $listExams = Tests::where('user_id', $userId)->get();

        if ($listExams) {
            foreach ($listExams as $exam) {
                $exam->test_url = asset($exam->test_img);
                $topicIds = json_decode($exam->topic_data);
                $tagIds = json_decode($exam->tag_data);
                $topics = [];
                $tags = [];

                $user = Users::find($exam->user_id);
                $exam->user = $user;
                if (!empty($topicIds)) {
                    foreach ($topicIds as $topicId) {
                        $topic = Topics::find($topicId);
                        if ($topic) {
                            $topics[] = $topic;
                        }
                    }
                }

                if (!empty($tagIds)) {
                    foreach ($tagIds as $tagId) {
                        $tag = Tags::find($tagId);
                        if ($tag) {
                            $tags[] = $tag;
                        }
                    }
                }
                $exam->topics = $topics;
                $exam->tags = $tags;
            }
        }

        if (!empty($listExams)) {
            return response()->json([
                'success' => true,
                'data' => $listExams,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Don't have test",
        ]);
    }
    public function getQuestion(Request $request)
    {
        $levelIds = $request->query('levelIds');
        $topicIds = $request->query('topicIds');
        $userId = $request->query('userId');
        $quantity = $request->query('quantity');
        $quesReturnId = $request->query('quesReturnId');


        $query = QuestionUser::whereNull('deleted_at')->where('user_id', $userId)->withTrashed();

        if (!empty($levelIds)) {
            $levelIdsArray = explode(',', $levelIds);
            $query->whereIn('level_id', $levelIdsArray);
        }

        if (!empty($topicIds)) {
            $topicIdsArray = explode(',', $topicIds);
            $query->whereIn('topic_id', $topicIdsArray);
        }
        if (!empty($quesReturnId)) {
            $query->whereNotIn('id', $quesReturnId);
        }
        $listQuestions = $query->inRandomOrder()->take($quantity)->get();
        foreach ($listQuestions as $question) {
            $question->question_url = asset($question->question_img);
            $question->level = Levels::find($question->level_id);
            $question->topic = Topics::find($question->topic_id);
            $question->type = QuestionTypes::find($question->question_type_id);
        }
        $message = 0;
        if ($listQuestions->count() < $quantity) {
            if ($listQuestions->count() == 0) {
                $message = "Không có câu hỏi nào";
            }
            $message = "Không đủ câu hỏi. Thêm được " . $listQuestions->count() . " câu hỏi";
        } else {
            $message = "Đã thêm " . $listQuestions->count() . " câu hỏi";
        }
        $processed = [];
        $processed[] = [
            'questions' => $listQuestions,
        ];

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $processed,
        ]);
    }

    public function create(Request $request)
    {

        $formData = $request->all();
        $data = $formData['formData'];

        $test = new Tests();
        $test->name = $data["examText"];

        if (isset($data["examImg"])) {

            $file = $data["examImg"];
            $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('img/exams', $fileName);
            $test->test_img = $path;
        }

        $questions = [];
        foreach ($data["questions"] as $question) {
            $questions[] = $question['questionId'];
        }


        $test->question_user = json_encode(array_unique($questions));



        $test->password = $data['password'];


        $test->topic_data = json_encode(array_unique($data["questionTopics"]));
        $test->tag_data = json_encode(array_unique($data["tags"]));

        $test->done_count = 0;
        $test->privacy = (int)$data["privacy"];
        $test->user_id = (int)$data["userId"];

        $test->save();

        return response()->json([
            'success' => true,
            'message' => "Thêm mới bài kiểm tra thành công",
        ]);
    }

    public function showExamEdit(Request $request)
    {
        $id = $request->query("examId");
        $test = Tests::find($id);
        $test->test_url = asset($test->test_img);
        if (!$test) {
            return response()->json([
                'success' => false,
                'message' => "Không có bài kiểm tra",
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $test,
        ]);
    }

    public function edit(Request $request)
    {

        $formData = $request->all();
        $data = $formData['formData'];

        $test = Tests::find($data["examId"]);
        $test->name = $data["examText"];


        if (isset($data["examImg"])) {
            if (is_uploaded_file($data["examImg"])) {
                $file = $data["examImg"];
                $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('img/exams', $fileName);
                $test->test_img = $path;
            } else {
                $test->test_img = $data["examImg"];
            }
        }
        $test->tag_data = json_encode(array_unique($data["tags"]));

        $test->password = $data["password"];

        $test->privacy = (int)$data["privacy"];
        $test->user_id = (int)$data["userId"];

        $test->save();

        return response()->json([
            'success' => true,
            'message' => "Cập nhật thành công",
        ]);
    }
    public function delete(Request $request)
    {
        $formData = $request->all();
        $data = $formData["formData"];



        $test = Tests::withTrashed()->find($data["examId"]);
        if (!$test) {
            return response()->json([
                'success' => true,
                'message' => "Không tìm thấy bài kiểm tra nào",
            ]);
        }

        if ($test->trashed()) {
            $test->restore();
            return response()->json([
                'success' => true,
                'message' => "Khôi phục thành công"
            ]);
        } else {
            $test->delete();
            return response()->json([
                'success' => true,
                'message' => "Bài kiểm tra đã xóa thành công"
            ]);
        }
    }
    public function search(Request $request)
    {
        $keyword = $request->query("keyword");
        $userId = $request->query("userId");

        $listExams = Tests::where("user_id", "=", $userId)->where("name", 'like', "%$keyword%")->get();
        if ($listExams) {
            foreach ($listExams as $exam) {
                $exam->test_url = asset($exam->test_img);
                $topicIds = json_decode($exam->topic_data);
                $tagIds = json_decode($exam->tag_data);
                $topics = [];
                $tags = [];

                $user = Users::find($exam->user_id);
                $exam->user = $user;
                if (!empty($topicIds)) {
                    foreach ($topicIds as $topicId) {
                        $topic = Topics::find($topicId);
                        if ($topic) {
                            $topics[] = $topic;
                        }
                    }
                }

                if (!empty($tagIds)) {
                    foreach ($tagIds as $tagId) {
                        $tag = Tags::find($tagId);
                        if ($tag) {
                            $tags[] = $tag;
                        }
                    }
                }
                $exam->topics = $topics;
                $exam->tags = $tags;
            }
        }

        if (!empty($listExams)) {
            return response()->json([
                'success' => true,
                'data' => $listExams,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Không có bài kiểm tra",
        ]);
    }
    public function filter(Request $request)
    {
        $outstanding = $request->query("outstanding");
        $new = $request->query("new");
        $userId = $request->query("userId");

        $query = Tests::where("user_id", "=", $userId);
        if ($new == true) {
            $query->orderBy('created_at', 'desc');
        }
        $listExams = $query->get();
        if ($listExams) {
            foreach ($listExams as $exam) {
                $exam->test_url = asset($exam->test_img);
                $topicIds = json_decode($exam->topic_data);
                $tagIds = json_decode($exam->tag_data);
                $topics = [];
                $tags = [];

                $user = Users::find($exam->user_id);
                $exam->user = $user;
                if (!empty($topicIds)) {
                    foreach ($topicIds as $topicId) {
                        $topic = Topics::find($topicId);
                        if ($topic) {
                            $topics[] = $topic;
                        }
                    }
                }

                if (!empty($tagIds)) {
                    foreach ($tagIds as $tagId) {
                        $tag = Tags::find($tagId);
                        if ($tag) {
                            $tags[] = $tag;
                        }
                    }
                }
                $exam->topics = $topics;
                $exam->tags = $tags;
            }
        }

        if (!empty($listExams)) {
            return response()->json([
                'success' => true,
                'data' => $listExams,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Không có bài kiểm tra",
        ]);
    }
}
