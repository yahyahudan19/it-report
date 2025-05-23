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
                ->withCount(['report_handling as achievement' => function ($query) {
                    $query->select(DB::raw("COALESCE(SUM(quantity), 0)"))
                        ->whereColumn('report_handling.task_id', 'work_tasks.id'); 
                }])
                ->get();

            // Hitung shortfall dan percentage di collection
            $work_tasks->transform(function ($task) {
                // Hitung selisih antara pencapaian dan target
                $difference = $task->achievement - $task->target_quantity;

                // Shortfall: negatif jika kurang, positif jika pas atau lebih
                $task->shortfall = $difference;

                // Presentase: bebas, bisa lebih dari 100%
                $task->percentage = $task->target_quantity > 0
                    ? round(($task->achievement / $task->target_quantity) * 100, 2)
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
            // Ambil semua staff di departemen yang sama
            $staff_ids = Staff::where('department_id', $staff->department_id)->pluck('id');

            $work_tasks = WorkTask::whereIn('staff_id', $staff_ids)
            ->with(['staff'])
            ->withCount(['report_handling as achievement' => function ($query) {
                $query->select(DB::raw("COALESCE(SUM(quantity), 0)"))
                ->whereColumn('report_handling.task_id', 'work_tasks.id'); 
            }])
            ->get();

            // Hitung shortfall dan percentage di collection
            $work_tasks->transform(function ($task) {
                $difference = $task->achievement - $task->target_quantity;
                $task->shortfall = $difference;
                $task->percentage = $task->target_quantity > 0
                    ? round(($task->achievement / $task->target_quantity) * 100, 2)
                    : 0;
                return $task;
            });

        }

        return view('apps.evaluation.hou', compact('work_tasks'));
    }

}
