<section class="home-slider position-relative pt-25 pb-20">
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-3 d-none gap-2 d-sm-block">
                <div class="categori-dropdown-wrap ">
                    <ul>
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active open" href="#">
                                <span class="fi-rs-apps"></span> Browse Categories
                            </a>
                        </div>
                        @foreach ($categories as $category)
                            <li class="has-children">
                                <a href="{{ route('front.category',$category->slugs) }}"><img width="30" style="margin-right: 6px; border-radius: 6px;" src="{{ asset('files/category/'.$category->category_image) }}" alt="">{{ $category->category_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="more_categories">Show more...</div>
                </div>
            </div> --}}
            <div class="col-lg-9">
                <div class="position-relative">
                    <div class="hero-slider-1 style-3 dot-style-1 dot-style-1-position-1">
                        @foreach ($banners as $banner)
                            <div class="single-hero-slider single-animation-wrap">
                                <div class="container">
                                    <div class="slider-1-height-3 slider-animated-1">
                                        <div class="hero-slider-content-2">
                                            <h4 class="animated">
                                                {{ $banner->category ? $banner->category->category_name : 'unkown' }}
                                            </h4>
                                            <h2 class="animated fw-900">{{ $banner->banner_title }}</h2>
                                            <h1 class="animated fw-900 text-brand">On All Products</h1>
                                            <p class="animated">{{ $banner->banner_description }}</p>
                                            <a class="animated btn btn-brush btn-brush-3"
                                                href="{{ route('front.category', $banner->category ? $banner->category->slugs : '') }}">
                                                Shop Now
                                            </a>
                                        </div>
                                        <div class="slider-img">
                                            <img src="{{ asset('files/banner/' . $banner->banner_image) }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="slider-arrow hero-slider-1-arrow style-3"></div>
                </div>
            </div>
            <div class="col-lg-3 d-none d-sm-block">
                @if ($header_one)
                    <div class="banner-img banner-1 wow fadeIn  animated home-3">
                        <img class="border-radius-10" src="{{ asset('files/campaign/' . $header_one->campaign_image) }}"
                            alt="">
                        <div class="banner-text">
                            <span>{{ $header_one->campaign_for }}</span>
                            <h4>{{ $header_one->campaign_name }}</h4>
                            <a href="{{ route('campaign.product.list', $header_one->id) }}">Shop Now <i
                                    class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                @endif

                @if ($header_two)
                    <div class="banner-img banner-2 wow fadeIn  animated mb-0">
                        <img class="border-radius-10" src="{{ asset('files/campaign/' . $header_two->campaign_image) }}"
                            alt="">
                        <div class="banner-text">
                            <span>{{ $header_two->campaign_for }}</span>
                            <h4>S{{ $header_two->campaign_name }}</h4>
                            <a href="{{ route('campaign.product.list', $header_two->id) }}">Shop Now <i
                                    class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
