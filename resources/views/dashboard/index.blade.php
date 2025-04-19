<x-layout>


            <!-- Main Content -->
            <main class="p-4 md:p-6">
                <h2 class="text-2xl font-bold mb-6">{{ $user->plan->name  }} Machine</h2>


<!-- Add a prominent expired banner if needed -->
@if($user->plan_ends_at && $user->plan_ends_at->isPast())
    <div class="bg-red-500/20 border border-red-500/30 text-red-400 p-4 rounded-xl mb-6 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <span>Your plan has expired. Please renew your subscription to continue mining.</span>
    </div>
@endif
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Mining Machine Animation -->
                    <div class="flex items-center justify-center p-4 md:p-12">
                        <div class="relative w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-[600px] xl:h-[500px] aspect-square sm:aspect-video bg-[#1E1E2E] rounded-3xl overflow-hidden shadow-2xl">
                            <!-- Mining Processor -->
                            <div class="absolute inset-4 sm:inset-8 bg-black rounded-2xl border border-purple-500/30 overflow-hidden">
                                <!-- Status Bar -->
                                <div class="absolute top-2 sm:top-4 left-2 sm:left-4 right-2 sm:right-4 h-6 sm:h-8 bg-gray-900/50 rounded-lg border border-purple-500/20 flex items-center justify-between px-2 sm:px-3">
                                    <div class="flex items-center space-x-1 sm:space-x-2">
                                        <div class="w-1.5 sm:w-2 h-1.5 sm:h-2 rounded-full" id="mining-circle" :class="isRunning ? 'bg-green-500 animate-pulse' : 'bg-red-500'"></div>
                                        <span class="text-xs font-mono text-purple-400" id='mining-status'>Mining Active</span>
                                    </div>
                                    <div class="text-xs font-mono text-purple-400" id="stop-hash">{{ $user->plan->hashrate }} KH/s</div>
                                </div>

                                <!-- Mining Grid -->
                                <div class="absolute top-10 sm:top-16 inset-x-2 sm:inset-x-4 bottom-10 sm:bottom-16 grid grid-cols-4 grid-rows-4 gap-1 sm:gap-2 ">
                                    
                                    <template x-for="i in 16">
                                        <div
                                            class="relative bg-gray-800/50 rounded-lg border border-purple-500/20 overflow-hidden"
                                            :class="isRunning ? ''  : ''"
                                        >
                                            <template x-if="isRunning" class="mining-grid">
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
                                    <div class="h-1.5 sm:h-2 bg-gray-900 rounded-full overflow-hidden " id='set-inactive'>
                                        <div 
                                            class="h-full bg-gradient-to-r from-purple-600 to-purple-400 transition-all duration-200 "
                                            :style="{ width: miningProgress + '%' }"
                                        ></div>
                                    </div>
                                    <div class="mt-1 sm:mt-2 flex justify-between text-[0.5rem] sm:text-xs font-mono text-purple-400/70" id='hide-progress'>
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
                        <div class="bg-purple-700 p-4 md:p-6 rounded-2xl relative overflow-hidden group hover:scale-105 transition-transform duration-300 {{ $user->plan_ends_at && $user->plan_ends_at->isPast() ? 'opacity-75' : '' }}">
                             <!-- Add an expired overlay if plan has expired -->
    @if($user->plan_ends_at && $user->plan_ends_at->isPast())
        <div class="absolute inset-0 bg-black/50 flex items-center justify-center z-10">
            <div class="bg-red-900/80 px-4 py-2 rounded-lg font-bold transform rotate-45 shadow-lg">
                EXPIRED
            </div>
        </div>
    @endif
                            <div class="absolute top-2 right-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 cursor-pointer hover:text-purple-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg mb-4">{{ $user->plan->name }} Machine</h3>
                            <div class="text-3xl md:text-4xl font-bold mb-4 token-balance" >{{ $balance }}</div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-300">Expired Date:</p>
                                    <p class="text-sm sm:text-base">{{ $user->plan_ends_at ? $user->plan_ends_at->format('F jS, Y') : 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm sm:text-base">{{ $user->name }}</p>
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
                                        id="change-status"
                                        class='px-2 md:px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-xs md:text-sm' 
                                    >Active</button>
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
                                    <p class="text-base md:text-lg font-semibold token-balance" >{{ $balance }}</p>
                                </div>

                                <div class="bg-gray-900/50 p-3 md:p-4 rounded-xl border border-gray-700/50 hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-center space-x-2 md:space-x-3 mb-1 md:mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-xs md:text-sm text-gray-400">Expired Date</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold">{{ $user->plan_ends_at ? $user->plan_ends_at->format('F jS, Y') : 'N/A' }}</p>
    
    @if($user->plan_ends_at && $user->plan_ends_at->isPast())
        <span class="inline-block mt-1 px-2 py-1 bg-red-500/20 text-red-400 text-xs rounded-full">EXPIRED</span>
    @endif
                                </div>

                                <div class="bg-gray-900/50 p-3 md:p-4 rounded-xl border border-gray-700/50 hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-center space-x-2 md:space-x-3 mb-1 md:mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        <span class="text-xs md:text-sm text-gray-400">Hash Rate</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold" >{{ $user->plan->hashrate }}</p>
                                </div>

                                <div class="bg-gray-900/50 p-3 md:p-4 rounded-xl border border-gray-700/50 hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-center space-x-2 md:space-x-3 mb-1 md:mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs md:text-sm text-gray-400">Machine Name</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold">{{ $user->plan->name }}</p>
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

    <script>
    // Parse dates for more accurate calculation
    const planStarted = new Date("{{ $user->plan_started_at }}");
    const planEnds = new Date("{{ $user->plan_ends_at ?? '' }}");
    const currentTime = new Date();
    
    // Check if plan is active (current time is between start and end dates)
    const isPlanActive = planStarted <= currentTime && 
                        (isNaN(planEnds) || planEnds >= currentTime);
    
    // Calculate initial balance
    let initialBalance = 0;
    const tokensPerDay = {{ $user->plan->tokens_per_day ?? 0 }};
    const tokensPerSecond = tokensPerDay / 86400;
    
    // Only calculate if plan has started and is still active
    if (isPlanActive) {
        const secondsRunning = Math.floor((currentTime - planStarted) / 1000);
        initialBalance = secondsRunning * tokensPerSecond;
    }
    
    // Set current balance with non-negative value
    let currentBalance = Math.max(0, initialBalance);
    
    // Set initial machine state based on plan status
    let isRunning = isPlanActive;
    
    // Function to update all balance displays
    function updateBalanceDisplays() {
        // Get all elements with the token-balance class
        const balanceElements = document.querySelectorAll('.token-balance');
        
        // Update each element with the formatted balance
        balanceElements.forEach(element => {
            element.textContent = currentBalance.toFixed(6);
        });
    }
    
    // Initialize all displays
    updateBalanceDisplays();

    // Update at regular intervals, but only if the plan is active
    const balanceInterval = isPlanActive ? setInterval(() => {
        currentBalance += tokensPerSecond;
        updateBalanceDisplays();
    }, 1000) : null; // update every second
    
    // Add status indicators for plan expiration
    if (!isPlanActive && !isNaN(planEnds) && planEnds < currentTime) {
        // Plan has expired - add visual indicators
        document.querySelectorAll('.machine-status').forEach(el => {
            el.textContent = 'EXPIRED';
            el.classList.add('text-red-400');
        });
        
        document.querySelectorAll('.disable-machine').forEach(el => {
            el.textContent = 'EXPIRED';
            el.classList.add('text-red-400');
        });
        // Hide the mining progress bar
        document.getElementById('set-inactive').classList.add('hidden');
        document.getElementById('hide-progress').classList.add('hidden');
        // Hide the mining grid
        document.querySelectorAll('.mining-grid').forEach(el => {
            el.classList.add('hidden');
        });

        document.getElementById("mining-circle").classList.add("bg-red-500");
        document.getElementById("mining-status").innerText = "Mining Stopped";
        document.getElementById("stop-hash").innerText = "0";
        document.getElementById("change-status").innerText = "Inactive";
        document.getElementById("change-status").classList.add("bg-red-800", "text-red-200");
        // Disable the mining toggle button
        const toggleButton = document.querySelector('[data-mining-toggle]');
        if (toggleButton) {
            toggleButton.disabled = true;
            toggleButton.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }
    
</script>
<script>
    // Your existing script code
    
    // Function to update hash rate display
    function updateHashRate() {
        const hashRateElement = document.getElementById('stop-hash');
        if (hashRateElement) {
            hashRateElement.textContent = hashRate.toFixed(1) + ' KH/s';
        }
    }
    
    // Set interval to update the hash rate display
    const hashRateInterval = isPlanActive ? setInterval(() => {
        // Update hash rate value with some randomness
        hashRate = Math.max(baseHashRate * 0.8, Math.min(baseHashRate * 1.2, hashRate + (Math.random() - 0.5)));
        
        // Update the display
        updateHashRate();
    }, 100) : null;
    
    // Initialize the hash rate display
    let hashRate = {{ $user->plan->hashrate ?? 10 }};
    let baseHashRate = {{ $user->plan->hashrate ?? 10 }};
    updateHashRate();
    
    // When plan is expired, set hash rate to 0
    if (!isPlanActive && !isNaN(planEnds) && planEnds < currentTime) {
        document.getElementById("stop-hash").innerText = "0 KH/s";
    }
</script>


</x-layout>