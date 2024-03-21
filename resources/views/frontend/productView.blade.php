@extends('frontend.layouts.app')
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> {{ $product->name }}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            @if (session('err'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ session('err') }}</li>
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        @foreach ($product->images as $key => $image)
                                            <figure class="border-radius-10">
                                                <img src="{{ asset('files/product/'.$image->image) }}" alt="product image">
                                            </figure>
                                        @endforeach
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @foreach ($product->images as $key => $image)
                                            <div><img src="{{ asset('files/product/'.$image->image) }}" alt="product image"></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail">{{ $product->name }}</h2>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand">৳ {{ $product->finalPrice }}</span></ins>
                                            <ins><span class="old-price font-md ml-15">{{ $product->price }}</span></ins>
                                            <span class="save-price  font-md color3 ml-15">{{ $product->discount }}% Off</span>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p>{{ $product->short_description }}</p>
                                    </div>
                                    <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            @if ($product->services)
                                                @foreach ($product->services as $service)
                                                    <li class="mb-10"><i class="fi-rs-crown mr-5"></i> {{ $service->service?$service->service->message:null }}</li>
                                                @endforeach
                                            @endif
                                            {{-- <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li>
                                            <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li> --}}
                                        </ul>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <form class="detail-extralink" method="POST" action="{{ route('addtocart') }}">
                                        @csrf
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val" >1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <input type="hidden" name="qnt" id="inputQntValue" value="1">
                                        <input type="hidden" name="id" class="inputQntValue" value="{{ $product->id }}">
                                        <div class="w-100 d-flex gap-3 flex-sm-row flex-column">
                                            <button type="submit" name="btn" value="cart"  class=" button d-block mb-md-3 button-add-to-cart">Add to cart</button>
                                            <button type="submit" name="btn" value="buy" class=" button d-block mb-3 button-add-to-cart">Order Now</button>
                                            {{-- <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a> --}}
                                        </div>
                                    </form>
                                    @if ($config)
                                        <a href="tel:{{ $config->number }}" class="btn btn-outline btn-sm text-primary">Call Us : {{ $config->number }}</a>
                                    @endif

                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li>SKU :<span class="in-stock text-black ml-5">{{ $product->sku }}</span></li>
                                        <li>Availability :<span class="in-stock text-{{ $product->qnt > 0 ? 'success':'danger' }} ml-5">{{ $product->qnt  }} Available</span></li>
                                    </ul>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    ক্যাশ অন ডেলিভারি - প্রডাক্ট হাতে পেয়ে মূল্য পরিশোধ করবেন <br>

                                    ৭২ ঘণ্টার মধ্যে সারা বাংলাদেশে হোম ডেলিভারি<br>

                                    Delivery time: 24 or 48 hours.<br>

                                    ১০০ % অরিজিনাল প্রডাক্ট এবং যে কোনো সমস্যায় শতভাগ সমাধানের নিশ্চয়তা<br>

                                     রিটার্ন এবং রি-ফান্ড পলিসিঃ<br>

                                    আমরা Smart Bazar এর মাধ্যমে যেহেতু ঢাকা সহ সারা বাংলাদেশ এ ডেলিভারি করে থাকি, যদি কোন প্রকার সমস্যা হয় যেমনঃ কালার বা ডিজাইনের কোন সমস্যা অথবা একটা প্রডাক্ট এর জায়গায় অন্য একটা প্রডাক্ট চলে যাওয়া অথবা প্রডাক্টে কোন সমস্যা থাকে, আপনি ২৪ ঘন্টার মধ্যে আমাদের সাথে যোগাযোগ করবেন এবং আপনার সমস্যাটি আমাদেরকে বললে আমাদের কাছে যদি উক্ত প্রডাক্টটি stock এ থাকে তখন আমরা আপনাদের হাতে উক্ত প্রডাক্ট টি পৌঁছে যাবে ৫ কর্মদিবসের মধ্যে এবং উক্ত প্রডাক্ট টি যদি available না থাকে সে ক্ষেত্রে আমরা ৫ কর্মদিবসের মধ্যে বিকাশ বা ব্যাংকের মাধ্যমে আপনার টাকা আপনার কাছে পৌছে দিব।
                                    <br>


                                    বিশেষ দ্রষ্টব্যঃ<br>



                                    ২৪ ঘন্টার মধ্যে যোগাযোগ না করা হলে, সেক্ষেত্রে আপনার কোন অভিযোগ ই গ্রহনযোগ্য হবে না।



                                    প্রডাক্ট এর কোন সমস্যা ব্যাতিতো আমরা কখনই প্রডাক্ট রিটার্ন বা এক্সচেঞ্জ করে থাকিনা।
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Related products</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    @if ($related)
                                        @foreach ($related as $product)
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <x-product :product="$product"/>
                                        </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('script')
    <!-- Add the following scripts for GTM data layer and Facebook Pixel -->
    <script>
        // Google Tag Manager Data Layer for View Content
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'viewContent',
            'pageType': 'product',
            'pageTitle': '{{ $product->name }}',
            'contentId': '{{ $product->id }}',
            'contentName': '{{ $product->name }}',   // Additional: Product name
            'contentCategory': '{{ $product->category ? $product->category->category_name : 'Uncategorized' }}',
            'contentList': '{{ $product->category ? $product->category->category_name : 'Uncategorized' }}',
            'contentPrice': '{{ $product->finalPrice }}',  // Additional: Final price of the product
            'contentQuantity': 1,  // Additional: Quantity viewed (default is 1)
            'stockStatus': '{{ $product->stock_status == 1 ? 'In Stock' : 'Out of Stock' }}',
            'currency': 'BDT',
            // Add other relevant information specific to your content view
        });

        // Facebook Pixel Event for View Content
        fbq('track', 'ViewContent', {
            content_ids: ['{{ $product->id }}'],
            content_name: '{{ $product->name }}',
            content_category: '{{ $product->category ? $product->category->category_name : 'Uncategorized' }}',
            content_type: 'product',
            content_list: '{{ $product->category ? $product->category->category_name : 'Uncategorized' }}',
            value: '{{ $product->finalPrice }}',
            currency: 'BDT',
            num_items: 1,
            'content_status': '{{ $product->stock_status == 1 ? 'In Stock' : 'Out of Stock' }}',
        });
    </script>
    @if (session('add'))
        <script>
            fbq('track', 'AddToCart', {
                content_ids: ['{{ session('add')->id }}'],
                content_name: '{{ session('add')->name }}',
                content_category: '{{ session('add')->category ? session('add')->category->category_name : 'Uncategorized' }}',
                content_type: 'product',
                content_list: '{{ session('add')->category ? session('add')->category->category_name : 'Uncategorized' }}',
                value: '{{ session('add')->finalPrice }}',
                currency: 'BDT',
                num_items: {{ session('qnt') }},
            });
        </script>
    @endif

@endsection
