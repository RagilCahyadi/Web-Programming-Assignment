@extends('layouts.app')

@section('title', 'Job Vacancy Details - Jobseeker Platform')

@section('content')
<div class="mx-auto max-w-7xl">
    <div class="mb-6">
        <a href="{{ route('job-vacancies.index') }}" class="text-blue-600 hover:text-blue-500 font-medium transition-colors">
            ← Back to Job Vacancies
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-primary-text mb-2">{{ $jobVacancy->company }}</h2>
            <p class="text-gray-600 text-lg">{{ $jobVacancy->address }}</p>
        </div>

        <div class="mb-8 p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-semibold text-primary-text mb-3">Description</h3>
            <p class="text-gray-700 leading-relaxed">{{ $jobVacancy->description }}</p>
        </div>

        @if(!$hasApplied)
            <form id="applicationForm" class="space-y-6" action="{{ route('applications.store') }}" method="POST">
                @csrf
                <input type="hidden" name="vacancy_id" value="{{ $jobVacancy->id }}">

                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-primary-text mb-4">Select Position(s)</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Select</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Position</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Capacity</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Applications / Max</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($jobVacancy->availablePositions as $position)
                                    <tr class="hover:bg-white transition-colors">
                                        <td class="px-4 py-4">
                                            <input type="checkbox" name="positions[]" value="{{ $position->id }}"
                                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        </td>
                                        <td class="px-4 py-4 text-sm font-medium text-primary-text">
                                            {{ $position->position }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-600">
                                            {{ $position->capacity }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-600">
                                            {{ $position->apply_count }} / {{ $position->apply_capacity }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-semibold text-primary-text mb-2">Notes for Company</label>
                    <textarea id="notes" name="notes" rows="4" required
                              class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                              placeholder="Explain why you should be accepted for this position"></textarea>
                </div>

                <div>
                    <button type="submit" class="w-full px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-sm hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        Apply for this Job
                    </button>
                </div>
            </form>
        @else
            <div class="py-12 text-center bg-gray-50 rounded-lg">
                <div class="inline-flex items-center px-6 py-3 text-sm font-medium text-green-800 bg-green-100 border border-green-200 rounded-lg shadow-sm">
                    ✓ You have already applied for this job
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
