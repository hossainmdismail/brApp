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
        <form method="POST" action="{{ route('addtocart') }}">
            @csrf
            <input type="hidden" name="qnt" id="inputQntValue" value="1">
            <input type="hidden" name="id" class="inputQntValue" value="{{ $product->id }}">
            <div class="product-action-1">
                <button type="submit" name="btn" value="cart" aria-label="Add To Cart" class="action-btn hover-up"><i class="fi-rs-shopping-bag-add"></i></button>
                <a href="{{ route('product.view', $product->slugs) }}" aria-label="Quick view" class="action-btn hover-up" ><i class="fi-rs-eye"></i></a>
            </div>
        </form>
            {{-- wire:click="addToCart({{ $product->id }},1)" --}}

        <div class="product-badges product-badges-position product-badges-mrg">
            @if ($product->featured == 1)
                <span class="hot">
                    Featured
                </span>
            @elseif ($product->popular == 1)
                <span class="new">
                    Popular
                </span>
            @endif
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
    {{-- <div class="product-content-wrap d-lg-block d-none">
        <a href="{{ route('product.view', $product->slugs) }}" class="btn btn-sm btn-primary" style="width: 100%"> Order now </a>
    </div> --}}
</div>
