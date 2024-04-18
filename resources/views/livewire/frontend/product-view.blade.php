<div class="col-md-8 col-sm-12 col-xs-12">
    <div class="detail-info">
        <h2 class="title-detail">{{ $product->name }}</h2>

        <div class="product-detail-rating">
            <div class="pro-details-brand">
                <span><a
                        href="#">{{ $product->category ? $product->category->category_name : 'Unknown' }}</a></span>
            </div>
            <div class="product-rate-cover text-end">
                <div class="product-rate d-inline-block">
                    <div class="product-rating" style="width:90%">
                    </div>
                </div>
                <span class="font-small ml-5 text-muted"> (25 reviews)</span>
            </div>
        </div>

        <div class="clearfix product-price-cover">
            <div class="product-price primary-color float-left">
                <ins><span class="text-brand">৳
                        {{ $product->getFinalPrice() }}</span></ins>
                <ins><span class="old-price font-md ml-15">৳{{ $product->price }}</span></ins>
                @if ($product->sp_type != 'Fixed')
                    <span class="save-price  font-md color3 ml-15">
                        {{ $product->sp_type == 'Fixed' ? '' : $product->s_price . '% Off' }}</span>
                @endif
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
                        <li class="mb-10"><i class="fi-rs-crown mr-5"></i>
                            {{ $service->service ? $service->service->message : null }}</li>
                    @endforeach
                @endif
                {{-- <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li>
            <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li> --}}
            </ul>
        </div>
        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
        <form wire:submit.prevent="addToCart">
            @csrf
            {{-- Color --}}
            @error('color_id')
                <span class="error text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
            <div class="attr-detail attr-color mb-15">
                <strong class="mr-10">Color</strong>
                <ul class="list-filter color-filter">
                    @foreach ($product->getUniqueColors() as $color)
                        {{-- @if ($color->color) --}}
                        <li class="{{ $color_id == $color->id ? 'active' : '' }}"><a
                                wire:click="sizeByColor({{ $color->id }})" data-color="black"><span
                                    class="product-color-red active" style="background: {{ $color->code }}">
                                </span></a></li>
                        {{-- @endif --}}
                    @endforeach
                </ul>
            </div>
            {{-- Size --}}
            @error('size_id')
                <span class="error text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
            <div class="attr-detail attr-size mb-15">
                <strong class="mr-10">Size</strong>
                <ul class="list-filter size-filter font-small">
                    @foreach ($sizes as $attr)
                        <li class="{{ $size_id == $attr->id ? 'active' : '' }}"><a
                                wire:click="sizeAction({{ $attr->id }})">{{ $attr->name }}</a></li>
                    @endforeach
                    <li wire:loading wire:target="sizeByColor">...</li>
                </ul>
            </div>
            <div class="detail-extralink">
                <div class="mb-3">
                    @error('quantity')
                        <span class="error text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                    {{-- <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                    <span class="qty-val">1</span>
                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a> --}}
                    <input type="number" id="inputQntValue" wire:model="quantity" min="1" max="50">
                </div>
                {{-- <input type="number" name="id" class="inputQntValue" value="{{ $product->id }}"> --}}
                <div class="w-100 d-flex gap-3 flex-sm-row flex-column">
                    <button type="submit" wire:model="bnt" value="cart"
                        class=" button d-block mb-md-3 button-add-to-cart">Add to cart</button>
                    <button type="submit" wire:model="bnt" value="buy"
                        class=" button d-block mb-3 button-add-to-cart">Order Now</button>
                    {{-- <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a> --}}
                </div>
                </d>
                {{-- @if ($config)
                <a href="tel:{{ $config->number }}" class="btn btn-outline btn-sm text-primary">Call Us :
                    {{ $config->number }}</a>
            @endif --}}

                <ul class="product-meta font-xs color-grey mt-50">
                    <li>SKU :<span class="in-stock text-black ml-5">{{ $product->sku }}</span></li>
                    <li>Availability :<span
                            class="in-stock text-{{ $product->qnt > 0 ? 'success' : 'danger' }} ml-5">{{ $product->qnt }}
                            Available</span></li>
                </ul>
            </div>
        </form>
        <!-- Detail Info -->
    </div>
