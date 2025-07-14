<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jobseeker Platform')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-primary-bg font-sans antialiased">
    <div class="flex min-h-screen">
        <div class="w-64 bg-accent text-white flex-col flex">
            <div class="h-20 flex items-center px-6 border-b border-white/10">
                <h1 class="text-xl font-bold">Jobseeker</h1>
            </div>
            <nav class="mt-6 px-4 flex-1">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-white/10' : '' }} hover:bg-white/10 hover:text-white transition-all duration-300 group flex items-center px-3 py-3 text-base font-medium rounded-md">
                    Dashboard
                </a>
                <a href="{{ route('validation.index') }}" class="{{ request()->routeIs('validation.index') ? 'bg-white/10' : '' }} text-white/70 hover:bg-white/10 hover:text-white transition-all duration-300 group flex items-center px-3 py-3 text-base font-medium rounded-md mt-2">
                    My Data Validation
                </a>
                <a href="{{ route('job-vacancies.index') }}" class="{{ request()->routeIs('job-vacancies.*') ? 'bg-white/10' : '' }} text-white/70 hover:bg-white/10 hover:text-white transition-all duration-300 group flex items-center px-3 py-3 text-base font-medium rounded-md mt-2">
                    Job Vacancies
                </a>
                <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.index') ? 'bg-white/10' : '' }} text-white/70 hover:bg-white/10 hover:text-white transition-all duration-300 group flex items-center px-3 py-3 text-base font-medium rounded-md mt-2">
                    My Job Applications
                </a>
            </nav>
        </div>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-md">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex justify-end items-center h-20">
                        <div class="flex items-center space-x-4">
                            <span class="text-primary-text font-medium">{{ Session::get('society_name') }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
