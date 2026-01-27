@extends('admin.layout')

@section('title', 'Applications')

@section('content')
<div class="space-y-8">

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-blue-100 p-3 text-blue-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total applications</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\Application::count()) }}</p>
            <p class="text-xs text-slate-500">All time submissions</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-amber-100 p-3 text-amber-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">In progress</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\Application::where('status', 'Applied')->count()) }}</p>
            <p class="text-xs text-slate-500">Awaiting review</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-green-100 p-3 text-green-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Accepted</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\Application::where('status', 'Accepted')->count()) }}</p>
            <p class="text-xs text-slate-500">Successful matches</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-lg bg-red-100 p-3 text-red-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2"/></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Rejected</p>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format(\App\Models\Application::where('status', 'Rejected')->count()) }}</p>
            <p class="text-xs text-slate-500">Not selected</p>
        </div>
    </div>

    <!-- Filters -->
    <form id="filters" method="GET" class="bg-white p-6 rounded-xl border shadow-sm">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
            <div class="lg:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-2">Search</label>
                <div class="relative">
                    <svg class="absolute left-3 top-3 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Student name, job title" class="block w-full rounded-lg border-slate-300 py-2.5 pl-10 pr-4 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                <select name="status" class="block w-full rounded-lg border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                    <option value="">All</option>
                    @foreach($statuses ?? [] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-3">
                <button type="submit" class="w-full rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus:ring-2 focus:ring-primary-500">Apply filters</button>
                <a href="{{ route('admin.applications.index') }}" class="hidden lg:inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Reset</a>
            </div>
        </div>
    </form>

    <!-- Applications List -->
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b bg-slate-50">
            <div>
                <h3 class="text-lg font-semibold text-slate-900">Job Applications</h3>
                <p class="text-sm text-slate-500">Showing {{ $applications->firstItem() ?? 0 }} - {{ $applications->lastItem() ?? 0 }} of {{ $applications->total() }}</p>
            </div>
        </div>
        
        @forelse($applications as $app)
        <div class="border-b last:border-b-0 hover:bg-slate-50/70 transition">
            <a href="{{ route('admin.applications.show', $app->_id) }}" class="block px-6 py-5">
                <div class="flex items-start gap-4">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 ring-1 ring-slate-200 flex items-center justify-center overflow-hidden">
                        <span class="text-lg font-bold text-slate-700">
                            {{ $app->student ? substr($app->student->name, 0, 1) : '?' }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0 space-y-2">
                        <div class="flex flex-wrap items-center gap-2">
                            @php
                                $statusColors = [
                                    'Applied' => 'bg-amber-50 text-amber-700 ring-amber-200',
                                    'Accepted' => 'bg-green-50 text-green-700 ring-green-200',
                                    'Rejected' => 'bg-red-50 text-red-700 ring-red-200',
                                ];
                                $colorClass = $statusColors[$app->status] ?? 'bg-slate-50 text-slate-700 ring-slate-200';
                            @endphp
                            <span class="rounded-full {{ $colorClass }} px-3 py-1 text-xs font-semibold ring-1">{{ ucfirst($app->status) }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h4 class="text-lg font-semibold text-slate-900 hover:text-primary-600">
                                {{ $app->student ? $app->student->name : 'Unknown Student' }}
                            </h4>
                            @if($app->job)
                                <span class="text-sm font-medium text-slate-600">→ {{ $app->job->title }}</span>
                            @endif
                        </div>
                        <div class="flex flex-wrap gap-3 text-sm text-slate-600">
                            @if($app->job)
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    {{ $app->job->clean('company_name', 'Unknown') }}
                                </span>
                            @endif
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $app->applied_at ? $app->applied_at->diffForHumans() : 'Recently' }}
                            </span>
                        </div>
                    </div>
                    <div class="hidden sm:flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="px-6 py-16 text-center">
            <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <h3 class="mt-4 text-lg font-medium text-slate-900">No applications found</h3>
            <p class="mt-2 text-sm text-slate-500">Adjust filters or check back later.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($applications->hasPages())
    <div class="bg-white px-6 py-4 rounded-lg border shadow-sm flex items-center justify-between">
        <p class="text-sm text-slate-700">Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $applications->total() }}</p>
        <div>{{ $applications->links() }}</div>
    </div>
    @endif
</div>
@endsection