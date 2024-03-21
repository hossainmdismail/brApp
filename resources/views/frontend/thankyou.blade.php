@extends('frontend.layouts.app')

@section('content')
<main class="main page-404">
    <div class="container">
        <div class="row align-items-center height-100vh text-center">
            <div class="col-lg-8 m-auto">
                <p class="mb-50"><img src="{{ asset('thankyou.webp') }}" alt="" class="hover-up"></p>
                {{-- <h2 class="mb-30">Page Not Found</h2> --}}
                <p class="font-lg text-grey-700 mb-30">
                    If you have any questions or need assistance, feel free to reply to this email or contact our customer support at.
                    thank you for being a valued customer. We look forward to serving you again!
                </p>
                <form class="contact-form-style text-center" >

                    <a class="btn btn-default submit-auto-width font-xs hover-up" href="{{ route('index') }}">Back To Home Page</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
    <!-- Add the following scripts for GTM data layer and Facebook Pixel -->
@if (session('data'))
    <script>
        // Facebook Pixel Event for View Category
        fbq('track', 'Purchase', {
            content_ids: {{ session('ids') }},
            content_type: 'Purchase',
            num_items: {{ session('data')['total'] }},
            currency: 'BDT',
            value: {{ session('data')['price'] }}
        });
    </script>
@endif
@endsection
