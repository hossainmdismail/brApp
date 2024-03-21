


<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{route('checkout')}}">
        <img alt="Evara" src="{{ asset('frontend') }}/imgs/theme/icons/icon-cart.svg">
        <span class="pro-count blue">{{ $total }}</span>
    </a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            {{-- {{ $products }} --}}
            @foreach ($products as $product)
                <li>
                    <div class="shopping-cart-img">


                        @if ($product->images->first())
                            <a href="#"><img alt="Evara"
                                src="{{ asset('files/product/' . $product->images->first()->image) }}">
                            </a>
                        @endif

                    </div>
                    <div class="shopping-cart-title">
                        <h4><a href="#">{{ $product->name }}</a></h4>
                        <h4><span>{{ $product->quantity }} × </span>{{ $product->finalPrice }} ৳</h4>
                    </div>
                    <div class="shopping-cart-delete">
                        <a wire:click="remove({{$product->id}})"><i class="fi-rs-cross-small"></i></a>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
                <h4>Total <span wire:loading.remove>৳ {{ $price }}</span> <span wire:loading class="spinner-border spinner-border-sm"></span></h4>
            </div>
            <div class="shopping-cart-button">
                <a href="{{route('checkout')}}" class="outline">View cart</a>
                <a href="{{route('checkout')}}">Checkout</a>
            </div>
        </div>
    </div>
</div>
