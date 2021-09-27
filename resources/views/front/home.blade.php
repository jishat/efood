@extends('front/layout')
@section('page_title', 'Home | eFood')
@section('home_select', 'menuActive')

@section('main_section')

@php
        if(isset($_COOKIE['lang'])){
                $lang = $_COOKIE['lang'];
        }
        
@endphp
<div class="rightDrawer shadow closeDrawer" id="drawer">
        <div>
                <div class="drawerHeader">
                        <span class="drawerHeaderLeft"><i class="ion-bag"></i> <span id="cartTotalItem2">{{count($sessionArr)}}</span> {{__('home.item')}}</span> 
                        <span class="drawerHeaderRight" id="closeIcon"><i class="ion-close-round"></i></span>
                </div>
                <ul id="cartItems">
                        @if(Session::has('cart'))
                                @foreach(Session::get('cart') as $eachSession)
                                        <li>
                                                <img src="{{$eachSession['product_img']}}" alt="">
                                                <div class="mr-3">
                                                        <h2>{{ $lang == 'bn' ? $eachSession['product_name_bn'] : $eachSession['product_name']}}</h2>
                                                        <p>৳ {{$eachSession['product_price']}} x {{$eachSession['product_qty']}} qty</p>
                                                </div>
                                                <span>৳ {{$eachSession['product_price'] * $eachSession['product_qty']}}</span>
                                        </li>                        
                                @endforeach
                        @endif
                </ul>
        </div>
        <a class="drawerFooter" href="{{url('checkout')}}">
                <h2>{{__('home.checkout')}}</h2>

                <span class="totalAmount">৳ <span id="cartTotalAmount2">{{$totalAmount}}</span> </span>
        </a>

</div>
<div class="rightDrawerButton shadow" id="drawerButton">
        <span class="bagIcon"><i class="ion-bag"></i> <span id="cartTotalItem">{{count($sessionArr)}}</span> {{__('home.item')}}</span>
        <span class="totalAmnt">৳ <span id="cartTotalAmount">{{$totalAmount}}</span> </span>
</div>

<section class="bg-1 h-900x main-slider pos-relative">
        <div class="triangle-up pos-bottom"></div>
        <div class="container h-100">
                <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white">
                            <h5><b>{{__('home.heroSub')}}</b></h5>
                            <h1 class="mt-30 mb-15">{{__('home.heroTitle')}}</h1>
                        </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
        </div><!-- container -->
</section>


<section class="story-area left-text center-sm-text pos-relative">
        <div class="abs-tbl bg-2 w-20 z--1 dplay-md-none"></div>
        <div class="abs-tbr bg-3 w-20 z--1 dplay-md-none"></div>
        <div class="container">
                <div class="heading">
                        <img class="heading-img" src="{{asset('web_assets/images/heading_logo.png')}}" alt="">
                        <h2>{{__('home.section1')}}</h2>
                </div>

                <div class="row">
                        <div class="col-md-4">
                                <img src="{{asset('web_assets/images/offer-1.png')}}" alt="">
                        </div><!-- col-md-6 -->
                        <div class="col-md-4">
                                <img src="{{asset('web_assets/images/offer-2.png')}}" alt="">
                        </div><!-- col-md-6 -->
                        <div class="col-md-4">
                                <img src="{{asset('web_assets/images/offer-3.png')}}" alt="">
                        </div><!-- col-md-6 -->

                </div><!-- row -->
        </div><!-- container -->
</section>


<section class="story-area bg-seller color-white pos-relative">
        <div class="pos-bottom triangle-up"></div>
        <div class="pos-top triangle-bottom"></div>
        <div class="container">
                <div class="heading">
                        <img class="heading-img" src="images/heading_logo.png" alt="">
                        <h2>{{__('home.section2')}}</h2>
                </div>
                <div class="row">
                        <div class="col-sm-12">
                                <ul class="selecton brdr-b-primary mb-70">
                                        <li><a class="active" href="#" data-select="*"><b>{{__('home.all')}}</b></a></li>
                                        @foreach($category as $eachCategory)
                                            <li><a href="#" data-select="{{$eachCategory->category_slug}}"><b>{{$lang == 'bn' ? $eachCategory->category_name_bn : $eachCategory->category_name}}</b></a></li>
                                        @endforeach
    
                                </ul>
                        </div><!--col-sm-12-->
                </div><!--row-->
                <div class="row">
                    @foreach($products as $eachProduct)
                        <div class="col-lg-3 col-md-4  col-sm-6 food-menu {{$categories[$eachProduct->category_id]}}">
                            <div class="center-text mb-60">
                                        <div class="ïmg-200x mlr-auto pos-relative">
                                                <img src=" {{asset('storage/media/'.$eachProduct->product_img)}}" alt="{{ $eachProduct->product_name}}">
                                        </div>
                                        
                                        <h5 class="mt-20">{{ $lang == 'bn' ? $eachProduct->product_name_bn :$eachProduct->product_name }}</h5>
                                        <h4 class="mt-5"><b>৳ {{ $eachProduct->product_price }}</b></h4>
                                        <div class="productAction">
                                                @if(array_key_exists($eachProduct->id,$sessionArr))
                                                <span class="qtyBtn" data-pd_id="{{$eachProduct->id}}" data-pd_price="{{$eachProduct->product_price}}" data-pd_img="{{asset('storage/media/'.$eachProduct->product_img)}}" data-pd_name="{{$eachProduct->product_name}}" data-pd_name_bn="{{$eachProduct->product_name_bn}}">
                                                        <span class="decrease" onClick="decreaseQty()"><i class="ion-minus-round"></i></span>

                                                        <span class="qty">{{$sessionArr[$eachProduct->id]}}</span>

                                                        <span class="increase" onClick="increaseQty()"><i class="ion-plus-round"></i></span>
                                                </span>
                                                @else
                                                
                                                <h6 class="mt-20"><a href="#" data-pd_id="{{$eachProduct->id}}" data-pd_price="{{$eachProduct->product_price}}" data-pd_img="{{asset('storage/media/'.$eachProduct->product_img)}}" data-pd_name="{{$eachProduct->product_name}}" data-pd_name_bn="{{$eachProduct->product_name_bn}}" onClick="handleAddToCart()" class="btn-brdr-primary plr-25"><b>{{__('home.orderNow')}}</b></a></h6>
                                                @endif
                                        </div>
                                    
                            </div><!--text-center-->
                        </div><!-- col-md-3 -->
                    @endforeach
                        
                </div><!-- row -->

        </div><!-- container -->
</section>


<section class="story-area left-text center-sm-text pos-relative">
        <div class="abs-tbl bg-2 w-20 z--1 dplay-md-none"></div>
        <div class="abs-tbr bg-3 w-20 z--1 dplay-md-none"></div>
        <div class="container">
                <div class="heading">
                        <img class="heading-img" src="images/heading_logo.png" alt="">
                        <h2>{{__('home.section3')}}</h2>
                </div>

                <div class="row">
                        <div class="col-md-6">
                                <p class="mb-30">{{__('home.p1')}}</p>
                        </div><!-- col-md-6 -->

                        <div class="col-md-6">
                                <p class="mb-30">{{__('home.p2')}} </p>
                        </div><!-- col-md-6 -->
                </div><!-- row -->
        </div><!-- container -->
</section>


@endsection