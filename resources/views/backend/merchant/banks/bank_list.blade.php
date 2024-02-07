@extends('backend.layouts.app')
@section('title', 'All Your Banks')
@section('content')

    <div class="table-responsive table-nowrap d-box p-0 border-radius-0">
        @if ($banks->isNotEmpty())
            <table class="table">
                <thead class="sticky-top">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('User Name') }}</th>
                        <th>{{ __('Bank Name') }}</th>
                        <th>{{ __('Account Number') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banks as $bank)
                        <tr>
                            <td>{{ $bank->id }}</td>
                            <td>{{ $bank->user_name }}</td>
                            <td>{{ $bank->bank_name }}</td>
                            <td>{{ $bank->account_no }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-green-light flex-mode" type="button" id="action"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="material-symbols-outlined">
                                            more_vert
                                        </span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end animated zoomIn" aria-labelledby="action">
                                        <!-- Add your dropdown menu items here if needed -->
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">
                {{ __('No bank accounts found for the authenticated user.') }}
            </div>
        @endif


    </div>

@endsection
