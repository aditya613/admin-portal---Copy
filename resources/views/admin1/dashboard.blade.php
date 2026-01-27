@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Jobs Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg border-2 border-blue-100/50 p-7 hover:shadow-2xl hover:border-blue-300 hover:-translate-y-1 transition-all duration-500 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-sm font-bold text-blue-800 uppercase tracking-wider">Total Jobs</h3>
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl p-3.5 shadow-xl transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 bg-clip-text text-transparent leading-tight">{{ $totalJobs }}</p>
                    <p class="text-xs font-semibold text-blue-600/80 uppercase tracking-wide">Job listings created</p>
                </div>
            </div>
        </div>

        <!-- Verified Jobs Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg border-2 border-blue-100/50 p-7 hover:shadow-2xl hover:border-blue-300 hover:-translate-y-1 transition-all duration-500 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-sm font-bold text-blue-800 uppercase tracking-wider">Verified Jobs</h3>
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 rounded-2xl p-3.5 shadow-xl transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 bg-clip-text text-transparent leading-tight">{{ $verifiedJobs }}</p>
                    <p class="text-xs font-semibold text-blue-600/80 uppercase tracking-wide">Jobs verified</p>
                </div>
            </div>
        </div>

        <!-- Active Jobs Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg border-2 border-blue-100/50 p-7 hover:shadow-2xl hover:border-blue-300 hover:-translate-y-1 transition-all duration-500 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-sm font-bold text-blue-800 uppercase tracking-wider">Active Jobs</h3>
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-300 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-blue-300 via-blue-400 to-blue-500 rounded-2xl p-3.5 shadow-xl transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 bg-clip-text text-transparent leading-tight">{{ $activeJobs }}</p>
                    <p class="text-xs font-semibold text-blue-600/80 uppercase tracking-wide">Currently active</p>
                </div>
            </div>
        </div>

        <!-- Total Applications Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg border-2 border-blue-100/50 p-7 hover:shadow-2xl hover:border-blue-300 hover:-translate-y-1 transition-all duration-500 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-sm font-bold text-blue-800 uppercase tracking-wider">Total Applications</h3>
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-600 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl p-3.5 shadow-xl transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 bg-clip-text text-transparent leading-tight">{{ $totalApplications }}</p>
                    <p class="text-xs font-semibold text-blue-600/80 uppercase tracking-wide">Student applications</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="relative bg-white rounded-2xl shadow-xl border-2 border-blue-100/50 p-10 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 via-transparent to-transparent"></div>
        <div class="relative z-10">
            <h2 class="text-2xl font-extrabold bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 bg-clip-text text-transparent mb-8 tracking-tight">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Add Job Button -->
                <a href="{{ route('admin.jobs.create') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 via-blue-100/80 to-blue-50 p-8 border-2 border-blue-200/50 hover:border-blue-400 transition-all hover:shadow-2xl hover:scale-[1.02] duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="relative mb-5">
                            <div class="absolute inset-0 bg-blue-500 rounded-2xl blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-16 h-16 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl flex items-center justify-center group-hover:from-blue-600 group-hover:via-blue-700 group-hover:to-blue-800 transition-all shadow-xl transform group-hover:scale-110 group-hover:rotate-6 duration-300">
                                <svg class="w-8 h-8 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="font-extrabold text-blue-900 mb-2 text-lg group-hover:text-blue-800 transition-colors">Create New Job</h3>
                        <p class="text-sm font-semibold text-blue-700/80">Add a new job listing</p>
                    </div>
                </a>

                <!-- Add Company Button -->
                <a href="{{ route('admin.companies.create') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 via-blue-100/80 to-blue-50 p-8 border-2 border-blue-200/50 hover:border-blue-400 transition-all hover:shadow-2xl hover:scale-[1.02] duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="relative mb-5">
                            <div class="absolute inset-0 bg-blue-400 rounded-2xl blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-16 h-16 bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 rounded-2xl flex items-center justify-center group-hover:from-blue-500 group-hover:via-blue-600 group-hover:to-blue-700 transition-all shadow-xl transform group-hover:scale-110 group-hover:rotate-6 duration-300">
                                <svg class="w-8 h-8 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="font-extrabold text-blue-900 mb-2 text-lg group-hover:text-blue-800 transition-colors">Register Company</h3>
                        <p class="text-sm font-semibold text-blue-700/80">Add a new company</p>
                    </div>
                </a>

                <!-- View Applications Button -->
                <a href="{{ route('admin.applications.index') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 via-blue-100/80 to-blue-50 p-8 border-2 border-blue-200/50 hover:border-blue-400 transition-all hover:shadow-2xl hover:scale-[1.02] duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="relative mb-5">
                            <div class="absolute inset-0 bg-blue-600 rounded-2xl blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-16 h-16 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl flex items-center justify-center group-hover:from-blue-600 group-hover:via-blue-700 group-hover:to-blue-800 transition-all shadow-xl transform group-hover:scale-110 group-hover:rotate-6 duration-300">
                                <svg class="w-8 h-8 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="font-extrabold text-blue-900 mb-2 text-lg group-hover:text-blue-800 transition-colors">View Applications</h3>
                        <p class="text-sm font-semibold text-blue-700/80">Check student submissions</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

