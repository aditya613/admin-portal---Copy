@extends('admin.layout')

@section('page-title', 'Job Sources')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-start md:items-center">
        <div>
            <p class="text-sm text-gray-600 mb-2">Management</p>
            <h2 class="text-2xl font-bold text-gray-900">Job Sources</h2>
        </div>
        <a href="{{ route('admin.job-sources.create') }}" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>New Source</span>
        </a>
    </div>

    <!-- Empty State -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 px-6 py-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-1">No job sources yet</h3>
        <p class="text-gray-600 mb-4">Add a job source to get started</p>
        <a href="{{ route('admin.job-sources.create') }}" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Add Source</span>
        </a>
    </div>
</div>
@endsection
