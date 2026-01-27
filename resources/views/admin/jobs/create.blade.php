@extends('admin.layout')

@section('title', 'Create New Job')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol role="list" class="flex items-center space-x-4">
            <li>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-slate-500">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Home</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-5 w-5 flex-shrink-0 text-slate-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    <a href="{{ route('admin.jobs.index') }}" class="ml-4 text-sm font-medium text-slate-500 hover:text-slate-700">Jobs</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-5 w-5 flex-shrink-0 text-slate-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    <a href="#" class="ml-4 text-sm font-medium text-slate-500 hover:text-slate-700" aria-current="page">Create</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-3xl font-bold leading-tight text-slate-900">Post a Job</h2>
            <p class="mt-2 text-sm text-slate-600">Reach thousands of students by posting your job opportunity.</p>
        </div>
    </div>

    <form action="{{ route('admin.jobs.store') }}" method="POST" class="space-y-8 divide-y divide-slate-200">
        @csrf
        
        <!-- Job Details Section -->
        <div class="space-y-8 divide-y divide-slate-200 sm:space-y-5">
            <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-slate-900">Job Details</h3>
                    <p class="mt-1 max-w-2xl text-sm text-slate-500">Basic information about the role.</p>
                </div>

                <div class="space-y-6 sm:space-y-5">
                    
                    <!-- Title & Company -->
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-slate-200 sm:pt-5">
                        <label for="title" class="block text-sm font-medium text-slate-700 sm:mt-px sm:pt-2">Job Title</label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" name="title" id="title" class="block w-full max-w-lg rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="e.g. Senior Product Designer">
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-slate-200 sm:pt-5">
                        <label for="company_name" class="block text-sm font-medium text-slate-700 sm:mt-px sm:pt-2">Company Name</label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="flex max-w-lg rounded-md shadow-sm">
                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-slate-300 px-3 text-slate-500 sm:text-sm bg-slate-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </span>
                                <input type="text" name="company_name" id="company_name" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="Company Name">
                            </div>
                        </div>
                    </div>

                    <!-- Location & Type -->
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-slate-200 sm:pt-5">
                        <label for="location" class="block text-sm font-medium text-slate-700 sm:mt-px sm:pt-2">Location</label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" name="location" id="location" class="block w-full max-w-lg rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="e.g. Remote, San Francisco, CA">
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-slate-200 sm:pt-5">
                        <label for="type" class="block text-sm font-medium text-slate-700 sm:mt-px sm:pt-2">Employment Type</label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <select id="type" name="type" class="block w-full max-w-lg rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6">
                                <option>Full-time</option>
                                <option>Part-time</option>
                                <option>Contract</option>
                                <option>Internship</option>
                                <option>Temporary</option>
                            </select>
                        </div>
                    </div>

                    <!-- Salary -->
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-slate-200 sm:pt-5">
                        <label for="salary" class="block text-sm font-medium text-slate-700 sm:mt-px sm:pt-2">Salary Range</label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="grid grid-cols-2 gap-4 max-w-lg">
                                <div class="relative rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-slate-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="text" name="salary_min" id="salary_min" class="block w-full rounded-md border-0 py-1.5 pl-7 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="Min">
                                </div>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-slate-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="text" name="salary_max" id="salary_max" class="block w-full rounded-md border-0 py-1.5 pl-7 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="Max">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rich Text Description -->
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-slate-200 sm:pt-5">
                        <label for="description" class="block text-sm font-medium text-slate-700 sm:mt-px sm:pt-2">
                            Description
                            <span class="block text-xs font-normal text-slate-500 mt-1">Markdown supported</span>
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <textarea id="description" name="description" rows="10" class="block w-full max-w-2xl rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="## Responsibilities&#10;- Write clean code&#10;- Collaborate with team"></textarea>
                            <p class="mt-2 text-sm text-slate-500">Describe the role, responsibilities, and company culture.</p>
                        </div>
                    </div>

                    <!-- Requirements (Dynamic Fields Mockup) -->
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-slate-200 sm:pt-5">
                        <label class="block text-sm font-medium text-slate-700 sm:mt-px sm:pt-2">Requirements</label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="space-y-3 max-w-2xl">
                                <div class="flex gap-2">
                                    <input type="text" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="e.g. 3+ years React experience">
                                    <button type="button" class="text-slate-400 hover:text-red-500">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                    </button>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="e.g. Knowledge of SQL">
                                    <button type="button" class="text-slate-400 hover:text-red-500">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                    </button>
                                </div>
                                <button type="button" class="inline-flex items-center text-sm text-primary-600 hover:text-primary-700">
                                    <svg class="mr-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                                    Add Requirement
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Meta & Settings -->
            <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-slate-900">Application Settings</h3>
                    <p class="mt-1 max-w-2xl text-sm text-slate-500">How should candidates apply?</p>
                </div>

                <div class="space-y-6 sm:space-y-5">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-slate-200 sm:pt-5">
                        <label for="apply_link" class="block text-sm font-medium text-slate-700 sm:mt-px sm:pt-2">External Application Link</label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" name="apply_link" id="apply_link" class="block w-full max-w-lg rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="https://">
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-slate-200 sm:pt-5">
                        <label class="block text-sm font-medium text-slate-700 sm:mt-px sm:pt-2">Status</label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="flex items-center">
                                <input id="is_active" name="is_active" type="checkbox" checked class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-600">
                                <label for="is_active" class="ml-3 block text-sm font-medium text-slate-700">Publish immediately</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-5 pb-12">
            <div class="flex justify-end gap-x-3">
                <button type="button" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50">Cancel</button>
                <button type="submit" class="inline-flex justify-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Post Job</button>
            </div>
        </div>
    </form>
</div>
@endsection