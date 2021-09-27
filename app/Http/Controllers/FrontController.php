<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['category'] = DB::table('categories')->get();

        $data = $result['category'];
        // $result['categories'] = DB::table('categories')->get();
        $arr= [];
        foreach($data as $d){
            $arr += [$d->id => $d->category_slug];
        }
        $result['categories'] =  $arr;

        $result['products'] = DB::table('products')->get();

        $sessionArr = array();
        $totalAmount = 0;
        if(session()->has('cart')){
                foreach(session()->get('cart') as $key=>$value){
                    $sessionArr  += [ $value['product_id'] => $value['product_qty']];
                    $totalAmount += $value['product_qty'] * $value['product_price'];
                }
        }
        $result['sessionArr'] = $sessionArr;
        $result['totalAmount'] = $totalAmount;
        return view('front.home', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function set_session(Request $request)
    {
        $sessionArr = array();
        if(session()->has('cart')){
            foreach(session()->get('cart') as $arr){
                $sessionArr += [ $arr['product_id'] => $arr['product_qty']];
            }
        }
        if(array_key_exists($request->pdId, $sessionArr)){
            foreach(session()->get('cart') as $key => $value ){
                if($value['product_id'] == $request->pdId  && $request->pdQty > 0){
                    $value['product_qty'] = $request->pdQty;
                }elseif($value['product_id'] == $request->pdId  && $request->pdQty <= 0){
                    $c = session()->get('cart');
                    unset($c[$key]);
                    session()->put('cart', $c);
                }
            }
        }else{
            $arr =["product_id"=>$request->pdId, "product_qty" => $request->pdQty, "product_price" => $request->pdPrice, "product_img" => $request->pdImg, "product_name" => $request->pdName, "product_name_bn" => $request->pdNameBn];
            $data = collect($arr); 
            session()->push('cart', $data);
        }
        
        $result = array("result"=> "success", "data"=>session()->get('cart'));
        return json_encode($result);
    }

    public function checkout()
    {
        $sessionArr = array();
        $totalAmount = 0;
        if(session()->has('cart')){
                foreach(session()->get('cart') as $key=>$value){
                    $sessionArr  += [ $value['product_id'] => $value['product_qty']];
                    $totalAmount += $value['product_qty'] * $value['product_price'];
                }
        }
        $result['sessionArr'] = $sessionArr;
        $result['totalAmount'] = $totalAmount;

        return view('front.checkout', $result);
    }


    public function register(Request $request)
    {
        if(session()->has('CUSTOMER_LOGIN') && session()->get('CUSTOMER_LOGIN') == true){
            return redirect('/');
        }else{
            return view("front.register");
        }
        
    }

    public function login(Request $request)
    {
        if(session()->has('CUSTOMER_LOGIN') && session()->get('CUSTOMER_LOGIN') == true){
            return redirect('/');
        }else{
            return view("front.login");
        }
    }

    public function forgot_password(Request $request){
        if(session()->has('CUSTOMER_LOGIN') && session()->get('CUSTOMER_LOGIN') == true){
            return redirect('/');
        }else{
            return view("front.forgot-password");
        }
    }


    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $result['data'] = Category::where([ 'id' => $id ])->first();
        return view('admin.category_edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name'=> 'required|unique:categories,category_name,'.$request->post('id'),
            'category_name_bn'=> 'required|unique:categories,category_name_bn,'.$request->post('id'),
            'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id')
        ]);
        $categoryName = $request->post('category_name');
        $categoryNameBn = $request->post('category_name_bn');
        $categorySlug = $request->post('category_slug');

        $model = category::find($request->post('id'));

        if($model){
            $model->category_name = $categoryName;
            $model->category_name_bn = $categoryNameBn;
            $model->category_slug = $categorySlug;
            $model->save();

            $request->session()->flash('message', "Category updated");
            
        }else{
            $request->session()->flash('error_message', "Data not found or Something went wrong");
        }
        return redirect('admin/category/edit/'.$request->post('id'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    }

    public function orderSuccess(){
        return view('utility.order_success');
    }

    public function set_local(Request $request){

        if($request->lang == 'bn' || $request->lang == 'en'){
            setcookie('lang',  $request->lang, time()+60*60*24*365);
            return response()->json(['status'=>'success', 'msg' => url('/')]);
        }
       
    }
}
