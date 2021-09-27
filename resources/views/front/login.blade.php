@extends('front/layout')
@section('page_title', 'Home | eFood')
@section('login_select', 'menuActive')
@section('main_section')

@php
        if(isset($_COOKIE['remember_email']) && isset($_COOKIE['remember_password'])){
                $rememberEmail = $_COOKIE['remember_email'];
                $rememberPassword = $_COOKIE['remember_password'];
                $isRemember = "checked='checked'";
        }else{
                $rememberEmail = "";
                $rememberPassword = "";  
                $isRemember = "";
        }
@endphp
<section class="bg-6  main-slider pos-relative">
        <div class="triangle-up pos-bottom"></div>
        <div class="container h-100">
                <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white pt-70">
                                <h3 class="mt-30 mb-15">{{__('all.login')}}</h3>
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
                
                <form class="form-style-1 placeholder-1" method="POST" id="loginForm"  action="{{route('login.getLogin')}}">
                        @csrf
                        <div class="row">
                                <div class="col-md-12 offset-md-3">
                                        
                                        <div class="col-md-6"> 
                                                <input  type="text" name="email" placeholder="E-mail" value="{{$rememberEmail}}"> 
                                                <span id="email" class="text-danger mb-20 errorMsg"></span> 
                                        </div>
                                        <div class="col-md-6">
                                                <input type="password" name="password" placeholder="Password" value="{{$rememberPassword}}">
                                                <span id="password" class="text-danger mb-20 errorMsg"></span>  
                                        </div>
                                        <div class="col-md-6 d-flex">
                                            <h6 class="mtb-10 mr-3"><button id="loginSubmit" class="btn-primaryc plr-25"><b>{{__('all.loginNow')}}</b> <span id="loader"></span></button></h6>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox"
                                                    name="rememberMe"
                                                    {{$isRemember}}
                                                    class="form-check-input rememberMe" >{{__('all.remember')}}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                                {{__('all.forgot')}} <a href="{{url('forgot-password')}}" class="text-danger "> <strong>{{__('all.click')}}</strong> </a>
                                        </div>
                                </div>
                        </div><!-- row -->
                        
                        
                </form>
        </div><!-- container -->
</section>
@endsection