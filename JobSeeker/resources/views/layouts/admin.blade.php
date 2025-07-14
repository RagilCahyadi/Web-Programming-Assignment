<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Jobseeker Platform')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary-bg font-sans">
    <div class="min-h-screen flex">
        <div class="w-64 bg-accent text-white flex flex-col">
            <div class="h-20 flex items-center px-6 border-b border-white/10">
                <h1 class="text-xl font-bold">Admin Panel</h1>
            </div>
            <nav class="mt-6 px-4 flex-1">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/70' }} hover:bg-white/10 hover:text-white transition-colors duration-200 group flex items-center px-3 py-3 text-base font-medium rounded-md">
                    <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.validations.index') }}" class="{{ request()->routeIs('admin.validations.*') ? 'bg-white/10 text-white' : 'text-white/70' }} hover:bg-white/10 hover:text-white transition-colors duration-200 group flex items-center px-3 py-3 text-base font-medium rounded-md mt-2">
                    <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    Validations
                </a>
            </nav>
            <div class="px-4 pb-4">
                <div class="pt-4 border-t border-white/10">
                    <div class="flex items-center px-2">
                        <div>
                            <div class="text-base font-medium text-white">{{ Session::get('admin_name') }}</div>
                            <div class="text-sm font-medium text-white/70">{{ ucfirst(Session::get('admin_role')) }}</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left block px-3 py-3 text-base font-medium text-white/70 hover:bg-white/10 hover:text-white rounded-md transition-colors duration-200">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-auto">
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
