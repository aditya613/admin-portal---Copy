@extends('admin.layout')

@section('title', 'Manage Companies')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Partner Companies</h1>
        <p class="mt-1 text-sm text-slate-500">Manage company profiles and recruiting partners.</p>
    </div>
    <div class="mt-4 sm:mt-0">
        <button type="button" class="inline-flex items-center rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700">
            <svg class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Company
        </button>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    @foreach(range(1, 6) as $i)
    <div class="col-span-1 bg-white rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between p-6 space-x-6">
            <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">
                    <h3 class="text-slate-900 text-sm font-semibold truncate">Tech Giant Inc.</h3>
                    <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">Verified</span>
                </div>
                <p class="mt-1 text-slate-500 text-sm truncate">Technology • San Francisco</p>
                <div class="mt-3 flex gap-2">
                    <span class="inline-flex items-center rounded-md bg-slate-50 px-2 py-1 text-xs font-medium text-slate-600 ring-1 ring-inset ring-slate-500/10">12 Jobs</span>
                    <span class="inline-flex items-center rounded-md bg-slate-50 px-2 py-1 text-xs font-medium text-slate-600 ring-1 ring-inset ring-slate-500/10">84 Hires</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-gray-100 rounded-lg flex-shrink-0 flex items-center justify-center text-xl font-bold text-gray-500">
                T
            </div>
        </div>
        <div class="border-t border-slate-200">
            <div class="-mt-px flex divide-x divide-slate-200">
                <div class="flex w-0 flex-1">
                    <a href="#" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-slate-900 hover:text-slate-700 hover:bg-slate-50">
                        <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                            <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                        </svg>
                        Email
                    </a>
                </div>
                <div class="-ml-px flex w-0 flex-1">
                    <a href="#" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-slate-900 hover:text-slate-700 hover:bg-slate-50">
                        <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        View Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection