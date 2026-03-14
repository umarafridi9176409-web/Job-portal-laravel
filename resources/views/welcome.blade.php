<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'JobPortal') }} - Find Your Dream Job</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="antialiased bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 selection:bg-indigo-500 selection:text-white">
        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 bg-white/80 dark:bg-gray-950/80 backdrop-blur-xl border-b border-gray-100 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-2xl font-extrabold tracking-tight">Job<span class="text-indigo-600">Portal</span></span>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-bold hover:text-indigo-600 transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-bold hover:text-indigo-600 transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/25">Get Started</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="pt-32 pb-20 overflow-hidden relative">
            <!-- Background Blurs -->
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[600px] h-[600px] bg-indigo-500/10 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-purple-500/10 blur-[120px] rounded-full"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-sm font-bold mb-8">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                            </span>
                            Over 10,000+ jobs added this week
                        </div>
                        <h1 class="text-6xl lg:text-7xl font-extrabold leading-[1.1] mb-8">
                            Find the <span class="text-indigo-600">perfect</span> job made for you.
                        </h1>
                        <p class="text-xl text-gray-500 dark:text-gray-400 mb-12 leading-relaxed max-w-lg">
                            Discover thousands of high-quality job postings from world-class companies. Your next career move starts here.
                        </p>
                        
                        <!-- CTA -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('jobs.index') }}" class="bg-indigo-600 text-white px-10 py-5 rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-2xl shadow-indigo-500/40 text-center text-lg">
                                Browse Jobs
                            </a>
                            <a href="{{ route('register') }}" class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 px-10 py-5 rounded-2xl font-bold hover:border-indigo-600 transition-all text-center text-lg shadow-xl shadow-black/5">
                                Join as Employer
                            </a>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-8 mt-16 pt-16 border-t border-gray-100 dark:border-gray-800">
                            <div>
                                <div class="text-3xl font-extrabold mb-1">12K+</div>
                                <div class="text-sm text-gray-500">Active Jobs</div>
                            </div>
                            <div>
                                <div class="text-3xl font-extrabold mb-1">8K+</div>
                                <div class="text-sm text-gray-500">Companies</div>
                            </div>
                            <div>
                                <div class="text-3xl font-extrabold mb-1">45K+</div>
                                <div class="text-sm text-gray-500">Job Seekers</div>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Image Mockup -->
                    <div class="relative lg:-mr-32">
                        <div class="bg-gradient-to-tr from-indigo-100 to-white dark:from-indigo-950 dark:to-gray-900 p-8 rounded-[40px] shadow-2xl border border-white dark:border-gray-800 relative z-10">
                            <!-- Floating Card 1 -->
                            <div class="absolute -top-10 -left-10 bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-2xl max-w-xs animate-bounce-slow border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div class="font-bold">Hired Successfully</div>
                                </div>
                                <div class="text-sm text-gray-500">Project Manager position at Google Cloud.</div>
                            </div>

                            <!-- Floating Card 2 -->
                            <div class="absolute -bottom-10 -right-10 bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-2xl max-w-xs animate-pulse-slow border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center font-extrabold text-purple-700">G</div>
                                    <div>
                                        <div class="font-bold">New Job Alert</div>
                                        <div class="text-xs text-indigo-600 font-bold">Graphic Designer</div>
                                    </div>
                                </div>
                            </div>

                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" alt="Team Working" class="rounded-[28px] shadow-lg w-full">
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <section class="py-24 bg-gray-50 dark:bg-gray-900/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-extrabold mb-16">Trusted by world leading companies</h2>
                <div class="flex flex-wrap justify-center items-center gap-12 lg:gap-24 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                    <span class="text-2xl font-bold tracking-tighter">APPLE</span>
                    <span class="text-2xl font-bold tracking-tighter">GOOGLE</span>
                    <span class="text-2xl font-bold tracking-tighter">MICROSOFT</span>
                    <span class="text-2xl font-bold tracking-tighter">FACEBOOK</span>
                    <span class="text-2xl font-bold tracking-tighter">AMAZON</span>
                </div>
            </div>
        </section>

        <footer class="bg-white dark:bg-gray-950 py-12 border-t border-gray-100 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight">Job<span class="text-indigo-600">Portal</span></span>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    &copy; {{ date('Y') }} JobPortal. Premium Design for Modern Teams.
                </div>
                <div class="flex gap-6">
                    <a href="#" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">Twitter</a>
                    <a href="#" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">LinkedIn</a>
                    <a href="#" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">GitHub</a>
                </div>
            </div>
        </footer>

        <style>
            @keyframes bounce-slow {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
            }
            @keyframes pulse-slow {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.95; transform: scale(1.05); }
            }
            .animate-bounce-slow { animation: bounce-slow 5s ease-in-out infinite; }
            .animate-pulse-slow { animation: pulse-slow 3s ease-in-out infinite; }
        </style>
    </body>
</html>
