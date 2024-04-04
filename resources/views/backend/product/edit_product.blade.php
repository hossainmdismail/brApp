@extends('backend.master')
@section('style')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <!-- Modal Color add -->
    <div class="modal fade show" id="attr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attributes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('attributes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <div class="modal-body row">
                        <div class="row">
                            <div class="mb-4 col-12">
                                <label for="product_name" class="form-label">Product Image</label>
                                <input type="file" class="form-control @error('sku') is-invalid @enderror"
                                    name="image">
                            </div>
                            <div class="mb-4 col-12">
                                <label for="product_name" class="form-label">SKU</label>
                                <input type="text" placeholder="Entire Name"
                                    class="form-control @error('sku') is-invalid @enderror" name="sku">
                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="product_name" class="form-label">Color</label>
                                <select name="color_id" class="form-select @error('color_id') is-invalid @enderror"
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
                                <label for="product_name" class="form-label">Size</label>
                                <select name="size_id" id=""
                                    class="form-select @error('size_id') is-invalid @enderror">
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
                                    class="form-control @error('price') is-invalid @enderror" name="price">
                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="stock_price" class="form-label">Stock
                                    Price</label>
                                <input type="number" placeholder="Entire Name"
                                    class="form-control @error('stock_price') is-invalid @enderror" name="stock_price">
                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="s_price" class="form-label">Discount
                                    Price</label>
                                <input type="number" placeholder="Entire Name"
                                    class="form-control @error('s_price') is-invalid @enderror" name="s_price">
                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="product_name" class="form-label">Type</label>
                                <select name="sp_type" id=""
                                    class="form-control @error('sp_type') is-invalid @enderror">
                                    <option value="">Discount Type</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="qnt" class="form-label">Quantity</label>
                                <input type="number" placeholder="0"
                                    class="form-control @error('qnt') is-invalid @enderror" name="qnt">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                        <div class="col-md-6">
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
                                                            <option value="{{ $category->id }}"
                                                                @if ($request->category) {{ $request->category->id == $category->id ? 'selected' : '' }} @endif>
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
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Inventory</h4>
                                    <button class="btn btn-md btn-primary font-sm" data-bs-toggle="modal"
                                        data-bs-target="#attr" type="button">Add Inventroy</button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product Name</th>
                                                {{-- <th scope="col">Category Name</th> --}}
                                                <th scope="col">Image</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Market Status</th>
                                                <th scope="col"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ $request->name }}<br>
                                                    <strong style="font-size: 12px;"> SKU : <span
                                                            style=" font-weight: 800">{{ $request->sku }} </span></strong>
                                                </td>
                                                {{-- <td><b>{{ $request->category ? $request->category->category_name : 'Unknow' }}</b></td> --}}
                                                <td>
                                                    {{-- @if ($request->images != null)
                                                    @foreach ($request->images as $img)
                                                        <img class="rounded" style="width: 30px; height: 30px;"
                                                            src="{{ asset('files/product/' . $img->image) }}" alt="">
                                                    @endforeach
                                                @endif --}}
                                                </td>
                                                <td><b> <span>৳</span> {{ $request->price }} </b></td>
                                                <td>
                                                    <span class="badge bg-info text-dark">{{ $request->qnt }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $request->status == 'active' ? 'success' : 'warning' }}">{{ $request->status }}</span>
                                                </td>

                                                <td>
                                                    <div class="form-check form-switch">
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckDefault">Feature</label>
                                                        <input class="form-check-input"
                                                            wire:click="featured({{ $request->id }})" type="checkbox"
                                                            id="flexSwitchCheckDefault"
                                                            {{ $request->featured == 1 ? 'checked' : '' }}>
                                                    </div><br>
                                                    <div class="form-check form-switch">
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckDefault">Popular</label>
                                                        <input class="form-check-input"
                                                            wire:click="popular({{ $request->id }})" type="checkbox"
                                                            id="flexSwitchCheckDefault"
                                                            {{ $request->popular == 1 ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('product.edit', $request->id) }}"
                                                        class="badge p-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                            height="18" viewBox="0 0 24 24">
                                                            <path fill="black"
                                                                d="M2 12c0 1.64.425 2.191 1.275 3.296C4.972 17.5 7.818 20 12 20c4.182 0 7.028-2.5 8.725-4.704C21.575 14.192 22 13.639 22 12c0-1.64-.425-2.191-1.275-3.296C19.028 6.5 16.182 4 12 4C7.818 4 4.972 6.5 3.275 8.704C2.425 9.81 2 10.361 2 12"
                                                                opacity=".5" />
                                                            <path fill="currentColor" fill-rule="evenodd"
                                                                d="M8.25 12a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0m1.5 0a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
@endsection
