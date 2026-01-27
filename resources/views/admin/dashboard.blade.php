@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<!-- Animated Background -->
<div class="absolute inset-0 -z-10 overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-b from-primary-100 to-transparent rounded-full blur-3xl opacity-20"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-t from-blue-100 to-transparent rounded-full blur-3xl opacity-20"></div>
</div>

<!-- Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
    <div>
        <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">Dashboard</h1>
        <p class="mt-2 text-base text-slate-600">Welcome back! Here's your platform overview.</p>
    </div>
    {{-- <div class="mt-4 md:mt-0 flex items-center space-x-3">
        <span class="inline-flex items-center rounded-full bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300">
            <span class="inline-flex h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></span>
            Live
        </span>
        <button type="button" class="inline-flex items-center rounded-lg bg-gradient-to-r from-primary-600 to-primary-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:from-primary-500 hover:to-primary-400 transition-all">
            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Generate Report
        </button>
    </div> --}}
</div>

<!-- Stats Grid - Using Real Data -->
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    <!-- Total Jobs -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all cursor-pointer">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 h-24 w-24 rounded-full bg-white/10"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <span class="inline-flex items-center rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                    </svg>
                </span>
                <svg class="h-8 w-8 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <p class="text-sm font-medium text-white/80 mb-1">Total Active Jobs</p>
            <p class="text-4xl font-bold text-white tracking-tight">{{ $totalJobs }}</p>
            <p class="text-xs text-white/70 mt-2">↑ 12% from last week</p>
        </div>
    </div>

    <!-- Total Students -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all cursor-pointer">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 h-24 w-24 rounded-full bg-white/10"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <span class="inline-flex items-center rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </span>
                <svg class="h-8 w-8 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <p class="text-sm font-medium text-white/80 mb-1">Verified Students</p>
            <p class="text-4xl font-bold text-white tracking-tight">{{ $totalStudents }}</p>
            <p class="text-xs text-white/70 mt-2">↑ 8% from last week</p>
        </div>
    </div>

    <!-- Total Applications -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all cursor-pointer">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 h-24 w-24 rounded-full bg-white/10"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <span class="inline-flex items-center rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <svg class="h-8 w-8 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <p class="text-sm font-medium text-white/80 mb-1">Total Applications</p>
            <p class="text-4xl font-bold text-white tracking-tight">{{ $totalApplications }}</p>
            <p class="text-xs text-white/70 mt-2">↑ 24% from last week</p>
        </div>
    </div>

    <!-- Acceptance Rate -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all cursor-pointer">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 h-24 w-24 rounded-full bg-white/10"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <span class="inline-flex items-center rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25a.75.75 0 01.75.75v2.25A2.25 2.25 0 006.375 17h-2.25A1.125 1.125 0 013 15.875v-2.75zm0-5.25c0-.621.504-1.125 1.125-1.125h2.25a.75.75 0 01.75.75V9a2.25 2.25 0 00-2.25 2.25v-2.75zm7.5 7.5H12a.75.75 0 01.75.75v2.25a2.25 2.25 0 01-2.25 2.25h-2.25a.75.75 0 01-.75-.75v-2.25c0-.621.504-1.125 1.125-1.125zm0-5.25H12a.75.75 0 01.75.75V9a2.25 2.25 0 00-2.25-2.25h-2.25A.75.75 0 009 7.5v2.25c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </span>
                <svg class="h-8 w-8 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <p class="text-sm font-medium text-white/80 mb-1">Acceptance Rate</p>
            <p class="text-4xl font-bold text-white tracking-tight">{{ $applicationRate }}%</p>
            <p class="text-xs text-white/70 mt-2">↑ 5% from last week</p>
        </div>
    </div>
</div>

