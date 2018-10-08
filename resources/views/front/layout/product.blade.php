<?php

use App\Model\Category;

$categories = DB::table('categories')->get();
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{asset('front/img/fav-icon.png')}}" type="image/x-icon"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DREAM FASHION</title>

    <!-- Icon css link -->
    <link href="{{asset('front/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendors/line-icon/css/simple-line-icons.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendors/elegant-icon/style.css')}}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Rev slider css -->
    <link href="{{asset('front/vendors/revolution/css/settings.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendors/revolution/css/layers.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendors/revolution/css/navigation.css')}}" rel="stylesheet">

    <!-- Extra plugin css -->
    <link href="{{asset('front/vendors/owl-carousel/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendors/bootstrap-selector/css/bootstrap-select.min.css')}}" rel="stylesheet">

    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/responsive.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('header_js')
</head>
<body>

<!--================Top Header Area =================-->
<div class="header_top_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="top_header_left">
                    <div class="selector">
                        <select class="language_drop" name="countries" id="countries" style="width:300px;">
                            <option value='yt' data-image="{{asset('front/img/icon/flag-1.png')}}"
                                    data-imagecss="flag yt" data-title="English">English
                            </option>
                            <option value='yu' data-image="{{asset('front/img/icon/flag-1.png')}}"
                                    data-imagecss="flag yu" data-title="Bangladesh">Bangla
                            </option>
                            <option value='yt' data-image="{{asset('front/img/icon/flag-1.png')}}"
                                    data-imagecss="flag yt" data-title="English">English
                            </option>
                            <option value='yu' data-image="{{asset('front/img/icon/flag-1.png')}}"
                                    data-imagecss="flag yu" data-title="Bangladesh">Bangla
                            </option>
                        </select>
                    </div>
                    <select class="selectpicker usd_select">
                        <option>USD</option>
                        <option>$</option>
                        <option>$</option>
                    </select>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                        <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button"><i class="icon-magnifier"></i></button>
                                </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="top_header_middle">
                    <a href="#"><i class="fa fa-phone"></i> Call Us: <span>+84 987 654 321</span></a>
                    <a href="#"><i class="fa fa-envelope"></i> Email: <span>support@yourdomain.com</span></a>
                    <a href="{{route('home_page')}}"><img src="{{asset('front/img/df-2.gif')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="top_right_header">
                    <ul class="header_social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                    </ul>
                    <ul class="top_right">
                        <li class="user"><a href="#"><i class="icon-user icons"></i></a></li>
                        <li class="cart"><a href="{{route('view_cart')}}"><i class="icon-handbag icons"></i></a></li>
                        <li class="h_price">
                            <select class="selectpicker">
                                <option>$0.00</option>
                                <option>$0.00</option>
                                <option>$0.00</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Top Header Area =================-->

<!--================Menu Area =================-->
@include('front.layout.home_menu')
<!--================End Menu Area =================-->

<!--================Categories Banner Area =================-->
<section class="categories_banner_area">
    <div class="container">
        <div class="c_banner_inner">
            <h3>shop grid with left sidebar</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li class="current"><a href="#">Shop Grid with Left Sidebar</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->

@yield('front_content')

<!--================Footer Area =================-->
<footer class="footer_area">
    <div class="container">
        <div class="footer_widgets">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-6">
                    <aside class="f_widget f_about_widget">
                        <a href="{{route('home_page')}}"><img src="{{asset('front/img/df-2.gif')}}" alt=""></a>
                        <p>Persuit is a Premium PSD Template. Best choice for your online store. Let purchase it to
                            enjoy now</p>
                        <h6>Social:</h6>
                        <ul>
                            <li><a href="#"><i class="social_facebook"></i></a></li>
                            <li><a href="#"><i class="social_twitter"></i></a></li>
                            <li><a href="#"><i class="social_pinterest"></i></a></li>
                            <li><a href="#"><i class="social_instagram"></i></a></li>
                            <li><a href="#"><i class="social_youtube"></i></a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <aside class="f_widget link_widget f_info_widget">
                        <div class="f_w_title">
                            <h3>Information</h3>
                        </div>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Delivery information</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">Returns & Refunds</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <aside class="f_widget link_widget f_service_widget">
                        <div class="f_w_title">
                            <h3>Customer Service</h3>
                        </div>
                        <ul>
                            <li><a href="#">My account</a></li>
                            <li><a href="#">Ordr History</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Newsletter</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <aside class="f_widget link_widget f_extra_widget">
                        <div class="f_w_title">
                            <h3>Extras</h3>
                        </div>
                        <ul>
                            <li><a href="#">Brands</a></li>
                            <li><a href="#">Gift Vouchers</a></li>
                            <li><a href="#">Affiliates</a></li>
                            <li><a href="#">Specials</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <aside class="f_widget link_widget f_account_widget">
                        <div class="f_w_title">
                            <h3>My Account</h3>
                        </div>
                        <ul>
                            <li><a href="#">My account</a></li>
                            <li><a href="#">Ordr History</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Newsletter</a></li>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
        <div class="footer_copyright">
            <h5>©
                <script>document.write(new Date().getFullYear());</script>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                        href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </h5>
        </div>
    </div>
</footer>
<!--================End Footer Area =================-->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('front/js/jquery-3.2.1.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<!-- Rev slider js -->
<script src="{{asset('front/vendors/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('front/vendors/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{asset('front/vendors/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('front/vendors/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{asset('front/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('front/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('front/vendors/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('front/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<!-- Extra plugin css -->
<script src="{{asset('front/vendors/counterup/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('front/vendors/counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('front/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/vendors/bootstrap-selector/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('front/vendors/image-dropdown/jquery.dd.min.js')}}"></script>
<script src="{{asset('front/js/smoothscroll.js')}}"></script>
<script src="{{asset('front/vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('front/vendors/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('front/vendors/magnify-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('front/vendors/vertical-slider/js/jQuery.verticalCarousel.js')}}"></script>
<script src="{{asset('front/vendors/jquery-ui/jquery-ui.js')}}"></script>

<script src="{{asset('front/js/theme.js')}}"></script>
<script>
    $(document).ready(function () {
        $(document.body).delegate('#category_id', 'change', function () {
            var cat = $("#category_id").val();
            window.location = '/category/' + cat;
        });
        $(document.body).delegate('#limit_div', 'change', function () {
            var cat = $("#category_id").val();
            var limit = $("#limit_div").val();
            window.location = '/category/' + cat + '/' + limit;
        });
    });
</script>
</body>
</html>