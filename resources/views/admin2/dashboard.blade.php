@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    <p class="mt-1 text-sm text-gray-500">Overview of the platform's performance.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    <!-- Total Jobs -->
    <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary-100 text-primary-600">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Jobs</dt>
                        <dd>
                            <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_jobs'] ?? '1,284' }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
            <div class="text-sm">
                <a href="{{ route('admin.jobs.index') }}" class="font-medium text-primary-700 hover:text-primary-900">View all jobs</a>
            </div>
        </div>
    </div>

    <!-- Verified Jobs -->
    <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-100 text-green-600">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Verified Jobs</dt>
                        <dd>
                            <div class="text-2xl font-semibold text-gray-900">{{ $stats['verified_jobs'] ?? '892' }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
            <div class="text-sm">
                <span class="text-green-600 font-medium">95% completion rate</span>
            </div>
        </div>
    </div>

    <!-- Active Jobs -->
    <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Active Now</dt>
                        <dd>
                            <div class="text-2xl font-semibold text-gray-900">{{ $stats['active_jobs'] ?? '342' }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
            <div class="text-sm">
                <span class="text-gray-500">+12% from last week</span>
            </div>
        </div>
    </div>

    <!-- Applications -->
    <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-purple-100 text-purple-600">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Applications</dt>
                        <dd>
                            <div class="text-2xl font-semibold text-gray-900">{{ $stats['applications'] ?? '12.5k' }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
            <div class="text-sm">
                <a href="#" class="font-medium text-primary-700 hover:text-primary-900">View analytics</a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity / Table Section -->
<div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between bg-gray-50">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Job Postings</h3>
        <a href="{{ route('admin.jobs.index') }}" class="text-sm text-primary-600 hover:text-primary-900 font-medium">View All</a>
    </div>
    <div class="overflow-x-auto">
        <!-- Placeholder for table content (simplified version of index) -->
        <div class="p-8 text-center text-gray-500 text-sm">
            No recent activity to display right now.
        </div>
    </div>
</div>
@endsection