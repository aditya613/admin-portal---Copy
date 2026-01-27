@extends('admin.layout')

@section('title', 'Students')

@section('content')
<div class="space-y-8">
    <!-- Stats -->
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-blue-100 p-3 text-blue-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total students</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\Student::count()) }}</p>
            <p class="text-xs text-slate-500">Registered accounts</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-green-100 p-3 text-green-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Verified</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\Student::where('is_verified', true)->count()) }}</p>
            <p class="text-xs text-slate-500">Email verified</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-purple-100 p-3 text-purple-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Complete</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\Student::where('profile_complete', true)->count()) }}</p>
            <p class="text-xs text-slate-500">Profile completed</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-orange-100 p-3 text-orange-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Branches</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\Student::distinct('branch')->count('branch')) }}</p>
            <p class="text-xs text-slate-500">Study programs</p>
        </div>
    </div>

    <!-- Filters -->
    <form id="filters" method="GET" class="bg-white p-6 rounded-xl border shadow-sm">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-6">
            <div class="lg:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-2">Search</label>
                <div class="relative">
                    <svg class="absolute left-3 top-3 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, email, ID, branch" class="block w-full rounded-lg border border-slate-300 py-2.5 pl-10 pr-4 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Branch</label>
                <select name="branch" class="block w-full rounded-lg border border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                    <option value="">All</option>
                    @foreach($branches ?? [] as $branch)
                        <option value="{{ $branch }}" {{ request('branch') == $branch ? 'selected' : '' }}>{{ $branch }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Verification</label>
                <select name="is_verified" class="block w-full rounded-lg border border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                    <option value="">All</option>
                    <option value="true" {{ request('is_verified') === 'true' ? 'selected' : '' }}>Verified</option>
                    <option value="false" {{ request('is_verified') === 'false' ? 'selected' : '' }}>Unverified</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Profile</label>
                <select name="profile_complete" class="block w-full rounded-lg border border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                    <option value="">All</option>
                    <option value="true" {{ request('profile_complete') === 'true' ? 'selected' : '' }}>Complete</option>
                    <option value="false" {{ request('profile_complete') === 'false' ? 'selected' : '' }}>Incomplete</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 transition">Apply</button>
                <a href="{{ route('admin.students.index') }}" class="hidden lg:inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">Reset</a>
            </div>
        </div>
    </form>

    <!-- Students List -->
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b bg-slate-50">
            <div>
                <h3 class="text-lg font-semibold text-slate-900">Student Directory</h3>
                <p class="text-sm text-slate-500">Showing {{ $students->firstItem() ?? 0 }} - {{ $students->lastItem() ?? 0 }} of {{ $students->total() }}</p>
            </div>
            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">{{ \App\Models\Student::count() }} total</span>
        </div>
        
        @forelse($students as $student)
        <a href="{{ route('admin.students.show', $student->_id) }}" class="block border-b last:border-b-0 hover:bg-slate-50/50 transition group">
            <div class="px-6 py-5">
                <div class="flex items-start gap-4">
                    <!-- Avatar -->
                    <div class="relative">
                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-lg ring-2 ring-white shadow-sm">
                            {{ substr($student->clean('name', 'S'), 0, 1) }}
                        </div>
                        @if($student->is_verified)
                            <div class="absolute -bottom-1 -right-1 h-5 w-5 rounded-full bg-green-500 ring-2 ring-white flex items-center justify-center">
                                <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Main Info -->
                    <div class="flex-1 min-w-0 space-y-2.5">
                        <!-- Name and ID -->
                        <div class="flex items-baseline gap-3">
                            <h4 class="text-base font-bold text-slate-900 group-hover:text-primary-600 transition">
                                {{ $student->clean('name', 'Unknown') }}
                            </h4>
                            @if($student->clean('university_id'))
                                <span class="text-xs font-mono text-slate-500 bg-slate-100 px-2 py-1 rounded">
                                    {{ $student->clean('university_id') }}
                                </span>
                            @endif
                        </div>

                        <!-- Email and Contact -->
                        <div class="flex flex-wrap gap-3 text-sm text-slate-600">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $student->clean('email', 'No email') }}
                            </span>
                            @if($student->clean('phone'))
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    {{ $student->clean('phone') }}
                                </span>
                            @endif
                        </div>

                        <!-- Status Badges and Details -->
                        <div class="flex flex-wrap items-center gap-2 pt-1">
                            <!-- Verification Status -->
                            @if($student->is_verified)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 ring-1 ring-green-200">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Verified
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    Pending
                                </span>
                            @endif

                            <!-- Profile Status -->
                            @if($student->profile_complete)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 ring-1 ring-blue-200">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2h10a1 1 0 000-2 2 2 0 00-2 2v10a2 2 0 002 2 1 1 0 100 2h-4a1 1 0 100-2h4a2 2 0 002-2V5z" clip-rule="evenodd"/>
                                    </svg>
                                    Complete
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 ring-1 ring-slate-200">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0-11V7a2 2 0 012-2h2.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2h-3m-7 0H5a2 2 0 01-2-2V5a2 2 0 012-2h3"/>
                                    </svg>
                                    Incomplete
                                </span>
                            @endif

                            <!-- Resume Status -->
                            @if($student->resume_url)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 ring-1 ring-purple-200">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"/>
                                    </svg>
                                    Resume
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 ring-1 ring-red-200">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 113.89 2.523a1 1 0 00-1.414 1.414A4 4 0 1012.06 12.06a1 1 0 101.415-1.414A6 6 0 113.889 2.52a1 1 0 10-1.414 1.415A4 4 0 1112.06 12.06z" clip-rule="evenodd"/>
                                    </svg>
                                    No Resume
                                </span>
                            @endif

                            <!-- Branch Badge -->
                            @if($student->clean('branch'))
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200">
                                    {{ $student->clean('branch') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Right Side Info -->
                    <div class="flex flex-col items-end justify-between gap-4 pl-4">
                        <!-- CGPA and Batch -->
                        <div class="text-right space-y-1">
                            @if($student->cgpa)
                                <div class="flex items-center justify-end gap-1.5">
                                    <svg class="h-4 w-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="font-bold text-slate-900">{{ number_format($student->cgpa, 2) }}</span>
                                </div>
                            @endif
                            @if($student->batch_year)
                                <p class="text-xs text-slate-500">Class of {{ $student->batch_year }}</p>
                            @endif
                        </div>

                        <!-- Applications Count -->
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-slate-100/50">
                            <svg class="h-4 w-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-xs font-semibold text-slate-700">
                                {{ \App\Models\Application::where('student_id', new \MongoDB\BSON\ObjectId($student->_id))->count() }} apps
                            </span>
                        </div>

                        <!-- Arrow -->
                        <div class="hidden md:flex h-10 w-10 items-center justify-center rounded-full bg-slate-200 text-slate-400 group-hover:bg-primary-100 group-hover:text-primary-600 transition">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="px-6 py-16 text-center">
            <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <h3 class="mt-4 text-lg font-medium text-slate-900">No students found</h3>
            <p class="mt-2 text-sm text-slate-500">Try adjusting your filters.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($students->hasPages())
    <div class="bg-white px-6 py-4 rounded-lg border shadow-sm flex items-center justify-between">
        <p class="text-sm text-slate-700">Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }}</p>
        <div>{{ $students->links() }}</div>
    </div>
    @endif
</div>
@endsection