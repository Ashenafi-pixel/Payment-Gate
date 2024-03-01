@extends('frontend.layouts.app')
@section('title','Home')
@section('content')
<section class="section-padder">
    <div class="container">
        <div class="row">
        <style>
        .main-heading {
            line-height: 1.2; /* Adjust the value as needed */
            font-size: 3em; /* Adjust the value as needed */
        }
    </style>
   
            <div class="col-lg-6 my-auto" data-aos="fade-up" data-aos-duration="2000">
                <h1 class="main-heading">
                    Enabling E-Commerce For All.
                </h1>
                <p class="main-text">
                    Traders Deserve a safe, convenient, and Affordable Globalized payment platform.
                </p>
                <div class=" mt-32 d-flex flex-column flex-sm-row gap-3">
                    <a href="" class="btn btn-lg btn-theme-effect">Start Now!</a>
                    <a href="" class="btn btn-lg btn-outline-effect">
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
<section id="about" class="section-padder">
<div class="container">
        <div class="row px-3 px-md-5 ">
            <div class="col-md-6 aos-init aos-animate " data-aos="fade-down-left">
                <div class="row justify-content-center   position-relative">
                    <div class="yellow-box" data-aos="fade-right" data-aos-offset="300" data-aos-delay="200"
                        data-aos-easing="ease-in-sine">
                        <h4>About</h4>
                        <div class="onboard-media">
                        <img alt="" src="{{asset('images/addispay-logo.png')}}" height="44">
                    </div>
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
                <p class="b-text aos-init aos-animate" data-aos="fade-left" style="text-align: justify;">
                AddisPay Financial Technology Share Company is a new financial technology
                (Fin-tech) company that delivers convenient, innovative, safe and secure payment
                 processing services and platforms in the Ethiopian market.
                </p>
                <p class="b-text aos-init aos-animate" data-aos="fade-left"style="text-align: justify;">
                The company provides M-pos and getaway and related digital financial services in Ethiopia by leveraging the latest M-pos and online
                payment technology platform in the industry and developing user-oriented products and services
                that will allow people to use their mobile phone and their payment instruments for conducting financial services including payments. AddisPay aspires to make a significant contribution to the financial
                sector by offering digital based payments services that meet the needs of consumers and merchants towards cash-lite transactions in
                line with the national agenda of digital economy.
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

