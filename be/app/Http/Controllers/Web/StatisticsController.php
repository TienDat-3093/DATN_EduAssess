<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\QuestionsAdmin;
use App\Models\QuestionTypes;
use App\Models\Levels;
use App\Models\Topics;
use App\Models\AnswersAdmin;
use App\Models\Tests;

class StatisticsController extends Controller
{
    public function getYears(){
        $years = QuestionsAdmin::selectRaw('YEAR(created_at) as year')
                           ->distinct()
                           ->orderBy('year', 'desc')
                           ->get()
                           ->pluck('year');

        return response()->json(['years' => $years]);
    }
    public function getMonthly($year,$month){
        // Select questions made in the year
        $statistics = QuestionsAdmin::whereYear('created_at', $year)
        ->get();

        // Create an array to hold counts for each month
        $monthlyCounts = [
            'January' => 0,
            'February' => 0,
            'March' => 0,
            'April' => 0,
            'May' => 0,
            'June' => 0,
            'July' => 0,
            'August' => 0,
            'September' => 0,
            'October' => 0,
            'November' => 0,
            'December' => 0,
        ];

        // Count questions by month
        foreach ($statistics as $statistic) {
            $temp_month = date('F', strtotime($statistic->created_at));
            $monthlyCounts[$temp_month]++;
        }
        $monthlyResult = [];
        foreach ($monthlyCounts as $temp_month => $count) {
            $monthlyResult[] = [
                'month' => $temp_month,
                'count' => $count,
            ];
        }
        $statistics_byMonth = QuestionsAdmin::whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get();
        // Calculate weekly counts for the specified month
        $weeklyCounts = [];

        // Get the number of weeks in the month
        $weeksInMonth = Carbon::create($year, $month)->weeksInMonth;
        for ($week = 1; $week <= $weeksInMonth; $week++) {
            $weeklyCounts[$week] = 0;
        }
        // Count questions by week within the specified month
        foreach ($statistics_byMonth as $statistic) {
            $createdAt = Carbon::parse($statistic->created_at);
            $weekNumber = $createdAt->weekOfMonth;
            if (!isset($weeklyCounts[$weekNumber])) {
                $weeklyCounts[$weekNumber] = 0;
            }
            $weeklyCounts[$weekNumber]++;
        }
        
        $weeklyResult = [];
        foreach ($weeklyCounts as $week => $count) {
            $weeklyResult[] = [
                'week' => $week,
                'count' => $count,
            ];
        }

        return response()->json([
            'monthly_data' => $monthlyResult,
            'weekly_data' => $weeklyResult,
            'year' => $year,
        ]);
    }
}