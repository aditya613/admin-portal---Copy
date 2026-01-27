@extends('admin.layout')

@section('page-title', 'Create Company')

@section('content')
<div class="max-w-2xl">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.companies.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4 font-medium transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Companies
        </a>
        <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">Add New Company</h1>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-md border-2 border-blue-100 p-8">
        <form method="POST" action="{{ route('admin.companies.store') }}" class="space-y-6">
            @csrf

            <!-- Company Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-blue-700 mb-2">Company Name</label>
                <input type="text" id="name" name="name" placeholder="e.g., Acme Corporation" class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            </div>

            <!-- Form Actions -->
            <div class="flex items-center space-x-4 pt-6 border-t-2 border-blue-100">
                <button type="submit" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Add Company</span>
                </button>
                <a href="{{ route('admin.companies.index') }}" class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                    <span>Cancel</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
