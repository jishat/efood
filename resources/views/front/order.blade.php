@extends('front/layout')
@section('page_title', 'Order | eFood')
@section('order_select', 'menuActive')
@section('main_section')

@php
        if(isset($_COOKIE['lang'])){
                $lang = $_COOKIE['lang'];
        }
        
@endphp


<section class="bg-6  main-slider pos-relative">
        <div class="triangle-up pos-bottom"></div>
        <div class="container h-100">
                <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white pt-70">
                                <h3 class="mt-30 mb-15">{{__('all.order')}}</h3>
                        </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
        </div><!-- container -->
</section>


<section class="story-area left-text center-sm-text">
        <div class="container">
                <div class="row">
                        <div class="col-md-12 offset-md-3">
                                <div class="col-md-6" id="successMsg">
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
                </div>
                
              
                        <div class="row">
                        @php
                        $i = 0;
                        @endphp
                        @foreach($data as $eachData)
                            @php
                            $i++
                            @endphp
                            
                            <div class="col-md-6"> <!-- col-md-6 -->
                                <div class="eachOrder">
                                    <div class="orderHead">
                                        <h2>Order ID: #{{$eachData->id}}</h2>
                                        <p><i class="ion-ios-clock-outline"></i> {{date('h:i a', strtotime($eachData->created_at))}}   <i class="ion-ios-calendar-outline ml-3 mr-1"></i> {{date('d M, Y', strtotime($eachData->created_at))}}</p>
                                    </div>
                                    <div class="orderBody">
                                        <div class="orderBodyLeft">
                                            <h2>{{__('all.mobile')}}</h2>
                                            <p>{{$eachData->mobile}}</p>
                                            <h2>{{__('all.shipping')}}</h2>
                                            <p>{{$eachData->address}}</p>
                                        </div>
                                        <div class="orderBodyRight">
                                            <p><span>{{__('all.subTotal')}}</span> <span>৳ {{$eachData->sub_total}}</span></p>
                                            <p><span>{{__('all.deliveryFee')}}</span> <span>৳ {{$eachData->shipping_cost}}</span></p>
                                            <p><span>{{__('all.discount')}}</span> <span>৳ {{$eachData->discount}}</span></p>
                                            <p><span>{{__('all.total')}}</span> <span>৳ {{$eachData->total_amount}}</span></p>
                                        </div>
                                    </div>
                                    <div class="productSection" >
                                        <button data-toggle="collapse" data-target="#demo{{$i}}">{{__('all.productList')}}</button>

                                        <div id="demo{{$i}}" class="collapse productList">
                                            <ul>
                                                @foreach($eachData->order_details as $eachDetails)
                                                    <li>
                                                        <img src="{{$eachDetails->product_img}}" alt="{{$eachDetails->product_name}}">
                                                        <div class="mr-3">
                                                                <h2>{{ $eachDetails->product_name }}</h2>
                                                                <p>৳ {{$eachDetails->price}} x {{$eachDetails->quantity}} qty</p>
                                                        </div>
                                                        <span>৳ {{$eachDetails->price * $eachDetails->quantity}}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- col-md-6 -->
                            
                        @endforeach                               
                                
                        </div><!-- row -->
                        
              
        </div><!-- container -->
</section>
@endsection