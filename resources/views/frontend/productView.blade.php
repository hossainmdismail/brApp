@extends('frontend.layouts.app')

@php
    function rating($rating)
    {
        if ($rating == 1) {
            return 20;
        } elseif ($rating == 2) {
            return 40;
        } elseif ($rating == 3) {
            return 60;
        } elseif ($rating == 4) {
            return 80;
        } elseif ($rating == 5) {
            return 100;
        } else {
            return 0; // Handle invalid ratings
        }
    }
@endphp

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
            display: flex;
            justify-content: flex-end;
            padding: 23px 11px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            display: inline-block;
            font-size: 30px;
            cursor: pointer;
            color: #ccc;
        }

        .rating label:before {
            content: '\2605';
        }

        .rating label:hover:before,
        .rating input:checked~label:before {
            color: #ffcc00;
        }
    </style>
@endsection
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
                                            {{-- {{ $product->attributes }} --}}
                                            @foreach ($product->attributes as $key => $image)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset('files/product/' . $image->image) }}"
                                                        alt="product image" width="100%">
                                                </figure>
                                            @endforeach
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails pl-15 pr-15">
                                            @foreach ($product->attributes as $key => $image)
                                                <div><img src="{{ asset('files/product/' . $image->image) }}"
                                                        alt="product image"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                {{-- Product details --}}
                                @livewire('frontend.product-view', ['id' => $product->id])
                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                            href="#Description">Description</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                            href="#Additional-info">Additional info</a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews
                                            ({{ count($product->comments) }})</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Reviews">
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h4 class="mb-30">Customer questions & answers</h4>
                                                    <div class="comment-list">
                                                        @forelse ($product->comments->take(5) as $comment)
                                                            <div class="single-comment justify-content-between d-flex">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="{{ asset('avatar.webp') }}"
                                                                            alt="">
                                                                        <h6><a href="#">{{ $comment->name }}</a></h6>
                                                                        <p class="font-xxs">
                                                                            {{ $product->created_at->format('M Y') }}</p>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div class="product-rate d-inline-block">
                                                                            <div class="product-rating"
                                                                                style="width:{{ rating($comment->rating) }}">
                                                                            </div>
                                                                        </div>
                                                                        <p>{{ $comment->comment }}
                                                                        </p>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="d-flex align-items-center">
                                                                                <p class="font-xs mr-30">
                                                                                    {{ $comment->created_at->format('F j, Y \a\t g:i a') }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @livewire('frontend.comments', ['id' => $product->id])

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
                                                    <x-product :product="$product" />
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
            'contentName': '{{ $product->name }}', // Additional: Product name
            'contentCategory': '{{ $product->category ? $product->category->category_name : 'Uncategorized' }}',
            'contentList': '{{ $product->category ? $product->category->category_name : 'Uncategorized' }}',
            'contentPrice': '{{ $product->finalPrice }}', // Additional: Final price of the product
            'contentQuantity': 1, // Additional: Quantity viewed (default is 1)
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
    <script>
        const stars = document.querySelectorAll('.rating input');

        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const rating = this.value;
                highlightStars(rating);
            });

            star.addEventListener('mouseleave', function() {
                const currentRating = document.querySelector('.rating input:checked').value;
                highlightStars(currentRating);
            });
        });

        function highlightStars(rating) {
            const starLabels = document.querySelectorAll('.rating label');
            starLabels.forEach(label => {
                if (label.htmlFor <= rating) {
                    label.style.color = '#ffcc00';
                } else {
                    label.style.color = '#ccc';
                }
            });
        }
    </script>
@endsection
