<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $buildings = Building::withCount(['floors', 'rooms'])->get();
        $floors = Floor::all();
        $rooms = Room::all();
        // Logic to retrieve and display locations
        return view('apps.locations.index', compact('buildings', 'floors', 'rooms'));
    }

    public function getFloors($building_id)
    {
        $floors = Floor::where('building_id', $building_id)->get();
        return response()->json($floors);
    }

    public function store_room(Request $request)
    {
        $request->validate([
            'building_id' => 'required|uuid|exists:buildings,id',
            'floor_id' => 'required|uuid|exists:floors,id',
            'name' => 'required|string|max:255',
        ]);

        // Cek apakah room dengan kombinasi building_id, floor_id, dan name sudah ada
        $exists = Room::where('floor_id', $request->floor_id)
            ->whereHas('floor', function ($query) use ($request) {
                $query->where('building_id', $request->building_id);
            })
            ->where('name', $request->name)
            ->exists();

        if ($exists) {
            return back()->with([
                'status' => 'error',
                'message' => 'Room already exists!',
            ]);
        }

        Room::create([
            'floor_id' => $request->floor_id,
            'name' => $request->name,
        ]);

        return back()->with([
            'status' => 'success',
            'message' => 'Room successfully created!',
        ]);
    }

    public function store_floor(Request $request)
    {
        $request->validate([
            'building_id' => 'required|uuid|exists:buildings,id',
            'floor_number' => 'required|string|max:255',
        ]);

        // Cek apakah floor dengan kombinasi building_id dan floor_number sudah ada
        $exists = Floor::where('building_id', $request->building_id)
            ->where('floor_number', $request->floor_number)
            ->exists();

        if ($exists) {
            return back()->with([
                'status' => 'error',
                'message' => 'Floor already exists!',
            ]);
        }

        Floor::create([
            'building_id' => $request->building_id,
            'floor_number' => $request->floor_number,
        ]);

        return back()->with([
            'status' => 'success',
            'message' => 'Floor successfully created!',
        ]);
    }

    public function store_building(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cek apakah building dengan name sudah ada
        $exists = Building::where('name', $request->name)->exists();

        if ($exists) {
            return back()->with([
                'status' => 'error',
                'message' => 'Building already exists!',
            ]);
        }

        Building::create([
            'name' => $request->name,
        ]);

        return back()->with([
            'status' => 'success',
            'message' => 'Building successfully created!',
        ]);
    }

    public function api_rooms(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        $query = Room::with('floor');

        $total = $query->count();

        $rooms = $query->skip(($page - 1) * $perPage)
                        ->take($perPage)
                        ->get();

        $data = $rooms->map(function($rr) {
            return [
                'id' => $rr->id,
                'name' => $rr->name,
                'floor_number' => $rr->floor->floor_number,
                'building_name' => $rr->floor->building->name,
            ];
        });

        return response()->json([
            'data' => $data,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }

}
