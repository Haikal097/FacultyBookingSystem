<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;

class RoomApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query()->orderBy('created_at', 'desc');

        if ($request->filled('type') && $request->type !== 'All Types') {
            $query->where('type', $request->type);
        }

        if ($request->filled('status') && $request->status !== 'All Statuses') {
            $query->where('status', strtolower($request->status));
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('building', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
            });
        }

        $rooms = $query->paginate(8);

        return response()->json([
            'status' => 200,
            'data' => $rooms
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'building' => 'required|string|max:255',
            'status' => 'required|in:available,maintenance,occupied',
            'price_per_hour' => 'required|numeric|min:0',
            'price_fullday' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $room = Room::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Room created successfully.',
            'data' => $room
        ], 201);
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $room
        ], 200);
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'building' => 'required|string|max:255',
            'status' => 'required|in:available,maintenance',
            'price_per_hour' => 'required|numeric|min:0',
            'price_fullday' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $room->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Room updated successfully.',
            'data' => $room
        ], 200);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Room deleted successfully.'
        ], 200);
    }
}

