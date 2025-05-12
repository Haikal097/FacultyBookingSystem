<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 2)->get(); // Excludes users with role 2
        return view('admin.manageuser', compact('users'));
    }
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified fields
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone_number' => ['required', 'string', 'max:20'],
            'ic_number' => ['required', 'string', 'max:20', 'unique:users,ic_number,'.$user->id],
        ];
        
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::min(8)];
        }
        
        $validatedData = $request->validate($rules);
        
        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'ic_number' => $validatedData['ic_number'],
        ];
        
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }
    
        $user->update($updateData);
        
        return back()->with('success', 'Profile updated successfully');
    }

}
