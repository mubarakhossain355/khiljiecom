@extends('frontend.layouts.master')
    @section('frontend_title')
         Cart Page
    @endsection

    @section('frontend_content')
    @include('frontend.layouts.inc.breadcumb',['pagename'=>'Cart '])

         <!-- cart-area start -->
        <div class="cart-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="#">
                            <table class="table-responsive cart-wrap">
                                <thead>
                                    <tr>
                                        <th class="images">Image</th>
                                        <th class="product">Product</th>
                                        <th class="ptice">Price</th>
                                        <th class="quantity">Quantity</th>
                                        <th class="total">Total</th>
                                        <th class="remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cartItem)
                                    <tr>
                                        <td class="images"><img src="{{asset('uploads/product_photos')}}/{{$cartItem->options->product_image}}" alt=""></td>
                                        <td class="product"><a href="single-product.html">{{$cartItem->name}}</a></td>
                                        <td class="ptice">${{$cartItem->price}}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" value="{{$cartItem->qty}}" />
                                        </td>
                                        <td class="total">${{$cartItem->price*$cartItem->qty}}</td>
                                        <td class="remove">
                                            <a href="{{route('removeFrom.cart',['cart_id' =>$cartItem->rowId])}}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <div class="row mt-60">
                                <div class="col-xl-4 col-lg-5 col-md-6 ">
                                    <div class="cartcupon-wrap">
                                        <ul class="d-flex">
                                            {{-- <li>
                                                <button>Update Cart</button>
                                            </li> --}}
                                            <li><a href="shop.html">Continue Shopping</a></li>
                                        </ul>
                                        <h3>Cupon</h3>
                                        <p>Enter Your Cupon Code if You Have One</p>
                                        <div class="cupon-wrap">
                                            <input type="text" placeholder="Cupon Code">
                                            <button>Apply Cupon</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                    <div class="cart-total text-right">
                                        <h3>Cart Totals</h3>
                                        <ul>
                                            <li><span class="pull-left">Subtotal </span>${{$total_price}}</li>
                                            <li><span class="pull-left"> Total </span> ${{$total_price}}</li>
                                        </ul>
                                        <a href="checkout.html">Proceed to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-area end -->

    @endsection
