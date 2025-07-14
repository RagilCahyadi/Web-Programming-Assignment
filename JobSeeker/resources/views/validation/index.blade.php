@extends('layouts.app')

@section('title', 'Data Validation - Jobseeker Platform')

@section('content')
<div class="mx-auto max-w-7xl">
    <h2 class="text-3xl font-bold text-primary-text mb-8">Data Validation</h2>

    @if(!$society || !$society->validation)
        <!-- Request Validation Form -->
        <div class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
            <h3 class="text-lg font-semibold text-primary-text mb-6">Request Data Validation</h3>

            <form id="validationForm" class="space-y-6">
                @csrf
                <div>
                    <label for="job_category" class="block text-sm font-medium text-primary-text mb-2">Job Category</label>
                    <select id="job_category" name="job_category" required class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="">Select Job Category</option>
                        @foreach($jobCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->job_category }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="work_experience" class="block text-sm font-medium text-primary-text mb-2">Work Experience</label>
                    <select id="work_experience" name="work_experience" required class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="">Select Work Experience</option>
                        <option value="0-1 years">0-1 years</option>
                        <option value="1-3 years">1-3 years</option>
                        <option value="3-5 years">3-5 years</option>
                        <option value="5+ years">5+ years</option>
                    </select>
                </div>

                <div>
                    <label for="job_position" class="block text-sm font-medium text-primary-text mb-2">Job Position</label>
                    <textarea id="job_position" name="job_position" rows="3" required class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Describe your desired job position"></textarea>
                </div>

                <div>
                    <label for="reason_accepted" class="block text-sm font-medium text-primary-text mb-2">Reason to be Accepted</label>
                    <textarea id="reason_accepted" name="reason_accepted" rows="3" required class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Explain why you should be accepted"></textarea>
                </div>

                <div>
                    <button type="submit" class="w-full px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-sm hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        Send Request
                    </button>
                </div>
            </form>
        </div>
    @else
        <!-- Validation Status -->
        <div class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl">
            <h3 class="text-lg font-semibold text-primary-text mb-6">Data Validation Progress</h3>

            <div class="space-y-4">
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
                    <div class="flex justify-between"><span class="text-sm font-medium text-gray-500">Work Experience:</span><span class="text-sm text-primary-text font-semibold">{{ $society->validation->work_experience }}</span></div>
                    <div class="flex justify-between"><span class="text-sm font-medium text-gray-500">Reason Accepted:</span><span class="text-sm text-primary-text font-semibold">{{ $society->validation->reason_accepted }}</span></div>
                    @if($society->validation->validator)
                        <div class="flex justify-between"><span class="text-sm font-medium text-gray-500">Validator:</span><span class="text-sm text-primary-text font-semibold">{{ $society->validation->validator->name }}</span></div>
                    @endif
                    @if($society->validation->validator_notes)
                        <div class="flex flex-col text-left"><span class="text-sm font-medium text-gray-500">Validator Notes:</span><span class="text-sm text-primary-text font-semibold">{{ $society->validation->validator_notes }}</span></div>
                    @endif
                </div>
            </div>

            @if($society->validation->status === 'accepted')
                <div class="mt-6">
                    <a href="{{ route('job-vacancies.index') }}" class="w-full text-center block px-6 py-3 font-medium text-white bg-gradient-to-r from-green-600 to-green-700 rounded-lg hover:opacity-90 transition-opacity">
                        Browse Job Vacancies
                    </a>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
