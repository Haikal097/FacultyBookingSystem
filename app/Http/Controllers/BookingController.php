<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {
        $rooms = Room::all();
        return view('booking', compact('rooms'));
    }

    public function destroy($id)
    {
        // Find the booking by ID and delete it
        $booking = Booking::find($id);

        if ($booking) {
            $booking->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'purpose_type' => 'required|string|max:255',
            'purpose' => 'required|string',
        ]);

        // Check for conflicting bookings
        $conflict = Booking::where('room_id', $validated['room_id'])
            ->where('booking_date', $validated['booking_date'])
            ->where(function($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhere(function($q) use ($validated) {
                          $q->where('start_time', '<=', $validated['start_time'])
                            ->where('end_time', '>=', $validated['end_time']);
                      });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors([
                'time_slot' => 'The selected time slot is already booked for this room.'
            ])->withInput();
        }

        // Create the booking
        $booking = Auth::user()->bookings()->create($validated);

        // Redirect with success message
        return redirect()->route('userprofile')
                         ->with('success', 'Booking created successfully!');
    }

    public function index()
    {
        $bookings = Booking::with(['room', 'user'])->latest()->get();
        return view('admin.managebooking', compact('bookings'));
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->with(['room', 'user'])->get();
        return view('userprofile', compact('bookings'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        return redirect()->back()->with('success', 'Booking approved successfully.');
    }
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        return redirect()->back()->with('success', 'Booking rejected.');
    }
}