@extends('layouts.app')

@section('title', 'Dashboard - Jobseeker Platform')

@section('content')
<div class="mx-auto max-w-7xl">
    <h2 class="text-3xl font-bold text-primary-text mb-8">Dashboard</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <h3 class="text-lg font-semibold leading-6 text-primary-text">Data Validation Status</h3>
                @if($society->validation)
                    <div class="space-y-4 mt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500">Status:</span>
                             @if($society->validation->status === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">Pending</span>
                            @elseif($society->validation->status === 'accepted')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">Accepted</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">Declined</span>
                            @endif
                        </div>
                        <div class="border-t border-gray-200 pt-4 space-y-3">
                            <div class="flex justify-between"><span class="text-sm font-medium text-gray-500">Job Category:</span><span class="text-sm text-primary-text font-semibold">{{ $society->validation->jobCategory->job_category ?? 'N/A' }}</span></div>
                            <div class="flex justify-between"><span class="text-sm font-medium text-gray-500">Job Position:</span><span class="text-sm text-primary-text font-semibold">{{ $society->validation->job_position }}</span></div>
                            @if($society->validation->validator)
                                <div class="flex justify-between"><span class="text-sm font-medium text-gray-500">Validator:</span><span class="text-sm text-primary-text font-semibold">{{ $society->validation->validator->name }}</span></div>
                            @endif
                            @if($society->validation->validator_notes)
                                <div class="flex flex-col text-left"><span class="text-sm font-medium text-gray-500">Validator Notes:</span><span class="text-sm text-primary-text font-semibold">{{ $society->validation->validator_notes }}</span></div>
                            @endif
                        </div>
                    </div>
                    @if($society->validation->status === 'accepted')
                        <div class="mt-6"><a href="{{ route('job-vacancies.index') }}" class="w-full text-center block px-4 py-2 font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg hover:opacity-90 transition-opacity">Browse Jobs</a></div>
                    @endif
                @else
                    <p class="text-gray-500 mt-4">No validation request found.</p>
                    <div class="mt-6"><a href="{{ route('validation.index') }}" class="w-full text-center block px-4 py-2 font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg hover:opacity-90 transition-opacity">Request Validation</a></div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
             <h3 class="text-lg font-semibold leading-6 text-primary-text mb-4">Quick Actions</h3>
             <div class="space-y-4">
                <a href="{{ route('validation.index') }}" class="block p-4 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                    <p class="font-semibold text-primary-text">Data Validation</p>
                    <p class="text-sm text-gray-500">Manage your data validation request</p>
                </a>
                 <a href="{{ route('applications.index') }}" class="block p-4 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                    <p class="font-semibold text-primary-text">My Applications</p>
                    <p class="text-sm text-gray-500">View your job application history</p>
                </a>
             </div>
        </div>
    </div>
</div>
@endsection
