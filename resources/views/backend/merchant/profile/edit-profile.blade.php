@extends('backend.layouts.app')
@section('title','Profile')
@section('content')
    <h3 class="page-title">{{ __('My Profile') }}</h3>
    <div class="row gy-3 mt-1">
        <!---profile detail--->
        <div class="col-md-4 animated slideInUp">
            @include('backend.merchant.profile.__show-profile')
        </div>
        <!--profile forms---->
        <div class="col-md-8 animated slideInDown">
            <div class="d-box myTab">
                <ul class="nav nav-tabs nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#profile-setting">{{ __('Profile Setting') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#change-password">{{ __('Change Password') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#set-pin">{{ __('PIN CODE') }}</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content mt-4">
                    @include('backend.merchant.profile.__profile-update')
                    @include('backend.merchant.profile.__password-update')
                    @include('backend.merchant.profile.__pin-code')

                </div>
            </div>
        </div>
        <!--profile form ends here---->
    </div>
@endsection
@push('js')
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
