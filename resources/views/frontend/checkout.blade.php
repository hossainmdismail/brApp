@extends('frontend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/radio.css') }}">
    <script src="https://use.fontawesome.com/b4564248e6.js"></script>
@endsection

@section('content')
    @livewire('frontend.checkout')
@endsection

@section('script')
    <!-- Add the following scripts for GTM data layer and Facebook Pixel -->
    <script>
        // Facebook Pixel Event for View Category
        fbq('track', 'InitiateCheckout', {
            content_ids: {{ $ids }},
            content_type: 'InitiateCheckout',
            num_items: {{ $data['total'] }},
            currency: 'BDT',
            value: {{ $data['price'] }}
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
