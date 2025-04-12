<x-layout>
<!-- Add this at the top of your update-details.blade.php -->
@if(!isset($user))
    <div class="bg-red-500/20 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg mb-6" role="alert">
        <span class="block sm:inline">Debug: $user variable is not available</span>
    </div>
@endif
<div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-8">Update Details</h2>
    
    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif
    
    <div class="bg-gray-800/50 p-6 rounded-2xl backdrop-blur-sm border border-gray-700 mb-6">
        <h3 class="text-xl font-semibold mb-6">Personal Information</h3>
        
        <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-colors"
                    placeholder="Enter your full name"
                />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-colors"
                    placeholder="Enter your email"
                />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button
                type="submit"
                class="w-full bg-purple-600 py-4 rounded-xl font-bold hover:bg-purple-500 transition-colors"
            >
                Save Personal Information
            </button>
        </form>
    </div>

    <div class="bg-gray-800/50 p-6 rounded-2xl backdrop-blur-sm border border-gray-700">
    <h3 class="text-xl font-semibold mb-6">Change Password</h3>
    
    <form action="{{ route('users.update.password', ['id' => $user->id]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">Current Password</label>
            <input
                type="password"
                name="current_password"
                id="current_password"
                class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-colors"
                placeholder="Enter current password"
            />
            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="new_password" class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
            <input
                type="password"
                name="new_password"
                id="new_password"
                class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-colors"
                placeholder="Enter new password"
            />
            @error('new_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm New Password</label>
            <input
                type="password"
                name="new_password_confirmation"
                id="new_password_confirmation"
                class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-colors"
                placeholder="Confirm new password"
            />
        </div>
        
        <button
            type="submit"
            class="w-full bg-purple-600 py-4 rounded-xl font-bold hover:bg-purple-500 transition-colors"
        >
            Update Password
        </button>
    </form>
</div>
</div>
</x-layout>