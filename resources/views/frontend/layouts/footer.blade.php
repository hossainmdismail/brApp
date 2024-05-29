<footer class="main">
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            @if ($config)
                                {{-- <link rel="shortcut icon" href="" type="image/x-icon"> --}}
                                <a href="{{ route('index') }}"><img src="{{ asset('files/config/' . $config->logo) }}"
                                        alt="logo"></a>
                            @endif
                        </div>
                        <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                        <p class="wow fadeIn animated">
                            <strong>Address: </strong>{{ $config ? $config->address : 'Dhaka' }}
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Phone: </strong>{{ $config ? $config->number : '+880170000000' }}
                        </p>
                        <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated animated animated"
                            style="visibility: visible;">Follow Us</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0 animated animated"
                            style="visibility: visible;">
                            <a href="#"><img src="{{ asset('frontend') }}/imgs/theme/icons/icon-facebook.svg"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('frontend') }}/imgs/theme/icons/icon-twitter.svg"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('frontend') }}/imgs/theme/icons/icon-instagram.svg"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('frontend') }}/imgs/theme/icons/icon-pinterest.svg"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('frontend') }}/imgs/theme/icons/icon-youtube.svg"
                                    alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">About</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="{{ route('aboutus') }}">About Us</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-3">
                    <h5 class="widget-title wow fadeIn animated">My Account</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="{{ route('checkout') }}">View Cart</a></li>
                        <li><a href="#">Track My Order</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="widget-title wow fadeIn animated">Payment</h5>
                    <div class="row">
                        <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                            <p class="mb-20 wow fadeIn animated">Secured Payment Gateways</p>
                            <img class="wow fadeIn animated"
                                src="{{ asset('frontend') }}/imgs/theme/payment-method.png" style="width: 194px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated">
        <div class="row justify-content-center">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6 text-center">
                <p class="float-md-left font-sm text-muted mb-0">&copy; 2024, <strong
                        class="text-brand">{{ $config ? $config->name : '' }}</strong>- All rights reserved</p>
            </div>

        </div>
    </div>
</footer>
