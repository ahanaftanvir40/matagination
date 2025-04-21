<?php

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
})->name('welcome');

// Dashboard route
Route::get('/dashboard/{id}', function($id) {
    
    if (Auth::id() != $id) {
        return redirect()->route('dashboard', ['id' => Auth::id()]);
    }
    // Find the user by ID with plan relationship loaded
    $user = User::with('plan')->find($id);
    
    if (!$user) {
        return redirect()->route('login')->with('error', 'User not found. Please provide a valid user ID.');
    }
    
    // Calculate token balance considering time zones
    $balance = 0;
    
    if ($user->plan && $user->plan_started_at) {
        $startDate = Carbon::parse($user->plan_started_at);
        $now = now();
        
        // Only calculate if plan has started
        if ($startDate->lessThanOrEqualTo($now)) {
            $seconds = $startDate->diffInSeconds($now);
            $tokensPerDay = $user->plan->tokens_per_day ?? 0;
            $tokensPerSecond = $tokensPerDay / 86400;
            $balance = round($seconds * $tokensPerSecond, 6);
        }
    }
    $isPlanExpired = $user->isPlanExpired();
    
    // User found, show the dashboard
    return view('dashboard.index', [
        'user' => $user,
        'balance' => $balance,
        'isPlanExpired' => $isPlanExpired,
    ]);
})->middleware('auth')->name('dashboard');

// Add a catch-all redirect for the base dashboard URL
Route::get('/dashboard', function() {
    if (Auth::check()) {
        return redirect()->route('dashboard', ['id' => Auth::id()]);
    }
    return redirect()->route('login');
})->name('dashboard.redirect');



// Update details route
Route::get('/update-details/{id}', function($id) {

    if (Auth::id() != $id) {
        return redirect()->route('update-details', ['id' => Auth::id()]);
    }
    // Get the user by ID
    $user = User::find($id);
    
    // If user not found, redirect
    if (!$user) {
        return redirect()->route('welcome')->with('error', 'User not found.');
    }
    
    return view('dashboard.update-details', [
        'user' => $user
    ]);
})->middleware('auth')->name('update-details');

Route::put('/users/{id}/update', function(Request $request, $id) {

    if (Auth::id() != $id) {
        return redirect()->route('dashboard', ['id' => Auth::id()]);
    }
    
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
})->middleware('auth')->name('users.update');


// password route 
Route::put('/users/{id}/update-password', function(Request $request, $id) {

    if (Auth::id() != $id) {
        return redirect()->route('dashboard', ['id' => Auth::id()]);
    }
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
})->middleware('auth')->name('users.update.password');




// Authentication Routes
Route::get('/login', function () {
    // If user is already logged in, redirect to dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard', ['id' => Auth::id()]);
    }
    return view('login.index');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Remember me functionality
    $remember = $request->has('remember');

    // Get the user first
    $user = User::where('email', $credentials['email'])->first();
    
    if (!$user) {
        return back()->withErrors([
            'email' => 'No account found with this email address.',
        ])->withInput($request->only('email'));
    }

    $passwordMatches = false;

    // Check if the password is already a bcrypt hash
    if (str_starts_with($user->password, '$2y$')) {
        // It's a bcrypt hash, use Hash::check
        $passwordMatches = Hash::check($credentials['password'], $user->password);
    } else {
        // It's likely a plain text password, do a direct comparison
        $passwordMatches = $credentials['password'] === $user->password;
        
        // If it matches, update to bcrypt hash for security
        if ($passwordMatches) {
            $user->password = Hash::make($credentials['password']);
            $user->save();
        }
    }

    if ($passwordMatches) {
        // Login successful
        Auth::login($user, $remember);
        $request->session()->regenerate();
        
        // Redirect to the user's dashboard
        return redirect()->route('dashboard', ['id' => Auth::id()]);
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->withInput($request->only('email'));
})->name('login.process');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect()->route('login');
})->name('logout');