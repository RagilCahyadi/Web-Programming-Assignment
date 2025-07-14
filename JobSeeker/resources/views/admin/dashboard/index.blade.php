@extends('layouts.admin')

@section('title', 'Admin Dashboard - Jobseeker Platform')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold text-primary-text">Dashboard</h1>

    <div class="grid grid-cols-1 gap-6 mt-8 sm:grid-cols-2 lg:grid-cols-3">
        @php
            $stats = [
                [
                    'title' => 'Pending Validations', 
                    'value' => $pendingValidations, 
                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 
                    'gradient' => 'bg-gradient-to-br from-yellow-500 to-yellow-400',
                    'link' => route('admin.validations.index') . '?status=pending'
                ],
                [
                    'title' => 'Accepted Validations', 
                    'value' => $acceptedValidations, 
                    'icon' => 'M5 13l4 4L19 7', 
                    'gradient' => 'bg-gradient-to-br from-green-500 to-green-400',
                    'link' => route('admin.validations.index') . '?status=accepted'
                ],
                [
                    'title' => 'Declined Validations', 
                    'value' => $declinedValidations, 
                    'icon' => 'M6 18L18 6M6 6l12 12', 
                    'gradient' => 'bg-gradient-to-br from-red-500 to-red-400',
                    'link' => route('admin.validations.index') . '?status=declined'
                ],
                [
                    'title' => 'Total Societies', 
                    'value' => $totalSocieties, 
                    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 
                    'gradient' => 'bg-gradient-to-br from-blue-500 to-blue-400',
                    'link' => '#'
                ],
                [
                    'title' => 'Total Job Vacancies', 
                    'value' => $totalVacancies, 
                    'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 
                    'gradient' => 'bg-gradient-to-br from-purple-500 to-purple-400',
                    'link' => '#'
                ],
            ];
        @endphp

        @foreach ($stats as $stat)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-4 {{ $stat['gradient'] }} rounded-lg shadow-md">
                        <svg class="w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}" />
                        </svg>
                    </div>
                    <div class="flex-1 w-0 ml-5">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            {{ $stat['title'] }}
                        </dt>
                        <dd class="text-3xl font-bold text-primary-text">
                            {{ $stat['value'] }}
                        </dd>
                    </div>
                </div>
            </div>
            @if($stat['link'] !== '#')
            <div class="px-5 py-3 bg-slate-50">
                <div class="text-sm">
                    <a href="{{ $stat['link'] }}" class="font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                        View all
                    </a>
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    @if($adminRole === 'validator' && count($assignedValidations) > 0)
        <!-- Assigned Validations for Validators -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-primary-text mb-6">Your Assigned Validations</h2>
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($assignedValidations as $validation)
                        <li class="hover:bg-slate-50 transition-colors duration-200">
                            <a href="{{ route('admin.validations.show', $validation->id) }}" class="block">
                                <div class="px-6 py-5">
                                    <div class="flex items-center justify-between">
                                        <p class="text-lg font-semibold text-primary-text truncate">
                                            {{ $validation->society->name }}
                                        </p>
                                        <div class="flex flex-shrink-0 ml-2">
                                            @if($validation->status === 'pending')
                                                <span class="inline-flex px-3 py-1 text-sm font-semibold leading-5 text-yellow-800 bg-yellow-100/70 rounded-full">
                                                    Pending
                                                </span>
                                            @elseif($validation->status === 'accepted')
                                                <span class="inline-flex px-3 py-1 text-sm font-semibold leading-5 text-green-800 bg-green-100/70 rounded-full">
                                                    Accepted
                                                </span>
                                            @else
                                                <span class="inline-flex px-3 py-1 text-sm font-semibold leading-5 text-red-800 bg-red-100/70 rounded-full">
                                                    Declined
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-600">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                                </svg>
                                                {{ $validation->jobCategory->job_category }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
@endsection
