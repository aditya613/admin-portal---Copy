<div class="hidden md:flex md:w-72 md:flex-col md:fixed md:inset-y-0 bg-white border-r border-slate-200 z-50">
    <!-- Logo -->
    <div class="flex items-center h-20 flex-shrink-0 px-6 border-b border-slate-100">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-sm">
                P
            </div>
            <div>
                <div class="text-sm font-bold text-slate-900">PLACIFY</div>
                <div class="text-xs font-medium text-slate-500">Admin</div>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <div class="flex-1 flex flex-col overflow-y-auto py-6 px-3">
        <nav class="space-y-1">
            <!-- OVERVIEW SECTION -->
            <div class="px-4 py-3 mb-2">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Overview</h3>
            </div>
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="group flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
               {{ request()->routeIs('admin.dashboard') 
                   ? 'bg-primary-50 text-primary-700' 
                   : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span>Dashboard</span>
                </span>
                @if(request()->routeIs('admin.dashboard'))
                    <span class="h-1.5 w-1.5 rounded-full bg-primary-600"></span>
                @endif
            </a>

            <!-- RECRUITMENT SECTION -->
            <div class="px-4 py-3 mb-2 mt-6">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Recruitment</h3>
            </div>

            <!-- Jobs -->
            <a href="{{ route('admin.jobs.index') }}" 
               class="group flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
               {{ request()->routeIs('admin.jobs.*') 
                   ? 'bg-primary-50 text-primary-700' 
                   : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.jobs.*') ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Job Listings</span>
                </span>
                <span class="bg-primary-100 text-primary-700 py-0.5 px-2 rounded text-xs font-bold">{{ $jobCount ?? 0 }}</span>
            </a>

            <!-- Applications -->
            <a href="{{ route('admin.applications.index') }}" 
               class="group flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
               {{ request()->routeIs('admin.applications.*') 
                   ? 'bg-primary-50 text-primary-700' 
                   : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.applications.*') ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Applications</span>
                </span>
                @if(request()->routeIs('admin.applications.*'))
                    <span class="h-1.5 w-1.5 rounded-full bg-primary-600"></span>
                @endif
            </a>

            <!-- Companies -->
            <button disabled class="w-full group flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 opacity-60 cursor-not-allowed">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span>Companies</span>
                </span>
                <span class="bg-slate-100 text-slate-500 py-0.5 px-1.5 rounded text-xs font-semibold">Soon</span>
            </button>

            <!-- PEOPLE SECTION -->
            <div class="px-4 py-3 mb-2 mt-6">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">People</h3>
            </div>

            <!-- Students -->
            <a href="{{ route('admin.students.index') }}" 
               class="group flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
               {{ request()->routeIs('admin.students.*') 
                   ? 'bg-primary-50 text-primary-700' 
                   : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.students.*') ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Students</span>
                </span>
                <span class="bg-emerald-100 text-emerald-700 py-0.5 px-2 rounded text-xs font-bold">{{ $studentCount ?? 0 }}</span>
            </a>

            <!-- Mentors -->
            <button disabled class="w-full group flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 opacity-60 cursor-not-allowed">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    <span>Mentors</span>
                </span>
                <span class="bg-slate-100 text-slate-500 py-0.5 px-1.5 rounded text-xs font-semibold">Soon</span>
            </button>

            <!-- SYSTEM SECTION -->
            <div class="px-4 py-3 mb-2 mt-6">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">System</h3>
            </div>

            <!-- Analytics -->
            <button disabled class="w-full group flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 opacity-60 cursor-not-allowed">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Analytics</span>
                </span>
                <span class="bg-slate-100 text-slate-500 py-0.5 px-1.5 rounded text-xs font-semibold">Soon</span>
            </button>

            <!-- Settings -->
            <button disabled class="w-full group flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 opacity-60 cursor-not-allowed">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Settings</span>
                </span>
                <span class="bg-slate-100 text-slate-500 py-0.5 px-1.5 rounded text-xs font-semibold">Soon</span>
            </button>
        </nav>
    </div>

    <!-- Divider -->
    <div class="border-t border-slate-100"></div>

    <!-- User Profile Section (Bottom) -->
    <div class="flex-shrink-0 p-4">
        <a href="#" class="flex-shrink-0 w-full group block hover:opacity-75 transition-opacity">
            <div class="flex items-center gap-3">
                <div class="h-11 w-11 rounded-lg bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-sm">
                    {{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-900 truncate">
                        {{ Auth::user()->name ?? 'Administrator' }}
                    </p>
                    <p class="text-xs text-slate-500 truncate">
                        {{ Auth::user()->email ?? 'admin@offcampus.com' }}
                    </p>
                </div>
            </div>
        </a>
    </div>
</div>