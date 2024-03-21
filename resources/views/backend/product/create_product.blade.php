@extends('backend.master')

@section('style')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
@endsection

@section('content')
    <section class="content-main">
        @if (session('succ'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('succ') }}</li>
                </ul>
            </div>
        @endif
        @if (session('err'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('err') }}</li>
                </ul>
            </div>
        @endif

        <div class="row">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- button --}}
                <div class="col-12">
                    <div class="content-header">
                        <h2 class="content-title">Add New Product</h2>
                        <div>
                            <a class="btn btn-md btn-primary mr-5 font-sm hover-up" href="{{ route('product.index') }}">Product list</a>
                            <button type="submit" name="btn" value="deactive"
                                class="btn btn-light rounded font-sm mr-5 text-body hover-up">Save to draft</button>
                            <button type="submit" name="btn" value="active"
                                class="btn btn-md rounded font-sm hover-up">Publich</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Left --}}
                    <div class="col-md-8">
                        {{-- Basic --}}
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4>Basic</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Select A Category</label>
                                                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                                    <option value="">Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Product Name</label>
                                                <input type="text" placeholder="Entire Name" class="form-control @error('product_name') is-invalid @enderror"
                                                    name="product_name" value="{{ old('product_name') }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Short Description</label>
                                                <textarea class="form-control  @error('short_description') is-invalid @enderror" name="short_description" id="" cols="30" rows="10"
                                                    placeholder="Short details"> {{ old('short_description') }}</textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label @error('description') text-danger @enderror">Description @error('description') is required * @enderror</label>
                                                <textarea id="description" class="form-control" name="description" cols="30" rows="10"
                                                    placeholder="Short details">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- card end// -->
                        </div>

                        {{-- SEO --}}
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>SEO Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">SEO Titile</label>
                                                <input type="text" placeholder="Entire Email" class="form-control"
                                                    name="seo_title" value="{{ old('seo_title') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">SEO Tags</label>
                                                <input type="text" placeholder="Entire Tags"
                                                    value="{{ old('seo_tags') }}" class="form-control" name="seo_tags">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">SEO Description</label>
                                                <textarea class="form-control" name="seo_description" id="" cols="30" rows="10">{{ old('seo_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Right --}}
                    <div class="col-md-4">
                        {{-- Pricing --}}
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Pricing / Features</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Stock price</label>
                                        <input type="number" placeholder="0.00" class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('stk_price') }}" name="stk_price">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Selling price</label>
                                        <input type="number" placeholder="0.00" class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price') }}" name="price">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Discount %</label>
                                        <input type="number" placeholder="0%" class="form-control"
                                            value="{{ old('discount') }}" name="discount">
                                    </div>
                                </div>

                                {{-- Quantity --}}
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Stock Qnt</label>
                                    <input type="number" placeholder="Quantity" class="form-control @error('qnt') is-invalid @enderror"
                                            value="{{ old('qnt') }}" name="qnt">
                                </div>

                                <hr>
                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="checkFeatured">Feature</label>
                                        <input class="form-check-input" name="featured" type="checkbox"
                                            id="checkFeatured">
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="checkPopular">Popular</label>
                                        <input class="form-check-input" name="popular" type="checkbox"
                                            id="checkPopular">
                                    </div>
                                </div>
                                <hr>

                                <div class="col-12">
                                    <div class="mb-4">
                                        @error('service')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                        <label for="product_name" class="form-label">Services</label>

                                        <div class="mt-2">
                                            @foreach ($services as $service)
                                                <div class="form-check">
                                                    <input class="form-check-input" name="service[]" type="checkbox"
                                                        value="{{ $service->id }}" id="{{ $service->id }}">
                                                    <label class="form-check-label" style="font-size: 10.5px"
                                                        for="{{ $service->id }}">
                                                        {{ $service->message }} </label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        {{-- Media --}}
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Media</h4>
                            </div>
                            <div class="card-body">
                                <div class="input-upload mb-4">
                                    <img src=" {{ asset('backend/assets/imgs/theme/upload.svg') }}" alt="">
                                    <input class="form-control" type="file" name="images[]" multiple
                                        accept="image/*">
                                    @error('images')
                                        <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>


                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Video Link</label>
                                    <input type="text" placeholder="https://" class="form-control" name="link">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection


@section('script')
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ))
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection
