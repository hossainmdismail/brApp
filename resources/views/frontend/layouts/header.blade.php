<?php
use App\Models\ProductCategory;
use App\Models\Campaign;
use App\Models\Config;

$categories = ProductCategory::All();
$camps = Campaign::All();
$config = Config::first();
?>
<header class="header-area header-style-1 header-height-2">
    {{-- Top Header --}}
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            @if ($config)
                                <li><i class="fi-rs-smartphone"></i> <a href="#">{{ $config->number }}</a></li>
                            @endif
                            <li><i class="fi-rs-marker"></i><a href="{{ route('contact') }}">Our location</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                @foreach ($camps as $camp)
                                    <li>{{ $camp->campaign_name }} <a
                                            href="{{ route('campaign.product.list', $camp->id) }}">Shop now</a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>
                                <a class="language-dropdown-active" href="#"> <i class="fi-rs-world"></i>
                                    English <i class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li><a href="#"><img src="{{ asset('frontend') }}/imgs/theme/flag-fr.png"
                                                alt="">Français</a></li>
                                    <li><a href="#"><img src="{{ asset('frontend') }}/imgs/theme/flag-dt.png"
                                                alt="">Deutsch</a></li>
                                    <li><a href="#"><img src="{{ asset('frontend') }}/imgs/theme/flag-ru.png"
                                                alt="">Pусский</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    @if ($config)
                        {{-- <link rel="shortcut icon" href="" type="image/x-icon"> --}}
                        <a href="{{ route('index') }}"><img src="{{ asset('files/config/' . $config->logo) }}"
                                alt="logo"></a>
                    @endif
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="#">
                            <select class="select-active select2-hidden-accessible" data-select2-id="1" tabindex="-1"
                                aria-hidden="true">
                                @foreach ($categories as $category)
                                    <option data-select2-id="3">{{ $category->category_name }}</option>
                                @endforeach

                            </select>
                            <input type="text" placeholder="Search for items...">
                        </form>
                    </div>
                    <div class="header-action-right d-none d-lg-block">
                        <div class="header-action-2">

                            @livewire('frontend.shopping-cart')
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            {{-- shpping cart --}}
                            @livewire('frontend.shopping-cart')
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Header Bottom --}}
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    @if ($config)
                        {{-- <link rel="shortcut icon" href="" type="image/x-icon"> --}}
                        <a href="{{ route('index') }}"><img src="{{ asset('files/config/' . $config->logo) }}"
                                alt="logo"></a>
                    @endif
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categori-button-active" href="#">
                            <span class="fi-rs-apps"></span> Browse Categories
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-large">
                            <ul>
                                @foreach ($categories as $category)
                                    <li class="has-children">
                                        <a href="{{ route('front.category', $category->slugs) }}"><img width="30"
                                                style="margin-right: 6px; border-radius: 6px;"
                                                src="{{ asset('files/category/' . $category->category_image) }}"
                                                alt="">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="more_categories">Show more...</div>
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                        <nav>
                            <ul>
                                <li>
                                    <a href="{{ route('index') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('shop') }}">Shop</a>
                                </li>
                                <li><a href="#">Category <i class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ route('front.category', $category->slugs) }}">{{ $category->category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('contact') }}">Contact</a>
                                </li>
                                <li>
                                    <a href="{{ route('aboutus') }}">About</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-block">
                    <p><i class="fi-rs-headset"></i><span>Hotline</span>
                        @if ($config)
                            {{ $config->number }}
                        @endif
                    </p>
                </div>

                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        @livewire('frontend.shopping-cart')
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</header>

<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                @if ($config)
                    <a href="{{ route('index') }}"><img src="{{ asset('files/config/' . $config->logo) }}"
                            alt="logo"></a>
                @endif
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <nav>
                    <ul class="mobile-menu">
                        <li>
                            <a href="{{ route('index') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('shop') }}">Shop</a>
                        </li>
                        <li><a href="#">Category <i class="fi-rs-angle-down"></i></a>
                            <ul class="sub-menu">
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('front.category', $category->slugs) }}">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li>
                            <a href="{{ route('aboutus') }}">About</a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>


        </div>
    </div>
</div>
