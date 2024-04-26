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
                <span class="font-small ml-5 text-muted"> ({{ count($product->comments) }}) reviews</span>
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
            </ul>
        </div>
        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
        <form wire:submit.prevent="addToCart">
            @csrf
            {{-- Color --}}
            @error('err')
                <div class="mb-3"
                    style="background: #d700000a; padding: 2px 10px 2px 10px; border-radius: 5px; border: 1px solid #DC3544;">
                    {{ $message }}</div>
            @enderror
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
                    <input type="number" id="inputQntValue" wire:model="quantity" min="1" max="50">
                </div>
                <div class="w-100 d-flex gap-3 flex-sm-row flex-column">
                    <button type="submit" wire:model="bnt" value="cart"
                        class=" button d-block mb-md-3 button-add-to-cart">Add to cart
                        <span wire:loading wire:target="addToCart">...</span></button>
                    <button type="submit" wire:click="orderNow" class=" button d-block mb-3 button-add-to-cart">Order
                        Now</button>
                </div>
                </d>

                <ul class="product-meta font-xs color-grey mt-50">
                    <li>SKU :<span class="in-stock text-black ml-5">{{ $sku }}</span></li>
                    <li>Availability :
                        @if ($stock == 0)
                            <span
                                class="in-stock text-{{ $product->stock() > 0 ? 'success' : 'danger' }} ml-5">{{ $product->stock() }}
                                Available</span>
                        @else
                            <span class="in-stock text-success ml-5">{{ $stock }}
                                Available</span>
                        @endif


                    </li>
                </ul>
            </div>
        </form>
        <!-- Detail Info -->
    </div>
