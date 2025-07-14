@extends('layouts.app')

@section('title', 'My Applications - Jobseeker Platform')

@section('content')
<div class="max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold text-primary-text mb-8">My Job Applications</h2>

    <div class="grid gap-6">
        @forelse($applications as $application)
            <div class="bg-white overflow-hidden shadow-lg rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="px-6 py-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-xl leading-6 font-bold text-primary-text">{{ $application->jobVacancy->company }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $application->jobVacancy->address }}</p>
                            <p class="mt-1 text-sm text-gray-500">Applied on: {{ $application->date->format('M d, Y') }}</p>

                            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                <h4 class="text-sm font-semibold text-gray-700 mb-2">Applied Positions:</h4>
                                <div class="space-y-2">
                                    @foreach($application->jobApplyPositions as $position)
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-primary-text font-medium">{{ $position->availablePosition->position }}</span>
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'accepted' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800'
                                                ];
                                                $statusClass = $statusClasses[$position->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                                {{ ucfirst($position->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @if($application->notes)
                                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                    <h4 class="text-sm font-semibold text-primary-text mb-2">Application Notes:</h4>
                                    <p class="text-sm text-gray-700">{{ $application->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <p class="text-gray-500 mb-4">You haven't applied for any jobs yet.</p>
                    <a href="{{ route('job-vacancies.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:opacity-90 transition-opacity">
                        Browse Job Vacancies
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
