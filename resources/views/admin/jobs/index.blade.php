@extends('admin.layout')

@section('title', 'Job Listings')

@section('content')
<div class="space-y-8">


    <!-- Stats -->
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-blue-100 p-3 text-blue-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total roles</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format($jobs->total()) }}</p>
            <p class="text-xs text-slate-500">Across all sources</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-green-100 p-3 text-green-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Active jobs</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\JobListing::where('is_active', true)->count()) }}</p>
            <p class="text-xs text-slate-500">Currently active</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-purple-100 p-3 text-purple-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Companies</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\JobListing::distinct('company_name')->count('company_name')) }}</p>
            <p class="text-xs text-slate-500">Unique employers</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-orange-100 p-3 text-orange-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Locations</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\JobListing::distinct('location')->count('location')) }}</p>
            <p class="text-xs text-slate-500">Geographies covered</p>
        </div>
    </div>

    <!-- Filters -->
    <form id="filters" method="GET" class="bg-white p-6 rounded-xl border shadow-sm">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-2">Search</label>
                <div class="relative">
                    <svg class="absolute left-3 top-3 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Title, company, location" class="block w-full rounded-lg border-slate-300 py-2.5 pl-10 pr-4 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Source</label>
                <select name="source" class="block w-full rounded-lg border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                    <option value="">All Sources</option>
                    @if($sources && count($sources) > 0)
                        @foreach($sources as $source)
                            <option value="{{ $source }}" {{ request('source') == $source ? 'selected' : '' }}>
                                {{ ucfirst(is_string($source) ? $source : (isset($source['_id']) ? $source['_id'] : 'Unknown')) }}
                            </option>
                        @endforeach
                    @else
                        <option disabled>No sources available</option>
                    @endif
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Employment Type</label>
                <select name="employment_type" class="block w-full rounded-lg border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                    <option value="">All</option>
                    <option value="Full-time" {{ request('employment_type') === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ request('employment_type') === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ request('employment_type') === 'Contract' ? 'selected' : '' }}>Contract</option>
                </select>
            </div>
            <div class="flex items-end gap-3">
                <button type="submit" class="w-full rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus:ring-2 focus:ring-primary-500">Apply filters</button>
                <a href="{{ route('admin.jobs.index') }}" class="hidden lg:inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Reset</a>
            </div>
        </div>
    </form>

    <!-- Jobs List -->
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b bg-slate-50">
            <div>
                <h3 class="text-lg font-semibold text-slate-900">Available Opportunities</h3>
                <p class="text-sm text-slate-500">Showing {{ $jobs->firstItem() ?? 0 }} - {{ $jobs->lastItem() ?? 0 }} of {{ $jobs->total() }}</p>
            </div>
            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">Live feed</span>
        </div>
        
        @forelse($jobs as $job)
        <div class="border-b last:border-b-0 hover:bg-slate-50/70 transition group">
            <div class="px-6 py-5 flex items-start justify-between gap-4">
                <a href="{{ route('admin.jobs.show', $job->_id) }}" class="flex-1 block min-w-0">
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 ring-1 ring-slate-200 flex items-center justify-center overflow-hidden">
                            <span class="text-lg font-bold text-slate-700">{{ substr($job->clean('company_name', 'N'), 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0 space-y-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="rounded-full bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-700 ring-1 ring-primary-100">{{ ucfirst($job->clean('source', 'Unknown')) }}</span>
                                @if($job->employment_type)
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">{{ $job->clean('employment_type') }}</span>
                                @endif
                                @if($job->is_verified)
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-blue-200">Verified</span>
                                @endif
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <h4 class="text-lg font-semibold text-slate-900 hover:text-primary-600">{{ $job->clean('title', 'Untitled role') }}</h4>
                                @if($job->clean('company_name'))
                                    <span class="text-sm font-medium text-slate-600">• {{ $job->clean('company_name') }}</span>
                                @endif
                            </div>
                            <div class="flex flex-wrap gap-3 text-sm text-slate-600">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    {{ $job->clean('location', 'Not specified') }}
                                </span>
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $job->posted_at ? $job->posted_at->diffForHumans() : 'Recently posted' }}
                                </span>
                                @if($job->salary_range)
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $job->clean('salary_range') }}
                                    </span>
                                @endif
                            </div>
                            @php
                                $summary = \Illuminate\Support\Str::limit(strip_tags($job->clean('description', '')), 180);
                            @endphp
                            @if($summary)
                                <p class="text-sm text-slate-600 line-clamp-2">{{ $summary }}</p>
                            @endif
                        </div>
                    </div>
                </a>
                
                <!-- Action Buttons -->
                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <!-- Toggle Verification Button -->
                    <button onclick="toggleVerification('{{ $job->_id }}')" 
                            class="inline-flex items-center justify-center rounded-lg px-3 py-2 text-sm font-semibold transition-all
                            @if($job->is_verified) 
                                bg-blue-100 text-blue-700 hover:bg-blue-200
                            @else 
                                bg-slate-100 text-slate-600 hover:bg-slate-200
                            @endif">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="ml-1">{{ $job->is_verified ? 'Verified' : 'Verify' }}</span>
                    </button>

                    <!-- Delete Button -->
                    <button onclick="deleteJob('{{ $job->_id }}', '{{ addslashes($job->clean('title', 'Job')) }}')" 
                            class="inline-flex items-center justify-center rounded-lg bg-red-50 px-3 py-2 text-sm font-semibold text-red-700 hover:bg-red-100 transition-all">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span class="ml-1">Delete</span>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="px-6 py-16 text-center">
            <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <h3 class="mt-4 text-lg font-medium text-slate-900">No jobs found</h3>
            <p class="mt-2 text-sm text-slate-500">Adjust filters or refresh the feed.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($jobs->hasPages())
    <div class="bg-white px-6 py-4 rounded-lg border shadow-sm flex items-center justify-between">
        <p class="text-sm text-slate-700">Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }}</p>
        <div>{{ $jobs->links() }}</div>
    </div>
    @endif
</div>

<!-- JavaScript for delete and verify actions -->
<script>
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
            // Success message
            showAlert(data.message, 'success');
            // Reload page after 1 second
            setTimeout(() => location.reload(), 1000);
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
            // Reload page after 500ms
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
