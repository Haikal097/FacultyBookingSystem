<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        $rooms = Room::all();
        return view('booking', compact('rooms'));
    }
}
