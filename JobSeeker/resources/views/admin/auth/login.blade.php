@extends('layouts.auth')

@section('title', 'Admin Login - Jobseeker Platform')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        
        <!-- Login Form -->
        <div class="bg-white shadow-2xl rounded-2xl p-8 border border-gray-100">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Jobseeker Platform</h1>
                <div class="admin-badge">
                    <h2 class="text-lg font-semibold">Admin Login</h2>
                    <p class="text-sm opacity-90">Validator and Officer Access</p>
                </div>
            </div>
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
                    <p class="text-sm text-green-600">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                    <ul class="text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-6">
                @csrf
                
                <!-- ID or KTP Field -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                        ID or KTP
                    </label>
                    <div class="relative">
                        <input id="username" name="username" type="text" required
                            class="login-input focus:ring-2 focus:ring-primary-800 focus:border-primary-800"
                            placeholder="Enter your ID or KTP number" value="{{ old('username') }}">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required
                            class="login-input focus:ring-2 focus:ring-primary-800 focus:border-primary-800"
                            placeholder="Enter your password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Login Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="login-button focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-800">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login
                        </span>
                    </button>
                </div>
            </form>

            <!-- Society Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Not an admin? 
                    <a href="{{ route('login') }}" class="login-link">
Go to Society Login
         </div>
        </div>
    </div>
</div>
@endsection
