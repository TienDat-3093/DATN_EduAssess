<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserStats;
use App\Models\UserStatsDetails;
use App\Models\Tests;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApiUserStatsController extends Controller
{
    public function create(Request $request)
    {
        $formData = $request->all();
        $data = $formData['formData'];
        $listUserStats = UserStats::where("test_id", $data['testId'])->where("user_id", $data['userId'])->first();

        if (empty($listUserStats)) {

            $userStats = new UserStats();
            $userStats->count = 1;
            $userStats->test_id = $data['testId'];
            $userStats->user_id = $data['userId'];
            $userStats->save();
        } else {

            $userStats = UserStats::where("test_id", $data['testId'])->where("user_id", $data['userId'])->first();
            $userStats->count = $userStats->count + 1;

            $userStats->test_id = $data['testId'];
            $userStats->user_id = $data['userId'];
            $userStats->save();
        }


        $userStatsDetail = new UserStatsDetails();
        $userStatsDetail->question_right = $data['questionRight'];
        $userStatsDetail->question_wrong = (int)$data['totalQuestion'] - (int)$data['questionRight'];
        $userStatsDetail->total_time = $data['totalTimer'] / 1000;
        $userStatsDetail->finished_at = date('Y-m-d H:i:s');
        $userStatsDetail->user_stats_id = $userStats->id;
        $userStatsDetail->save();
        return response()->json([
            'success' => true,
            'message' => "Đã hoàn thành bài kiểm tra",


        ]);
    }

    public function indexUserStatsToUser(Request $request)
    {
        $id = $request->query('userId');
        $page = $request->query('page', 1);
        $itemsPerPage = $request->query('itemsPerPage', 10);

        $query = UserStats::where('user_id', $id);

        $total = $query->count();
        $userStatsList = $query->skip(($page - 1) * $itemsPerPage)->take($itemsPerPage)->get();

        $boxUserStats = [];

        foreach ($userStatsList as $userStats) {
            $test = $userStats->test;
            $userStatsDetailsList = $userStats->userStatsDetails;

            foreach ($userStatsDetailsList as $userStatsDetail) {
                $finishedAt = Carbon::parse($userStatsDetail->finished_at)->format('H:i:s d-m-Y');

                $boxUserStats[] = [
                    'testName' => $test->name,
                    'questionRight' => $userStatsDetail->question_right,
                    'questionWrong' => $userStatsDetail->question_wrong,
                    'totalQuestion' => $userStatsDetail->question_right + $userStatsDetail->question_wrong,
                    'totalTime' => $userStatsDetail->total_time,
                    'finished' => $finishedAt,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'data' => $boxUserStats,
            'total' => $total,
        ]);
    }
    public function indexUserStatsToExam(Request $request)
    {
        $id = $request->query('examId');

        $userStatsList = UserStats::where('test_id', $id)->get();

        $boxUserStats = [];

        foreach ($userStatsList as $userStats) {
            $test = $userStats->user;
            $userStatsDetailsList = $userStats->userStatsDetails;

            foreach ($userStatsDetailsList as $userStatsDetail) {
                $finishedAt = Carbon::parse($userStatsDetail->finished_at)->format('H:i:s d-m-Y');

                $boxUserStats[] = [
                    'testName' => $test->name,
                    'questionRight' => $userStatsDetail->question_right,
                    'questionWrong' => $userStatsDetail->question_wrong,
                    'totalQuestion' => $userStatsDetail->question_right + $userStatsDetail->question_wrong,
                    'totalTime' => $userStatsDetail->total_time,
                    'finished' => $finishedAt,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'data' => $boxUserStats,

        ]);
    }
}
