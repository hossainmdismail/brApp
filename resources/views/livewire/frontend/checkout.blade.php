<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('index') }}" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Your Cart
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products['products'] as $product)
                                    <tr>
                                        @if ($product->images->first())
                                            <td class="image product-thumbnail"><img src="{{ asset('files/product/' . $product->images->first()->image) }}" alt="#"></td>
                                        @endif
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="{{ route('product.view', $product->slugs) }}">{{ $product->name }}</a></h5>
                                            {{-- <p class="font-xs">Maboriosam in a tonto nesciung eget<br> distingy magndapibus.
                                            </p> --}}
                                        </td>
                                        <td class="price" data-title="Price"><span>৳ {{ $product->finalPrice }} </span></td>
                                        <td class="text-center" data-title="Stock">
                                            <div class="detail-qty border radius  m-auto">
                                                <a wire:click="decrement({{$product->id}})" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                <span wire:loading class="spinner-border spinner-border-sm"></span>
                                                <span class="qty-val" wire:loading.remove> {{ $product->quantity }}</span>
                                                <a wire:click="increment({{$product->id}})" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span>৳ {{ $product->finalPrice *$product->quantity }} </span>
                                        </td>
                                        <td class="action" data-title="Remove"><a wire:click="remove({{$product->id}})" class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                    <form wire:submit="save">
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-12">
                                <div class="row">

                                    <div class="mb-3">
                                        <div class="mb-2">
                                            <h4>Delivery Area</h4>
                                        </div>

                                        <div class="frb-group">
                                            @error('shippingPrice')
                                                <div class="mb-3" style="background: #d700000a; padding: 2px 10px 2px 10px; border-radius: 5px; border: 1px solid #DC3544;">{{ $message }}</div>
                                            @enderror
                                            @foreach ($shippings as $key => $shipping)
                                                <div class="frb frb-primary">
                                                    <input type="radio" wire:click="ship({{ $shipping->id }})" id="radio-button-{{ $key+1 }}" name="radio-button">
                                                    <label for="radio-button-{{ $key+1 }}">
                                                        <span class="frb-title">{{ $shipping->name }}</span>
                                                        <span class="frb-description">৳ {{ $shipping->price }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="mb-2">
                                            <h4>Information</h4>
                                            {{-- <p style="font-size: 12px;color: #23232399;">
                                                অর্ডার কনফার্ম করতে আপনার নাম, মোবাইল নাম্বর,ঠিকানা লিখে " Complete your order " বাটনে ক্লিক করুন।
                                            </p> --}}
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class=" input-group mb-3">
                                            <input type="text" class="form-control input-sm @error('name') is-invalid @enderror" wire:model="name" aria-label="lg" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class=" input-group mb-3">
                                            <input type="email" class="form-control input-sm @error('email') is-invalid @enderror" wire:model="email" aria-label="lg" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control input-sm @error('number') is-invalid @enderror" wire:model="number" aria-label="lg" placeholder=" 017xxxxxxxx">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        {{-- <label for="">Address</label> --}}
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control input-sm @error('address') is-invalid @enderror" wire:model="address" aria-label="lg" placeholder="Address ( থানা+জেলা )">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <textarea type="text" class="form-control input-sm" wire:model="message" placeholder="Messages" rows="10" cols="50"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="mb-3">
                                    <div class="mb-2">
                                        <h4>Delivery Area</h4>
                                    </div>
                                </div>
                                <div class=" border-radius cart-totals">
                                    @error('cart')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">৳{{ $products['price'] }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Shipping</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i>৳{{ $shippingPrice }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">৳{{ $total }}</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Complete your order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
