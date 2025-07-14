@extends('layouts.admin')

@section('title', 'Validations - Admin Dashboard')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-primary-text">Validations</h1>

        <div class="flex space-x-3">
            <a href="{{ route('admin.validations.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-primary-text bg-white hover:bg-gray-50 hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                All
            </a>
            <a href="{{ route('admin.validations.index') }}?status=pending" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-primary-text bg-white hover:bg-gray-50 hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Pending
            </a>
            <a href="{{ route('admin.validations.index') }}?status=accepted" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-primary-text bg-white hover:bg-gray-50 hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Accepted
            </a>
            <a href="{{ route('admin.validations.index') }}?status=declined" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-primary-text bg-white hover:bg-gray-50 hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Declined
            </a>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <ul role="list" class="divide-y divide-gray-200">
            @forelse($validations as $validation)
                <li class="hover:bg-slate-50 transition-colors duration-200">
                    <a href="{{ route('admin.validations.show', $validation->id) }}" class="block">
                        <div class="px-6 py-5">
                            <div class="flex items-center justify-between">
                                <p class="text-lg font-semibold text-primary-text truncate">
                                    {{ $validation->society->name }}
                                </p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    @if($validation->status === 'pending')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100/70 text-yellow-800">
                                            Pending
                                        </span>
                                    @elseif($validation->status === 'accepted')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100/70 text-green-800">
                                            Accepted
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100/70 text-red-800">
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
                                    <p class="mt-2 flex items-center text-sm text-gray-600 sm:mt-0 sm:ml-6">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $validation->job_position }}
                                    </p>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-600 sm:mt-0">
                                    @if($validation->validator)
                                        <p>
                                            Validator: {{ $validation->validator->name }}
                                        </p>
                                    @else
                                        <p>
                                            No validator assigned
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li class="px-6 py-12 text-center">
                    <div class="text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No validations found</h3>
                        <p class="mt-1 text-sm text-gray-500">No validation records match your current filter.</p>
                    </div>
                </li>
            @endforelse
        </ul>

        <div class="px-6 py-4 bg-slate-50 border-t border-gray-200">
            {{ $validations->links() }}
        </div>
    </div>
</div>
@endsection
