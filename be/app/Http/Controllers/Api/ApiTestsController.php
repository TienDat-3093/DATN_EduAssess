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

class ApiTestsController extends Controller
{

    public function create()
    {
        $test = new Tests();
    }
}
