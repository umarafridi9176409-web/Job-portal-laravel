<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <nav class="flex mb-8 text-sm font-medium text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
                <a href="{{ route('jobs.index') }}" class="hover:text-indigo-600 transition-colors">Jobs</a>
                <svg class="w-5 h-5 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                <span class="text-gray-900 dark:text-white truncate">{{ $job->title }}</span>
            </nav>

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700 ring-1 ring-black/5 dark:ring-white/5">
                <!-- Header -->
                <div class="p-8 md:p-12 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="flex items-start gap-6">
                            <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-lg shadow-indigo-500/30 shrink-0">
                                {{ substr($job->employer->company_name ?? $job->employer->name, 0, 1) }}
                            </div>
                            <div>
                                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2 tracking-tight">{{ $job->title }}</h1>
                                <p class="text-lg text-indigo-600 dark:text-indigo-400 font-bold mb-4">{{ $job->employer->company_name ?? $job->employer->name }}</p>
                                <div class="flex flex-wrap gap-4 text-sm text-gray-500 dark:text-gray-400 font-medium">
                                    <span class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $job->location }}</span>
                                    <span class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $job->job_type }}</span>
                                    <span class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $job->salary_range ?? 'Competitive' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0 flex gap-3">
                            <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 p-4 rounded-2xl transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </button>
                            @auth
                                @if(!auth()->user()->isEmployer())
                                    <a href="#apply" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-xl shadow-indigo-500/25 flex items-center gap-2">
                                        Apply Now
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-xl shadow-indigo-500/25">Login to Apply</a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 md:p-12 lg:p-16">
                    <div class="prose prose-indigo dark:prose-invert max-w-none">
                        <h2 class="text-2xl font-bold mb-6">About the Role</h2>
                        <div class="text-gray-600 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                            {{ $job->description }}
                        </div>
                    </div>

                    @auth
                        @if(!auth()->user()->isEmployer())
                        <div id="apply" class="mt-16 pt-16 border-t border-gray-100 dark:border-gray-700">
                            <h2 class="text-2xl font-bold mb-8">Submit Your Application</h2>
                            <form action="{{ route('applications.store', $job) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-2xl bg-gray-50 dark:bg-gray-800/50 p-8 rounded-3xl border border-gray-100 dark:border-gray-700">
                                @csrf
                                <div>
                                    <x-input-label for="cover_letter" :value="__('Cover Letter (Express why you are a great fit)')" />
                                    <textarea id="cover_letter" name="cover_letter" rows="5" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl shadow-sm" required>{{ old('cover_letter') }}</textarea>
                                </div>
                                
                                <div class="p-6 bg-white dark:bg-gray-900 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl text-center">
                                    <x-input-label for="resume" :value="__('Resume (PDF/DOC)')" class="mb-2" />
                                    <input type="file" name="resume" id="resume" class="hidden" required accept=".pdf,.doc,.docx">
                                    <label for="resume" class="cursor-pointer text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Click to upload</label>
                                    <p class="text-xs text-gray-500 mt-2">or drag and drop your file here</p>
                                </div>

                                <x-primary-button class="w-full justify-center py-4 text-lg rounded-2xl">
                                    Submit Application
                                </x-primary-button>
                            </form>
                        </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
