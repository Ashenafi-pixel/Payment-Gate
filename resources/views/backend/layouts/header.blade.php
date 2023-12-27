<header class="sticky-top">
    <div class="col-12">
        <div class="row h-100">
            <div class="col-lg-5 text-center text-lg-start my-auto">
                <h3 class="page-title"> {{ __('Welcome!') }} </h3>
            </div>
            <div class="col-lg-7 mt-3 my-lg-auto">
                <div class="flex-mode justify-content-center justify-content-lg-end">
                    <div>
                        <div class="switchScreen" onclick="switchScreen();">
                            <img width="24" id="screen" src="{{ asset('images/icons/fullscreen.svg') }}"
                                alt="">
                        </div>
                    </div>
                    <!--Notification icon---->
                    <div class="position-relative">
                        <button class="btn p-0" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#notifications" aria-controls="notifications">
                            <div class="notify bell-animate">
                                <img src="{{ asset('images/icons/notification-bell.svg') }}" alt="">
                            </div>
                            <span class="notify-dot pulse-button"></span>
                        </button>
                    </div>
                    <!--User profile dropdown--->
                    <div>
                        <div class="dropdown profile-dd">
                            <button class="btn p-0 dropdown-toggle" type="button" id="profile"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ isset(auth()->user()->image) ? asset(auth()->user()->image->url) : asset('images/user-img.png') }}"
                                    alt="user" class="user-img">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end user-dd animated zoomIn py-0"
                                aria-labelledby="user-dropdown" data-bs-popper="static">
                                <div class="d-flex no-block align-items-center profile-dd-bg  ">
                                    <img src="{{ isset(auth()->user()->image) ? asset(auth()->user()->image->url) : asset('images/user-img.png') }}"
                                        alt="user" class="user-img">
                                    <div>
                                        <h4 class="sub-title">{{ __(Auth::user()->username) }}</h4>
                                        <p class="sub-title">{{ __(Auth::user()->email) }}</p>
                                    </div>
                                </div>

                                <a class="dropdown-item"
                                    href="{{ route(\App\Helpers\GeneralHelper::WHO_AM_I() . '.profile.view') }}">
                                    <img class="filter" src="{{ asset('images/icons/my-profile.svg') }}" alt="">
                                    <span>{{ __('My Profile') }}</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <img class="filter" src="{{ asset('images/icons/account-setting.svg') }}"
                                        alt="">
                                    <span>{{ __('Account Setting') }}</span>
                                </a>
                                {{-- Lock Screen --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item mb-2" href="{{ route('user.lock.screen') }}">
                                    <img class="filter" src="{{ asset('images/icons/lock-screen.svg') }}"
                                        alt="">
                                    <span>{{ __('Lock Screen') }}</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                {{-- Logout --}}
                                <a class="dropdown-item mb-2" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <img class="filter" src="{{ asset('images/icons/log-out.svg') }}" alt="">
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
</header>
<!---Notification Sidebar------>
<div class="offcanvas offcanvas-end" data-bs-backdrop="true" tabindex="-1" id="notifications"
    aria-labelledby="notificationsLabel">
    <div class="offcanvas-header">
        <h5 class="page-title"> {{ __('Notifications') }} <span class="sub-heading">(4)</span></h5>
        <button type="button" class="btn-close btn text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        {{-- <a href="" class="flex-mode notify-space">
            <img src="{{asset('images/user-img.png')}}" class='user-img' alt="">
            <div>
                <h4 class="noti-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Eum, consequatur.</h4>
                <div class="flex-mode justify-content-between">
                    <p class="notify-author">Ayesha</p>
                    <p class="notify-date">01-01-2023</p>
                </div>
            </div>
        </a>
        <a href="" class="flex-mode notify-space unread">
            <img src="{{asset('images/user-img.png')}}" class='user-img' alt="">
            <div>
                <h4 class="noti-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Eum, consequatur.</h4>
                <div class="flex-mode justify-content-between">
                    <p class="notify-author">Ayesha</p>
                    <p class="notify-date">01-01-2023</p>
                </div>
            </div>
        </a> --}}
        <div class="flex-mode flex-column h-100 p-3 content-center">
            <img height="120" class='filter-img' src="{{ asset('images/icons/bell.svg') }}" alt="">
            <h4 class="page-title"> {{ __('Hey! You have no any notifications') }} </h4>
        </div>
    </div>
    <div class="offcanvas-footer">
        <a class="page-title" href="#"> {{ __('See All') }}
            <img width='24' src="{{ asset('images/arrow-left-d.svg') }}" alt=""> </a>
    </div>
</div>
