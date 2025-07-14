@extends('layouts.admin')

@section('title', 'Validation Details - Admin Dashboard')

@section('content')
<div class="p-8">
    <div class="mb-6">
        <a href="{{ route('admin.validations.index') }}" class="inline-flex items-center text-primary-text hover:text-accent-hover transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Validations
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="px-6 py-6 border-b border-gray-200">
            <h3 class="text-2xl font-bold text-primary-text">
                Validation Request Details
            </h3>
            <p class="mt-2 text-gray-600">
                Details about the validation request from {{ $validation->society->name }}.
            </p>
        </div>
        <div class="px-6 py-6">
            <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="bg-slate-50 rounded-lg p-4">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Society Name
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ $validation->society->name }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        ID Card Number
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ $validation->society->id_card_number }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Gender
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ ucfirst($validation->society->gender) }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Born Date
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ $validation->society->born_date->format('F d, Y') }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4 sm:col-span-2">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Address
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ $validation->society->address }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Regional
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ $validation->society->regional->province }}, {{ $validation->society->regional->district }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Job Category
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ $validation->jobCategory->job_category }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Work Experience
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ $validation->work_experience }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Job Position
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ $validation->job_position }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4 sm:col-span-2">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Reason to be Accepted
                    </dt>
                    <dd class="text-base text-primary-text font-medium">
                        {{ $validation->reason_accepted }}
                    </dd>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <dt class="text-sm font-semibold text-gray-700 mb-2">
                        Status
                    </dt>
                    <dd class="text-base font-medium">
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
                    </dd>
                </div>
                @if($validation->validator)
                    <div class="bg-slate-50 rounded-lg p-4">
                        <dt class="text-sm font-semibold text-gray-700 mb-2">
                            Validator
                        </dt>
                        <dd class="text-base text-primary-text font-medium">
                            {{ $validation->validator->name }}
                        </dd>
                    </div>
                @endif
                @if($validation->validator_notes)
                    <div class="bg-slate-50 rounded-lg p-4 sm:col-span-2">
                        <dt class="text-sm font-semibold text-gray-700 mb-2">
                            Validator Notes
                        </dt>
                        <dd class="text-base text-primary-text font-medium">
                            {{ $validation->validator_notes }}
                        </dd>
                    </div>
                @endif
            </dl>
        </div>

        <!-- Actions -->
        @if(($adminRole === 'validator' && $validation->status === 'pending') || ($adminRole === 'officer' && !$validation->validator_id))
            <div class="px-6 py-6 bg-slate-50 border-t border-gray-200">
                @if($adminRole === 'validator' && $validation->status === 'pending')
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <h4 class="text-lg font-semibold text-primary-text mb-4">Update Validation Status</h4>
                        <form id="validationForm" action="{{ route('admin.validations.update', $validation->id) }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Update Status</label>
                                <select id="status" name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-primary-text">
                                    <option value="accepted">Accept</option>
                                    <option value="declined">Decline</option>
                                </select>
                            </div>

                            <div>
                                <label for="validator_notes" class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                                <textarea id="validator_notes" name="validator_notes" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-primary-text" placeholder="Add your notes here..."></textarea>
                            </div>

                            <div>
                                <button type="submit" class="w-full bg-gradient-to-r from-blue-700 to-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:scale-105 hover:shadow-lg transition-all duration-200">
                                    Update Validation
                                </button>
                            </div>
                        </form>
                    </div>
                @elseif($adminRole === 'officer' && !$validation->validator_id)
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <h4 class="text-lg font-semibold text-primary-text mb-4">Assign Validator</h4>
                        <form id="assignForm" action="{{ route('admin.validations.assign', $validation->id) }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="validator_id" class="block text-sm font-semibold text-gray-700 mb-2">Select Validator</label>
                                <select id="validator_id" name="validator_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-primary-text">
                                    <option value="">Choose a validator</option>
                                    @foreach($validators as $validator)
                                        <option value="{{ $validator->id }}">{{ $validator->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <button type="submit" class="w-full bg-gradient-to-r from-blue-700 to-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:scale-105 hover:shadow-lg transition-all duration-200">
                                    Assign Validator
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

<script>
$(document).ready(function() {
    $('#validationForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("admin.validations.update", $validation->id) }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                Swal.fire({
                    title: 'Error!',
                    text: response.message || 'Update failed',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    $('#assignForm').on('submit', function(e) {
        e.preventDefault();

        if (!$('#validator_id').val()) {
            Swal.fire({
                title: 'Error!',
                text: 'Please select a validator',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        $.ajax({
            url: '{{ route("admin.validations.assign", $validation->id) }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                Swal.fire({
                    title: 'Error!',
                    text: response.message || 'Assignment failed',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>
@endsection
