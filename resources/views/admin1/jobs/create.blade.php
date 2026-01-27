@extends('admin.layout')

@section('page-title', 'Create Job')

@section('content')
<div class="max-w-2xl">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.jobs.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Jobs
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Create New Job</h1>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('admin.jobs.store') }}" class="space-y-6">
            @csrf

            <!-- Company -->
            <div>
                <label for="company_id" class="block text-sm font-semibold text-gray-900 mb-2">Company</label>
                <select id="company_id" name="company_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('company_id') border-red-500 @enderror">
                    <option value="">Select a company</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                    @endforeach
                </select>
                @error('company_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Job Source -->
            <div>
                <label for="source_id" class="block text-sm font-semibold text-gray-900 mb-2">Job Source</label>
                <select id="source_id" name="source_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('source_id') border-red-500 @enderror">
                    <option value="">Select a job source</option>
                    @foreach($jobSources as $source)
                        <option value="{{ $source->id }}" {{ old('source_id') == $source->id ? 'selected' : '' }}>{{ $source->name }}</option>
                    @endforeach
                </select>
                @error('source_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Job Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">Job Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g., Senior Software Engineer" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                <textarea id="description" name="description" rows="5" placeholder="Job description..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Employment Type -->
            <div>
                <label for="employment_type" class="block text-sm font-semibold text-gray-900 mb-2">Employment Type</label>
                <select id="employment_type" name="employment_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('employment_type') border-red-500 @enderror">
                    <option value="">Select type</option>
                    <option value="Full-time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('employment_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Apply URL -->
            <div>
                <label for="apply_url" class="block text-sm font-semibold text-gray-900 mb-2">Apply URL</label>
                <input type="url" id="apply_url" name="apply_url" value="{{ old('apply_url') }}" placeholder="https://example.com/apply" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('apply_url') border-red-500 @enderror">
                @error('apply_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Expiry Date -->
            <div>
                <label for="expires_at" class="block text-sm font-semibold text-gray-900 mb-2">Expiry Date</label>
                <input type="date" id="expires_at" name="expires_at" value="{{ old('expires_at') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('expires_at') border-red-500 @enderror">
                @error('expires_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center space-x-4 pt-6 border-t border-gray-200">
                <button type="submit" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Create Job</span>
                </button>
                <a href="{{ route('admin.jobs.index') }}" class="inline-flex items-center space-x-2 text-gray-700 hover:text-gray-900 font-medium">
                    <span>Cancel</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
