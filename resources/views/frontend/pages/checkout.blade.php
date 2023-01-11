@extends('frontend.layouts.master')
    @section('frontend_title')
        Checkout Page
    @endsection
    @push('frontend_style')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @section('frontend_content')
    @include('frontend.layouts.inc.breadcumb',['pagename'=>'Checkout'])


        <!-- checkout-area start -->
        <div class="checkout-area ptb-100">
            <div class="container">
                <form action="{{route('customer.placeorder')}}" method="POST">
                    <div class="row">
                        @csrf
                        <div class="col-lg-8">
                            <div class="checkout-form form-style">
                                <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <p>Full Name *</p>
                                            <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" placeholder="Enter Full Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-12 col-12">
                                            <p>Email Address *</p>
                                            <input type="email" name="email" class="form-control @error('email')is-invalid @enderror" placeholder="Enter Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-12">
                                            <p>Phone No. *</p>
                                            <input type="text" name="phone" class="form-control @error('phone')is-invalid @enderror" placeholder="Enter Phone">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <p>District *</p>
                                            <select id="district_id" name="district_id" class="custom-select js-example-basic-single">
                                                <option value="1">Select a district</option>
                                                @foreach ($districts as $district)
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <p>Upazila *</p>
                                            <select name="upazila_id" id="upazila_id" class="custom-select js-example-basic-single">
                                                <option value="">Select upazila</option>
                                            </select>

                                        </div>
                                        <div class="col-sm-12 col-12">
                                            <p>Address *</p>
                                            <input type="text" name="address" class="form-control @error('address')is-invalid @enderror" placeholder="Enter Address">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <p>Order Notes </p>
                                            <textarea name="order_note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-area">
                                <h3>Your Order</h3>
                                <ul class="total-cost">
                                    @foreach ($carts as $item)
                                        <li>{{$item->name}} X {{$item->qty}}<span class="pull-right">{{$item->price*$item->qty}}</span></li>
                                    @endforeach
                                    @if (Session::has('coupon'))

                                        <li>Discount Amount <span class="pull-right"><strong>(-) ${{Session::get('coupon')['discount_amount']}}</strong></span></li>
                                        <li>Total <span class="pull-right"><strong>${{Session::get('coupon')['balance']}} <del class="text-danger">${{Session::get('coupon')['cart_total']}}</del></strong></span></li>
                                        @else
                                        <li><span class="pull-left">Subtotal </span>${{$total_price}}</li>
                                        <li><span class="pull-left"> Total </span> ${{$total_price}}</li>
                                    @endif
                                </ul>

                                <ul class="payment-method">

                                    <li>
                                        <input id="delivery" type="checkbox">
                                        <label for="delivery">Cash on Delivery</label>
                                    </li>
                                </ul>
                                <button type="submit" class="btn btn-danger">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- checkout-area end -->


    @endsection


    @push('frontend_script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();

                $('#district_id').on('change',function(){
                    var $district_id = $(this).val();
                    console.log();
                    if($district_id){
                        $.ajax({
                            url: "{{url('/upzilla/ajax')}}/" + $district_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data){
                                console.log(data)
                                var d = $('#upazila_id').empty();
                                $.each(data,function(key,value){
                                    $('#upazila_id').append('<option value="' + value.id + '">'+ value.name + '</option>');
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
