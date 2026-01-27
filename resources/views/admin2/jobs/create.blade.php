@extends('admin.layout')

@section('title', 'Create New Job')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Create New Job</h2>
            <p class="mt-1 text-sm text-gray-500">Post a new off-campus opportunity for students.</p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('admin.jobs.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Cancel
            </a>
        </div>
    </div>

    <form action="{{ route('admin.jobs.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Job Details</h3>
                    <p class="mt-1 text-sm text-gray-500">Basic information about the role.</p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2 space-y-6">
                    <!-- Title -->
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                            <input type="text" name="title" id="title" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3 border" placeholder="e.g. Junior Software Developer">
                            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Company Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                            <input type="text" name="company_name" id="company_name" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3 border" placeholder="e.g. Google">
                        </div>

                         <!-- Location -->
                         <div class="col-span-6">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3 border" placeholder="e.g. Remote, Bangalore, India">
                        </div>

                        <!-- Job Type -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="type" class="block text-sm font-medium text-gray-700">Job Type</label>
                            <select id="type" name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                <option>Full-time</option>
                                <option>Part-time</option>
                                <option>Internship</option>
                                <option>Contract</option>
                            </select>
                        </div>
                        
                        <!-- Salary Range -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="salary" class="block text-sm font-medium text-gray-700">Salary (Optional)</label>
                            <input type="text" name="salary" id="salary" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3 border" placeholder="e.g. $60k - $80k">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Description & Requirements</h3>
                    <p class="mt-1 text-sm text-gray-500">Detailed information for applicants.</p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2 space-y-6">
                    
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Job Description</label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="5" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border border-gray-300 rounded-md p-3" placeholder="Describe the role responsibilities..."></textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Brief description of the job role and responsibilities.</p>
                    </div>

                    <!-- Application Link -->
                    <div>
                        <label for="apply_link" class="block text-sm font-medium text-gray-700">Application Link</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                http://
                            </span>
                            <input type="text" name="apply_link" id="apply_link" class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 border py-2 px-3" placeholder="www.example.com/apply">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="is_active" name="is_active" type="checkbox" checked class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_active" class="font-medium text-gray-700">Active Listing</label>
                            <p class="text-gray-500">Make this job visible to students immediately.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 mr-3">
                Cancel
            </button>
            <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Create Job
            </button>
        </div>
    </form>
</div>
@endsection