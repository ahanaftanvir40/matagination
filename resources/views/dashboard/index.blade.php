<x-layout>


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
                                    <p class="text-base md:text-lg font-semibold">{{ $user->name }}</p>
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