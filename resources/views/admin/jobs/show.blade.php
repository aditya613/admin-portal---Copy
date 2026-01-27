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
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Job Description
            </h2>
            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-line">
                {{ $job->clean('description') }}
            </div>
        </div>
        @endif
    </div>
    
    <!-- Sidebar -->
    <div class="space-y-6">
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
                    <div class="flex items-start gap-3">
                        <svg class="h-5 w-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase">Company</p>
                            <p class="text-sm font-semibold text-slate-900 mt-1">{{ $job->clean('company_name') }}</p>
                        </div>
                    </div>
                @endif
                
                @if($job->salary_range)
                    <div class="flex items-start gap-3 pt-4 border-t border-slate-200">
                        <svg class="h-5 w-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase">Salary Range</p>
                            <p class="text-sm font-semibold text-slate-900 mt-1">{{ $job->salary_range }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Application Links -->
        <div class="bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl border border-primary-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Apply Now</h3>
            <div class="space-y-3">
                @if($job->apply_url)
                    <a href="{{ $job->apply_url }}" target="_blank" class="block w-full text-center rounded-lg bg-primary-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 transition-all">
                        Apply on {{ ucfirst($job->clean('source', 'Website')) }}
                    </a>
                @endif
            </div>
        </div>
        
        <!-- Metadata -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Job Info</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-600">Job ID</span>
                    <span class="font-mono text-xs text-slate-900">{{ $job->_id }}</span>
                </div>
                @if($job->posted_at)
                    <div class="flex justify-between">
                        <span class="text-slate-600">Posted Date</span>
                        <span class="font-semibold text-slate-900">{{ $job->posted_at->format('M d, Y') }}</span>
                    </div>
                @endif
                @if($job->expires_at)
                    <div class="flex justify-between">
                        <span class="text-slate-600">Expires On</span>
                        <span class="font-semibold text-slate-900">{{ $job->expires_at->format('M d, Y') }}</span>
                    </div>
                @endif
                <div class="flex justify-between pt-2 border-t border-slate-200">
                    <span class="text-slate-600">Verified</span>
                    <span class="font-semibold text-slate-900">{{ $job->is_verified ? 'Yes' : 'No' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Active</span>
                    <span class="font-semibold text-slate-900">{{ $job->is_active ? 'Yes' : 'No' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Source</span>
                    <span class="font-semibold text-slate-900">{{ ucfirst($job->clean('source', 'Unknown')) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Applications Section -->
<div class="mt-6">
    <h2 class="text-2xl font-bold text-slate-900 mb-4">Student Applications</h2>
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div id="applications-container" class="divide-y">
            <div class="px-6 py-8 text-center text-slate-500">
                <svg class="mx-auto h-12 w-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-sm">Loading applications...</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jobId = '{{ $job->_id }}';
    const container = document.getElementById('applications-container');
    
    fetch(`/admin/api/applications/job/${jobId}`)
        .then(response => response.json())
        .then(applications => {
            if (applications.length === 0) {
                container.innerHTML = '<div class="px-6 py-8 text-center text-slate-500"><p>No applications yet</p></div>';
                return;
            }
            
            container.innerHTML = applications.map(app => `
                <a href="/admin/applications/${app._id}" class="block px-6 py-5 hover:bg-slate-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h4 class="font-semibold text-slate-900">${app.student ? app.student.name : 'Unknown Student'}</h4>
                            <p class="text-sm text-slate-600">${app.student ? app.student.email : 'Unknown Email'}</p>
                            <p class="text-xs text-slate-500 mt-1">Applied ${new Date(app.applied_at).toLocaleDateString()}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${
                                app.status === 'Applied' ? 'bg-amber-50 text-amber-700' :
                                app.status === 'Accepted' ? 'bg-green-50 text-green-700' :
                                app.status === 'Rejected' ? 'bg-red-50 text-red-700' :
                                'bg-slate-50 text-slate-700'
                            }">
                                ${app.status}
                            </span>
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            `).join('');
        })
        .catch(error => {
            console.error('Error loading applications:', error);
            container.innerHTML = '<div class="px-6 py-8 text-center text-red-500"><p>Error loading applications</p></div>';
        });
});

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
