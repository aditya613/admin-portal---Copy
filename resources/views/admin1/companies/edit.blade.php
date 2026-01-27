@extends('admin.layout')

@section('page-title', 'Edit Company')

@section('content')
<div class="max-w-2xl">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.companies.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Companies
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Edit Company</h1>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.companies.update') }}" class="space-y-6">
            @csrf

            <!-- Company Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Company Name</label>
                <input type="text" id="name" name="name" placeholder="e.g., Acme Corporation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <!-- Form Actions -->
            <div class="flex items-center space-x-4 pt-6 border-t border-gray-200">
                <button type="submit" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Update Company</span>
                </button>
                <a href="{{ route('admin.companies.index') }}" class="inline-flex items-center space-x-2 text-gray-700 hover:text-gray-900 font-medium">
                    <span>Cancel</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
