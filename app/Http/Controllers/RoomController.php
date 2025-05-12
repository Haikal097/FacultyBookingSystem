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
            'description' => 'nullable|string',
        ]);

        Room::create($validated);

        return redirect()->back()->with('success', 'Room added successfully.');
    }

    public function index()
    {
        $rooms = Room::all(); // Fetch all rooms
        return view('admin.manageroom', compact('rooms')); // Pass to view
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
            'description' => 'nullable|string',
        ]);

        // Update the room
        $room->update($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Room updated successfully.');
    }
}
