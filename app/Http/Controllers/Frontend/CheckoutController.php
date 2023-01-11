<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Models\Upazila;
use App\Models\District;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\OrderStoreRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function checkoutPage(){
        $carts = Cart::content();
        $total_price = Cart::subtotal();
        $districts = District::select(['id','name','bn_name'])->get();
        return view('frontend.pages.checkout',compact('carts','total_price','districts'));
    }

    public function loadUpazilaAjax($district_id){
        $upazilas = Upazila::where('district_id',$district_id)->select(['id','name'])->get();
        return response()->json($upazilas,200);
    }

    public function placeOrder(OrderStoreRequest $request){
        // dd($request->all());

        // insert all information of billing

        $billing = Billing::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'address' => $request->address,
            'order_note' => $request->order_note,
        ]);

        // Order table data insert

        $order = Order::create([
            'user_id' => Auth::id(),
            'billing_id' => $billing->id,
            'sub_total' => Session::get('coupon')['cart_total'] ?? round(Cart::subtotalFloat()),
            'discount_amount' => Session::get('coupon')['discount_amount'] ?? 0,
            'coupon_name' => Session::get('coupon')['name'] ?? '',
            'total' => Session::get('coupon')['balance'] ?? round(Cart::subtotalFloat()),
        ]);

        // Order details table data insert using cart item helper

        foreach(Cart::content() as $cart_item){
            OrderDetail::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'product_id' => $cart_item->id,
                'product_qty' => $cart_item->qty,
                'product_price' => $cart_item->price,


            ]);

            // Update product table with decrement quantity

            Product::findOrFail($cart_item->id)->decrement('product_stock',$cart_item->qty);


        }
         // forceDelete from cart item
         Cart::destroy();
         Session::forget('coupon');

        Toastr::success('Your Order Placed Successfully!!','Success');
        return redirect()->route('cart.page');

    }
}
