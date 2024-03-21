@extends('frontend.layouts.app')

@section('content')
@livewire('frontend.shop')
@endsection
@section('script')
    <script>
        // Google Tag Manager Data Layer for Page View
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'pageView',
            'pageType': 'shop',  // Custom variable indicating page type
            'pageTitle': 'Shop',  // Custom variable for page title
            // Add other relevant information specific to your page view
        });

        // Facebook Pixel Event for Page View
        fbq('track', 'PageView', {
            content_type: 'shop',
            content_category: 'shop',
            // Add other relevant parameters
        });
    </script>
@endsection
