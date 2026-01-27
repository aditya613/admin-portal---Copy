@extends('admin.layout')

@section('page-title', 'Create Job Source')

@section('content')
<div class="max-w-2xl">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.job-sources.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Job Sources
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Add Job Source</h1>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.job-sources.store') }}" class="space-y-6">
            @csrf

            <!-- Source Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Source Name</label>
                <input type="text" id="name" name="name" placeholder="e.g., LinkedIn, Indeed" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <!-- Origin URL -->
            <div>
                <label for="origin_url" class="block text-sm font-semibold text-gray-900 mb-2">Origin URL</label>
                <input type="url" id="origin_url" name="origin_url" placeholder="https://example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <!-- Form Actions -->
            <div class="flex items-center space-x-4 pt-6 border-t border-gray-200">
                <button type="submit" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Add Source</span>
                </button>
                <a href="{{ route('admin.job-sources.index') }}" class="inline-flex items-center space-x-2 text-gray-700 hover:text-gray-900 font-medium">
                    <span>Cancel</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
