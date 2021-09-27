@extends('front/layout')
@section('page_title', 'Home | eFood')
@section('register_select', 'menuActive')
@section('main_section')

<section class="bg-6 main-slider pos-relative">
        <div class="triangle-up pos-bottom"></div>
        <div class="container h-100">
                <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white pt-70">
                                <h3 class="mt-30 mb-15">{{__('all.register')}}</h3>
                        </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
        </div><!-- container -->
</section>


<section class="story-area left-text center-sm-text">
        <div class="container">
                <div class="row">
                        <div class="col-md-12 offset-md-3">
                                <div class="col-md-6" id="successMsg">
                                </div>
                        </div>
                </div>

                <form class="form-style-1 placeholder-1" method="POST" id="registerForm"  action="{{route('register.store')}}">
                        @csrf
                        <div class="row">
                                <div class="col-md-12 offset-md-3">
                                        <div class="col-md-6"> 
                                                <input class="" type="text" name="name" placeholder="Name">  
                                                <span id="name" class="text-danger mb-20 errorMsg"></span>
                                        </div>
                                        
                                        <div class="col-md-6"> 
                                                <input  type="text" name="email" placeholder="E-mail"> 
                                                <span id="email" class="text-danger mb-20 errorMsg"></span> 
                                        </div>
                                        <div class="col-md-6">
                                                <input type="password" name="password" placeholder="Password">
                                                <span id="password" class="text-danger mb-20 errorMsg"></span>  
                                        </div>
                                </div>
                        </div><!-- row -->
                        <h6 class="center-text mtb-30"><button id="registerSubmit" class="btn-primaryc plr-25"><b>{{__('all.registerNow')}}</b> <span id="loader"></span></button></h6>
                </form>
        </div><!-- container -->
</section>
@endsection