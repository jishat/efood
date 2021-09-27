<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Coupon::all();
        return view('admin.coupon.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
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
            'coupon_name'=> 'required|unique:coupons',
            'coupon_name_bn'=> 'required|unique:coupons',
            'coupon_code'=>'required|unique:coupons',
            'coupon_method'=>'required|regex:/^[a-zA-Z ]*$/',
            'coupon_value'=>'required|numeric',
            'coupon_quantity'=>'required|numeric',
            'coupon_expired'=>'required|date_format:Y-m-d',
        ]);
        $coupon_name = $request->post('coupon_name');
        $coupon_name_bn = $request->post('coupon_name_bn');
        $coupon_code = $request->post('coupon_code');
        $coupon_method = $request->post('coupon_method');
        $coupon_value = $request->post('coupon_value');
        $coupon_quantity = $request->post('coupon_quantity');
        $coupon_expired = $request->post('coupon_expired');

        $model = new Coupon;
        $model->coupon_name = $coupon_name;
        $model->coupon_name_bn = $coupon_name_bn;
        $model->coupon_code = $coupon_code;
        $model->coupon_method = $coupon_method;
        $model->coupon_value = $coupon_value;
        $model->coupon_quantity = $coupon_quantity;
        $model->coupon_expired_at = $coupon_expired;
        $model->save();

        $request->session()->flash('message', "Coupon Inserted Successfully");
        return redirect('admin/coupon');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'coupon_code'=> 'required',
        ]);

        if(!$validate->passes()){
            return response()->json(['status'=>'error', 'error' => $validate->errors()]);
        }else{
            $result = Coupon::where(['coupon_code' => $request->coupon_code])->first();
            if($result){
                return response()->json(['status'=>'success', 'data' => $result]);
            }else{
                return response()->json(['status'=>'fail', 'msg' => 'Invalid Coupon Code']);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $result['data'] = Coupon::where([ 'id' => $id ])->first();
        return view('admin.coupon.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'coupon_name'=> 'required|unique:coupons,coupon_name,'.$request->post('id'),
            'coupon_name_bn'=> 'required|unique:coupons,coupon_name_bn,'.$request->post('id'),
            'coupon_code'=>'required|unique:coupons,coupon_code,'.$request->post('id'),
            'coupon_method'=>'required|regex:/^[a-zA-Z ]*$/',
            'coupon_value'=>'required|numeric',
            'coupon_quantity'=>'required|numeric',
            'coupon_expired'=>'required|date_format:Y-m-d'
        ]);
        $coupon_name = $request->post('coupon_name');
        $coupon_name_bn = $request->post('coupon_name_bn');
        $coupon_code = $request->post('coupon_code');
        $coupon_method = $request->post('coupon_method');
        $coupon_value = $request->post('coupon_value');
        $coupon_quantity = $request->post('coupon_quantity');
        $coupon_expired = $request->post('coupon_expired');

        $model = Coupon::find($request->post('id'));

        if($model){
            $model->coupon_name = $coupon_name;
            $model->coupon_name_bn = $coupon_name_bn;
            $model->coupon_code = $coupon_code;
            $model->coupon_method = $coupon_method;
            $model->coupon_value = $coupon_value;
            $model->coupon_quantity = $coupon_quantity;
            $model->coupon_expired_at = $coupon_expired;
            $model->save();

            $request->session()->flash('message', "Coupon updated");
            
        }else{
            $request->session()->flash('error_message', "Data not found or Something went wrong");
        }
        return redirect('admin/coupon/edit/'.$request->post('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Coupon::destroy($id);
        $request->session()->flash('message', "Coupon deleted Successfully");
        return redirect('admin/coupon');
    }
}
