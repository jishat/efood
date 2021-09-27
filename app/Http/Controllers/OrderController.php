<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * $result['dd'] = Order::whereHas('order_details', function ($query) {
     *      $query->where('customer_id', 18);
     * })->get();
     * 
     */
    public function index()
    {
        $customerId = session()->get('CUSTOMER_ID');

        $result['data']   = Order::where(['customer_id' => $customerId])->get();

        return view('front.order', $result);
        // return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sessionArr = array();
        $subTotal = 0;
        if(session()->has('cart')){
            foreach(session()->get('cart') as $key=>$value){
                $sessionArr  += [ $value['product_id'] => $value['product_qty']];
                $subTotal += $value['product_qty'] * $value['product_price'];
            }

            $validate = Validator::make($request->all(), [
                'name'=> 'required|regex:/^[a-zA-Z ]*$/',
                'mobile'=> 'required|regex:/(^(?:\+?88)?(01){1}[356789]{1}(\d){8})$/',
                'city'=>'required|regex:/^[a-zA-Z ]*$/',
                'district'=>'required|regex:/^[a-zA-Z ]*$/',
                'address'=>'required',
                'shippingCost'=>'required',
            ]);
    
            if(!$validate->passes()){
                return response()->json(['status'=>'error', 'error' => $validate->errors()]);
            }else{
                
                $getCart = session()->get('cart');
                $discount = 0;
                if($request->post('couponCode') !== NULL){
                    $getCouponInfo = Coupon::where(['coupon_code' => $request->post('couponCode')])->first();
                    if($getCouponInfo->coupon_method == "cash"){
                        $discount = $getCouponInfo->coupon_value;
                    }
                    if($getCouponInfo->coupon_method == "percentage"){
                        $discount = ($subTotal * $getCouponInfo->coupon_value) / 100;
                    }
                }
                $totalAmount = ($subTotal + $request->post('shippingCost')) - $discount;
    
                $model =  new Order;
                $model->customer_id = session()->get('CUSTOMER_ID');
                $model->name = $request->post('name');
                $model->mobile = $request->post('mobile');
                $model->city = $request->post('city');
                $model->district = $request->post('district');
                $model->address = $request->post('address');
                $model->order_notes = $request->post('orderNotes');
                $model->sub_total = $subTotal;
                $model->shipping_cost = $request->post('shippingCost');
                $model->discount = $discount;
                $model->total_amount = $totalAmount;
                $model->save();
                $getOrderId =  $model->id;
                foreach($getCart as $eachCart){
                    $productArr['order_id'] = $getOrderId;
                    $productArr['product_id'] = $eachCart['product_id'];
                    $productArr['product_img'] = $eachCart['product_img'];
                    $productArr['product_name'] = $eachCart['product_name'];
                    $productArr['price'] = $eachCart['product_price'];
                    $productArr['quantity'] = $eachCart['product_qty'];
                    DB::table('order_details')->insert($productArr);
                }
                if($request->post('couponCode') !== NULL){
                    $decreaseCoupon = $getCouponInfo->coupon_quantity - 1;
                    Coupon::where(['coupon_code' => $request->post('couponCode')])->update(['coupon_quantity' => $decreaseCoupon]);
                }
                session()->forget('cart');
                return response()->json(['status'=>'success', 'msg' => url('order-success')]);
            }
        }else{
            return response()->json(['status'=>'fail', 'msg' => "Select product before order"]);
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