<section id="services-section" class="section-padder">    
    <div class="container">
        <h2 class="heading h-margin-64 aos-init aos-animate" data-aos-delay="500" data-aos="fade-right">
            Our Valuable Services
        </h2>
        <div class="row g-4">
            <div class="col-md-4 ">
                <div class="box-card aos-init aos-animate" data-aos-delay="500" data-aos-duration="1500"
                    data-aos="fade-left">
                    <img height="56" src="{{asset('images/site/icons/net-banking.svg')}}" alt="" class="aos-init aos-animate"
                        data-aos="flip-left">
                        <h4 class="sub-heading my-3">
                    Payment Gateway
                    </h4>
                    <p class="b-text"style="text-align: justify;">
                    Empower your business with AddisPay's state-of-the-art Payment Gateway solutions. 
                    Seamlessly conduct secure online transactions, ensuring a frictionless payment experience 
                    for your customers. We provide the technology that enables businesses to thrive in the 
                    digital economy.
                    </p>
                    <a href="" class="btn btn-theme-effect mt-3">
                        Read More
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-card aos-init aos-animate" data-aos-delay="500" data-aos-duration="1500"
                    data-aos="fade-left">
                    <img height="56" src="{{asset('images/site/credit-card.svg')}}" alt="" class="aos-init aos-animate"
                        data-aos="flip-left">
                    <h4 class="sub-heading my-3">
                    Payment aggregation
                    </h4>
                    <p class="b-text" style="text-align: justify;">
                    Experience the ease of Payment Aggregation with AddisPay. We streamline payment processes, 
                    making it effortless for businesses to manage and monitor transactions. Our aggregation
                    services simplify financial operations, offering a comprehensive solution for your payment needs.
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
                    Point of sale Service
                    </h4>
                    <p class="b-text" style="text-align: justify;">
                    Transform your point of sale experience with AddisPay's Point of Sale (POS) services. 
                    Whether in-store or on-the-go, our POS solutions are designed for versatility and reliability.
                    Accept payments seamlessly, enhance customer satisfaction, and stay ahead in the competitive market.
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
                    The payments platform for some of the leading brands
                </h2>
            </div>
            <div class="col-6  col-sm-5 col-md-3 col-lg-2  text-center aos-init aos-animate" data-aos-duration="1500"
                data-aos="fade-left">
                <img width="120" src="{{asset('images/site/bbm-04.png')}}" alt="">
            </div>
            <div class="col-6  col-sm-5 col-md-3 col-lg-2  text-center aos-init aos-animate " data-aos-duration="1500"
                data-aos="fade-left">
                <img width="120" src="{{asset('images/site/bridgetech PLC-01.png')}}" alt="">
            </div>
            <div class="col-6  col-sm-5 col-md-3 col-lg-2  text-center aos-init aos-animate" data-aos-duration="1500"
                data-aos="fade-left">
                <img width="120" src="{{asset('images/site/STARTIMES-02.png')}}" alt="">
            </div>
            <div class="col-6  col-sm-5 col-md-3 col-lg-2  text-center aos-init aos-animate " data-aos-duration="1500"
                data-aos="fade-left">
                <img width="120" src="{{asset('images/site/BRUHWAY HOTEL-03.png')}}" alt="">
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
            <div class="col-md-3">
                <div class="box-card aos-init aos-animate" data-aos-duration="1000" data-aos="fade-up">
                    <img width="24" class="check-icon" src="{{asset('images/icons/check.svg')}}" alt="">
                    <div class="box-content">
                        <h3 class="sub-heading">
                        Better customer experience
                        </h3>
                        <p class="b-text" style="text-align: justify;">
                        customers feel it is convenient t o purchase from us while also being able to save money and time, then that automatically translates to a positive customer experience.
                        And as a business, we put customer experience above everything else.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box-card aos-init aos-animate" data-aos-duration="1000" data-aos="fade-up">
                    <img width="24" class="check-icon" src="{{asset('images/icons/check.svg')}}" alt="">
                    <div class="box-content">
                        <h3 class="sub-heading">
                        Variety of payment choices
                        </h3>
                        <p class="b-text"style="text-align: justify;">
                        We offer you a wide variety of payment options to choose from. People have
                        their own preferences, and if they can find that option while purchasing from 
                        us, there are obviously more chances of them actually getting through with the
                        transaction. 
                        </p>
                    </div>
                </div>
            </div>
         
            <div class="col-md-3">
                <div class="box-card aos-init aos-animate" data-aos-duration="1000" data-aos="fade-up">
                    <img width="24" class="check-icon" src="{{asset('images/icons/check.svg')}}" alt="">
                    <div class="box-content">
                        <h3 class="sub-heading">
                        Speed of transactions
                        </h3>
                        <p class="b-text" style="text-align: justify;">
                        People don’t have to wait in lines, take time to write checks, or wait for paper bills. They don’t have to wait for banks to
                        clear their checks so that they can access the money. we saves a great deal of time since we don’t have to waste time printing
                        and mailing bills.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box-card aos-init aos-animate" data-aos-duration="1000" data-aos="fade-up">
                    <img width="24" class="check-icon" src="{{asset('images/icons/check.svg')}}" alt="">
                    <div class="box-content">
                        <h3 class="sub-heading">
                      Speed of Transaction
                        </h3>
                        <p class="b-text"style="text-align: justify;">
                        Instead of spending time on setting up a whole payment process that involves certain
                        equipment and some extra employees, we can easily and quickly integrate online payment gateways for your business. 
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
                Enabling E-Commerce For All. Making payments accessible to everyone.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 my-lg-auto  aos-init aos-animate" data-aos="fade-up">
                <a href="{{ route('register') }}" class="btn btn-theme-effect btn-lg">Get Started</a>
            </div>
        </div>
      </div>
    </div>
</section>
@endsection
