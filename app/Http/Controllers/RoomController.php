<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'building' => 'required|string|max:255',
            'status' => 'required|in:available,maintenance,occupied',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Room::create($validated);

        return redirect()->back()->with('success', 'Room added successfully.');
    }

    public function index()
    {
        $query = Room::query()->orderBy('created_at', 'desc');

        // Apply type filter if selected and not "All Types"
        if (request()->filled('type') && request('type') !== 'All Types') {
            $query->where('type', request('type'));
        }

        // Apply status filter if selected and not "All Statuses"
        if (request()->filled('status') && request('status') !== 'All Statuses') {
            $query->where('status', strtolower(request('status')));
        }

        // Apply search filter if search term exists
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('building', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
            });
        }

        $rooms = $query->paginate(8); // Maintain your 8 items per page

        return view('admin.manageroom', compact('rooms'));
    }

    public function destroy(Room $room)
    {
        // Delete the room from the database
        $room->delete();

        // Redirect back to the rooms list with a success message
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }

    public function update(Request $request, Room $room)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string',
            'capacity'    => 'required|integer|min:1',
            'building'    => 'required|string|max:255',
            'status'      => 'required|in:available,maintenance',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Update the room
        $room->update($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Room updated successfully.');
    }
}
