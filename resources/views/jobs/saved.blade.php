<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Saved Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($savedJobs as $job)
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 relative group overflow-hidden">
                        <div class="absolute top-0 right-0 p-4">
                            <form action="{{ route('jobs.toggle-save', $job) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-600 transition-colors bg-red-50 dark:bg-red-900/30 p-2 rounded-xl">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </button>
                            </form>
                        </div>
                        
                        <div class="mb-6">
                            <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-700 font-bold text-xl mb-4 group-hover:scale-110 transition-transform">
                                {{ substr($job->employer->company_name ?? $job->employer->name, 0, 1) }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">
                                <a href="{{ route('jobs.show', $job->slug) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">{{ $job->title }}</a>
                            </h3>
                            <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ $job->employer->company_name ?? $job->employer->name }}</p>
                        </div>

                        <div class="flex items-center gap-4 text-xs font-bold text-gray-500 dark:text-gray-400 mb-6">
                            <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $job->location }}</span>
                            <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $job->job_type }}</span>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-gray-100 dark:border-gray-700">
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $job->salary_range ?? 'Competitive' }}</span>
                            <a href="{{ route('jobs.show', $job->slug) }}" class="text-indigo-600 dark:text-indigo-400 font-bold text-sm flex items-center group-hover:translate-x-1 transition-transform">
                                Details
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white dark:bg-gray-800 rounded-3xl border border-dashed border-gray-300 dark:border-gray-700">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        <h3 class="text-xl font-bold dark:text-white">No saved jobs</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">Start browsing and save jobs you're interested in.</p>
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all">
                            Browse Jobs
                        </a>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-12">
                {{ $savedJobs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
