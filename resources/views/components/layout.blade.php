<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://unpkg.com/feather-icons"></script>

        <!-- Styles / Scripts -->
       
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes data-stream {
            0% {
            transform: translateY(-100%);
            }
            100% {
            transform: translateY(100%);
            }
        }

        @keyframes hash-complete {
            0% {
            transform: scale(1);
            opacity: 1;
            }
            50% {
            transform: scale(1.5);
            opacity: 0.5;
            }
            100% {
            transform: scale(0);
            opacity: 0;
            }
        }

        @keyframes mining-pulse {
            0%, 100% {
            opacity: 0.5;
            transform: scale(0.95);
            }
            50% {
            opacity: 1;
            transform: scale(1.05);
            }
        }
    </style>
       
            

    </head>

    <body>
    <div class="min-h-screen bg-[#1a1a1a] text-white flex flex-col md:flex-row" x-data="{ 
    balance: {{ $balance ?? '0' }},
    hashRate: {{ $user->plan->hashrate ?? 10 }},
    baseHashRate: {{ $user->plan->hashrate ?? 10 }},
    // Better condition check with isset() and instanceof
    isPlanExpired: {{ 
        isset($user->plan_ends_at) && 
        $user->plan_ends_at instanceof \Carbon\Carbon && 
        now()->greaterThanOrEqualTo($user->plan_ends_at) ? 'true' : 'false' 
    }},
    isRunning: {{ isset($user->plan_ends_at) && $user->plan_ends_at instanceof \Carbon\Carbon && $user->plan_ends_at->isPast() ? 'false' : 'true' }},
    miningProgress: 0,
    miningInterval: null,
    sidebarOpen: false,
    
    init() {
        // Add a console log for debugging
        
        // Check expired state at initialization
        if (this.isPlanExpired) {
            
            this.isRunning = false;
            // You could also visually update the UI here
        } else if (this.isRunning) {
           
            this.startMining();
        }
    },
    
    startMining() {
        if (this.isPlanExpired){
            this.isRunning = false;
            return;
        }
        if (!this.isRunning) return;
        
        this.miningInterval = setInterval(() => {
            this.balance = +(this.balance + 0.000001).toFixed(6);
            this.hashRate = Math.max(this.baseHashRate * 0.8, Math.min(this.baseHashRate * 1.2, this.hashRate + (Math.random() - 0.5)));
            this.miningProgress = (this.miningProgress + 1) % 100;
        }, 100);
    },
    
    stopMining() {
        this.isRunning = false;
        clearInterval(this.miningInterval);
    },
    
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
    }
}">
 
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-[#2a1a4a] min-h-screen fixed md:fixed left-0 top-0 z-20 transform transition-transform duration-300 ease-in-out" 
             :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
            <!-- Logo Section -->
            <div class="p-6 border-b border-gray-800">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-purple-600 rounded-full"></div>
                    <span class="text-xl font-bold">MATAGINATION</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="p-6 space-y-4">
                <a href="{{ isset($user) ? route('dashboard', ['id' => $user->id]) : route('dashboard.redirect') }}" class="flex items-center space-x-3 {{ Request::routeIs('dashboard') ? 'bg-purple-700 hover:bg-purple-600 text-white' : 'text-gray-400' }} px-6 py-3 rounded-full w-full hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ isset($user) ? route('update-details', ['id' => $user->id]) : route('dashboard.redirect') }}"  class="flex items-center space-x-3 {{ Request::routeIs('update-details') ? 'bg-purple-700 hover:bg-purple-600 text-white' : 'text-gray-400' }} px-6 py-3 rounded-full w-full hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Update Details</span>
                </a>
            </div>

            <!-- Upgrade Card -->
            <div class="mx-6 bg-purple-700 p-6 rounded-2xl mt-8 md:mt-56">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <h1 class='text-xl'>Upgrade</h1>
                <h3 class="text-2xl font-bold mb-2">PRIORITY</h3>
                <p class="text-sm text-gray-300 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
                </p>
                <div class="flex space-x-2">
                    <!-- Replace PHP foreach with static divs -->
                    <div class="w-6 h-1 bg-white rounded-full"></div>
                    <div class="w-6 h-1 bg-white rounded-full"></div>
                    <div class="w-6 h-1 bg-white rounded-full"></div>
                </div>
            </div>
            
            <!-- Close button for mobile -->
            <button @click="toggleSidebar" class="md:hidden absolute top-4 right-4 p-2 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Overlay for mobile sidebar -->
        <div @click="toggleSidebar" x-show="sidebarOpen" class="fixed inset-0 bg-black bg-opacity-50 z-10 md:hidden"></div>

        <!-- Main Content Area -->
        <div class="w-full md:ml-64 flex-1">
            <!-- Navigation -->
            <nav class="flex items-center justify-between p-6 border-b border-gray-800">
            <div class='flex sm:block items-center  '>
                <button @click="toggleSidebar" x-show='!sidebarOpen' class="md:hidden   rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
                    <h1 class="text-2xl font-bold ml-2 md:ml-0">Dashboard</h1>
            </div>
                <div class="flex items-center space-x-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hover:text-purple-500 transition-colors hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hover:text-purple-500 transition-colors hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <img
                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150"
                        alt="Profile"
                        class="w-10 h-10 rounded-full border-2 border-purple-500"
                    />
                </div>
            </nav>
        {{ $slot }}
    </body>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


</html>