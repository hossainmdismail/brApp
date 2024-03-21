@extends('backend.master')
@section('content')
<section class="content-main">
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @livewire('backend.addcampaign',['id' => $request->id])
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">+ Add</button>
            </div> --}}
          </div>
        </div>
      </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Edit Campaign</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                      </button>
                      <a href="{{ route('campaign.index') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('campaign.update', $request->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Campaign For</label>
                                    <input type="text" placeholder="Entire Name" class="form-control" name="campaign_for" value="{{ $request->campaign_for }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Campaign Name</label>
                                    <input type="text" placeholder="Entire Name" class="form-control" name="campaign_name" value="{{ $request->campaign_name }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Start</label>
                                    <input type="date" placeholder="Entire Email" class="form-control" name="start" value="{{ $request->start }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">End</label>
                                    <input type="date" placeholder="Entire Email" class="form-control" name="end" value="{{ $request->end }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Percentage</label>
                                    <input type="number" class="form-control" name="percentage" value="{{ $request->percentage }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Campaign Image</label>
                                    <input type="file" class="form-control" name="campaign_image">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="product_name" class="form-label">Image type</label>
                                <select class="form-select" name="image_type" id="">
                                    <option value="">Select Type</option>
                                    <option value="horizontal"><sup>(966*542)</sup> Horizontal</option>
                                    <option value="vertical"><sup>(600*712)</sup> Vertical</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label"></label>
                                    <button type="submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">+ Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- card end// -->
            @if ($request->products && $request->products->count() != 0)
                <div class="card">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="cam_id" value="{{ $request->id }}">
                        <div class="table-responsive">
                            <table class="table table-hover mb-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        {{-- <th scope="col">Category Name</th> --}}
                                        <th scope="col">Image</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($request->products as $key => $value)
                                    <tr>
                                        <td><b>{{ $value->name }}</b></td>
                                        {{-- <td><b>{{ $request->category ? $request->category->category_name : 'Unknow' }}</b></td> --}}
                                        <td>
                                            @if ($value->images != null)
                                            @foreach ($value->images as $img)
                                            <img class="rounded" style="width: 30px; height: 30px;"
                                            src="{{ asset('files/product/' . $img->image) }}" alt="">
                                            @endforeach
                                            @endif
                                        </td>
                                        <td><b> <span>৳</span> {{ $value->price }} </b></td>
                                        <form action="{{ route('campaign.product') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cam_id" value="{{ $request->id }}">
                                            <input type="hidden" name="pro_id" value="{{ $value->id }}">
                                            <td><button class="btn btn-primary" type="submit">remove</button></td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- table-responsive //end -->
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
