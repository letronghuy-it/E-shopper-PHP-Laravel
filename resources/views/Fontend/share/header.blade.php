<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="/frontend/images/home/logo.png" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right clearfix">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canada</a></li>
                                <li><a href="">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canadian Dollar</a></li>
                                <li><a href="">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            @if (session()->get('Islogin') == true)
                                <li><a href="{{route('Account.Member')}}"><i class="fa fa-user"></i> Account</a></li>
                            @endif
                            @if (session()->get('Islogin') == false)
                            <li></li>
                            @endif
                            <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="/shop/check-out"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="/shop/cart"><i class="fa fa-shopping-cart"></i> Cart <span id="totalcart"> {{ session()->get('totalQuantity')}} </span></a></li>
                            @if (session()->get('Islogin') == true)
                                <li><a href="/shop/logout"><i class="fa fa-lock"></i> Logout</a></li>
                            @endif
                            @if (session()->get('Islogin') == false)
                                <li><a href="/shop/login-user"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/shop" class="active">Home</a></li>
                            <li class="dropdown"><a href="/shop/page-shop">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="/shop/page-shop">Products</a></li>
                                    <li><a href="/shop/product-detail/1">Product Details</a></li>
                                    <li><a href="/shop/check-out">Checkout</a></li>
                                    <li><a href="/shop/cart">Cart</a></li>
                                    <li><a href="/shop/login">Login</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="/shop/blog">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    {{-- <li><a href="/shop/blog">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li> --}}
                                </ul>
                            </li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="/shop/view-contract">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search" />
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
