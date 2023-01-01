@extends('backend.layouts.master')

@section('title')
    Category Edit
@endsection
@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('admin.content')
    <div class="row">
        <h2>Category Edit Form</h2>
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
                    <form action="{{route('category.update',$category->slug)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Category Title</label>
                            <input type="text" name="title" value="{{$category->title}}" class="form-control @error('title')is-invalid @enderror" id="exampleFormControlInput1" placeholder="category title">
                                 @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="is_active" type="checkbox" id="flexSwitchCheckChecked" @if ($category->is_active)
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

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('admin_script')

@endpush
