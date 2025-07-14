
@extends('layouts.auth')

@section('title', 'Login - Jobseeker Platform')

@section('content')
<div class="min-h-screen bg-primary-bg flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-primary-text mb-2">Jobseeker Platform</h1>
            <p class="text-gray-600 text-lg">Welcome back! Please sign in to your account</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white shadow-2xl rounded-2xl p-8 border border-gray-100 transform hover:scale-[1.02] transition-transform duration-300">
            <form class="space-y-6" id="loginForm" action="{{ route('login.action') }}" method="POST" data-redirect-url="{{ route('dashboard') }}">
                @csrf
                
                <!-- ID or KTP Field -->
                <div>
                    <label for="id_card_number" class="block text-sm font-semibold text-primary-text mb-2">
                        ID or KTP
                    </label>
                    <div class="relative">
                        <input id="id_card_number" name="id_card_number" type="text" required
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-primary-text placeholder-gray-400 transition-colors duration-200"
                            placeholder="Enter your ID or KTP number">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1721 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-primary-text mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-primary-text placeholder-gray-400 transition-colors duration-200"
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
                        class="w-full bg-gradient-to-r from-blue-700 to-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:scale-105 hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login
                        </span>
                    </button>
                </div>
            </form>

            <!-- Admin Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Are you an admin? 
                    <a href="{{ route('admin.login') }}" class="font-medium text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                        Go to Admin Login
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
