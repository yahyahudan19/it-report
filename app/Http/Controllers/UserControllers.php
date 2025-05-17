<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\Room;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class UserControllers extends Controller
{
    public function index(){
        $user = User::where('role', '!=', 'sys_admin')->get();
        $departments = Department::all();
        $positions = Position::all();
        $rooms = Room::all();
        return view('apps.users.index',compact('user','departments','positions','rooms'));
    }
    public function getPositionsByDepartment($departmentId)
    {
        // Mengambil positions yang terkait dengan department
        $positions = Position::where('department_id', $departmentId)->get();

        // Kembalikan data dalam format JSON
        return response()->json(['positions' => $positions]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'whatsapp_number' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string',  // pastikan ada field password_confirmation di form
                'role' => 'required|string|in:staff,kepala',
                'department_id' => 'required|exists:departments,id',
                'position_id' => 'required|exists:positions,id',
                'room_id' => 'required|exists:rooms,id',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()
            ->withErrors($e->validator)
            ->withInput()
            ->with([
                'status' => 'error',
                'message' => 'Validasi gagal! Silakan periksa kembali data yang diinput.',
                'sweetalert' => true
            ]);
        }

        // Generate email berdasarkan username dan department
        $department = Department::find($request->department_id);
        $email = strtolower($request->username . '-' . strtolower($department->name) . '@karsa.id');

        try {
            // Create user
            $user = User::create([
                'id' => Str::uuid(),
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $email,  // Generate email
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            // Create staff (related to user)
            Staff::create([
                'user_id' => $user->id,
                'department_id' => $validated['department_id'],
                'position_id' => $validated['position_id'],
                'room_id' => $validated['room_id'],
                'whatsapp_number' => $validated['whatsapp_number'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
            'status' => 'error',
            'message' => 'Failed to create user or staff: ' . $e->getMessage(),
            ]);
        }

        // Redirect atau kembali dengan pesan sukses
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'User and staff created successfully',
        ]);
    }

    public function checkUsername(Request $request)
    {
        $username = $request->query('username');
        $exists = User::where('username', $username)->exists();

        return response()->json(['exists' => $exists]);
    }
    public function edit($id)
    {
        // Ambil data user dan relasi yang diperlukan (department, position, room)
        $user = User::with('staff')->findOrFail($id);

        // Kembalikan data user dalam format JSON
        return response()->json([
            'user' => $user,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:staff,kepala',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $user = User::findOrFail($id);
        $staff = Staff::where('user_id', $id)->first();

        // Update staff data
        try {
            $staff->update([
            'department_id' => $validated['department_id'],
            'position_id' => $validated['position_id'],
            'room_id' => $validated['room_id'],
            'whatsapp_number' => $validated['whatsapp_number'],
            ]);
            // Update user data
            $user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'role' => $validated['role'],
            'department_id' => $validated['department_id'],
            'position_id' => $validated['position_id'],
            'room_id' => $validated['room_id'],
            ]);

            if ($request->password) {
            $user->update(['password' => bcrypt($request->password)]);
            }
        } catch (\Exception $e) {
            return response()->json([
            'message' => 'Failed to update user or staff: ' . $e->getMessage()
            ], 500);
        }

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus user dan relasi terkait
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }


}
