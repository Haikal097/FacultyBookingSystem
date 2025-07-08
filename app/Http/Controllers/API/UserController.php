<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = User::where('role', '!=', 2); // Exclude certain roles

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone_number', 'like', "%{$search}%")
              ->orWhere('ic_number', 'like', "%{$search}%");
        });
    }

    $users = $query->orderBy('created_at', 'desc')->paginate(8);

    return response()->json([
        'status' => 200,
        'message' => 'Users fetched successfully',
        'data' => $users
    ]);
}
}
