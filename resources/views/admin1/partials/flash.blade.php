@if (session('success'))
    <div class="mb-6 bg-gradient-to-r from-blue-50 to-blue-100 border-2 border-blue-300 text-blue-900 px-5 py-4 rounded-xl flex items-start space-x-3 shadow-lg" role="alert">
        <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <div>
            <p class="font-bold text-blue-800">Success!</p>
            <p class="text-sm text-blue-700">{{ session('success') }}</p>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="mb-6 bg-gradient-to-r from-red-50 to-red-100 border-2 border-red-300 text-red-900 px-5 py-4 rounded-xl flex items-start space-x-3 shadow-lg" role="alert">
        <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
        <div>
            <p class="font-bold text-red-800">Error!</p>
            <p class="text-sm text-red-700">{{ session('error') }}</p>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 bg-gradient-to-r from-amber-50 to-amber-100 border-2 border-amber-300 text-amber-900 px-5 py-4 rounded-xl shadow-lg" role="alert">
        <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <strong class="font-bold block mb-2 text-amber-800">Please fix the following errors:</strong>
                <ul class="list-disc list-inside space-y-1 text-sm text-amber-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

