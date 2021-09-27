<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Product::all();
        $data = DB::table('categories')->get();
        // $result['categories'] = DB::table('categories')->get();
        $arr= [];
        foreach($data as $d){
            $arr += [$d->id => $d->category_name];
        }
        $result['categories'] =  $arr;
        return view('admin.product.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result['categories'] = DB::table('categories')->orderBy('category_name', 'ASC')->get(); 
        return view('admin.product.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'=> 'required',
            'product_name_bn'=> 'required',
            'product_slug'=>'required|unique:products',
            'product_img'=>'required|mimes:jpeg,jpg,bmp,png,webp',
            'product_price'=>'required|numeric',
            'category_id'=>'required',
        ]);
        // get img name
        $img = $request->file('product_img');
        $ext = $img->extension();
        $imgName = time().'.'.$ext;
        $img->storeAs('/public/media/', $imgName );

        $product_name = $request->post('product_name');
        $product_name_bn = $request->post('product_name_bn');
        $product_slug = $request->post('product_slug');
        $product_img = $imgName;
        $product_price = $request->post('product_price');
        $category_id = $request->post('category_id');

        $model = new Product;
        $model->product_name = $product_name;
        $model->product_name_bn = $product_name_bn;
        $model->product_slug = $product_slug;
        $model->product_img = $product_img;
        $model->product_price = $product_price;
        $model->category_id = $category_id;
        $model->save();

        $request->session()->flash('message', "Product Inserted Successfully");
        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $result['data'] = Product::where([ 'id' => $id ])->first();
        $result['categories'] = DB::table('categories')->orderBy('category_name', 'ASC')->get(); 
        return view('admin.product.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $model = Product::find($request->post('id'));

        if($model != NULL){
            $request->validate([
                'product_name'=> 'required',
                'product_name_bn'=> 'required',
                'product_slug'=>'required|unique:products,product_slug,'.$request->post('id'),
                'product_price'=>'required|numeric',
                'category_id'=>'required',
            ]);
            $imgName = $model->product_img;
            if($request->hasfile('product_img')){
                $request->validate([
                    'product_img'=>'required|mimes:jpeg,jpg,bmp,png,webp',
                ]);
                // get img name
                $img = $request->file('product_img');
                $ext = $img->extension();
                $imgName = time().'.'.$ext;
                $img->storeAs('/public/media/', $imgName );
            }
            
    
            $product_name = $request->post('product_name');
            $product_name_bn = $request->post('product_name_bn');
            $product_slug = $request->post('product_slug');
            $product_img = $imgName;
            $product_price = $request->post('product_price');
            $category_id = $request->post('category_id');

            $model->product_name = $product_name;
            $model->product_name_bn = $product_name_bn;
            $model->product_slug = $product_slug;
            $model->product_img = $product_img;
            $model->product_price = $product_price;
            $model->category_id = $category_id;
            $model->save();

            $request->session()->flash('message', "Product updated Successfully");
        
        }else{
            $request->session()->flash('error_message', "Data not found or Something went wrong");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Product::destroy($id);
        $request->session()->flash('message', "Product deleted Successfully");
        return redirect('admin/product');
    }
}
