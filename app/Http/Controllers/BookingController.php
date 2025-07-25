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
        $request->merge([
            'end_date' => $request->input('booking_end_date')
        ]);
        // Validate the request data
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:booking_date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'purpose_type' => 'required|string|max:255',
            'purpose' => 'required|string',
            'total_price' => 'required|numeric|min:0',
        ]);

        // Check for conflicting bookings (only using booking_date logic)
        // Determine start and end date
        $startDate = $validated['booking_date'];
        $endDate = $validated['end_date'] ?? $startDate;

        $conflict = Booking::where('room_id', $validated['room_id'])
            ->where('status', 'approved')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    // Only overlap if booking_date <= endDate AND (end_date >= startDate OR end_date is null and booking_date >= startDate)
                    $q->whereDate('booking_date', '<=', $endDate)
                      ->where(function ($inner) use ($startDate) {
                          $inner->where(function ($i) use ($startDate) {
                              $i->whereNull('end_date')
                                ->whereDate('booking_date', '>=', $startDate);
                          })
                          ->orWhereDate('end_date', '>=', $startDate);
                      });
                });
            })
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhere(function ($q) use ($validated) {
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

        // Conditionally add end_date if it was provided
        if ($request->filled('end_date')) {
            $validated['end_date'] = $request->end_date;
        }

        // Create the booking
        $booking = Auth::user()->bookings()->create($validated);

        // Redirect with success message
        return redirect()->route('userprofile')
                        ->with('success', 'Booking created successfully!');
    }

    public function index()
    {
        $query = Booking::with(['room', 'user'])
            ->orderBy('created_at', 'desc');

        // Apply search filter if search term exists
        if (request()->has('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('purpose', 'like', "%{$search}%")
                ->orWhere('purpose_type', 'like', "%{$search}%")
                ->orWhereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('room', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('building', 'like', "%{$search}%");
                });
            });
        }

        // Apply time period or status filters
        if (request()->has('filter')) {
            $filter = request('filter');
            
            switch ($filter) {
                case 'today':
                    $query->whereDate('booking_date', today());
                    break;
                case 'this_week':
                    $query->whereBetween('booking_date', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ]);
                    break;
                case 'this_month':
                    $query->whereBetween('booking_date', [
                        now()->startOfMonth(),
                        now()->endOfMonth()
                    ]);
                    break;
                case 'pending':
                case 'approved':
                case 'rejected':
                case 'cancelled':
                    $query->where('status', $filter);
                    break;
            }
        }

        $bookings = $query->paginate(8);

        return view('admin.managebooking', compact('bookings'));
    }

    public function myBookings()
    {
        $query = Booking::where('user_id', Auth::id())
            ->with(['room', 'user'])
            ->orderBy('created_at', 'desc');

        // Apply status filter if selected
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        // Apply date range filter
        if (request()->filled('date_from')) {
            $query->whereDate('booking_date', '>=', request('date_from'));
        }
        if (request()->filled('date_to')) {
            $query->whereDate('booking_date', '<=', request('date_to'));
        }

        // Apply facility type filter
        if (request()->filled('facility_type')) {
            $query->whereHas('room', function($q) {
                $q->where('type', request('facility_type'));
            });
        }

        // Apply search filter
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('purpose', 'like', "%{$search}%")
                ->orWhere('purpose_type', 'like', "%{$search}%")
                ->orWhereHas('room', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });
        }

        $bookings = $query->paginate(8);

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

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return response()->json(['message' => 'Booking cancelled successfully.']);
    }

    public function pdfview($id)
    {
        $booking = Booking::findOrFail($id);
        return view('partials.pdf-template', compact('booking'));
    }
}