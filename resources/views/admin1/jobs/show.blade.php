@extends('admin.layout')

@section('page-title', 'Job Details')

@section('content')
<div class="max-w-4xl">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.jobs.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Jobs
            </a>
            <h1 class="text-3xl font-bold text-gray-900">{{ $job->title }}</h1>
        </div>
        @if(!$job->verified)
            <form method="POST" action="{{ route('admin.jobs.verify', $job->id) }}" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors" onclick="return confirm('Verify this job?')">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Verify Job</span>
                </button>
            </form>
        @endif
    </div>

    <!-- Status Badge -->
    <div class="mb-8">
        @if($job->verified)
            <span class="inline-flex items-center space-x-1 px-4 py-2 bg-green-100 text-green-700 text-sm font-medium rounded-full">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>Verified</span>
            </span>
        @else
            <span class="inline-flex items-center space-x-1 px-4 py-2 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-full">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span>Pending Verification</span>
            </span>
        @endif
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Left Column (2/3) -->
        <div class="col-span-2 space-y-6">
            <!-- Company Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase mb-4">Company</h3>
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $job->company->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase mb-4">Description</h3>
                <div class="prose prose-sm text-gray-700">
                    {{ $job->description }}
                </div>
            </div>

            <!-- Details Grid -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase mb-6">Job Details</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Employment Type</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $job->employment_type ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Job Source</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $job->source->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Posted Date</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $job->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Expiry Date</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $job->expires_at ? $job->expires_at->format('M d, Y') : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column (1/3) -->
        <div class="col-span-1">
            <!-- Apply Link -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase mb-4">Apply Link</h3>
                <a href="{{ $job->apply_url }}" target="_blank" class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 break-all">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span class="text-sm break-all">{{ substr($job->apply_url, 0, 30) }}...</span>
                </a>
            </div>

            <!-- Active Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase mb-4">Status</h3>
                @if($job->active)
                    <span class="inline-flex items-center space-x-2 px-3 py-2 bg-green-100 text-green-700 text-sm font-medium rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Active</span>
                    </span>
                @else
                    <span class="inline-flex items-center space-x-2 px-3 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Inactive</span>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
