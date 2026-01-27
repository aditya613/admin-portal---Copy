<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-white border-r border-gray-200">
    <!-- Logo -->
    <div class="flex items-center h-16 flex-shrink-0 px-6 bg-white border-b border-gray-100">
        <span class="text-xl font-bold tracking-tight text-gray-900">
            OffCampus<span class="text-primary-600">Admin</span>
        </span>
    </div>

    <!-- Navigation -->
    <div class="flex-1 flex flex-col overflow-y-auto pt-5 pb-4">
        <nav class="mt-2 flex-1 px-4 space-y-1">
            
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out">
                <svg class="{{ request()->routeIs('admin.dashboard') ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <!-- Jobs -->
            <a href="{{ route('admin.jobs.index') }}" 
               class="{{ request()->routeIs('admin.jobs.*') ? 'bg-gray-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out">
                <svg class="{{ request()->routeIs('admin.jobs.*') ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Jobs
            </a>

            <!-- Companies -->
            <a href="#" 
               class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out">
                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Companies
            </a>

            <!-- Applications -->
            <a href="#" 
               class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out">
                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Applications
            </a>

        </nav>
    </div>

    <!-- User Profile Snippet (Bottom) -->
    <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
        <a href="#" class="flex-shrink-0 w-full group block">
            <div class="flex items-center">
                <div class="h-9 w-9 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-sm">
                    {{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                        {{ Auth::user()->name ?? 'Administrator' }}
                    </p>
                    <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">
                        View profile
                    </p>
                </div>
            </div>
        </a>
    </div>
</div>