<!-- Main Grid: Charts & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Left: Application Status Chart with Donut Chart -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Applications Overview</h3>
                <p class="text-sm text-slate-500 mt-1">Status distribution with trends</p>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-xs text-slate-500 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-full">
                <span class="inline-flex h-2 w-2 rounded-full bg-primary-500"></span>
                Updated just now
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-2 items-center">
            <!-- Donut Chart -->
            <div class="relative mx-auto w-full max-w-md">
                <div class="relative aspect-square rounded-2xl bg-gradient-to-br from-slate-50 to-white border border-slate-100 shadow-inner">
                    <canvas id="applicationsDonutChart" class="absolute inset-0 w-full h-full" aria-label="Applications distribution donut"></canvas>
                </div>
            </div>

            <!-- Status Breakdown Bars -->
            <div class="space-y-4">
                @php
                    $statusColor = ['Applied' => 'primary', 'Accepted' => 'emerald', 'Rejected' => 'red'];
                    $total = array_sum((array)json_decode($applicationsByStatus, true));
                @endphp
                @foreach(json_decode($applicationsByStatus, true) as $status => $count)
                @php $percentage = $total > 0 ? ($count / $total) * 100 : 0; @endphp
                <div class="p-3 rounded-xl border border-slate-100 shadow-sm bg-slate-50/60">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-slate-900 inline-flex items-center">
                            <span class="h-3 w-3 rounded-full bg-{{ $statusColor[$status] ?? 'slate' }}-500 mr-2"></span>
                            {{ $status }}
                        </span>
                        <span class="text-sm font-bold text-slate-900">{{ $count }} <span class="text-slate-500 font-normal">({{ round($percentage) }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                        <div class="h-full rounded-full bg-{{ $statusColor[$status] ?? 'slate' }}-500 transition-all duration-500 shadow-sm" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Right: Recent Activity (1/3) -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Recent Applications</h3>
        <div class="space-y-4 max-h-96 overflow-y-auto scrollbar-hide">
            @forelse($recentApplications as $app)
            <div class="pb-4 border-b border-slate-100 last:border-0 last:pb-0 hover:bg-slate-50 -mx-2 px-2 py-2 rounded-lg transition-colors">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">{{ $app['student_name'] }}</p>
                        <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $app['job_title'] }}</p>
                    </div>
                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ml-2 flex-shrink-0
                        @if($app['status'] === 'Applied') bg-blue-50 text-blue-700 ring-1 ring-blue-200
                        @elseif($app['status'] === 'Accepted') bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200
                        @else bg-red-50 text-red-700 ring-1 ring-red-200 @endif">
                        {{ $app['status'] }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 mt-2 inline-flex items-center">
                    <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $app['applied_at'] }}
                </p>
            </div>
            @empty
            <div class="text-center py-12">
                <svg class="h-12 w-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <p class="text-sm text-slate-500">No applications yet</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Recent Jobs Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Jobs Trend Line Chart (2/3) -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Job Posting Trends</h3>
                <p class="text-sm text-slate-500 mt-1">Last 7 days activity</p>
            </div>
            <select class="text-sm border-slate-200 rounded-lg px-3 py-1.5 font-medium text-slate-600 focus:ring-2 focus:ring-primary-500">
                <option>Last 7 days</option>
                <option>Last 30 days</option>
                <option>Last 90 days</option>
            </select>
        </div>
        <div class="p-6">
            <canvas id="jobsTrendChart" height="80"></canvas>
        </div>
    </div>

    <!-- Top Companies (1/3) -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-900">Top Hiring Companies</h3>
            <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-2 py-1 rounded-full">Live</span>
        </div>
        <div class="space-y-3">
            @forelse($topCompanies as $index => $company)
            <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-xs">
                    #{{ $index + 1 }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-700 truncate">{{ $company['name'] }}</p>
                    <p class="text-xs text-slate-500">{{ $company['count'] }} positions</p>
                </div>
                <div class="flex-shrink-0">
                    <canvas id="companyChart{{ $index }}" width="40" height="40"></canvas>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <svg class="h-12 w-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <p class="text-sm text-slate-500">No data available</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Recent Jobs List -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8">
    <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-slate-900">Recently Posted Jobs</h3>
            <p class="text-sm text-slate-500 mt-1">Latest opportunities on the platform</p>
        </div>
        <a href="{{ route('admin.jobs.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700 inline-flex items-center group">
            View All 
            <svg class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>
    <div class="divide-y divide-slate-200">
        @forelse($recentJobs as $job)
        <div class="px-6 py-4 hover:bg-slate-50/70 transition-colors cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 ring-1 ring-slate-200 flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-bold text-slate-700">{{ substr($job['company'], 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-900 group-hover:text-primary-600 transition-colors truncate">{{ $job['title'] }}</p>
                    <p class="text-xs text-slate-500 mt-1 inline-flex items-center gap-3">
                        <span class="inline-flex items-center">
                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            {{ $job['company'] }}
                        </span>
                        <span class="inline-flex items-center">
                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $job['location'] }}
                        </span>
                    </p>
                </div>
                <div class="flex-shrink-0 flex items-center gap-3">
                    <span class="text-xs text-slate-400 whitespace-nowrap">{{ $job['posted_at'] }}</span>
                    <svg class="h-5 w-5 text-slate-300 group-hover:text-slate-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
        </div>
        @empty
        <div class="px-6 py-12 text-center">
            <svg class="h-16 w-16 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <p class="text-sm text-slate-500">No recent jobs</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Bottom Section: Students & Verification Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
    <!-- Students by Branch with Bar Chart -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Students by Branch</h3>
        <canvas id="studentsBranchChart" height="200"></canvas>
    </div>

    <!-- Verification Status with Progress Rings -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Verification Status</h3>
        <div class="grid grid-cols-2 gap-6">
            <!-- Jobs Verification -->
            <div class="text-center">
                <div class="relative inline-flex items-center justify-center mb-3">
                    <svg class="transform -rotate-90 w-32 h-32">
                        <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" class="text-slate-100"/>
                        @php $jobPercent = ($verifiedJobs + $unverifiedJobs) > 0 ? ($verifiedJobs / ($verifiedJobs + $unverifiedJobs)) * 100 : 0; 
                        $jobCircumference = 2 * 3.14159 * 56;
                        $jobOffset = $jobCircumference - ($jobPercent / 100) * $jobCircumference;
                        @endphp
                        <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" 
                                stroke-dasharray="{{ $jobCircumference }}" 
                                stroke-dashoffset="{{ $jobOffset }}"
                                class="text-emerald-500 transition-all duration-1000"/>
                    </svg>
                    <span class="absolute text-2xl font-bold text-slate-900">{{ round($jobPercent) }}%</span>
                </div>
                <p class="text-sm font-semibold text-slate-700">Jobs Verified</p>
                <p class="text-xs text-slate-500 mt-1">{{ $verifiedJobs }}/{{ $verifiedJobs + $unverifiedJobs }}</p>
            </div>

            <!-- Students Verification -->
            <div class="text-center">
                <div class="relative inline-flex items-center justify-center mb-3">
                    <svg class="transform -rotate-90 w-32 h-32">
                        <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" class="text-slate-100"/>
                        @php $studPercent = ($verifiedStudents + $unverifiedStudents) > 0 ? ($verifiedStudents / ($verifiedStudents + $unverifiedStudents)) * 100 : 0; 
                        $studCircumference = 2 * 3.14159 * 56;
                        $studOffset = $studCircumference - ($studPercent / 100) * $studCircumference;
                        @endphp
                        <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" 
                                stroke-dasharray="{{ $studCircumference }}" 
                                stroke-dashoffset="{{ $studOffset }}"
                                class="text-primary-500 transition-all duration-1000"/>
                    </svg>
                    <span class="absolute text-2xl font-bold text-slate-900">{{ round($studPercent) }}%</span>
                </div>
                <p class="text-sm font-semibold text-slate-700">Students Verified</p>
                <p class="text-xs text-slate-500 mt-1">{{ $verifiedStudents }}/{{ $verifiedStudents + $unverifiedStudents }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Initialization -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Applications Donut Chart
    const applicationsData = @json(json_decode($applicationsByStatus, true));
    const appLabels = Object.keys(applicationsData);
    const appValues = Object.values(applicationsData);
    
    new Chart(document.getElementById('applicationsDonutChart'), {
        type: 'doughnut',
        data: {
            labels: appLabels,
            datasets: [{
                data: appValues,
                backgroundColor: [
                    'rgba(37, 99, 235, 0.8)',  // Primary
                    'rgba(16, 185, 129, 0.8)',  // Emerald
                    'rgba(239, 68, 68, 0.8)'    // Red
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            resizeDelay: 120,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 12, weight: '600' },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            },
            cutout: '72%'
        }
    });

    // Jobs Trend Line Chart (Sample data - replace with real data from controller)
    new Chart(document.getElementById('jobsTrendChart'), {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Jobs Posted',
                data: [12, 19, 15, 25, 22, 18, 24],
                borderColor: 'rgb(37, 99, 235)',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: 'rgb(37, 99, 235)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    ticks: { font: { size: 11 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            }
        }
    });

    // Students by Branch Bar Chart
    const branchData = @json($studentsByBranch);
    const branchLabels = branchData.map(b => b.name);
    const branchValues = branchData.map(b => b.count);
    
    new Chart(document.getElementById('studentsBranchChart'), {
        type: 'bar',
        data: {
            labels: branchLabels,
            datasets: [{
                label: 'Students',
                data: branchValues,
                backgroundColor: 'rgba(37, 99, 235, 0.8)',
                borderRadius: 8,
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    ticks: { font: { size: 11 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            }
        }
    });

    // Mini sparkline charts for top companies
    @foreach($topCompanies as $index => $company)
        const ctx{{ $index }} = document.getElementById('companyChart{{ $index }}');
        if (ctx{{ $index }}) {
            new Chart(ctx{{ $index }}, {
                type: 'line',
                data: {
                    labels: [1, 2, 3, 4, 5],
                    datasets: [{
                        data: [{{ rand(5, 15) }}, {{ rand(10, 20) }}, {{ rand(8, 18) }}, {{ rand(12, 22) }}, {{ $company['count'] }}],
                        borderColor: 'rgb(37, 99, 235)',
                        borderWidth: 2,
                        tension: 0.4,
                        pointRadius: 0,
                        fill: false
                    }]
                },
                options: {
                    responsive: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    }
                }
            });
        }
    @endforeach
});
</script>

@endsection