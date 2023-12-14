@extends('auth.layouts.app')

@section('title','Addis | Documents')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="credential-holder">
                    <div class="row">
                        <div class="col-12">
                            <div class="login-content text-center" data-aos="fade-up" data-aos-easing="linear"
                                 data-aos-duration="1500">
                                <h3 class="sub-heading text-white text-center">
                                    {!! __('One step away...') !!}
                                </h3>
                                <p class="b-text text-white text-center mb-0">
                                    {!! __('To keep connected with us please upload required documents.') !!}
                                </p>
                            </div>
                        </div>
                        {{-- data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" --}}
                        <div class="col-12">
                            <div class="container my-4">
                                <div class="zoom-90 myTab">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#upload-document">Upload Document</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#view-document">View Document</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content  border p-4 ">
                                        @include('backend.customer.document.__upload-document')
                                        @include('backend.customer.document.__show-document')
                                    </div>
                                    <!-- Tab panes ends-->
                                    <div class="text-center text-lg-end mt-3">
                                        <a class="otp-req" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span>{{ __('Logout') }}</span>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')

@endsection
