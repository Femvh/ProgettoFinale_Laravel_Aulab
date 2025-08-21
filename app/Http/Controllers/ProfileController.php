<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); 
        return view('profile', compact('user'));
    }
    
    
    
    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }
    
    
    
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
    
}
