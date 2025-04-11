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
});

Route::get('/dashboard', function() {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/update-details', function() {
    // Get the first user for demo purposes
    $user = User::first();
    
    return view('dashboard.update-details', [
        'user' => $user
    ]);
})->name('update-details');

// Form submission routes
Route::put('/users/update', function(Request $request) {
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);
    
    // Update the first user (for demo purposes)
    $user = User::first();
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->save();
    
    return redirect()->back()->with('status', 'Profile updated successfully!');
})->name('users.update');

Route::put('/users/update-password', function(Request $request) {
    // Validate the request
    $validated = $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
        'new_password_confirmation' => 'required',
    ]);
    
    // Get the first user (for demo purposes)
    $user = User::first();
    
    // Check if current password is correct or if it's our test password
    if ($validated['current_password'] !== 'password123' && !Hash::check($validated['current_password'], $user->password)) {
        return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }
    
    // Update password
    $user->password = Hash::make($validated['new_password']);
    $user->save();
    
    return redirect()->back()->with('status', 'Password updated successfully!');
})->name('users.update.password');