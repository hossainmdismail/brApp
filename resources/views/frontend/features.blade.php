@extends('frontend.layouts.app')

@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('index') }}" rel="nofollow">Home</a>
                <span></span> Featured
                {{-- <span></span> {{ $slugs }} --}}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p> We found <strong class="text-brand"> <span wire:loading.remove>{{ $products->count() }}</span> <span wire:loading class="spinner-border spinner-border-sm text-secondary" role="status"></span></strong> items for you!</p>

                        </div>
                        <div class="sort-by-product-area">
                            {{-- <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> {{ $paginateCount != null? $paginateCount:10 }} <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" wire:click="pageFilter({{ 10 }})">10</a></li>
                                        <li><a wire:click="pageFilter({{ 20 }})">20</a></li>
                                        <li><a wire:click="pageFilter({{ 50 }})">50</a></li>
                                        <li><a wire:click="pageFilter({{ 100 }})">100</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                            {{-- <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="row product-grid-3">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-4 col-12 col-sm-6">
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
                                                <img class="default-img" src="assets/imgs/shop/product-2-1.jpg" alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-2-2.jpg" alt="">
                                            </a>
                                        </div>
                                        @if ($product->featured == 1)
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="best">Featured</span>
                                            </div>
                                        @elseif ($product->popular == 1)
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="new">Popular</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="#">{{ $product->category ? $product->category->category_name : 'Random' }}</a>
                                        </div>
                                        <h2><a href="{{ route('product.view', $product->slugs) }}">{{ $product->name }}</a></h2>
                                        {{-- <div class="rating-result" title="90%">
                                            <span>
                                                <span>90%</span>
                                            </span>
                                        </div> --}}
                                        <div class="product-price">
                                            <span>{{ $product->finalPrice }} </span>
                                            @if ($product->discount != 0)
                                                <span class="old-price">{{ $product->price }}</span>
                                            @endif
                                            {{-- <span class="old-price">$245.8</span> --}}
                                        </div>
                                        {{-- <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up" wire:click="addToCart({{ $product->id }})"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div> --}}
                                    </div>
                                    <div class="product-content-wrap">
                                        <a href="{{ route('product.view', $product->slugs) }}" class="btn btn-sm btn-primary" style="width: 100%"> Order now </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>

                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="row">
                        <div class="col-lg-12 col-mg-6"></div>
                        <div class="col-lg-12 col-mg-6"></div>
                    </div>
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                        <ul class="categories">
                            @forelse ($categories as $category)
                                <li><a href="{{ route('front.category',$category->slugs) }}">{{ $category->category_name }}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    <!-- Fillter By Price -->
                    {{-- <div class="sidebar-widget price_range range mb-30">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Fill by price</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range"></div>
                                <div class="price_slider_amount">
                                    <div class="label-input">
                                        <span>Range:</span><input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                    <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                    <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                    <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                </div>
                                <label class="fw-900 mt-15">Item Condition</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                    <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                    <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                    <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                </div>
                            </div>
                        </div>
                        <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div> --}}
                    <!-- Product sidebar Widget -->
                    <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Featured</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        @forelse ($featured as $item)
                            <div class="single-post clearfix">
                                <div class="image">
                                    @if ($item->images->first())
                                        <img src="{{ asset('files/product/' . $item->images->first()->image) }}" alt="#">
                                    @endif
                                </div>
                                <div class="content pt-10">
                                    <h5><a href="{{ route('product.view', $item->slugs) }}">{{ $item->name }}</a></h5>
                                    <p class="price mb-0 mt-5">{{ $item->name }}</p>

                                </div>
                            </div>
                        @empty
                            No Data Found
                        @endforelse
                    </div>

                    {{-- <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none">
                        <img src="{{ asset('files/campaign/'.$horizontal->campaign_image) }}" alt="">
                        <div class="banner-text">
                            <span>{{ $horizontal->campaign_for }}</span>
                            <h4>{{ $horizontal->campaign_name }}</h4>
                            <a href="shop-grid-right.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
