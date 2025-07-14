@extends('layouts.app')

@section('title', 'Job Vacancies - Jobseeker Platform')

@section('content')
<div class="max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold text-primary-text mb-8">Job Vacancies</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jobVacancies as $vacancy)
            <div class="bg-white overflow-hidden shadow-lg rounded-xl transform hover:-translate-y-1 transition-all duration-300 hover:shadow-xl flex flex-col">
                <div class="p-6 flex-grow">
                    <h3 class="text-xl leading-6 font-bold text-primary-text">{{ $vacancy->company }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $vacancy->address }}</p>

                    <div class="mt-4 border-t pt-4">
                        <h4 class="text-sm font-semibold text-gray-600">Available Positions:</h4>
                        <div class="mt-2 space-y-2">
                            @foreach($vacancy->availablePositions as $position)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-primary-text font-medium">{{ $position->position }}</span>
                                    <span class="text-gray-500 font-mono">({{ $position->apply_count }}/{{ $position->capacity }})</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="px-6 pb-6 bg-white">
                    @if(in_array($vacancy->id, $appliedVacancies))
                        <span class="w-full text-center block px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-green-800 bg-green-100">
                            Applied
                        </span>
                    @else
                        <a href="{{ route('job-vacancies.show', $vacancy->id) }}" class="w-full text-center block px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:opacity-90 transition-opacity">
                            View & Apply
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-gray-500">No job vacancies available for your category at the moment.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
