@extends('backend.master')
@section('style')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <section class="content-main">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
            <form action="{{ route('product.update', $request->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="content-header">
                        <h5 class="content-title">{{ $request->name }}</h5>
                        <div>
                            <a href="{{ route('product.index') }}" name="btn"
                                class="btn btn-md rounded font-sm hover-up">Back</a>
                            <button type="submit" name="btn" value="deactive"
                                class="btn btn-light rounded font-sm mr-5 text-body hover-up">Save to draft</button>
                            <button type="submit" name="btn" value="active"
                                class="btn btn-md rounded font-sm hover-up">Update</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
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
                                                    <select class="form-select" name="category_id">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" @if ($request->category) {{ $request->category->id == $category->id ? 'selected' : '' }} @endif>
                                                                {{ $category->category_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">Product Name </label>
                                                    <input type="text" placeholder="Entire Name" class="form-control"
                                                        name="product_name" value="{{ $request->name }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">Short Description</label>
                                                    <textarea class="form-control" name="short_description" id="" cols="30" rows="10"
                                                        placeholder="Short details"> {{ $request->short_description }}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">Description</label>
                                                    <textarea id="description" class="form-control" name="description" id="" cols="30" rows="10"
                                                        placeholder="Short details">{{ $request->description }}</textarea>
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
                                                        name="seo_title" value="{{ $request->seo_title }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">SEO Tags</label>
                                                    <input type="text" placeholder="Entire Tags"
                                                        value="{{ $request->seo_tags }}" class="form-control"
                                                        name="seo_tags">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">SEO Description</label>
                                                    <textarea class="form-control" name="seo_description" id="" cols="30" rows="10">{{ $request->seo_description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- Right --}}
                        <div class="col-md-4">
                            {{-- Stock --}}
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Stock</h4>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <table class="table border">
                                                <tr >
                                                    <td>SKU</td>
                                                    <th scope="row" style="font-weight: 800;">{{ $request->sku }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Stock history</td>
                                                    <th scope="row" style="font-weight: 800;">{{ $request->stock() }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Current stock</td>
                                                    <th scope="row" style="font-weight: 800;">{{ $request->qnt }}</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="product_name" class="form-label">Upadate stock - <span style="font-size: 12px; color:rgb(8 129 120)">"It will update current stock"</span></label>
                                            <input type="number" placeholder="0" class="form-control"
                                                 name="qnt">
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Discount %</label>
                                                <input type="number" placeholder="0%" class="form-control"
                                                    value="{{ $request->discount }}" name="discount" max="100" min="0">
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="product_name" class="form-label">Selling Price</label>
                                            <input type="number" placeholder="0.00" class="form-control"
                                                value="{{ str_replace(',', '', number_format($request->price ?? 0, 0)) }}" name="price">
                                        </div>
                                        <div class="mb-4">
                                            <label for="product_name" class="form-label">Stock price</label>
                                            <input type="number" placeholder="0.00" class="form-control"
                                                value="{{ $request->stockItem->first() ? number_format($request->stockItem->first()->stock_price,0):0 }}" name="stk_price">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Pricing --}}
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4>Service</h4>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <div class="mt-2">
                                                @if ($request->services)
                                                <ul>

                                                </ul class="list-group">
                                                    @foreach ($request->services as $service)
                                                        <li class="list-group-item">{{ $service->service?$service->service->message:'Unknown' }}</li>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            {{-- Media --}}
                            @livewire('backend.product-image', ['product_id' => $request->id])

                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4>Video</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <iframe width="100%" src="https://www.youtube.com/embed/{{ $request->link }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div>
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Video Link</label>
                                        <input type="text" placeholder="https://" value="{{ $request->link }}"
                                            class="form-control" name="link">
                                    </div>
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
