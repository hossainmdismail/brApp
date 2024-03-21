<?php
use App\Models\Config;

$config = Config::first();
?>
@extends('frontend.layouts.app')

@section('content')
<!-- Modal -->
{{-- <div class="modal fade custom-modal" id="onloadModal" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="deal"
                    style="background-image: url('{{ asset('frontend') }}/imgs/banner/menu-banner-7.png')">
                    <div class="deal-top">
                        <h2 class="text-brand">Deal of the Day</h2>
                        <h5>Limited quantities.</h5>
                    </div>
                    <div class="deal-content">
                        <h6 class="product-title"><a href="shop-product-right.html">Summer Collection New Morden
                                Design</a></h6>
                        <div class="product-price"><span class="new-price">$139.00</span><span
                                class="old-price">$160.99</span></div>
                    </div>
                    <div class="deal-bottom">
                        <p>Hurry Up! Offer End In:</p>
                        <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"><span
                                class="countdown-section"><span class="countdown-amount hover-up">03</span><span
                                    class="countdown-period"> days </span></span><span class="countdown-section"><span
                                    class="countdown-amount hover-up">02</span><span class="countdown-period"> hours
                                </span></span><span class="countdown-section"><span
                                    class="countdown-amount hover-up">43</span><span class="countdown-period"> mins
                                </span></span><span class="countdown-section"><span
                                    class="countdown-amount hover-up">29</span><span class="countdown-period"> sec
                                </span></span></div>
                        <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i
                                class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    @if ($config)
                        <h5 class="mb-5">{{ $config->name }}</h5>
                    @endif
                    <div class="loader">
                        <div class="bar bar1"></div>
                        <div class="bar bar2"></div>
                        <div class="bar bar3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<main class="main">
    @livewire('frontend.header-ads')
    @livewire('frontend.product')
</main>
@endsection
