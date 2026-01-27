@extends('admin.layout')

@section('page-title', 'Jobs')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-start md:items-center">
        <div>
            <p class="text-sm text-blue-600 mb-2 font-medium">Content Management</p>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">Job Listings</h2>
        </div>
        <a href="{{ route('admin.jobs.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>New Job</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-xl border-2 border-blue-100/50 overflow-hidden backdrop-blur-sm">
        @if($jobs->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-blue-200 bg-gradient-to-r from-blue-50 via-blue-100/80 to-blue-50 backdrop-blur-sm">
                            <th class="px-8 py-5 text-left">
                                <span class="text-xs font-extrabold text-blue-800 uppercase tracking-widest">Company</span>
                            </th>
                            <th class="px-8 py-5 text-left">
                                <span class="text-xs font-extrabold text-blue-800 uppercase tracking-widest">Job Title</span>
                            </th>
                            <th class="px-8 py-5 text-left">
                                <span class="text-xs font-extrabold text-blue-800 uppercase tracking-widest">Type</span>
                            </th>
                            <th class="px-8 py-5 text-left">
                                <span class="text-xs font-extrabold text-blue-800 uppercase tracking-widest">Status</span>
                            </th>
                            <th class="px-8 py-5 text-left">
                                <span class="text-xs font-extrabold text-blue-800 uppercase tracking-widest">Expires</span>
                            </th>
                            <th class="px-8 py-5 text-right">
                                <span class="text-xs font-extrabold text-blue-800 uppercase tracking-widest">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-100/50">
                        @foreach($jobs as $job)
                        <tr class="group hover:bg-gradient-to-r hover:from-blue-50/80 hover:to-blue-100/50 transition-all duration-300 cursor-pointer">
                            <td class="px-8 py-5">
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-blue-500 rounded-2xl blur-md opacity-20 group-hover:opacity-30 transition-opacity"></div>
                                        <div class="relative w-12 h-12 bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-6 h-6 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="font-bold text-blue-900 group-hover:text-blue-800 transition-colors">{{ $job->company->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <p class="text-blue-900 font-bold group-hover:text-blue-800 transition-colors">{{ $job->title }}</p>
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 bg-blue-100/80 text-blue-800 text-sm font-semibold rounded-xl border border-blue-200/50">{{ $job->employment_type ?? 'N/A' }}</span>
                            </td>
                            <td class="px-8 py-5">
                                @if($job->verified)
                                    <span class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-green-100 to-green-50 text-green-800 text-xs font-bold rounded-xl border-2 border-green-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Verified</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-amber-100 to-amber-50 text-amber-800 text-xs font-bold rounded-xl border-2 border-amber-200 shadow-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Pending</span>
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-sm font-semibold text-blue-700">{{ $job->expires_at ? $job->expires_at->format('M d, Y') : 'N/A' }}</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end items-center space-x-3">
                                    <a href="{{ route('admin.jobs.show', $job->id) }}" class="group relative px-4 py-2 text-blue-700 hover:text-blue-900 font-bold text-sm rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 border border-transparent hover:border-blue-200 transition-all duration-300 shadow-sm hover:shadow-md">
                                        View
                                    </a>
                                    @if(!$job->verified)
                                        <form method="POST" action="{{ route('admin.jobs.verify', $job->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold text-sm rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105" onclick="return confirm('Verify this job listing?')">
                                                Verify
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($jobs->hasPages())
            <div class="px-8 py-5 border-t-2 border-blue-200/50 bg-gradient-to-r from-blue-50/80 to-blue-100/50 backdrop-blur-sm">
                {{ $jobs->links() }}
            </div>
            @endif
        @else
            <div class="px-6 py-12 text-center">
                <div class="mx-auto w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-blue-900 mb-1">No jobs yet</h3>
                <p class="text-blue-600 mb-6">Get started by creating your first job listing</p>
                <a href="{{ route('admin.jobs.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Create Job</span>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

