<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function cartPage(){
        $carts = Cart::content();
        $total_price = Cart::subtotal();

        // return $carts;
        // return $total_price;
        return view('frontend.pages.shopping-cart',compact('carts','total_price'));
    }

    public function addToCart(Request $request){
        // dd($request->all());

        $product_slug = $request->product_slug;
        $order_qty = $request->order_qty;

        $product = Product::whereSlug($product_slug)->first();

        Cart::add([
            'id' =>$product->id,
            'name' =>$product->name,
            'price' => $product->product_price,
            'weight' =>0,
            'product_stock' =>$product->product_stock,
            'qty' => $order_qty,
            'options' =>[
                'product_image' => $product->product_image,
            ]
        ]);

        Toastr::success('Product Added in to Cart');
        return back();
    }


    public function removeFromCart($cart_id){

        Cart::remove($cart_id);
        Toastr::info('Product removed From Cart !!');
        return back();
    }
}
