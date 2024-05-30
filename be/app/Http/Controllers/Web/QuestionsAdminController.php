<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\QuestionsAdmin;
use App\Models\QuestionTypes;
use App\Models\Levels;
use App\Models\Topics;

class QuestionsAdminController extends Controller
{
    public function index()
    {
        $listTopics = Topics::all();
        $listLevels = Levels::all();
        $listTypes = QuestionTypes::all();
        $listQuestions = QuestionsAdmin::all();
        return view('question/index',compact('listTopics','listLevels','listTypes','listQuestions'));
    }
}
