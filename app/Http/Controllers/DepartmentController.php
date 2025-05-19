<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\Room;
use App\Models\Staff;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('apps.department.index', compact('departments','positions'));
    }
    public function index_hou()
    {
        $staff = auth()->user()->staff()->first();
        
        if (!$staff) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Sorry, you are not a staff member',
            ]);
        }
              
        $departments = Department::where('id', $staff->department_id)->get();
        $positions = Position::where('department_id', $staff->department_id)->get();
        return view('apps.department.hou', compact('departments','positions'));
    }
    public function staff_hou()
    {
        if (auth()->user()->staff()->first() == NULL) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Sorry, you are not a staff member',
            ]);
        }
        $staff = Staff::where('department_id', auth()->user()->staff()->first()->department_id)->get();
         
        $positions = Position::where('department_id', $staff->first()->department_id)->get();
        return view('apps.department.staff', compact('staff','positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $existingDepartment = Department::where('name', $request->name)->first();

        if ($existingDepartment) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Department '.$request->name.' already exists',
            ]);
        }

        Department::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Department created successfully',
        ]);

    }

    public function store_positions(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $existingPosition = Position::where('name', $request->name)
            ->where('department_id', $request->department_id)
            ->first();

        if ($existingPosition) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Position '.$request->name.' already exists',
            ]);
        }

        Position::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
        ]);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Position created successfully',
        ]);
    }
    public function searchRoom(Request $request)
    {
        $query = $request->input('q');
        $locations = Room::where('name', 'like', '%' . $query . '%')
            ->select('id', 'name')
            ->limit(10)
            ->get();
        return response()->json($locations);
    }
}
