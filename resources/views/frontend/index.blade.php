@extends('frontend.layouts.app')
@section('title','Home')
@section('content')
<section class="section-padder">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 my-auto" data-aos="fade-up" data-aos-duration="3000">
                <h1 class="main-heading">
                    Making Payments accessible to all.
                </h1>
                <p class="main-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada, justo in convallis blandit.
                </p>
                <div class=" mt-32 d-flex flex-column flex-sm-row gap-3">
                    <a href="" class="btn btn-lg btn-theme-effect">Start Now!</a>
                    <a href="" class="btn btn-lg btn-outline-effect ">
                        Contact Us
                    </a>
                </div>
            </div>
            <div class="col-lg-6 my-auto text-center text-lg-right" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                <img class="img-fluid banner-img" src="{{asset('images/site/adispay-dashboard.svg')}}" alt=""
                    role="presentation" loading="lazy" fetchpriority="high">
            </div>
        </div>
    </div>
</section>
<section class="line-breaker">
    <div class="container">
        <div class="border-b"></div>
    </div>
</section>
<section class="section-padder ">
    <div class="container">
        <div class="row px-3 px-md-5 ">
            <div class="col-md-6 aos-init aos-animate " data-aos="fade-down-left">
                <div class="row justify-content-center   position-relative">
                    <div class="yellow-box" data-aos="fade-right" data-aos-offset="300" data-aos-delay="200"
                        data-aos-easing="ease-in-sine">
                        <h4>Lorem ipsum dolor sit amet consectetur</h4>
                    </div>
                    <div class="offset-4 col-8">
                        <img class="img-fluid w-100 who-we" src="{{asset('images/site/who-we-are-1.png')}}" alt=""
                            data-aos="fade-left" data-aos-offset="300" data-aos-delay="300" data-aos-duration="1000">
                    </div>
                    <div class="col-11 translate-y">
                        <img class="img-fluid w-100 who-we aos-init aos-animate"
                            src="{{asset('images/site/who-we-are-2.png')}}" alt="" data-aos-delay="800" data-aos-duration="1500"
                            data-aos="fade-left" />
                    </div>
                </div>
            </div>
            <div class="col-md-6 ps-md-5 aos-init aos-animate" data-aos-delay="300" data-aos-duration="1500"
                data-aos="fade-left">
                <h2 class="heading h-margin" data-aos="fade-left">
                    Who We Are?
                </h2>
                <p class="b-text aos-init aos-animate" data-aos="fade-left">
                    Lorem ipsum dolor sit amet consectetur. Sit tellus purus rhoncus cursus hac ac etiam. Etiam morbi
                    amet egestas condimentum nulla consectetur nisi. Vehicula in pulvinar quam ut amet massa pulvinar.
                    Eleifend magnis cursus lacinia tincidunt. Vitae amet suspendisse integer aliquam lacus sagittis
                    proin vitae.
                </p>
                <p class="b-text aos-init aos-animate" data-aos="fade-left">
                    Proin quam maecenas in id tellus blandit. Ut sed mi eu ut. Enim nec suscipit eget arcu adipiscing
                    condimentum turpis est. Libero condimentum pellentesque blandit egestas .
                </p>
                <a href="" class="btn btn-outline-effect mt-3 aos-init aos-animate" data-aos="fade-right">
                    Read More
                </a>
            </div>
        </div>
    </div>
</section>
<section class="line-breaker">
    <div class="container">
        <div class="border-b"></div>
    </div>
</section>
<section class="section-padder ">
    <div class="container">
        <h2 class="heading h-margin-64 aos-init aos-animate" data-aos-delay="500" data-aos="fade-right">
            Our Valuable Services
        </h2>
        <div class="row g-4">
            <div class="col-md-4 ">
                <div class="box-card aos-init aos-animate" data-aos-delay="500" data-aos-duration="1500"
                    data-aos="fade-left">
                    <img height="56" src="{{asset('images/site/credit-card.svg')}}" alt="" class="aos-init aos-animate"
                        data-aos="flip-left">
                    <h4 class="sub-heading my-3">
                        Credit Card Payment
                    </h4>
                    <p class="b-text">
                        Lorem ipsum dolor sit amet consectetur.
                        Sit tellus purus rhoncus cursus hac ac etiam, Etiam morbi amet egestas.
                    </p>
                    <a href="" class="btn btn-theme-effect mt-3">
                        Read More
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-card aos-init aos-animate" data-aos-delay="500" data-aos-duration="1500"
                    data-aos="fade-left">
                    <img height="56" src="{{asset('images/site/icons/pay-via-payment.svg')}}" alt="" class="aos-init aos-animate"
                        data-aos="flip-left">
                    <h4 class="sub-heading my-3">
                        Pay Via Payment
                    </h4>
                    <p class="b-text">
                        Lorem ipsum dolor sit amet consectetur.
                        Sit tellus purus rhoncus cursus hac ac etiam, Etiam morbi amet egestas.
                    </p>
                    <a href="" class="btn btn-theme-effect mt-3">
                        Read More
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-card aos-init aos-animate" data-aos-delay="500" data-aos-duration="1500"
                    data-aos="fade-left">
                    <img height="56" src="{{asset('images/site/icons/net-banking.svg')}}" alt="" class="aos-init aos-animate"
                        data-aos="flip-left">
                    <h4 class="sub-heading my-3">
                        Internet Banking
                    </h4>
                    <p class="b-text">
                        Lorem ipsum dolor sit amet consectetur.
                        Sit tellus purus rhoncus cursus hac ac etiam, Etiam morbi amet egestas.
                    </p>
                    <a href="" class="btn btn-theme-effect mt-3">
                        Read More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-theme-dark padder-inner">
    <div class="container">
        <div class="row g-4 justify-content-center align-items-center">
            <div class="col-12 text-center mb-66 aos-init aos-animate" data-aos-duration="1500" data-aos="fade-right">
                <h2 class="inner-heading">
                    The payments platform for some of the world’s leading brands
                </h2>
            </div>
            <div class="col-6  col-sm-5 col-md-3 col-lg-2  text-center aos-init aos-animate" data-aos-duration="1500"
                data-aos="fade-left">
                <img width="120" src="{{asset('images/site/yelp-logo.png')}}" alt="">
            </div>
            <div class="col-6  col-sm-5 col-md-3 col-lg-2  text-center aos-init aos-animate " data-aos-duration="1500"
                data-aos="fade-left">
                <img width="120" src="{{asset('images/site/uber-logo.png')}}" alt="">
            </div>
            <div class="col-6  col-sm-5 col-md-3 col-lg-2  text-center aos-init aos-animate" data-aos-duration="1500"
                data-aos="fade-left">
                <img width="120" src="{{asset('images/site/stubhub-logo.png')}}" alt="">
            </div>
            <div class="col-6  col-sm-5 col-md-3 col-lg-2  text-center aos-init aos-animate " data-aos-duration="1500"
                data-aos="fade-left">
                <img width="120" src="{{asset('images/site/dropbox-logo.png')}}" alt="">
            </div>
            <div class="col-6  col-sm-5 col-md-3 col-lg-2  text-center aos-init aos-animate " data-aos-duration="1500"
                data-aos="fade-left">
                <img width="120" src="{{asset('images/site/github-logo.png')}}" alt="">
            </div>
            <div class="col-12 mt-66 text-center aos-init aos-animate" data-aos-duration="1500" data-aos="fade-up">
                <a href="" class="btn btn-theme-effect btn-lg">
                    Learn more about our Merchants
                </a>
            </div>
        </div>
    </div>
