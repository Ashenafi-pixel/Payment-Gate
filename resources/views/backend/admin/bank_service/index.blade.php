@extends('backend.layouts.app')
@section('title', 'All {{ $bank->name }} Services')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    {{ $bank->name }}
                </div>

                <div class="card-tools">
                    <a href="{{ route('admin.bank-service.create', ['bank' => $bank]) }}" class="btn btn-theme-effect mt-2">
                        Add Service
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive table-nowrap d-box p-0 border-radius-0">
                    <table class="table">
                        <thead class="sticky-top">
                            <tr>
                                <th>#</th>
                                <th>Service Name</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @forelse($bank->bankServices as $key => $service)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $service->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                id="status_{{ $key }}" data-service-id="{{ $service->id }}"
                                                {{ $service->status ? 'checked' : '' }}>

                                            <label class="custom-control-label" for="status-{{ $key }}"></label>
                                        </div>
                                    </td>
                                    <td>{{ \App\Helpers\GeneralHelper::FORMAT_DATE($service->created_at) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-green-light flex-mode" type="button" id="action"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="material-symbols-outlined">
                                                    more_vert
                                                </span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end animated zoomIn"
                                                aria-labelledby="action">
                                                <a class="dropdown-item flex-mode"
                                                    href="{{ route('admin.bank-service.edit', ['bank' => $bank, 'bank_service' => $service]) }}">
                                                    <span class="material-symbols-outlined">
                                                        edit_note
                                                    </span>
                                                    <span>{{ __('Edit') }}</span>
                                                </a>

                                                {{-- <a class="dropdown-item flex-mode"
                                               href="{{ route('admin.bank-service.index', ['bank'=>$bank]) }}">
                                                <span class="material-symbols-outlined">
                                                    Add
                                                </span>
                                                <span>{{ __('Services') }}</span>
                                            </a> --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                @include('backend.partials.no-table-data')
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add event listener to checkboxes
            $('input[type="checkbox"]').change(function() {
                var serviceId = $(this).data('service-id'); // Get service ID from data attribute
                var isChecked = $(this).prop('checked'); // Check if the checkbox is checked
                // Send AJAX request
                $.ajax({
                    type: 'GET',
                    url: '/admin/update-service-status', // Your update endpoint
                    data: {
                        service_id: serviceId,
                        is_checked: isChecked ? 1 : 0 // Convert boolean to integer
                    },
                    success: function(response) {
                        console.log(response); // Log success message or handle response
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Log error message
                    }
                });
            });
        });
    </script>
@endpush
