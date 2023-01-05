<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('is_active',1)
        ->with('category')
        ->latest('id')
        ->select(['id','name','slug','category_id','product_price','product_stock','alert_quantity','product_image','product_rating','updated_at'])
        ->paginate(10);
        return view('backend.pages.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id','title'])->get();
        return view('backend.pages.product.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        // dd($request->all());
        $product = Product::create([
            'category_id' =>$request->category_id,
            'name' => $request->name,
            'slug' =>Str::slug($request->name),
            'product_price' =>$request->product_price,
            'product_code' =>$request->product_code,
            'product_stock' =>$request->product_stock,
            'alert_quantity' =>$request->alert_quantity,
            'short_description' =>$request->short_description,
            'long_description' =>$request->long_description,
            'additional_info' =>$request->additional_info,

        ]);

        $this->image_upload($request, $product->id);

        Toastr::success('Product Store Successfully');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::whereSlug($slug)->first();
        $categories = Category::select(['id','title'])->get();
        return view('backend.pages.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $slug)
    {
        // dd($request->all());
        $product = Product::whereSlug($slug)->first();
        $product->update([
            'category_id' =>$request->category_id,
            'name' => $request->name,
            'slug' =>Str::slug($request->name),
            'product_price' =>$request->product_price,
            'product_code' =>$request->product_code,
            'product_stock' =>$request->product_stock,
            'alert_quantity' =>$request->alert_quantity,
            'short_description' =>$request->short_description,
            'long_description' =>$request->long_description,
            'additional_info' =>$request->additional_info,
        ]);

        $this->image_upload($request, $product->id);

        Toastr::success('Product Update Successfully');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product = Product::whereSlug($slug)->first();

        if($product->product_image){
            $photo_location = 'uploads/products/'. $product->product_image;
            unlink($photo_location);
        }
        $product->delete();
        Toastr::success('Product Deleted Successfully');
        return redirect()->route('product.index');
    }

    public function image_upload($request, $item_id)
    {
        $product = Product::findorFail($item_id);

        if($request->hasFile('product_image'))
        {
            if ($product->product_image !='product-default.jpg') {
                //delete old photo

                $photo_location = 'public/uploads/products/';
                $old_photo_location = $photo_location .
                $product->product_image;
                unlink(base_path($old_photo_location));
            }

            $photo_location = 'public/uploads/products/';
            $uploaded_photo = $request->file('product_image');
            $new_photo_name = $product->id . '.'.
            $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(600,600)->save(base_path($new_photo_location),40);

            $check = $product->update([
                'product_image' => $new_photo_name,
            ]);


        }
    }
}
