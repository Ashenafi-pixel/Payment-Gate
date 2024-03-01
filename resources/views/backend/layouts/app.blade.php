<!DOCTYPE html>
<html lang="en" data-sidebar='boxed' data-theme="light" sidebar-color="dark-theme">

<head>
    @include('backend.layouts.style-files')
</head>

<body>
    <div class="dashboard-wrapper">
        <section id="sidebar" class='collapsed-menu'>
            @include('backend.layouts.sidebar')
        </section>
        <section id="content">
            @include('backend.layouts.header')
            <main class='content-inner'>
               <div class="col-12">
                      @yield('content')
               </div>
            </main>
            @include('backend.layouts.footer')
        </section>
    </div>
    @include('backend.layouts.script-files')
    <!---Settings button on sidebar--->
    <div class="d-settings" data-bs-toggle="offcanvas" data-bs-target="#Id1" aria-controls="Id1">
        <img width="30" src="{{asset('images/icons/account-setting.svg')}}" alt="">
    </div>
    <!--Theme Customization list--->
    <div class="offcanvas offcanvas-end theme " data-bs-scroll="false" tabindex="-1" id="Id1">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Theme Customization</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <div class="col-12">
                    <p class="sidebar-title semi-bold">
                        Prefered sidebar:
                    </p>
                    <div class="row">
                        <div class="col-6">
                            <input type="radio" class="btn-check sidebar-radio" name="sidebar-mode" id="s-collapsed"
                                value="collapsed">
                            <label class="d-block text-center position-relative" for="s-collapsed">
                                <span class="r-flex">
                                    <span class="r-sidebar collapsed">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active"><img width="12"
                                                src="{{asset('images/icons/radio-boxed-icon.svg')}}" alt=""></span>
                                        <span class="r-menu flex-mode"><img width="12"
                                                src="{{asset('images/icons/radio-boxed-icon.svg')}}" alt=""></span>
                                        <span class="r-menu flex-mode"><img width="12"
                                                src="{{asset('images/icons/radio-boxed-icon.svg')}}" alt=""></span>
                                    </span>
                                    <span class="r-content collapsed">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                                <span class="pt-1 d-block">Collapsed</span>
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check sidebar-radio" name="sidebar-mode" id="s-boxed"
                                value="boxed">
                            <label class="d-block text-center position-relative" for="s-boxed">
                                <span class="r-flex">
                                    <span class="r-sidebar">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                                <span class="pt-1 d-block">Boxed</span>
                            </label>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-12">
                    <p class="sidebar-title semi-bold">
                        Prefered theme:
                    </p>
                    <div class="row">
                        <div class="col-6">
                            <input type="radio" class="btn-check theme-radio" name="options-mode" id="light-outlined"
                                value="light">
                            <label class="d-block text-center position-relative" for="light-outlined">
                                <span class="r-flex">
                                    <span class="r-sidebar">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                                <span class="pt-1 d-block">Light</span>
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check theme-radio" name="options-mode" id="dark-outlined"
                                value="dark">
                            <label class="d-block text-center position-relative" for="dark-outlined">
                                <span class="r-flex">
                                    <span class="r-sidebar dark">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content dark">
                                        <span class="r-header dark">
                                        </span>
                                    </span>
                                </span>
                                <span class="pt-1 d-block">Dark</span>
                            </label>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-12">
                    <p class="sidebar-title semi-bold">
                        Prefered sidebar colors:
                    </p>
                    <div class="row gy-4">
                        <div class="col-6">
                            <input type="radio" class="btn-check colors-radio" name="sidebar-colors" id="default"
                                value="default">
                            <label class="d-block text-center position-relative" for="default">
                                <span class="r-flex">
                                    <span class="r-sidebar">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                         <div class="col-6">
                            <input type="radio" class="btn-check colors-radio" name="sidebar-colors" id="dark-color"
                                value="dark">
                            <label class="d-block text-center position-relative" for="dark-color">
                                <span class="r-flex">
                                    <span class="r-sidebar dark-color">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check colors-radio" name="sidebar-colors" id="dark-theme"
                                value="dark-theme">
                            <label class="d-block text-center position-relative" for="dark-theme">
                                <span class="r-flex">
                                    <span class="r-sidebar dark-theme">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check colors-radio" name="sidebar-colors" id="light-grey"
                                value="light-grey">
                            <label class="d-block text-center position-relative" for="light-grey">
                                <span class="r-flex">
                                    <span class="r-sidebar light-grey">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check colors-radio" name="sidebar-colors" id="theme-yellow"
                                value="theme-yellow">
                            <label class="d-block text-center position-relative" for="theme-yellow">
                                <span class="r-flex">
                                    <span class="r-sidebar theme-yellow">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check colors-radio" name="sidebar-colors" id="theme-orange"
                                value="theme-orange">
                            <label class="d-block text-center position-relative" for="theme-orange">
                                <span class="r-flex">
                                    <span class="r-sidebar theme-orange">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check colors-radio" name="sidebar-colors" id="theme-green"
                                value="theme-green">
                            <label class="d-block text-center position-relative" for="theme-green">
                                <span class="r-flex">
                                    <span class="r-sidebar theme-green">
                                        <span class="r-logo flex-mode">logo</span>
                                        <span class="r-menu flex-mode active">Dashboard</span>
                                        <span class="r-menu flex-mode">menu</span>
                                        <span class="r-menu flex-mode">menu</span>
                                    </span>
                                    <span class="r-content">
                                        <span class="r-header">
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
