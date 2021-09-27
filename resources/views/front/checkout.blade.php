@extends('front/layout')
@section('page_title', 'Checkout | eFood')
@section('checkout_select', 'menuActive')
@section('main_section')




<div class="rightDrawer shadow closeDrawer" id="drawer">
        <div>
                <div class="drawerHeader">
                        <span class="drawerHeaderLeft"><i class="ion-bag"></i> <span id="cartTotalItem2">{{count($sessionArr)}}</span> Item</span> 
                        <span class="drawerHeaderRight" id="closeIcon"><i class="ion-close-round"></i></span>
                </div>
                <ul id="cartItems">
                        @if(Session::has('cart'))
                                @foreach(Session::get('cart') as $eachSession)
                                        <li>
                                                <img src="{{$eachSession['product_img']}}" alt="">
                                                <div class="mr-3">
                                                        <h2>{{$eachSession['product_name']}}</h2>
                                                        <p>৳ {{$eachSession['product_price']}} x {{$eachSession['product_qty']}} qty</p>
                                                </div>
                                                <span>৳ {{$eachSession['product_price'] * $eachSession['product_qty']}}</span>
                                        </li>                        
                                @endforeach
                        @endif
                </ul>
        </div>
        <a class="drawerFooter" href="{{url('checkout')}}">
                <h2>Checkout</h2>

                <span class="totalAmount">৳ <span id="cartTotalAmount2">{{$totalAmount}}</span> </span>
        </a>

</div>
<div class="rightDrawerButton shadow" id="drawerButton">
        <span class="bagIcon"><i class="ion-bag"></i> <span id="cartTotalItem">{{count($sessionArr)}}</span> Item</span>
        <span class="totalAmnt">৳ <span id="cartTotalAmount">{{$totalAmount}}</span> </span>
</div>


<section class="bg-6  main-slider pos-relative">
        <div class="triangle-up pos-bottom"></div>
        <div class="container h-100">
                <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white pt-70">
                                <h3 class="mt-30 mb-15">{{__('all.checkout')}}</h3>
                        </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
        </div><!-- container -->
</section>


<section class="story-area left-text center-sm-text">
        <div class="container">
                <div class="row">
                        <div class="col-md-5 offset-md-1 couponBanner"> <img src="{{asset('web_assets/images/coupon-1.png')}}"  alt=""></div>
                        <div class="col-md-5 couponBanner"> <img src="{{asset('web_assets/images/coupon-2.png')}}"  alt=""></div>
                        <div class="col-md-12" id="successMsg">
                                        @if(Session::has('error'))
                                                <div class="alert alert-danger" role="alert">
                                                        {{session('error')}}
                                                </div>
                                        @endif
                                        @if(Session::has('message'))
                                                <div class="alert alert-success" role="alert">
                                                        {{session('message')}}
                                                </div>
                                        @endif
                        </div>
                </div>
                
                
                <div class="row">
                        <div class="col-md-8">
                                <form class="form-style-1 placeholder-1" method="POST" id="orderForm"  action="{{route('checkout.order')}}">
                                @csrf
                                <div class="row">
                                        <div class="col-md-12">
                                        <h2 class="checkoutHead">{{__('all.shippingDetails')}}</h2>
                                        </div>
                                        <div class="col-md-6"> 
                                                <input  type="text" name="name" placeholder="Full Name" value="{{Session::get('CUSTOMER_NAME')}}"> 
                                                <span id="name" class="text-danger mb-20 errorMsg"></span> 
                                        </div>
                                        <div class="col-md-6">
                                                <input type="text" name="mobile" placeholder="Mobile" >
                                                <span id="mobile" class="text-danger mb-20 errorMsg"></span>  
                                        </div>
                                        <div class="col-md-6">
                                                <input type="text" name="city" placeholder="City/Town" >
                                                <span id="city" class="text-danger mb-20 errorMsg"></span>  
                                        </div>
                                        <div class="col-md-6">
                                                <input type="text" name="district" placeholder="District" >
                                                <span id="district" class="text-danger mb-20 errorMsg"></span>  
                                        </div>
                                        <div class="col-md-12">
                                        <textarea name="address" class="h-100x ptb-20"  placeholder="Full address"></textarea>
                                        <span id="address" class="text-danger mb-20 errorMsg"></span>  
                                        </div>
                                        <div class="col-md-12">
                                        <textarea name="orderNotes" class="h-150x ptb-20" placeholder="Enter order notes if have (Optional)"></textarea>
                                        <span id="orderNotes" class="text-danger mb-20 errorMsg"></span>  
                                        </div>
                                </div>
                                
                        </div>
                        <div class="col-md-4">
                                <div class="row  ml-2">
                                <div class="col-md-12">
                                        <h2 class="checkoutHead">{{__('all.orderDetails')}}</h2>
                                </div>
                                <div class="col-md-12 "> 
                                        <div class="amountDetails">
                                        <h3><span>{{__('all.subTotal')}}</span> <span>৳ <span id="subtotal">{{$totalAmount}}</span> </span></h3> 
                                        <h3><span>{{__('all.deliveryFee')}}</span> <span><i class="text-success ion-plus-round"></i> ৳ <span id="shippingCost">30</span></span></h3> 
                                        <h3><span>{{__('all.discount')}}</span> <span><i class="text-danger ion-minus-round"></i> ৳ <span id="discount">0</span></span></h3>
                                        <h4><span>{{__('all.total')}} </span> <span>৳ <span id="total">{{$totalAmount + 30}}</span></span></h4>

                                        <button class="btn btnOrder" id="placeOrder">{{__('all.placeOrder')}} <span id="loader"></span></button>
                                        </div>
                                                
                                </div>
                                </form>
                                <div class="col-md-12">
                                        <form method="POST" id="couponForm" class="form-style-1 placeholder-1" action="{{route('coupon.get')}}">
                                                @csrf
                                                <div class="coupon">
                                                        <input  type="text" name="coupon_code" id="coupon_code_val" placeholder="Coupon Code" > 
                                                        <span id="coupon_code" class="text-danger mb-20 errorMsg"></span> 
                                                        <button class="btn btnOrder" id="applyCoupon">{{__('all.applyCoupon')}} <span id="loader2"></span></button>
                                                </div>
                                        </form>
                                </div>
                                </div>
                        </div>
                </div><!-- row -->
                
                
                
        </div><!-- container -->
</section>
@endsection