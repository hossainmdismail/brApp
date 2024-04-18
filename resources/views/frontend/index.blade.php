<?php
use App\Models\Config;

$config = Config::first();
?>
@extends('frontend.layouts.app')

@section('content')
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
