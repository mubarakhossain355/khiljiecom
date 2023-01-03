@extends('backend.layouts.master')

@section('title')
    Category Create
@endsection
@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('admin.content')
    <div class="row">
        <h2>Category Create Form</h2>
        <div class="col-md-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('category.index') }}" class="btn btn-primary">
                    <i class="fa fa-backward"></i>
                    Back to Categories
                </a>
            </div>
        </div>

        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Category Title</label>
                            <input type="text" name="title" class="form-control @error('title')is-invalid @enderror" id="exampleFormControlInput1" placeholder="category title">
                                 @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="mb-3">
                            <label for="client-image" class="form-label">Category Image</label>
                            <input type="file" name="category_image" class="form-control dropify @error('category_image')is-invalid @enderror" id="exampleFormControlInput1" placeholder="category image">
                                 @error('category_image')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Active/ Inactive</label>
                                 @error('status')
                                    <span class="invalid-feedback" role="alert">
                                     <strong>{{$message}}</strong>
                                    </span>
                                 @enderror
                      </div>


                      <div class="mt-5">
                        <button type="submit" class="btn btn-success">Save</button>
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
