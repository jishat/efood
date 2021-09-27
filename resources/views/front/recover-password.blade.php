@extends('front/layout')
@section('page_title', 'Recover Password | eFood')
@section('login_select', 'menuActive')
@section('main_section')

<section class="bg-6  main-slider pos-relative">
        <div class="triangle-up pos-bottom"></div>
        <div class="container h-100">
                <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white pt-70">
                                <h3 class="mt-30 mb-15">Recover Password</h3>
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
                
                <form class="form-style-1 placeholder-1" method="POST" id="recoverPasswordForm"  action="{{route('submit-recover-password.password')}}">
                        @csrf
                        <input type="hidden" value="{{$id}}" name="randId">
                        <div class="row">
                                <div class="col-md-12 offset-md-3">
                                        
                                        <div class="col-md-6"> 
                                                <input  type="text" name="password" placeholder="Enter new password" > 
                                                <span id="password" class="text-danger mb-20 errorMsg"></span> 
                                        </div>
                                        <div class="col-md-6 d-flex">
                                            <h6 class="mtb-10 mr-3"><button id="recoverPassSubmit" class="btn-primaryc plr-25"><b>Submit</b> <span id="loader"></span></button></h6>
 
                                        </div>
                                </div>
                        </div><!-- row -->
                        
                        
                </form>
        </div><!-- container -->
</section>
@endsection