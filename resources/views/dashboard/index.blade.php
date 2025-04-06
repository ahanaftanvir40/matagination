<x-layout>
<div class="min-h-screen bg-[#1a1a1a] text-white flex flex-col md:flex-row" x-data="{ 
    balance: 0.010987,
    hashRate: 10,
    isRunning: true,
    miningProgress: 0,
    miningInterval: null,
    sidebarOpen: false,
    
    init() {
        this.startMining();
    },
    
    startMining() {
        if (!this.isRunning) return;
        
        this.miningInterval = setInterval(() => {
            this.balance = +(this.balance + 0.000001).toFixed(6);
            this.hashRate = Math.max(8, Math.min(12, this.hashRate + (Math.random() - 0.5)));
            this.miningProgress = (this.miningProgress + 1) % 100;
        }, 100);
    },
    
    stopMining() {
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
                <button class="flex items-center space-x-3 bg-purple-700 text-white px-6 py-3 rounded-full w-full hover:bg-purple-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </button>
                <button class="flex items-center space-x-3 text-gray-400 px-6 py-3 rounded-full w-full hover:bg-gray-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Update Details</span>
                </button>
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

            <!-- Main Content -->
            <main class="p-4 md:p-6">
                <h2 class="text-2xl font-bold mb-6">Starter Machine</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Mining Machine Animation -->
                    <div class="flex items-center justify-center p-4 md:p-12">
                        <div class="relative w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-[600px] xl:h-[500px] aspect-square sm:aspect-video bg-[#1E1E2E] rounded-3xl overflow-hidden shadow-2xl">
                            <!-- Mining Processor -->
                            <div class="absolute inset-4 sm:inset-8 bg-black rounded-2xl border border-purple-500/30 overflow-hidden">
                                <!-- Status Bar -->
                                <div class="absolute top-2 sm:top-4 left-2 sm:left-4 right-2 sm:right-4 h-6 sm:h-8 bg-gray-900/50 rounded-lg border border-purple-500/20 flex items-center justify-between px-2 sm:px-3">
                                    <div class="flex items-center space-x-1 sm:space-x-2">
                                        <div class="w-1.5 sm:w-2 h-1.5 sm:h-2 rounded-full" :class="isRunning ? 'bg-green-500 animate-pulse' : 'bg-red-500'"></div>
                                        <span class="text-xs font-mono text-purple-400">Mining <span x-text="isRunning ? 'Active' : 'Stopped'"></span></span>
                                    </div>
                                    <div class="text-xs font-mono text-purple-400" x-text="hashRate.toFixed(1) + ' KH/s'"></div>
                                </div>

                                <!-- Mining Grid -->
                                <div class="absolute top-10 sm:top-16 inset-x-2 sm:inset-x-4 bottom-10 sm:bottom-16 grid grid-cols-4 grid-rows-4 gap-1 sm:gap-2">
                                    
                                    <template x-for="i in 16">
                                        <div
                                            class="relative bg-gray-800/50 rounded-lg border border-purple-500/20 overflow-hidden"
                                            :class="isRunning ? ''  : ''"
                                        >
                                            <template x-if="isRunning">
                                                <div class="absolute inset-x-1 sm:inset-x-2 h-full animate-data-stream">
                                                    <div 
                                                        class="w-0.5 sm:w-1 h-1/3 bg-purple-500/30 animate-data-stream"
                                                        style="left: 25%;"
                                                    ></div>
                                                    <div 
                                                        class="w-0.5 sm:w-1 h-1/3 bg-purple-500/30 animate-data-stream"
                                                        style="left: 75%;"
                                                    ></div>
                                                </div>
                                            </template>
                                            <template x-if="isRunning">
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <div class="text-[0.5rem] sm:text-xs font-mono text-purple-400/50" x-text="Math.floor(Math.random() * 0xFFFF).toString(16).padStart(4, '0').toUpperCase()">
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                </div>

                                <!-- Progress Bar -->
                                <div class="absolute bottom-2 sm:bottom-4 inset-x-2 sm:inset-x-4">
                                    <div class="h-1.5 sm:h-2 bg-gray-900 rounded-full overflow-hidden">
                                        <div 
                                            class="h-full bg-gradient-to-r from-purple-600 to-purple-400 transition-all duration-200"
                                            :style="{ width: miningProgress + '%' }"
                                        ></div>
                                    </div>
                                    <div class="mt-1 sm:mt-2 flex justify-between text-[0.5rem] sm:text-xs font-mono text-purple-400/70">
                                        <span>Block Progress</span>
                                        <span x-text="miningProgress + '%'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mining Stats -->
                    <div class="space-y-4 md:space-y-6">
                        <!-- Machine Card -->
                        <div class="bg-purple-700 p-4 md:p-6 rounded-2xl relative overflow-hidden group hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-2 right-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 cursor-pointer hover:text-purple-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg mb-4">Starter Machine</h3>
                            <div class="text-3xl md:text-4xl font-bold mb-4" x-text="balance.toFixed(6)"></div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-300">Expired Date:</p>
                                    <p class="text-sm sm:text-base">March 4th, 2024</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm sm:text-base">Olivia Wilson</p>
                                </div>
                            </div>
                        </div>

                        <!-- Machine Info -->
                        <div class="bg-gray-800/50 p-4 md:p-6 rounded-2xl backdrop-blur-sm border border-gray-700">
                            <div class="flex justify-between items-center mb-4 md:mb-6">
                                <div class="flex items-center space-x-2 md:space-x-3">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold">Machine Info</h3>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button
                                        @click="isRunning = !isRunning; isRunning ? startMining() : stopMining()"
                                        :class="isRunning ? 'px-2 md:px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-xs md:text-sm' : 'px-2 md:px-3 py-1 bg-red-500/20 text-red-400 rounded-full text-xs md:text-sm'"
                                        x-text="isRunning ? 'Active' : 'Stopped'"
                                    ></button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6 text-gray-400 hover:text-white transition-colors cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                                <div class="bg-gray-900/50 p-3 md:p-4 rounded-xl border border-gray-700/50 hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-center space-x-2 md:space-x-3 mb-1 md:mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                        <span class="text-xs md:text-sm text-gray-400">Machine ID</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold">123-456-7890</p>
                                </div>

                                <div class="bg-gray-900/50 p-3 md:p-4 rounded-xl border border-gray-700/50 hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-center space-x-2 md:space-x-3 mb-1 md:mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-xs md:text-sm text-gray-400">Name</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold">Olivia Wilson</p>
                                </div>

                                <div class="bg-gray-900/50 p-3 md:p-4 rounded-xl border border-gray-700/50 hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-center space-x-2 md:space-x-3 mb-1 md:mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                        </svg>
                                        <span class="text-xs md:text-sm text-gray-400">Balance</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold" x-text="balance.toFixed(6)"></p>
                                </div>

                                <div class="bg-gray-900/50 p-3 md:p-4 rounded-xl border border-gray-700/50 hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-center space-x-2 md:space-x-3 mb-1 md:mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-xs md:text-sm text-gray-400">Expired Date</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold">March 4th, 2024</p>
                                </div>

                                <div class="bg-gray-900/50 p-3 md:p-4 rounded-xl border border-gray-700/50 hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-center space-x-2 md:space-x-3 mb-1 md:mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        <span class="text-xs md:text-sm text-gray-400">Hash Rate</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold" x-text="hashRate.toFixed(1) + ' KH/s'"></p>
                                </div>

                                <div class="bg-gray-900/50 p-3 md:p-4 rounded-xl border border-gray-700/50 hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-center space-x-2 md:space-x-3 mb-1 md:mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs md:text-sm text-gray-400">Machine Name</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold">Starter</p>
                                </div>
                            </div>
                        </div>

                        <button class="w-full bg-purple-600 py-3 md:py-4 rounded-xl font-bold hover:bg-purple-500 transition-colors">
                            UPGRADE
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-layout>