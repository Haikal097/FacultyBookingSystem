<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        // Existing metrics
        $totalUsers = User::count();
        $todaysBookings = Booking::whereDate('created_at', Carbon::today())->count();
        $availableRooms = Room::where('status', 'available')->count();
        $maintenanceRooms = Room::where('status', 'maintenance')->count();

        // Recent pending bookings (last 3)
        $pendingBookings = Booking::where('status', 'pending')
            ->with(['room', 'user'])
            ->latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'todaysBookings',
            'availableRooms',
            'maintenanceRooms',
            'pendingBookings'
        ));
    }
}
