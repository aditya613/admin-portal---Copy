@extends('admin.layout')

@section('title', $job->clean('title', 'Job Details') . ' - Job Details')

@section('content')
<!-- Back Button -->
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.jobs.index') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900">
        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Job Listings
    </a>
    
    <!-- Admin Actions -->
    <div class="flex items-center gap-3">
        <!-- Toggle Verification Button -->
        <button onclick="toggleVerification('{{ $job->_id }}')" 
                class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold transition-all
                @if($job->is_verified) 
                    bg-blue-100 text-blue-700 hover:bg-blue-200
                @else 
                    bg-slate-100 text-slate-600 hover:bg-slate-200
                @endif">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="ml-2">{{ $job->is_verified ? 'Verified' : 'Verify' }}</span>
        </button>

        <!-- Delete Button -->
        <button onclick="deleteJob('{{ $job->_id }}', '{{ addslashes($job->clean('title', 'Job')) }}')" 
                class="inline-flex items-center justify-center rounded-lg bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100 transition-all">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            <span class="ml-2">Delete</span>
        </button>
    </div>
</div>

<!-- Job Header Card -->
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-8 py-6">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-4">
                <div class="h-20 w-20 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-3xl ring-4 ring-white/30">
                    {{ substr($job->clean('company_name', 'N'), 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $job->clean('title', 'Untitled role') }}</h1>
                    <p class="text-lg text-white/90 font-medium">{{ $job->clean('company_name', 'Unknown company') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="px-8 py-6 bg-slate-50 border-t border-slate-200">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Location</p>
                <p class="text-sm font-semibold text-slate-900 flex items-center gap-1.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    {{ $job->clean('location', 'Not specified') }}
                </p>
            </div>
            
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Employment Type</p>
                <p class="text-sm font-semibold text-slate-900">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                        {{ $job->clean('employment_type', 'Not specified') }}
                    </span>
                </p>
            </div>
            
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Posted</p>
                <p class="text-sm font-semibold text-slate-900">
                    {{ $job->posted_at ? $job->posted_at->format('M d, Y') : 'Recently' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Status</p>
                <p class="text-sm font-semibold text-slate-900">
                    @if($job->is_active)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 ring-1 ring-green-200">Active</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">Inactive</span>
                    @endif
                </p>
            </div>

            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Source</p>
                <p class="text-sm font-semibold text-slate-900">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 ring-1 ring-blue-200">
                        {{ ucfirst($job->clean('source', 'Unknown')) }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Job Description -->
        @if($job->clean('description'))
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-8 py-5 border-b border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                    <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Job Description
                </h2>
            </div>
            <div class="p-8">
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-line">
                    {{ $job->clean('description') }}
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-slate-500 font-medium">No description available</p>
        </div>
        @endif
    </div>
    
    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Stats Card -->
        <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold">Quick Stats</h3>
                <svg class="h-6 w-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                    <p class="text-xs font-medium opacity-90 mb-1">Applications</p>
                    <p class="text-2xl font-bold" id="stats-applications">-</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                    <p class="text-xs font-medium opacity-90 mb-1">Views</p>
                    <p class="text-2xl font-bold">{{ $job->views_count ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Application Link -->
        @if($job->apply_url)
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border-2 border-green-200 shadow-sm p-6">
            <div class="flex items-center gap-2 mb-3">
                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <h3 class="text-base font-bold text-slate-900">External Link</h3>
            </div>
            <a href="{{ $job->apply_url }}" target="_blank" rel="noopener noreferrer" 
               class="group block w-full text-center rounded-lg bg-gradient-to-r from-green-600 to-emerald-600 px-4 py-3.5 text-sm font-semibold text-white shadow-md hover:shadow-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 transform hover:-translate-y-0.5">
                <span class="flex items-center justify-center gap-2">
                    View on {{ ucfirst($job->clean('source', 'Website')) }}
                    <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </span>
            </a>
        </div>
        @endif
        
        <!-- Company Info -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Job Details
            </h3>
            
            <div class="space-y-4">
                @if($job->clean('company_name'))
                    <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg">
                        <svg class="h-5 w-5 text-primary-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Company</p>
                            <p class="text-sm font-bold text-slate-900 mt-1">{{ $job->clean('company_name') }}</p>
                        </div>
                    </div>
                @endif
                
                @if($job->clean('location'))
                    <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg">
                        <svg class="h-5 w-5 text-primary-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Location</p>
                            <p class="text-sm font-bold text-slate-900 mt-1">{{ $job->clean('location') }}</p>
                        </div>
                    </div>
                @endif
                
                @if($job->salary_range)
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg border border-green-100">
                        <svg class="h-5 w-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-green-700 uppercase tracking-wide">Salary Range</p>
                            <p class="text-sm font-bold text-green-900 mt-1">{{ $job->salary_range }}</p>
                        </div>
                    </div>
                @endif

                @if($job->clean('employment_type'))
                    <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg">
                        <svg class="h-5 w-5 text-primary-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Employment Type</p>
                            <p class="text-sm font-bold text-slate-900 mt-1">{{ $job->clean('employment_type') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Metadata -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Metadata
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center py-2">
                    <span class="text-slate-600 font-medium">Job ID</span>
                    <span class="font-mono text-xs text-slate-900 bg-slate-100 px-2 py-1 rounded">{{ substr($job->_id, 0, 8) }}...</span>
                </div>
                @if($job->posted_at)
                    <div class="flex justify-between items-center py-2 border-t border-slate-100">
                        <span class="text-slate-600 font-medium">Posted</span>
                        <span class="font-semibold text-slate-900">{{ $job->posted_at->format('M d, Y') }}</span>
                    </div>
                @endif
                @if($job->expires_at)
                    <div class="flex justify-between items-center py-2 border-t border-slate-100">
                        <span class="text-slate-600 font-medium">Expires</span>
                        <span class="font-semibold text-slate-900">{{ $job->expires_at->format('M d, Y') }}</span>
                    </div>
                @endif
                <div class="flex justify-between items-center py-2 border-t border-slate-100">
                    <span class="text-slate-600 font-medium">Verification</span>
                    @if($job->is_verified)
                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Verified
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Pending</span>
                    @endif
                </div>
                <div class="flex justify-between items-center py-2 border-t border-slate-100">
                    <span class="text-slate-600 font-medium">Status</span>
                    @if($job->is_active)
                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">Inactive</span>
                    @endif
                </div>
                <div class="flex justify-between items-center py-2 border-t border-slate-100">
                    <span class="text-slate-600 font-medium">Source</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">
                        {{ ucfirst($job->clean('source', 'Unknown')) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Applications Section -->
<div class="mt-8">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <svg class="h-7 w-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Student Applications
            </h2>
            <p class="text-sm text-slate-600 mt-1">View and manage all applications for this position</p>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div id="applications-container" class="divide-y divide-slate-200">
            <div class="px-6 py-12 text-center text-slate-500">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-50 rounded-full mb-3">
                    <svg class="h-8 w-8 text-primary-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <p class="text-sm font-medium">Loading applications...</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jobId = '{{ $job->_id }}';
    const container = document.getElementById('applications-container');
    const statsElement = document.getElementById('stats-applications');
    
    fetch(`/admin/api/applications/job/${jobId}`)
        .then(response => {
            if (!response.ok) throw new Error('Failed to load applications');
            return response.json();
        })
        .then(applications => {
            // Update stats
            if (statsElement) {
                statsElement.textContent = applications.length;
            }
            
            if (applications.length === 0) {
                container.innerHTML = `
                    <div class="px-6 py-12 text-center text-slate-500">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-3">
                            <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <p class="font-medium text-slate-900">No applications yet</p>
                        <p class="text-sm text-slate-500 mt-1">Applications will appear here when students apply</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = applications.map((app, index) => {
                const statusConfig = {
                    'Applied': { bg: 'bg-blue-50', text: 'text-blue-700', ring: 'ring-blue-200', icon: '📝' },
                    'Accepted': { bg: 'bg-green-50', text: 'text-green-700', ring: 'ring-green-200', icon: '✓' },
                    'Rejected': { bg: 'bg-red-50', text: 'text-red-700', ring: 'ring-red-200', icon: '✕' },
                    'Under Review': { bg: 'bg-amber-50', text: 'text-amber-700', ring: 'ring-amber-200', icon: '👁' }
                };
                
                const config = statusConfig[app.status] || statusConfig['Applied'];
                const appliedDate = new Date(app.applied_at);
                const timeAgo = getTimeAgo(appliedDate);
                
                return `
                    <a href="/admin/applications/${app._id}" 
                       class="group block px-6 py-5 hover:bg-gradient-to-r hover:from-slate-50 hover:to-primary-50/30 transition-all duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start gap-4 flex-1">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-lg ring-4 ring-primary-100">
                                    ${app.student?.name ? app.student.name.charAt(0).toUpperCase() : '?'}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-slate-900 group-hover:text-primary-600 transition-colors flex items-center gap-2">
                                        ${app.student?.name || 'Unknown Student'}
                                        ${app.student?.is_verified ? '<svg class="h-4 w-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>' : ''}
                                    </h4>
                                    <p class="text-sm text-slate-600 mt-0.5">${app.student?.email || 'Unknown Email'}</p>
                                    <div class="flex items-center gap-3 mt-2 text-xs text-slate-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            ${timeAgo}
                                        </span>
                                        ${app.student?.graduation_year ? `<span>•</span><span>Class of ${app.student.graduation_year}</span>` : ''}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold ${config.bg} ${config.text} ring-1 ${config.ring}">
                                    <span>${config.icon}</span>
                                    ${app.status}
                                </span>
                                <svg class="h-5 w-5 text-slate-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                `;
            }).join('');
        })
        .catch(error => {
            console.error('Error loading applications:', error);
            if (statsElement) statsElement.textContent = '0';
            container.innerHTML = `
                <div class="px-6 py-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-50 rounded-full mb-3">
                        <svg class="h-8 w-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="font-medium text-red-600">Failed to load applications</p>
                    <p class="text-sm text-slate-500 mt-1">Please refresh the page to try again</p>
                </div>
            `;
        });
});

function getTimeAgo(date) {
    const seconds = Math.floor((new Date() - date) / 1000);
    
    const intervals = {
        year: 31536000,
        month: 2592000,
        week: 604800,
        day: 86400,
        hour: 3600,
        minute: 60
    };
    
    for (const [unit, secondsInUnit] of Object.entries(intervals)) {
        const interval = Math.floor(seconds / secondsInUnit);
        if (interval >= 1) {
            return `${interval} ${unit}${interval > 1 ? 's' : ''} ago`;
        }
    }
    
    return 'Just now';
}

// Admin action functions
// Get CSRF token from meta tag
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}

async function deleteJob(jobId, jobTitle) {
    if (!confirm(`Are you sure you want to delete the job "${jobTitle}"? This action cannot be undone.`)) {
        return;
    }

    try {
        const csrfToken = getCsrfToken();
        const response = await fetch(`/admin/jobs/${jobId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        const data = await response.json();

        if (response.ok) {
            showAlert(data.message, 'success');
            setTimeout(() => window.location.href = '/admin/jobs', 1000);
        } else {
            showAlert(data.message || 'Error deleting job', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showAlert('An error occurred while deleting the job', 'error');
    }
}

async function toggleVerification(jobId) {
    try {
        const csrfToken = getCsrfToken();
        const response = await fetch(`/admin/jobs/${jobId}/verify`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        const data = await response.json();

        if (response.ok) {
            showAlert(data.message, 'success');
            setTimeout(() => location.reload(), 500);
        } else {
            showAlert(data.message || 'Error updating verification status', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showAlert('An error occurred while updating verification status', 'error');
    }
}

function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-4 right-4 px-4 py-3 rounded-lg text-white font-semibold z-50 ${
        type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);
    
    setTimeout(() => alertDiv.remove(), 3000);
}
</script>
@endsection
