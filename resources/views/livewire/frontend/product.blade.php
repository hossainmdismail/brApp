<section class="product-tabs section-padding wow fadeIn animated">
    {{-- Hot deal --}}
    <div class="container">
        <div class="tab-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <h3>Hot Deal</h3>
            </ul>
            <a href="{{ route('features') }}" class="view-more d-none d-md-flex">View More<i
                    class="fi-rs-angle-double-small-right"></i></a>
        </div>
        <div class="tab-content wow fadeIn animated" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($featureds as $featured)
                        <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                            <x-product :product="$featured"/>
                        </div>
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
    </div>

    {{-- popular category --}}
    <section class="popular-categories section-padding mt-15">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                <div class="carausel-6-columns" id="carausel-6-columns">
                    @forelse ($categories as $key => $category)
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <a href="{{ route('front.category',$category->slugs) }}" style="width: 100%;"><img src="{{ asset('files/category/'.$category->category_image) }}" style="width: 100%" alt="{{ $category->category_name }}"></a>
                            </figure>
                            <h5><a href="{{ route('front.category',$category->slugs) }}">{{ $category->category_name }}</a></h5>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- Best sale --}}
    <div class="container">
        <div class="tab-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <h3>Best Sale!</h3>
            </ul>
            {{-- Need link category base url --}}
            <a href="{{ route('hot') }}" class="view-more d-none d-md-flex">View More<i
                    class="fi-rs-angle-double-small-right"></i></a>
        </div>
        <div class="tab-content wow fadeIn animated" id="myTabContent">
            <div class="row product-grid-4">
                @foreach ($populars as $pupolar)
                    <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                        <x-product :product="$pupolar"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- New product --}}
    <div class="container">
        <div class="tab-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <h3>Latest Product</h3>
            </ul>
            {{-- Need link category base url --}}
            <a href="{{ route('shop') }}" class="view-more d-none d-md-flex">View More<i
                    class="fi-rs-angle-double-small-right"></i></a>
        </div>
        <div class="tab-content wow fadeIn animated" id="myTabContent">
            <div class="row product-grid-4">
                @foreach ($latests as $latest)
                    <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                        <x-product :product="$latest"/>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{-- ads --}}
    <section class="bg-grey-9 section-padding">
        <div class="container pt-15 pb-25">
            <div class="heading-tab d-flex">
                <div class="heading-tab-left wow fadeIn animated">
                    <h3 class="section-title mb-20"><span>Campaign</span> Best Sell</h3>
                </div>

            </div>

            <div class="row">
                @if ($ads)
                    <div class="col-lg-3">
                        <div class="banner-img style-2 wow fadeIn animated">
                            <img src="{{ asset('files/campaign/'.$ads->campaign_image) }}" alt="{{ $ads->campaign_name }}">
                            <div class="banner-text">
                                <span>{{ $ads->campaign_for }}</span>
                                <h4 class="mt-5">{{ $ads->campaign_name }}</h4>
                                <a href="{{ route('campaign.product.list',$ads->id) }}" class="text-white">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                @forelse ($ads->products as $product)
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.view', $product->slugs) }}">
                                                    @if ($product->images)
                                                        @foreach ($product->images->take(2) as $key => $image)
                                                            <img class="{{ $key + 1 == 1 ? 'default-img' : 'hover-img' }}"
                                                                src="{{ asset('files/product/' . $image->image) }}"
                                                                alt="">
                                                        @endforeach
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a href="{{ route('product.view', $product->slugs) }}" aria-label="Quick view" class="action-btn hover-up" ><i class="fi-rs-eye"></i></a>

                                            </div>

                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a
                                                    href="#">{{ $product->category ? $product->category->category_name : 'Random' }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ route('product.view', $product->slugs) }}">{{ $product->name }}</a>
                                            </h2>
                                            <div class="product-price">
                                                <span>৳ {{ $product->finalPrice }}</span>
                                                @if ($product->discount != 0)
                                                    <span class="old-price">{{ $product->price }}</span>
                                                @endif
                                            </div>
                                            <div class="product-action-1 show">
                                                <a href="{{ route('product.view', $product->slugs) }}" aria-label="Order now" class="action-btn hover-up" href="shop-cart.html"><i class="fi fi-rr-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                Pending...
                                @endforelse
                            </div>
                        </div>
                        <!--End tab-content-->
                    </div>
                @else
                @endif

                <!--End Col-lg-9-->
            </div>
        </div>
    </section>
</section>