</section>
<section class="section-padder ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-md-7 text-center mb-5 aos-init aos-animate">
                <h2 class="heading aos-init aos-animate" data-aos="fade-right">
                    Powerful integrated payments for any business model
                </h2>
            </div>
            <div class="col-10 col-md-7 text-center aos-init aos-animate" data-aos-duration="1500" data-aos="fade-left">
                <img class="img-fluid" src="{{asset('images/site/business-modal.svg')}}" alt="">
            </div>
        </div>
        <div class="row g-4 mt-66">
            <div class="col-md-4">
                <div class="box-card aos-init aos-animate" data-aos-duration="1500" data-aos="fade-up">
                    <img width="24" class="check-icon" src="{{asset('images/icons/check.svg')}}" alt="">
                    <div class="box-content">
                        <h3 class="sub-heading">
                            Instantly onboard merchants
                        </h3>
                        <p class="b-text">
                            Lorem ipsum dolor sit amet consectetur.
                            Dictum convallis sodales elit in viverra fames enim. Diam vulputate habitant quisque fames
                            mauris.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-card aos-init aos-animate" data-aos-duration="1500" data-aos="fade-up">
                    <img width="24" class="check-icon" src="{{asset('images/icons/check.svg')}}" alt="">
                    <div class="box-content">
                        <h3 class="sub-heading">
                            Do more with digital servicing
                        </h3>
                        <p class="b-text">
                            Lorem ipsum dolor sit amet consectetur.
                            Dictum convallis sodales elit in viverra fames enim. Diam vulputate habitant quisque fames
                            mauris.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-card aos-init aos-animate" data-aos-duration="1500" data-aos="fade-up">
                    <img width="24" class="check-icon" src="{{asset('images/icons/check.svg')}}" alt="">
                    <div class="box-content">
                        <h3 class="sub-heading">
                            Grow your payments with ease
                        </h3>
                        <p class="b-text">
                            Lorem ipsum dolor sit amet consectetur.
                            Dictum convallis sodales elit in viverra fames enim. Diam vulputate habitant quisque fames
                            mauris.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-card aos-init aos-animate" data-aos-duration="1500" data-aos="fade-up">
                    <img width="24" class="check-icon" src="{{asset('images/icons/check.svg')}}" alt="">
                    <div class="box-content">
                        <h3 class="sub-heading">
                            Build without the overhead
                        </h3>
                        <p class="b-text">
                            Lorem ipsum dolor sit amet consectetur.
                            Dictum convallis sodales elit in viverra fames enim. Diam vulputate habitant quisque fames
                            mauris.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-card aos-init aos-animate" data-aos-duration="1500" data-aos="fade-up">
                    <img width="24" class="check-icon" src="{{asset('images/icons/check.svg')}}" alt="">
                    <div class="box-content">
                        <h3 class="sub-heading">
                            Improve your cashflow
                        </h3>
                        <p class="b-text">
                            Lorem ipsum dolor sit amet consectetur.
                            Dictum convallis sodales elit in viverra fames enim. Diam vulputate habitant quisque fames
                            mauris.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container mb-padder ">
    <div class="get-started  aos-init aos-animate" data-aos-duration="1500" data-aos="fade-up">
      <div class="inner-get-started">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="heading aos-init aos-animate" data-aos="fade-right">Let’s Get Started</h3>
                <p class="b-text mb-0" data-aos="fade-left">
                    Lorem ipsum dolor sit amet consectetur.
                    Dictum convallis sodales elit
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 my-lg-auto  aos-init aos-animate" data-aos="fade-up">
                <a href="" class="btn btn-theme-effect btn-lg">Get Started</a>
            </div>
        </div>
      </div>
    </div>
</section>
@endsection
