<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero / Search Section -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">
                    Find Your <span class="text-indigo-600 dark:text-indigo-400">Dream Job</span> Today
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-8">
                    Browse thousands of high-quality job postings from top employers worldwide.
                </p>
                
                <form action="{{ route('jobs.index') }}" method="GET" x-data="jobSearch()" class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-2 rounded-2xl shadow-2xl flex flex-col md:flex-row gap-2 ring-1 ring-gray-200 dark:ring-gray-700 relative">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" name="search" x-model="query" @input.debounce.300ms="search()" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-4 border-transparent focus:ring-0 focus:border-transparent dark:bg-transparent dark:text-white text-sm" placeholder="Search job title or keywords...">
                        
                        <!-- Live Results -->
                        <div x-show="results.length > 0" class="absolute z-50 left-0 right-0 top-full mt-2 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                            <template x-for="result in results" :key="result.slug">
                                <a :href="'/jobs/' + result.slug" class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-50 dark:border-gray-700 last:border-0 transition-colors">
                                    <div class="font-bold text-sm text-gray-900 dark:text-white" x-text="result.title"></div>
                                    <div class="text-xs text-gray-500" x-text="result.location"></div>
                                </a>
                            </template>
                        </div>
                    </div>
                    <div class="md:w-px h-8 bg-gray-200 dark:bg-gray-700 my-auto hidden md:block"></div>
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <input type="text" name="location" value="{{ request('location') }}" class="block w-full pl-10 pr-3 py-4 border-transparent focus:ring-0 focus:border-transparent dark:bg-transparent dark:text-white text-sm" placeholder="City or remote...">
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-indigo-500/25">
                        {{ __('Search') }}
                    </button>
                </form>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-64 space-y-8">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                            Filters
                        </h3>
                        
                        <div class="space-y-6">
                            <!-- Categories -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Categories</label>
                                <div class="space-y-2">
                                    <a href="{{ route('jobs.index', request()->except('category')) }}" class="block text-sm {{ !request('category') ? 'text-indigo-600 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-indigo-500' }}">All Categories</a>
                                    @foreach($categories as $category)
                                        <a href="{{ route('jobs.index', array_merge(request()->all(), ['category' => $category->slug])) }}" class="block text-sm {{ request('category') == $category->slug ? 'text-indigo-600 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-indigo-500' }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Job Types -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Job Type</label>
                                <div class="space-y-2">
                                    @foreach(['Full-time', 'Part-time', 'Remote', 'Contract', 'Freelance'] as $type)
                                        <a href="{{ route('jobs.index', array_merge(request()->all(), ['type' => $type])) }}" class="block text-sm {{ request('type') == $type ? 'text-indigo-600 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-indigo-500' }}">
                                            {{ $type }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        @if(request()->anyFilled(['search', 'category', 'location', 'type']))
                            <a href="{{ route('jobs.index') }}" class="mt-8 block text-center text-xs font-semibold text-red-500 hover:text-red-600 uppercase">Clear All Filters</a>
                        @endif
                    </div>
                </aside>

                <!-- Job Listings -->
                <main class="flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($jobs as $job)
                            <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all border border-gray-100 dark:border-gray-700 ring-1 ring-gray-900/5 dark:ring-white/10 hover:ring-indigo-500/50">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <span class="text-indigo-600 dark:text-indigo-400 font-bold text-xl">{{ substr($job->employer->company_name ?? $job->employer->name, 0, 1) }}</span>
                                    </div>
                                    <span class="px-3 py-1 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold rounded-lg">{{ $job->job_type }}</span>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 self-start">
                                    <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                                </h4>
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-4 flex items-center">
                                    {{ $job->employer->company_name ?? $job->employer->name }} • {{ $job->location }}
                                </div>
                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50 dark:border-gray-700">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $job->salary_range ?? 'Competitive' }}</span>
                                    <a href="{{ route('jobs.show', $job->slug) }}" class="text-indigo-600 dark:text-indigo-400 font-bold text-sm flex items-center group-hover:translate-x-1 transition-transform">
                                        View Details
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center">
                                <div class="bg-gray-100 dark:bg-gray-800 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                                <h3 class="text-xl font-bold dark:text-white">No jobs found</h3>
                                <p class="text-gray-500 dark:text-gray-400">Try adjusting your filters or search keywords.</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="mt-12">
                        {{ $jobs->withQueryString()->links() }}
                    </div>
                </main>
            </div>
        </div>
    </div>
@push('scripts')
<script>
    function jobSearch() {
        return {
            query: '',
            results: [],
            loading: false,
            search() {
                if (this.query.length < 2) {
                    this.results = [];
                    return;
                }
                this.loading = true;
                fetch(`/api/jobs/search?q=${this.query}`)
                    .then(res => res.json())
                    .then(data => {
                        this.results = data;
                        this.loading = false;
                    });
            }
        }
    }
</script>
@endpush
</x-app-layout>
