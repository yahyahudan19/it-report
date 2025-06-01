<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\WorkTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function index()
    {
        $staff = Staff::where('user_id', auth()->id())->first();

        if (!$staff) {
            $work_tasks = collect();
        } else {
            $work_tasks = WorkTask::where('staff_id', $staff->id)
            ->with('staff')
            ->get();

            // Ambil total quantity per task_id dari report_handling
            $handlingTotals = DB::table('report_handling')
            ->select('task_id', DB::raw('SUM(quantity) as total_handling'))
            ->where('staff_id', $staff->id)
            ->groupBy('task_id')
            ->pluck('total_handling', 'task_id'); // collection keyed by task_id

            // Ambil total quantity per task_id dari daily_reports
            $dailyTotals = DB::table('daily_reports')
            ->select('task_id', DB::raw('SUM(quantity) as total_daily'))
            ->where('staff_id', $staff->id)
            ->groupBy('task_id')
            ->pluck('total_daily', 'task_id'); // collection keyed by task_id

            // Tambahkan property achievement ke tiap work_task hasil gabungan total
            $work_tasks->transform(function ($task) use ($handlingTotals, $dailyTotals) {
            $handlingQty = $handlingTotals->get($task->id, 0);
            $dailyQty = $dailyTotals->get($task->id, 0);

            $achievement = $handlingQty + $dailyQty;

            $difference = $achievement - $task->target_quantity;

            $task->achievement = $achievement;
            $task->shortfall = $difference;
            $task->percentage = $task->target_quantity > 0
                ? round(($achievement / $task->target_quantity) * 100, 2)
                : 0;

            return $task;
            });
        }

        return view('apps.evaluation.index', compact('work_tasks'));
    }


    public function index_hou()
    {
        $staff = Staff::where('user_id', auth()->id())->first();

        if (!$staff) {
            $work_tasks = collect();
        } else {
            $staff_ids = Staff::where('department_id', $staff->department_id)->pluck('id');

            // Query ambil work_tasks staff di departemen terkait
            $work_tasks = WorkTask::whereIn('staff_id', $staff_ids)
                ->with('staff')
                ->get();

            // Ambil total quantity per task_id dari report_handling
            $handlingTotals = DB::table('report_handling')
                ->select('task_id', DB::raw('SUM(quantity) as total_handling'))
                ->groupBy('task_id')
                ->pluck('total_handling', 'task_id'); // collection keyed by task_id

            // Ambil total quantity per task_id dari daily_reports
            $dailyTotals = DB::table('daily_reports')
                ->select('task_id', DB::raw('SUM(quantity) as total_daily'))
                ->groupBy('task_id')
                ->pluck('total_daily', 'task_id'); // collection keyed by task_id

            // Tambahkan property achievement ke tiap work_task hasil gabungan total
            $work_tasks->transform(function ($task) use ($handlingTotals, $dailyTotals) {
                $handlingQty = $handlingTotals->get($task->id, 0);
                $dailyQty = $dailyTotals->get($task->id, 0);

                $achievement = $handlingQty + $dailyQty;

                $difference = $achievement - $task->target_quantity;

                $task->achievement = $achievement;
                $task->shortfall = $difference;
                $task->percentage = $task->target_quantity > 0
                    ? round(($achievement / $task->target_quantity) * 100, 2)
                    : 0;

                return $task;
            });
        }

        return view('apps.evaluation.hou', compact('work_tasks'));
    }



}
