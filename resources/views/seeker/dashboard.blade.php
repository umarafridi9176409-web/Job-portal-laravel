<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Applications Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 dark:border-gray-700 ring-1 ring-black/5">
                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    <th class="px-6 py-4">{{ __('Job') }}</th>
                                    <th class="px-6 py-4">{{ __('Company') }}</th>
                                    <th class="px-6 py-4">{{ __('Status') }}</th>
                                    <th class="px-6 py-4">{{ __('Applied On') }}</th>
                                    <th class="px-6 py-4 text-right">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($applications as $application)
                                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-all">
                                        <td class="px-6 py-6">
                                            <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $application->job->title }}</div>
                                            <div class="text-xs text-gray-500">{{ $application->job->location }}</div>
                                        </td>
                                        <td class="px-6 py-6 text-sm text-gray-600 dark:text-gray-400 font-medium">
                                            {{ $application->job->employer->company_name ?? $application->job->employer->name }}
                                        </td>
                                        <td class="px-6 py-6">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-100 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-900/50',
                                                    'shortlisted' => 'bg-blue-50 text-blue-700 border-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-900/50',
                                                    'rejected' => 'bg-red-50 text-red-700 border-red-100 dark:bg-red-900/20 dark:text-red-400 dark:border-red-900/50',
                                                    'hired' => 'bg-green-50 text-green-700 border-green-100 dark:bg-green-900/20 dark:text-green-400 dark:border-green-900/50',
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors[$application->status] ?? 'bg-gray-50' }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-6 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $application->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-6 text-right">
                                            <a href="{{ route('jobs.show', $application->job->slug) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 font-bold text-sm">
                                                View Job
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400 font-medium">
                                            You haven't applied to any jobs yet.
                                            <div class="mt-4">
                                                <a href="{{ route('jobs.index') }}" class="text-indigo-600 font-bold hover:underline">Find Jobs</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
