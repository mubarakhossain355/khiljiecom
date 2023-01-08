@extends('backend.layouts.master')

@section('title')
    Coupon Edit
@endsection
@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('admin.content')
    <div class="row">
        <h2>Coupon Edit Form</h2>
        <div class="col-md-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('coupon.index') }}" class="btn btn-primary">
                    <i class="fa fa-backward"></i>
                    Back to Coupons
                </a>
            </div>
        </div>

        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('coupon.update',$coupon->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="coupon-name" class="form-label">Coupon Name</label>
                            <input type="text" name="coupon_name" value="{{$coupon->coupon_name}}" class="form-control @error('coupon_name')is-invalid @enderror" id="coupon-name" placeholder="coupon name">
                                 @error('coupon_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="mb-3">
                            <label for="discount-percentage" class="form-label">Discount Percentage</label>
                            <input type="number" name="discount_amount" value="{{$coupon->discount_amount}}" min="0" class="form-control  @error('discount_amount')is-invalid @enderror" id="discount-percentage" placeholder="discount percentage">
                                 @error('discount_amount')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="mb-3">
                            <label for="minimum-purchase-amount" class="form-label">Minimum Purchase Amount</label>
                            <input type="number" name="minimum_purchase_amount" value="{{$coupon->minimum_purchase_amount}}" min="0" class="form-control  @error('minimum_purchase_amount')is-invalid @enderror" id="minimum-purchase-amount" placeholder="minimum purchase amount">
                                 @error('minimum_purchase_amount')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="mb-3">
                            <label for="validity-till" class="form-label">Validity</label>
                            <input type="date" name="validity_till" value="{{$coupon->validity_till}}" class="form-control  @error('validity_till')is-invalid @enderror" id="validity-till" placeholder="validity">
                                 @error('validity_till')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="is_active" type="checkbox" id="flexSwitchCheckChecked"
                            @if ($coupon->is_active)
                            checked
                            @endif
                           >
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
