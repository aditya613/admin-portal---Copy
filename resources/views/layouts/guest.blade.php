<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 relative overflow-hidden">
            <!-- Animated background elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-400/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
            </div>
            
            <div class="relative z-10 mb-8 transform hover:scale-105 transition-transform duration-300">
                <a href="/" class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-500 rounded-3xl blur-2xl opacity-50"></div>
                        <div class="relative w-20 h-20 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-3xl flex items-center justify-center shadow-2xl">
                            <svg class="w-12 h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 bg-clip-text text-transparent tracking-tight">OffCampus</h1>
                        <p class="text-sm font-bold text-blue-600 uppercase tracking-wider">Admin Portal</p>
                    </div>
                </a>
            </div>

            <div class="relative z-10 w-full sm:max-w-md mt-6 px-8 py-10 bg-white/95 backdrop-blur-xl shadow-2xl border-2 border-blue-200/50 overflow-hidden sm:rounded-3xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-100/30 to-transparent rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
