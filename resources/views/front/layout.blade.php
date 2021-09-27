<!DOCTYPE HTML>
<html lang="en">
<head>
        <title>@yield('page_title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('web_assets/fonts/beyond_the_mountains-webfont.css')}}" type="text/css"/>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="{{asset('web_assets/plugin-frameworks/swiper.css')}}" rel="stylesheet">
        <link href="{{asset('web_assets/fonts/ionicons.css')}}" rel="stylesheet">
        <link href="{{asset('web_assets/common/styles.css')}}" rel="stylesheet">
        <link href="{{asset('web_assets/common/main.css')}}" rel="stylesheet">

</head>
<body>

<header>
        <div class="container">
                <a class="logo logoText" href="{{url('/')}}">eFood </a>

                <div class="right-area">
                        <div class="localization">
                                <a href="#" onClick="getLang('en')" class="{{isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'bn' ? '' : 'localActive'}}" id="eng">English</a> | 
                                <a href="#" onClick="getLang('bn')" class="{{isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'bn' ? 'localActive' : ''}}">বাংলা</a></div>
                        @if(Session::has('CUSTOMER_LOGIN') && Session::get('CUSTOMER_LOGIN') == true)
                        <div class="dropdown ml-2">
                                <button type="button" class="btn avatarBtn dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{asset('web_assets/images/img_avatar.png')}}" alt="Avatar" class="avatar">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Setting</a>
                                <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('userLogout')}}">Logout</a>
                                </div>
                        </div>
                        @endif
                        
                </div><!-- right-area -->

                <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>

                <ul class="main-menu font-mountainsre" id="main-menu">
                                <li><a href="{{url('/')}}" class="@yield('home_select')">{{__('layout.Shop')}}</a></li>
                        @if(Session::has('CUSTOMER_LOGIN') && Session::get('CUSTOMER_LOGIN') == true)
                                <li><a href="{{url('order')}}" class="@yield('order_select')">{{__('layout.Order')}}</a></li>
                                <li><a href="{{url('checkout')}}" class="@yield('checkout_select')">{{__('layout.Checkout')}}</a></li>

                        @else
                                <li><a href="{{url('login')}}" class="@yield('login_select')">{{__('layout.Login')}}</a></li>
                                <li><a href="{{url('register')}}" class="@yield('register_select')">{{__('layout.Register')}}</a></li>     
                        @endif
                        
                        
                </ul>

                <div class="clearfix"></div>
        </div><!-- container -->
</header>

@section('main_section')
@show


<footer class="pb-50  pt-70 pos-relative">
        <div class="pos-top triangle-bottom"></div>
        <div class="container-fluid">
                <a class="logo logoText" href="{{url('/')}}">eFood </a>
                <br/>

                <ul class="icon mt-30">
                        <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="#"><i class="ion-social-dribbble-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-linkedin"></i></a></li>
                        <li><a href="#"><i class="ion-social-vimeo"></i></a></li>
                </ul>

                <p class="color-light font-9 mt-50 mt-sm-30"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        &copy;<script>document.write(new Date().getFullYear());</script> Develop By <i class="ion-heart" aria-hidden="true"></i> <a href="#" target="_blank">AR Jishat</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div><!-- container -->
</footer>

<!-- SCIPTS -->
<script src="{{asset('web_assets/plugin-frameworks/jquery-3.2.1.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="{{asset('web_assets/plugin-frameworks/bootstrap.min.js')}}"></script>

<script src="{{asset('web_assets/plugin-frameworks/swiper.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('web_assets/common/scripts.js')}}"></script>
<script src="{{asset('web_assets/common/main.js')}}"></script>

</body>
</html>