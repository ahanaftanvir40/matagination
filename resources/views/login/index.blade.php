<x-base>
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 flex flex-col lg:flex-row">
    {{-- Left section (hidden on mobile) --}}
    <div class="hidden lg:flex lg:w-1/2  p-12 flex-col justify-between">
    <div class="flex items-center gap-2">
      <CpuIcon class="w-8 h-8 text-purple-500" />
      <span class="text-4xl font-bold bg-gradient-to-r from-purple-400 to-purple-600 bg-clip-text text-transparent">
        Matagination
      </span>
    </div>
        
        <div class="space-y-6">
            <h1 class="text-4xl font-bold text-white leading-tight">
                Mine Cryptocurrency<br />with Next-Gen AI Technology
            </h1>
            <p class="text-gray-300 text-lg max-w-md">
                Join thousands of miners already leveraging Matagination's advanced algorithms for optimal mining performance.
            </p>
            
            <div class="grid grid-cols-1 gap-4 mt-8">
                <div class="flex items-center gap-3 text-gray-200">
                    <div class="p-2 rounded-lg bg-purple-800/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="20" x="2" y="2" rx="2" />
                            <path d="M15 2v20" />
                            <path d="M2 15h20" />
                            <path d="M2 9h20" />
                        </svg>
                    </div>
                    <span>Advanced mining infrastructure</span>
                </div>
                <div class="flex items-center gap-3 text-gray-200">
                    <div class="p-2 rounded-lg bg-purple-800/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="8" cy="8" r="6" />
                            <path d="M18.09 10.37A6 6 0 1 1 10.34 18.1" />
                            <path d="M7 6h1v4" />
                            <path d="m16.71 13.88.7.71-2.82 2.82" />
                        </svg>
                    </div>
                    <span>Multi-currency support</span>
                </div>
                <div class="flex items-center gap-3 text-gray-200">
                    <div class="p-2 rounded-lg bg-purple-800/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2" />
                            <path d="M3 9h18" />
                            <path d="M3 15h18" />
                            <path d="M9 3v18" />
                            <path d="M15 3v18" />
                        </svg>
                    </div>
                    <span>Real-time analytics dashboard</span>
                </div>
            </div>
        </div>
        
        <div class="text-gray-400 text-sm">
            © {{ date('Y') }} Matagination. All rights reserved.
        </div>
    </div>
    
    {{-- Right section (login form) --}}
    <div class="flex-1 flex flex-col items-center justify-center px-6 py-12 lg:px-8 relative">
        {{-- Mobile logo (only visible on mobile) --}}
        <div class="lg:hidden mb-8">
            
        </div>
        
        <div class="max-w-md w-full space-y-8 bg-gray-800/50 backdrop-blur-sm p-8 rounded-xl border border-gray-700">
            <div>
                <h2 class="text-center text-3xl font-extrabold text-white">
                    Welcome back
                </h2>
                <p class="mt-2 text-center text-sm text-gray-400">
                    Sign in to access your mining dashboard
                </p>
            </div>
            
            <form class="mt-8 space-y-6" action="{{ route('login.process') }}" method="POST">
    @csrf
    
    <div class="space-y-4">
        <div>
            <label for="email" class="sr-only">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" required 
                class="appearance-none rounded-lg block w-full px-3 py-2 border border-gray-700 bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" 
                placeholder="Email address"
                value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="password" class="sr-only">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required 
                class="appearance-none rounded-lg block w-full px-3 py-2 border border-gray-700 bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" 
                placeholder="Password">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox" 
                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-700 rounded bg-gray-800">
            <label for="remember_me" class="ml-2 block text-sm text-gray-400">
                Remember me
            </label>
        </div>
        
        <div class="text-sm">
            <a href="#" class="font-medium text-purple-400 hover:text-purple-300">
                Forgot your password?
            </a>
        </div>
    </div>
    
    <button type="submit" 
        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
        Sign in
    </button>
</form>
        </div>
        
        {{-- Mobile footer (only visible on mobile) --}}
        <div class="lg:hidden text-gray-400 text-sm mt-8">
            © {{ date('Y') }} Matagination. All rights reserved.
        </div>
    </div>
</div>
</x-base>