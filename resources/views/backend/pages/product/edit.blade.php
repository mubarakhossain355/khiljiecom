@extends('backend.layouts.master')

@section('title')
    Product Edit
@endsection
@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('admin.content')
    <div class="row">
        <h2>Product Edit Form</h2>
        <div class="col-md-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('product.index') }}" class="btn btn-primary">
                    <i class="fa fa-backward"></i>
                    Back to Products
                </a>
            </div>
        </div>

        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('product.update',$product->slug)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                        <div class="col-12 mb-3">
                            <label for="" class="form-label"> Select Category Name</label>
                            <select class="form-select" name="category_id">
                                <option selected>Open this select menu</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id == $product->category_id) selected @endif>
                                    {{ $category->title }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="name" value="{{$product->name}}" class="form-control @error('name')is-invalid @enderror" id="exampleFormControlInput1" placeholder="Product name">
                                 @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="col-6 mb-3">
                            <label for="product_name" class="form-label">Product Price</label>
                            <input type="number" name="product_price" value="{{$product->product_price}}" min="0" class="form-control @error('product_price')is-invalid @enderror" id="exampleFormControlInput1" placeholder="Product product price">
                                 @error('product_price')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="col-6 mb-3">
                            <label for="product_code" class="form-label">Product Code</label>
                            <input type="text" name="product_code" value="{{$product->product_code}}" class="form-control @error('product_code')is-invalid @enderror" id="exampleFormControlInput1" placeholder="Enter Unique Product Code">
                                 @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="col-6 mb-3">
                            <label for="product_stock" class="form-label">Product Stock</label>
                            <input type="number" name="product_stock" value="{{$product->product_stock}}" min="1" class="form-control @error('product_stock')is-invalid @enderror" id="exampleFormControlInput1" placeholder="Product product stock">
                                 @error('product_stock')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="col-6 mb-3">
                            <label for="alert-quantity" class="form-label">Alert Quantity</label>
                            <input type="number" name="alert_quantity" value="{{$product->alert_quantity}}" min="1" class="form-control @error('alert_quantity')is-invalid @enderror" id="exampleFormControlInput1" placeholder="Product alert quantity">
                                 @error('alert_quantity')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="col-12 mb-3">
                            <label for="short-description" class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control @error('short_description')is-invalid
                            @enderror" id="" cols="30" rows="5">{{$product->short_description}}</textarea>
                                @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="long-description" class="form-label">Long Description</label>
                            <textarea name="long_description" class="form-control @error('long_description')is-invalid
                            @enderror" id="" cols="30" rows="5">{{$product->long_description}}</textarea>
                                @error('long_description')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="additional-info" class="form-label">Addition Info</label>
                            <textarea name="additional_info" class="form-control @error('additional_info')is-invalid
                            @enderror" id="" cols="30" rows="5">{{$product->additional_info}}</textarea>
                                @error('additional_info')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="product-image" class="form-label">Product Image</label>
                            <input type="file" name="product_image" data-default-file="{{asset('uploads/products')}}/{{$product->product_image}}" class="form-control dropify @error('product_image')is-invalid @enderror" id="exampleFormControlInput1" placeholder="category image">
                                 @error('product_image')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="form-check form-switch m-2">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                            @if ($product->is_active)
                                checked
                            @endif>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Active/ Inactive</label>
                                 @error('status')
                                    <span class="invalid-feedback" role="alert">
                                     <strong>{{$message}}</strong>
                                    </span>
                                 @enderror
                      </div>


                      <div class="mt-5">
                        <button type="submit" class="btn btn-success">Update</button>
                      </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('.dropify').dropify();
</script>
@endpush
