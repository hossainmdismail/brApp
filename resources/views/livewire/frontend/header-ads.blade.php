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
                                                {{ $banner->category ? $banner->category->category_name : 'unkown' }}</h4>
                                            <h2 class="animated fw-900">{{ $banner->banner_title }}</h2>
                                            <h1 class="animated fw-900 text-brand">On All Products</h1>
                                            <p class="animated">{{ $banner->banner_description }}</p>
                                            <a class="animated btn btn-brush btn-brush-3" href="#"> Shop Now </a>
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
        </div>
    </div>
</section>
