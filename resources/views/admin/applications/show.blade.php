@extends('admin.layout')

@section('title', ($application->student ? $application->student->name : 'Application') . ' - Application Details')

@section('content')
<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900">
        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Applications
    </a>
</div>

<!-- Application Header -->
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-8 py-6">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-4">
                <div class="h-20 w-20 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-3xl ring-4 ring-white/30">
                    {{ $application->student ? substr($application->student->name, 0, 1) : '?' }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">
                        {{ $application->student ? $application->student->name : 'Unknown Student' }}
                    </h1>
                    <p class="text-lg text-white/90 font-medium">
                        Applied for: {{ $application->job ? $application->job->title : 'Unknown Job' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="px-8 py-6 bg-slate-50 border-t border-slate-200">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Status</p>
                <p class="text-sm font-semibold text-slate-900">
                    @php
                        $statusBg = match($application->status) {
                            'Applied' => 'bg-amber-100 text-amber-700',
                            'Accepted' => 'bg-green-100 text-green-700',
                            'Rejected' => 'bg-red-100 text-red-700',
                            default => 'bg-slate-100 text-slate-700'
                        };
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusBg }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </p>
            </div>
            
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Applied Date</p>
                <p class="text-sm font-semibold text-slate-900">
                    {{ $application->applied_at ? $application->applied_at->format('M d, Y') : 'Recently' }}
                </p>
            </div>
            
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Company</p>
                <p class="text-sm font-semibold text-slate-900">
                    {{ $application->job ? $application->job->clean('company_name', 'Unknown') : 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Location</p>
                <p class="text-sm font-semibold text-slate-900">
                    {{ $application->job ? $application->job->clean('location', 'Not specified') : 'N/A' }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Student Details -->
        @if($application->student)
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Student Information
            </h2>
            <div class="space-y-4">
                <div class="flex justify-between pb-4 border-b border-slate-200">
                    <span class="text-slate-600">Name</span>
                    <span class="font-semibold text-slate-900">{{ $application->student->name }}</span>
                </div>
                <div class="flex justify-between pb-4 border-b border-slate-200">
                    <span class="text-slate-600">Email</span>
                    <span class="font-semibold text-slate-900">{{ $application->student->email }}</span>
                </div>
                <div class="flex justify-between pb-4 border-b border-slate-200">
                    <span class="text-slate-600">Branch</span>
                    <span class="font-semibold text-slate-900">{{ $application->student->clean('branch', 'Not specified') }}</span>
                </div>
                <div class="flex justify-between pb-4 border-b border-slate-200">
                    <span class="text-slate-600">CGPA</span>
                    <span class="font-semibold text-slate-900">{{ $application->student->cgpa ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Verification Status</span>
                    <span class="font-semibold">
                        @if($application->student->is_verified)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Verified</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">Not Verified</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        @endif

        <!-- Job Details -->
        @if($application->job)
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Job Position Details
            </h2>
            <div class="space-y-4">
                <div class="flex justify-between pb-4 border-b border-slate-200">
                    <span class="text-slate-600">Job Title</span>
                    <span class="font-semibold text-slate-900">{{ $application->job->clean('title', 'Untitled') }}</span>
                </div>
                <div class="flex justify-between pb-4 border-b border-slate-200">
                    <span class="text-slate-600">Company</span>
                    <span class="font-semibold text-slate-900">{{ $application->job->clean('company_name', 'Unknown') }}</span>
                </div>
                <div class="flex justify-between pb-4 border-b border-slate-200">
                    <span class="text-slate-600">Location</span>
                    <span class="font-semibold text-slate-900">{{ $application->job->clean('location', 'Not specified') }}</span>
                </div>
                <div class="flex justify-between pb-4 border-b border-slate-200">
                    <span class="text-slate-600">Employment Type</span>
                    <span class="font-semibold text-slate-900">{{ $application->job->clean('employment_type', 'Not specified') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Salary</span>
                    <span class="font-semibold text-slate-900">{{ $application->job->clean('salary_range', 'Not disclosed') }}</span>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Application Info -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Application Details
            </h3>
            
            <div class="space-y-4 text-sm">
                <div class="flex justify-between pb-3 border-b border-slate-200">
                    <span class="text-slate-600">Application ID</span>
                    <span class="font-mono text-xs text-slate-900">{{ substr($application->_id, 0, 8) }}...</span>
                </div>
                <div class="flex justify-between pb-3 border-b border-slate-200">
                    <span class="text-slate-600">Applied On</span>
                    <span class="font-semibold text-slate-900">{{ $application->applied_at ? $application->applied_at->format('M d, Y') : 'Recently' }}</span>
                </div>
                <div class="flex justify-between pb-3 border-b border-slate-200">
                    <span class="text-slate-600">Last Updated</span>
                    <span class="font-semibold text-slate-900">{{ $application->updated_at ? $application->updated_at->format('M d, Y H:i') : 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Current Status</span>
                    <span class="font-semibold text-slate-900">{{ ucfirst($application->status) }}</span>
                </div>
            </div>
        </div>

        <!-- Resume -->
        @if($application->resume_snapshot_url)
        <div class="bg-blue-50 rounded-xl border border-blue-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Resume
            </h3>
            
            <p class="text-sm text-slate-700 mb-4">{{ $application->clean('resume_snapshot_url', 'No resume available') }}</p>
            @if($application->resume_snapshot_url != 'Yoyo')
                <a href="{{ $application->resume_snapshot_url }}" target="_blank" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition-all">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Download Resume
                </a>
            @else
                <div class="inline-flex items-center rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0-6a4 4 0 110 8 4 4 0 010-8z"/>
                    </svg>
                    No valid resume URL
                </div>
            @endif
        </div>
        @endif

        <!-- Actions -->
        <div class="bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl border border-primary-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                @if($application->job && $application->job->apply_url)
                    <a href="{{ $application->job->apply_url }}" target="_blank" class="block w-full text-center rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 transition-all">
                        View Job Posting
                    </a>
                @endif
                @if($application->student)
                    <a href="{{ route('admin.students.show', $application->student->_id) }}" class="block w-full text-center rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-primary-600 shadow-sm ring-1 ring-primary-200 hover:bg-slate-50 transition-all">
                        View Student Profile
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
