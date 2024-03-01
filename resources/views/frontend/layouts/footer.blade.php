<section class="footer-main ">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-12 col-md-3">
                <img height='40' class="filter-logo" src="{{asset('images/addispay-logo.png')}}" alt="">
                <p class="b-text mt-3">
                    Making payments accessible to everyone and
                    simplifying the process for businesses to accept payments through multiple channels.
                </p>
            </div>
            <div class="col-6 col-md-auto">
                <h3 class="footer-heading mt-3">
                    Explore
                </h3>
                <ul class="footer-links">
                    <li>
                        <a href="#about" id="about-link">About us</a>
                    </li>

                    <script>
                        document.getElementById('about-link').addEventListener('click', function (event) {
                            event.preventDefault(); // Prevents the default behavior of the link

                            // Scroll to the target section
                            const targetSection = document.getElementById('about');
                            if (targetSection) {
                                targetSection.scrollIntoView({
                                    behavior: 'smooth'
                                });
                            }
                        });
                    </script>
                    <li>
                        <a href="#" id="services-link">Our services</a>
                    </li>

                    <script>
                        document.getElementById('services-link').addEventListener('click', function (event) {
                            event.preventDefault(); // Prevents the default behavior of the link

                            // Scroll to the target section
                            const targetSection = document.getElementById('services-section');
                            if (targetSection) {
                                targetSection.scrollIntoView({
                                    behavior: 'smooth'
                                });
                            }
                        });
                    </script>
                    <li>
                        <a href=""> Latest news </a>
                    </li>
                    <li>
                        <a href=""> Contact us </a>
                    </li>
                    <li>
                        <a href=""> Pricing </a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-auto">
                <h3 class="footer-heading mt-3">
                    Quick Links
                </h3>
                <ul class="footer-links">
                    <li>
                        <a href="{{ route('login') }}"> Sign in </a>
                    </li>
                    <li>
                        <a href=""> Privacy Policy </a>
                    </li>
                    <li>
                        <a href=""> Terms & Conditions </a>
                    </li>
                    <li>
                        <a href=""> Integration guide </a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-auto">
                <h3 class="footer-heading mt-3">
                    Contact us
                </h3>
                <ul class="footer-links">
                    <li>
                        <a href=""> <i class="fa fa-phone" aria-hidden="true"></i>&nbsp; +251116684243 </a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;info@addispay.co </a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;www.addispay.co</a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Near Lem Hotel Efrata
                            Building 4th Floor</a>
                    </li>
                </ul>
            </div>
            <div class="col-10 col-md-3 my-auto">
                <div class="subscription-box">
                    <input type="text" class="form-control form-control-lg" placeholder="Enter email address">
                    <button class="btn btn-theme-effect mt-2 w-100">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="footer-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-auto">
                <p class="text-copyright">
                    Copyright - 2023. www.addispay.et - All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 my-auto">
                <div class="social-icons">
                    <a href=""> <i class="fa-brands fa-facebook"></i> </a>
                    <a href=""> <i class="fa-brands fa-instagram"></i></a>
                    <a href="https://twitter.com/addispay"> <i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/company/addispay/posts/?feedView=all"> <i
                            class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- On Board Modal --}}
<div class="onboard-modal modal fade animated show-on-load" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content text-center">
            <button aria-label="Close" class="btn close pe-0 d-flex align-items-center" data-bs-dismiss="modal"
                type="button">
                <span class="close-label">Skip Intro</span>
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
            <div class="onboard-slider-container">
                <div class="onboard-slide">
                    <div class="onboard-media">
                        <img alt="" src="{{asset('images/addispay-logo.png')}}" height="44">
                    </div>
                    <div class="onboard-curve-left background-yellow">
                        <h4 class="heading text-white">
                            Welcome to AddisPay
                        </h4>
                        <div class="b-text text-white text-center">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita, unde?
                        </div>
                    </div>
                </div>
                <div class="onboard-slide">
                    <div class="onboard-media">
                        <img alt="" src="{{asset('images/addispay-logo.png')}}" height="44">
                    </div>
                    <div class="onboard-curve-left background-yellow">
                        <h4 class="heading text-white">
                            Use it
                        </h4>
                        <div class="b-text text-white text-center">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Laborum quidem exercitationem doloremque!
                        </div>
                    </div>
                </div>
                <div class="onboard-slide">
                    <div class="onboard-media">
                        <img alt="" src="{{asset('images/addispay-logo.png')}}" height="44">
                    </div>
                    <div class="onboard-curve-left background-yellow">
                        <h4 class="heading text-white ">
                            Let's get started
                        </h4>

                        <a href="" class="btn btn-theme-effect mt-1">
                            Become a Merchant
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
