@extends('frontend.layouts.app')

@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('index') }}" rel="nofollow">Home</a>
                <span></span> Campaign
                <span></span> {{ $campaign->campaign_name }}
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
                            <div class="sort-by-cover mr-10">
                                {{-- <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> {{ $paginateCount != null? $paginateCount:10 }} <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div> --}}

                            </div>

                        </div>
                    </div>

                    <div class="row product-grid-3">
                        @if ($products)
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-4 col-12 col-sm-6">
                                    <x-product :product="$product"/>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            {{-- {{ $products->links('livewire::bootstrap') }} --}}
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
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
