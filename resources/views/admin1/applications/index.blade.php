@extends('admin.layout')

@section('page-title', 'Applications')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-start md:items-center">
        <div>
            <p class="text-sm text-blue-600 mb-2 font-medium">Overview</p>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">Student Applications</h2>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-md border-2 border-blue-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-blue-200 bg-gradient-to-r from-blue-50 to-blue-100">
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-bold text-blue-700 uppercase tracking-wider">Student Name</span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-bold text-blue-700 uppercase tracking-wider">Job Title</span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-bold text-blue-700 uppercase tracking-wider">Status</span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-bold text-blue-700 uppercase tracking-wider">Applied Date</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100">
                    <tr class="hover:bg-blue-50/50 transition-colors">
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="mx-auto w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-bold text-blue-900">No applications yet</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
