@extends('backend.master')

@section('style')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <style>
        label.form-label.w-full {
            width: 100%;
            /* background: aqua; */
            height: 120px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px dotted #a7a7a7;
            cursor: pointer;
        }

        label.form-label.w-full:hover {
            background: #d1d0d0b5;
            transition-duration: 0.200s;
            transition-timing-function: ease-in-out;
        }

        .contentFit {
            height: fit-content;
        }
    </style>
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $key => $error)
                        <li>{{ $key . '.' . $error }}</li>
                    @endforeach
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
                            <a class="btn btn-md btn-primary mr-5 font-sm hover-up"
                                href="{{ route('product.index') }}">Product list</a>
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
                                                <select class="form-select @error('category_id') is-invalid @enderror"
                                                    name="category_id">
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
                                                <input type="text" placeholder="Entire Name"
                                                    class="form-control @error('product_name') is-invalid @enderror"
                                                    name="product_name" value="{{ old('product_name') }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="product_name"
                                                    class="form-label @error('description') text-danger @enderror">Description
                                                    @error('description')
                                                        is *
                                                    @enderror
                                                </label>
                                                <textarea id="description" class="form-control" name="description" cols="30" rows="10"
                                                    placeholder="Short details">{{ old('description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Short Description</label>
                                                <textarea class="form-control  @error('short_description') is-invalid @enderror" name="short_description" id=""
                                                    cols="30" rows="10" placeholder="Short details"> {{ old('short_description') }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- card end// -->
                        </div>

                        {{-- Attributes --}}
                        {{-- <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4>Attributes</h4>
                                </div>
                                <div class="card-body">
                                    <div class="accordion mb-3" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header d-flex gap-3 align-items-center" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Attributes #1
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="mb-4">
                                                                <div class="input-upload mb-4">
                                                                    <img src=" {{ asset('backend/assets/imgs/theme/upload.svg') }}"
                                                                        alt="">
                                                                    <input class="form-control" type="file"
                                                                        name="product_image[]" multiple accept="image/*">
                                                                    @error('product_image')
                                                                        <div class="text-danger">{{ $message }}*</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <div class="row">
                                                                <div class="mb-4 col-12">
                                                                    <label for="product_name"
                                                                        class="form-label">SKU</label>
                                                                    <input type="text" placeholder="Entire Name"
                                                                        class="form-control @error('sku.0') is-invalid @enderror"
                                                                        name="sku[]">
                                                                </div>
                                                                <div class="mb-4 col-md-6">
                                                                    <label for="product_name"
                                                                        class="form-label">Color</label>
                                                                    <select name="color_id[]"
                                                                        class="form-select @error('color_id.0') is-invalid @enderror"
                                                                        id="">
                                                                        <option value="">Select Color</option>
                                                                        @forelse ($colors as $color)
                                                                            <option value="{{ $color->id }}">
                                                                                {{ $color->name }}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                                <div class="mb-4 col-md-6">
                                                                    <label for="product_name"
                                                                        class="form-label">Size</label>
                                                                    <select name="size_id[]" id=""
                                                                        class="form-select @error('size_id.0') is-invalid @enderror">
                                                                        <option value="">Select Size</option>
                                                                        @forelse ($sizes as $size)
                                                                            <option value="{{ $size->id }}">
                                                                                {{ $size->name }}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                                <hr>
                                                                <div class="mb-4 col-md-6">
                                                                    <label for="price" class="form-label">Price</label>
                                                                    <input type="text" placeholder="Entire Name"
                                                                        class="form-control @error('price.0') is-invalid @enderror"
                                                                        name="price[]">
                                                                </div>
                                                                <div class="mb-4 col-md-6">
                                                                    <label for="stock_price" class="form-label">Stock
                                                                        Price</label>
                                                                    <input type="number" placeholder="Entire Name"
                                                                        class="form-control @error('stock_price.0') is-invalid @enderror"
                                                                        name="stock_price[] ">
                                                                </div>
                                                                <div class="mb-4 col-md-6">
                                                                    <label for="s_price" class="form-label">Discount
                                                                        Price</label>
                                                                    <input type="number" placeholder="Entire Name"
                                                                        class="form-control @error('s_price.0') is-invalid @enderror"
                                                                        name="s_price[]">
                                                                </div>
                                                                <div class="mb-4 col-md-6">
                                                                    <label for="product_name"
                                                                        class="form-label">Type</label>
                                                                    <select name="sp_type[]" id=""
                                                                        class="form-control @error('sp_type.0') is-invalid @enderror">
                                                                        <option value="">Discount Type</option>
                                                                        <option value="Fixed">Fixed</option>
                                                                        <option value="Percentage">Percentage</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-4 col-md-6">
                                                                    <label for="qnt"
                                                                        class="form-label">Quantity</label>
                                                                    <input type="number" placeholder="0"
                                                                        class="form-control @error('qnt.0') is-invalid @enderror"
                                                                        name="qnt[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" id="addVariant">Add
                                        variant</button>
                                </div>
                            </div>
                        </div> --}}

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
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" placeholder="Entire Name"
                                            class="form-control @error('price') is-invalid @enderror" name="price"
                                            value="{{ old('price') }}">
                                    </div>
                                    <div class="mb-4 col-md-6">
                                        <label for="stock_price" class="form-label">Stock
                                            Price</label>
                                        <input type="number" placeholder="Entire Name"
                                            class="form-control @error('stock_price') is-invalid @enderror"
                                            name="stock_price" value="{{ old('stock_price') }}">
                                    </div>
                                    <div class="mb-4 col-md-6">
                                        <label for="s_price" class="form-label">Discount
                                            Price</label>
                                        <input type="number" placeholder="Entire Name"
                                            class="form-control @error('s_price') is-invalid @enderror" name="s_price"
                                            value="{{ old('s_price') }}">
                                    </div>
                                    <div class="mb-4 col-md-6">
                                        <label for="product_name" class="form-label">Type</label>
                                        <select name="sp_type" id=""
                                            class="form-control @error('sp_type') is-invalid @enderror">
                                            <option value="">Discount Type</option>
                                            <option value="Fixed" @if (old('sp_type') == 'Fixed') selected @endif>Fixed
                                            </option>
                                            <option value="Percent" @if (old('sp_type') == 'Percent') selected @endif>
                                                Percentage
                                            </option>
                                        </select>
                                    </div>
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
                                </div>
                            </div>
                        </div>

                        {{-- Media --}}
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Media</h4>
                            </div>
                            <div class="card-body">
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
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        let valueOfVariant = 0; // Declare properly using let

        document.getElementById('addVariant').addEventListener('click', function() {
            // Clone the first accordion item
            const firstAccordionItem = document.querySelector('.accordion-item');
            const clonedAccordionItem = firstAccordionItem.cloneNode(true);

            // Update accordion header and body IDs and text
            const accordionHeader = clonedAccordionItem.querySelector('.accordion-header');
            const accordionCollapse = clonedAccordionItem.querySelector('.accordion-collapse');
            const headingId = 'heading' + (valueOfVariant + 1); // Concatenate number properly
            const collapseId = 'collapse' + (valueOfVariant + 1); // Concatenate number properly
            const button = accordionHeader.querySelector('button');

            accordionHeader.id = headingId;
            accordionHeader.setAttribute('aria-labelledby', headingId);
            accordionHeader.querySelector('button').textContent = 'Attributes #' + (valueOfVariant +
                1); // Concatenate number properly
            button.setAttribute('data-bs-target', '#' + collapseId); // Include '#' in data-bs-target
            button.setAttribute('aria-controls', collapseId);

            accordionCollapse.id = collapseId;
            accordionCollapse.setAttribute('aria-labelledby', headingId);
            accordionCollapse.classList.remove('show');

            // Append the cloned accordion item to the accordion
            document.getElementById('accordionExample').appendChild(clonedAccordionItem);

            valueOfVariant++;

            if (document.querySelectorAll('.accordion-item').length > 1) {
                const deleteButton = document.createElement('button');
                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'delete-btn', 'contentFit');
                deleteButton.type = 'button';
                deleteButton.type = 'button';
                deleteButton.textContent = 'Delete';
                deleteButton.addEventListener('click', function() {
                    // Find the parent accordion item
                    const accordionItem = deleteButton.closest('.accordion-item');
                    // Remove the accordion item from the DOM
                    accordionItem.remove();
                });
                accordionHeader.appendChild(deleteButton);
            }
        });
    </script>
@endsection
