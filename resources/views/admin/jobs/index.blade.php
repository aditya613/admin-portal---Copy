@extends('admin.layout')

@section('title', 'Job Listings')

@section('content')
<div class="space-y-8">
    <!-- Header with Fetch Jobs Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Job Listings</h1>
            <p class="text-slate-600 mt-1">Manage and fetch job opportunities</p>
        </div>
        <button onclick="openFetchJobsModal()" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 px-5 py-3 text-sm font-semibold text-white shadow-md hover:shadow-lg hover:from-primary-700 hover:to-primary-800 transition-all duration-200 transform hover:-translate-y-0.5">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Fetch More Jobs
        </button>
    </div>

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

function openFetchJobsModal() {
    const modal = document.getElementById('fetchJobsModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeFetchJobsModal() {
    const modal = document.getElementById('fetchJobsModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

async function fetchMoreJobs() {
    const searchTerm = document.getElementById('search_term').value;
    const location = document.getElementById('location').value;
    const resultsWanted = parseInt(document.getElementById('results_wanted').value);
    const hoursOld = parseInt(document.getElementById('hours_old').value);
    const submitBtn = document.getElementById('submitFetchBtn');
    const spinner = document.getElementById('fetchSpinner');

    // Validation
    if (!searchTerm || !location) {
        showAlert('Please fill in all required fields', 'error');
        return;
    }

    // Disable button and show spinner
    submitBtn.disabled = true;
    spinner.classList.remove('hidden');

    try {
        const response = await fetch('https://team-404-found-5uq1.onrender.com/scrape', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                search_term: searchTerm,
                location: location,
                results_wanted: resultsWanted,
                hours_old: hoursOld
            })
        });

        const data = await response.json();

        if (response.ok && data.status === 'started') {
            showAlert(data.message || `Scraping started for '${searchTerm}' in '${location}'`, 'success');
            closeFetchJobsModal();
            
            // Reset form
            document.getElementById('fetchJobsForm').reset();
            
            // Optional: Reload page after a delay to show new jobs
            setTimeout(() => {
                showAlert('Refreshing job listings...', 'info');
                location.reload();
            }, 3000);
        } else {
            showAlert(data.message || 'Failed to start job scraping', 'error');
        }
    } catch (error) {
        console.error('Error fetching jobs:', error);
        showAlert('An error occurred while fetching jobs. Please try again.', 'error');
    } finally {
        submitBtn.disabled = false;
        spinner.classList.add('hidden');
    }
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeFetchJobsModal();
    }
});
</script>

<!-- Fetch Jobs Modal -->
<div id="fetchJobsModal" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-5 flex items-center justify-between rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Fetch More Jobs</h2>
                    <p class="text-primary-100 text-sm">Search and import new job listings</p>
                </div>
            </div>
            <button onclick="closeFetchJobsModal()" class="text-white/80 hover:text-white transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Form -->
        <form id="fetchJobsForm" onsubmit="event.preventDefault(); fetchMoreJobs();" class="p-6 space-y-5">
            <!-- Search Term -->
            <div>
                <label for="search_term" class="block text-sm font-semibold text-slate-700 mb-2">
                    Search Term <span class="text-red-500">*</span>
                </label>
                <input type="text" id="search_term" name="search_term" value="software engineer" required
                    class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500 px-4 py-2.5"
                    placeholder="e.g., software engineer, data analyst">
                <p class="mt-1 text-xs text-slate-500">Enter job title or keywords to search for</p>
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-semibold text-slate-700 mb-2">
                    Location <span class="text-red-500">*</span>
                </label>
                <input type="text" id="location" name="location" value="Gurugram, Haryana" required
                    class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500 px-4 py-2.5"
                    placeholder="e.g., Gurugram, Haryana">
                <p class="mt-1 text-xs text-slate-500">City and state/region</p>
            </div>

            <!-- Results Wanted -->
            <div>
                <label for="results_wanted" class="block text-sm font-semibold text-slate-700 mb-2">
                    Number of Results
                </label>
                <input type="number" id="results_wanted" name="results_wanted" value="30" min="1" max="100"
                    class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500 px-4 py-2.5">
                <p class="mt-1 text-xs text-slate-500">Maximum number of jobs to fetch (1-100)</p>
            </div>

            <!-- Hours Old -->
            <div>
                <label for="hours_old" class="block text-sm font-semibold text-slate-700 mb-2">
                    Job Age (Hours)
                </label>
                <select id="hours_old" name="hours_old"
                    class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500 px-4 py-2.5">
                    <option value="24">Last 24 hours</option>
                    <option value="48">Last 2 days</option>
                    <option value="72">Last 3 days</option>
                    <option value="96" selected>Last 4 days</option>
                    <option value="168">Last week</option>
                </select>
                <p class="mt-1 text-xs text-slate-500">Only fetch jobs posted within this timeframe</p>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex gap-3">
                    <svg class="h-5 w-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm text-blue-900">
                        <p class="font-semibold mb-1">How it works</p>
                        <p class="text-blue-800">This will fetch jobs from external sources based on your criteria. The process may take a few moments to complete.</p>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeFetchJobsModal()"
                    class="flex-1 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Cancel
                </button>
                <button type="submit" id="submitFetchBtn"
                    class="flex-1 rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 px-4 py-2.5 text-sm font-semibold text-white hover:from-primary-700 hover:to-primary-800 shadow-md hover:shadow-lg transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <span class="flex items-center justify-center gap-2">
                        <svg id="fetchSpinner" class="hidden animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Start Fetching
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
