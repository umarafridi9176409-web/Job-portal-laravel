<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center text-sm font-medium">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Applicants for') }}: <span class="text-indigo-600 dark:text-indigo-400">{{ $job->title }}</span>
            </h2>
            <a href="{{ route('employer.jobs.index') }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Jobs
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 dark:border-gray-700 ring-1 ring-black/5">
                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    <th class="px-6 py-4">{{ __('Candidate') }}</th>
                                    <th class="px-6 py-4">{{ __('Status') }}</th>
                                    <th class="px-6 py-4">{{ __('Applied On') }}</th>
                                    <th class="px-6 py-4 text-right">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($applications as $application)
                                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-all">
                                        <td class="px-6 py-6">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold">
                                                    {{ substr($application->seeker->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $application->seeker->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $application->seeker->email }}</div>
                                                </div>
                                            </div>
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
                                        <td class="px-6 py-6 text-right space-x-3">
                                            <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 text-sm font-bold">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                Resume
                                            </a>
                                            
                                            <form action="{{ route('employer.applications.status.update', $application) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="text-xs font-bold border-gray-200 dark:border-gray-700 dark:bg-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 py-1 transition-all">
                                                    @foreach(['pending', 'shortlisted', 'rejected', 'hired'] as $status)
                                                        <option value="{{ $status }}" {{ $application->status == $status ? 'selected' : '' }}>
                                                            Change to {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400 font-medium">
                                            No candidates have applied yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($applications->hasPages())
                    <div class="px-8 py-6 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
