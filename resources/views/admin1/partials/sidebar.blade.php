<nav class="space-y-1.5">
    <a href="{{ route('admin.dashboard') }}" 
       class="group flex items-center px-5 py-3.5 text-sm font-semibold rounded-2xl transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-700 shadow-2xl shadow-blue-500/30 scale-105' : 'text-blue-100 hover:bg-blue-700/60 hover:text-white hover:scale-105' }}">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <svg class="w-5 h-5 mr-3.5 relative z-10 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-blue-200 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        <span class="relative z-10">Dashboard</span>
        @if(request()->routeIs('admin.dashboard'))
            <div class="absolute right-3 w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
        @endif
    </a>
    
    <a href="{{ route('admin.companies.index') }}" 
       class="group flex items-center px-5 py-3.5 text-sm font-semibold rounded-2xl transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.companies.*') ? 'bg-white text-blue-700 shadow-2xl shadow-blue-500/30 scale-105' : 'text-blue-100 hover:bg-blue-700/60 hover:text-white hover:scale-105' }}">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <svg class="w-5 h-5 mr-3.5 relative z-10 {{ request()->routeIs('admin.companies.*') ? 'text-blue-600' : 'text-blue-200 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <span class="relative z-10">Companies</span>
        @if(request()->routeIs('admin.companies.*'))
            <div class="absolute right-3 w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
        @endif
    </a>
    
    <a href="{{ route('admin.job-sources.index') }}" 
       class="group flex items-center px-5 py-3.5 text-sm font-semibold rounded-2xl transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.job-sources.*') ? 'bg-white text-blue-700 shadow-2xl shadow-blue-500/30 scale-105' : 'text-blue-100 hover:bg-blue-700/60 hover:text-white hover:scale-105' }}">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <svg class="w-5 h-5 mr-3.5 relative z-10 {{ request()->routeIs('admin.job-sources.*') ? 'text-blue-600' : 'text-blue-200 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
        </svg>
        <span class="relative z-10">Job Sources</span>
        @if(request()->routeIs('admin.job-sources.*'))
            <div class="absolute right-3 w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
        @endif
    </a>
    
    <a href="{{ route('admin.jobs.index') }}" 
       class="group flex items-center px-5 py-3.5 text-sm font-semibold rounded-2xl transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.jobs.*') ? 'bg-white text-blue-700 shadow-2xl shadow-blue-500/30 scale-105' : 'text-blue-100 hover:bg-blue-700/60 hover:text-white hover:scale-105' }}">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <svg class="w-5 h-5 mr-3.5 relative z-10 {{ request()->routeIs('admin.jobs.*') ? 'text-blue-600' : 'text-blue-200 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
        <span class="relative z-10">Jobs</span>
        @if(request()->routeIs('admin.jobs.*'))
            <div class="absolute right-3 w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
        @endif
    </a>
    
    <a href="{{ route('admin.applications.index') }}" 
       class="group flex items-center px-5 py-3.5 text-sm font-semibold rounded-2xl transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.applications.*') ? 'bg-white text-blue-700 shadow-2xl shadow-blue-500/30 scale-105' : 'text-blue-100 hover:bg-blue-700/60 hover:text-white hover:scale-105' }}">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <svg class="w-5 h-5 mr-3.5 relative z-10 {{ request()->routeIs('admin.applications.*') ? 'text-blue-600' : 'text-blue-200 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <span class="relative z-10">Applications</span>
        @if(request()->routeIs('admin.applications.*'))
            <div class="absolute right-3 w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
        @endif
    </a>
</nav>

