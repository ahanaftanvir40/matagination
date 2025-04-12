<?php

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Dashboard route
Route::get('/dashboard/{id}', function($id) {
    // Find the user by ID with plan relationship loaded
    $user = User::with('plan')->find($id);
    
    // If user not found, redirect to welcome page with error message
    if (!$user) {
        return redirect()->route('welcome')->with('error', 'User not found. Please provide a valid user ID.');
    }
    
    // User found, show the dashboard
    return view('dashboard.index', [
        'user' => $user
    ]);
})->name('dashboard');

// Add a catch-all redirect for the base dashboard URL
Route::get('/dashboard', function() {
    return redirect()->route('welcome')->with('error', 'Please provide a user ID to access the dashboard.');
})->name('dashboard.redirect');



// Update details route
Route::get('/update-details/{id}', function($id) {
    // Get the user by ID
    $user = User::find($id);
    
    // If user not found, redirect
    if (!$user) {
        return redirect()->route('welcome')->with('error', 'User not found.');
    }
    
    return view('dashboard.update-details', [
        'user' => $user
    ]);
})->name('update-details');

Route::put('/users/{id}/update', function(Request $request, $id) {
    // Find the user by ID
    $user = User::find($id);
    
    if (!$user) {
        return redirect()->route('welcome')->with('error', 'User not found.');
    }
    
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);
    
    // Update the user
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->save();
    
    return redirect()->route('update-details', ['id' => $user->id])->with('status', 'Profile updated successfully!');
})->name('users.update');


// password route 
Route::put('/users/{id}/update-password', function(Request $request, $id) {
    // Find the user by ID
    $user = User::find($id);
    
    if (!$user) {
        return redirect()->route('welcome')->with('error', 'User not found.');
    }
    
    
    $validated = $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
        'new_password_confirmation' => 'required',
    ]);
    
    
    $passwordValid = false;
    
    
    try {
        if (Hash::check($validated['current_password'], $user->password)) {
            $passwordValid = true;
        }
    } catch (\Exception $e) {
        // Continue to the next check
    }
    
    // If not a valid hash or exception occurred, check for plain text match
    if (!$passwordValid && $validated['current_password'] === $user->password) {
        $passwordValid = true;
    }
    
    // If password is still not valid, return error
    if (!$passwordValid) {
        return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }
    
    // Update password with proper bcrypt hashing
    $user->password = Hash::make($validated['new_password']);
    $user->save();
    
    return redirect()->route('update-details', ['id' => $user->id])->with('status', 'Password updated successfully!');
})->name('users.update.password');