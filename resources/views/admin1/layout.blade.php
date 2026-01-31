<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #dbeafe 100%);
            background-attachment: fixed;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(37, 99, 235, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 50%, #172554 100%);
            z-index: 50;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 
                4px 0 20px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.05) inset;
            backdrop-filter: blur(10px);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #60a5fa;
        }

        .main-wrapper {
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }

        .navbar {
            position: sticky;
            top: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 249, 255, 0.95) 100%);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(191, 219, 254, 0.5);
            padding: 20px 40px;
            z-index: 40;
            box-shadow: 
                0 4px 6px -1px rgba(37, 99, 235, 0.08),
                0 2px 4px -1px rgba(37, 99, 235, 0.06);
        }

        .content-area {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            position: relative;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 240px;
            }
            .main-wrapper {
                margin-left: 240px;
            }
            .navbar {
                padding: 16px 20px;
            }
            .content-area {
                padding: 24px;
            }
        }

        /* Smooth scrollbar styling */
        .content-area::-webkit-scrollbar {
            width: 10px;
        }

        .content-area::-webkit-scrollbar-track {
            background: rgba(191, 219, 254, 0.2);
            border-radius: 10px;
        }

        .content-area::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #2563eb);
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .content-area::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #2563eb, #1e40af);
            background-clip: padding-box;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="flex flex-col h-full">
            <!-- Logo Section -->
            <div class="flex-shrink-0 px-6 py-10 border-b border-blue-700/40 backdrop-blur-sm">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl blur-lg opacity-50"></div>
                        <div class="relative w-12 h-12 bg-gradient-to-br from-blue-300 via-blue-400 to-blue-500 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-2xl transform hover:scale-105 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl font-extrabold text-white tracking-tight drop-shadow-sm">Placify</h1>
                        <p class="text-xs font-semibold text-blue-200/90 tracking-wide uppercase">Admin Portal</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto px-4 py-6">
                @include('admin.partials.sidebar')
            </nav>

            <!-- Footer -->
            <div class="flex-shrink-0 px-5 py-5 border-t border-blue-700/40 backdrop-blur-sm bg-blue-900/20">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-400/30 rounded-full blur-md"></div>
                        <div class="relative w-10 h-10 bg-gradient-to-br from-blue-400/40 to-blue-600/40 backdrop-blur-sm rounded-full flex items-center justify-center flex-shrink-0 border-2 border-blue-300/30 shadow-lg">
                            <svg class="w-5 h-5 text-blue-100" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-white truncate drop-shadow-sm">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-200/80 truncate font-medium">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <nav class="navbar">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 bg-clip-text text-transparent tracking-tight drop-shadow-sm">@yield('page-title', 'Dashboard')</h2>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="group inline-flex items-center space-x-2 text-sm text-blue-700 hover:text-blue-900 transition-all duration-200 font-semibold px-4 py-2.5 rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 border border-transparent hover:border-blue-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="content-area">
            @include('admin.partials.flash')
            @yield('content')
        </div>
    </div>
</body>
</html>


