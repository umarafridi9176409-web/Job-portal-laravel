<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Moderation Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 dark:border-gray-700 ring-1 ring-black/5">
                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    <th class="px-6 py-4">{{ __('Job Details') }}</th>
                                    <th class="px-6 py-4">{{ __('Employer') }}</th>
                                    <th class="px-6 py-4">{{ __('Category') }}</th>
                                    <th class="px-6 py-4 text-right">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($jobs as $job)
                                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-all">
                                        <td class="px-6 py-6 font-medium text-gray-900 dark:text-white">
                                            <div class="text-sm font-bold">{{ $job->title }}</div>
                                            <div class="text-xs text-gray-500">{{ $job->location }} • {{ $job->job_type }}</div>
                                        </td>
                                        <td class="px-6 py-6 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $job->employer->company_name ?? $job->employer->name }}
                                        </td>
                                        <td class="px-6 py-6 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $job->category->name }}
                                        </td>
                                        <td class="px-6 py-6 text-right space-x-2">
                                            <form action="{{ route('admin.moderation.approve', $job) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-lg shadow-green-500/20">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.moderation.reject', $job) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-lg shadow-red-500/20">
                                                    Reject
                                                </button>
                                            </form>
                                            <a href="{{ route('jobs.show', $job->slug) }}" target="_blank" class="inline-flex items-center text-gray-400 hover:text-indigo-600 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400 font-medium">
                                            No pending jobs for moderation.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($jobs->hasPages())
                    <div class="px-8 py-6 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700">
                        {{ $jobs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
