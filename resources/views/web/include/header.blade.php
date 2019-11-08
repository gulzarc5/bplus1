<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="{{asset('src/img/logo-wwfav.png')}}" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('src/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/mystyles.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/switcher.css')}}" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/bright-turquoise.css')}}" title="bright-turquoise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/turkish-rose.css')}}" title="turkish-rose" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/salem.css')}}" title="salem" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/hippie-blue.css')}}" title="hippie-blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/mandy.css')}}" title="mandy" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/green-smoke.css')}}" title="green-smoke" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/horizon.css')}}" title="horizon" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/cerise.css')}}" title="cerise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/brick-red.css')}}" title="brick-red" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/de-york.css')}}" title="de-york" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/shamrock.css')}}" title="shamrock" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/studio.css')}}" title="studio" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/leather.css')}}" title="leather" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/denim.css')}}" title="denim" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/scarlet.css')}}" title="scarlet" media="all" /> 
    <style>.list{margin-top: 20px;}</style>  
  </head>
  <body>
    <div class="global-wrapper clearfix" id="global-wrapper">
      <div class="navbar-before mobile-hidden">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p class="navbar-before-sign">Everything You Need is Bplus
              </p>
            </div>
            <div class="col-md-6">
              <ul class="nav navbar-nav navbar-right navbar-right-no-mar">
                <li>
                  <a href="{{url('about_us')}}">About Us
                  </a>
                </li>
                <li>
                  <a href="{{url('contact_us')}}">Contact Us
                  </a>
                </li>
                <li>
                  <a href="#">FAQ
                  </a>
                </li>
                <li>
                  <a href="#">Terms of use
                  </a>
                </li>
                <li>
                  <a href="#">Help
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!--===================== Start Desktop Navbar =============================-->
      <nav class="navbar navbar-inverse navbar-main yamm">
        <div class="container">
          <div class="navbar-header" >
            <button class="navbar-toggle collapsed hidden-xs" type="button" data-toggle="collapse" data-target="#main-nav-collapse" area_expanded="false">
              <span class="sr-only">Main Menu
              </span>
              <span class="icon-bar">
              </span>
              <span class="icon-bar">
              </span>
              <span class="icon-bar">
              </span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">
              <img src="{{asset('src/img/logo-w.png')}}" alt="Image Alternative text" title="Image Title" />
            </a>
            <a class="hidden-lg mobile-cart" href="http://localhost/bplus1/public/Cart/shopping_cart">
              <i class="fa fa-shopping-cart"></i>
              <span>
                @if(isset($header_data) && !empty($header_data) && isset($header_data['cart_data']) && !empty($header_data['cart_data']) )
                  {{ count($header_data['cart_data'])}}
                @else
                  0
                @endif
              </span>
            </a>
          </div>
          <div class="collapse navbar-collapse hidden-md hidden-xs" id="main-nav-collapse">
            <ul class="nav navbar-nav" >
              <li class="dropdown">
                <a href="#">
                  <i class="fa fa-reorder">
                  </i>&nbsp; Shop by Category
                  <i class="drop-caret" data-toggle="dropdown">
                  </i>
                </a>
                <ul class="dropdown-menu dropdown-menu-category">

                  @if(isset($header_data) && !empty($header_data) && isset($header_data['category_list']) && !empty($header_data['category_list']))

                    @foreach($header_data['category_list'] as $category)

                      <li>
                        <a href="#">
                          <i class="fa fa-home dropdown-menu-category-icon">
                          </i>{{ $category['name'] }}
                        </a>

                       

                        <div class="dropdown-menu-category-section">
                          <div class="dropdown-menu-category-section-inner">
                            <div class="col-md-9">
                            <div class="dropdown-menu-category-section-content">
                              <div class="row">
                                <div class="col-md-12">
                                  <h5 class="dropdown-menu-category-title">{{ $category['name'] }}</h5>
                                     <hr>
                                  <ul >
                                    @if(!empty($category['first_category']))
                                    @php
                                      $first_div = 1;
                                    @endphp

                                    @foreach($category['first_category'] as $first_category)

                                    @if( ($first_div % 2) == 0 )
                                      
                                      <div class="col-md-6 dropdown-menu-category-list">
                                        <li >
                                          <a href="{{route('web.sub_category',['first_id'=>encrypt($first_category->id)])}}">{{ $first_category->name }}
                                          </a>
                                        </li>
                                      </div>
                                    @else
                                      <div class="col-md-6 dropdown-menu-category-list">
                                        <li>
                                          <a href="{{route('web.sub_category',['first_id'=>encrypt($first_category->id)])}}">{{ $first_category->name }}
                                          </a>
                                        </li>
                                      </div>
                                    @endif

                                    @php
                                       $first_div++;
                                    @endphp
                                    @endforeach
                                    @endif
                                   </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3" style="margin-top: 40%;">
                           <img class="dropdown-menu-category-section-theme-img" src="{{asset('images/category/main_category/thumb/'.$category['image'].'')}}" alt="Image Alternative text" title="Image Title" style=" " />
                           </div>
                          </div>
                        </div>                      

                      </li>

                    @endforeach
                  @endif               
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-left navbar-main-search" role="search">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Search the Entire Store..." />
              </div>
              <a class="fa fa-search navbar-main-search-submit" href="#">
              </a>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="{{route('web.viewCart')}}">
                  <i class="fa fa-shopping-cart" style="font-size: 20px;"></i> 
                    @if(isset($header_data) && !empty($header_data) && isset($header_data['cart_data']) && !empty($header_data['cart_data']) )
                     {{ count($header_data['cart_data'])}}
                     @else
                       0
                      @endif
                   Items
                </a>
                <ul class="dropdown-menu dropdown-menu-shipping-cart">
                  @php
                      $header_cart_total = 0; 
                    @endphp
                  @if(isset($header_data) && !empty($header_data) && isset($header_data['cart_data']) && !empty($header_data['cart_data']) )
                    

                     @foreach($header_data['cart_data'] as $cart)
                        <li>
                          <a class="dropdown-menu-shipping-cart-img" href="#">
                            <img src="{{ asset('images/product/thumb/'.$cart['image'].'')}}" alt="Image Alternative text" title="Image Title" />
                          </a>
                          <div class="dropdown-menu-shipping-cart-inner">
                            <p class="dropdown-menu-shipping-cart-price">₹{{ number_format($cart['price'],2) }}</p>
                            <p class="dropdown-menu-shipping-cart-item">
                              <a href="#">{{ $cart['title'] }}</a>
                            </p>
                          </div>
                        </li>

                        @php
                          $header_cart_total = $header_cart_total + (floatval($cart['quantity']) * floatval($cart['price']));
                        @endphp
                     @endforeach

                  @else
                    <li>
                      <div class="dropdown-menu-shipping-cart-inner">
                        <p class="dropdown-menu-shipping-cart-price">Cart is Empty</p>
                      </div>
                    </li>
                  @endif
                  <li>
                    <p class="dropdown-menu-shipping-cart-total">Total: ₹{{ number_format($header_cart_total,2) }} 
                    </p>
                   <a href="{{route('web.viewCart')}}" class="dropdown-menu-shipping-cart-checkout ">Checkout
                    </a>
                  </li>
                </ul>
              </li>
              <li class="dropdown">
                <a href=""><i class="fa fa-user" style="font-size: 20px;"></i> User Account</a>
                <ul class="dropdown-menu">
                  
                  @if(Auth::guard('buyer')->id())

                    <li><a href="{{route('web.myprofile')}}" data-effect="mfp-move-from-top" >My Profile</a></li>
                    <br>
                    @if (Auth::guard('buyer')->user()->user_role == '1')
                      <li><a href="{{route('seller_application')}}" data-effect="mfp-move-from-top" class="">Become A seller</a></li>
                      <br>
                    @else
                      <li><a href="{{url('seller_login')}}" data-effect="mfp-move-from-top" target="_blank" class="">Login To Seller Panel</a></li>
                    <br>
                    @endif
                    
                      

                    <li><a href="{{route('web.order_history')}}" data-effect="mfp-move-from-top" class="">My Orders</a></li>
                    <br>


                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                     <form id="logout-form" action="{{ route('web.buyerLogout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    <br>
                  @else
                      <li><a href="{{route('web.userLoginForm')}}" data-effect="mfp-move-from-top" >Sign In</a></li>
                      <br>

                      <li><a href="{{route('web.userRegistrationForm')}}" data-effect="mfp-move-from-top" >Create Account</a></li>
                      <br>

                      <li><a href="{{url('seller_login')}}" data-effect="mfp-move-from-top" class="">Sell On Bplus</a></li>
                      <br>
                  @endif

                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav> 
      <!--===================== End Desktop Navbar =============================-->

      <!--===================== Start Desktop Navbar =============================-->
      <nav role="navigation" class="hidden-lg" style="margin-bottom: -47px;">
        <div id="menuToggle">
          <input type="checkbox" />
          <div class="ham">            
            <span></span>
            <span></span>
            <span></span>
          </div>
          <ul id="menu">    
            <div class="menu-top">
              <h6 class="">Welcome to Bplus</h6>
              <div class="row">
                @if(Auth::guard('buyer')->id())
                  <div class="col-xs-6 pl-30"><a class="btn btn-primary btn-lg" href="{{route('web.myprofile')}}">Profile</a></div>
                  <div class="col-xs-6 pl-30"><a class="btn btn-primary btn-lg" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></div>
                  <form id="logout-form" action="{{ route('web.buyerLogout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                @else                  
                  <div class="col-xs-6 pl-30"><a class="btn btn-primary btn-lg" href="{{route('web.userLoginForm')}}">Login</a></div>
                  <div class="col-xs-6 pl-30"><a class="btn btn-primary btn-lg" href="{{route('web.userRegistrationForm')}}">Signup</a></div>
                @endif
              </div>
            </div>
            @if(isset($header_data) && !empty($header_data) && isset($header_data['category_list']) && !empty($header_data['category_list']))

              @foreach($header_data['category_list'] as $category)        
              <li>
                <a class="accordion"><i class="fa fa-home dropdown-menu-category-icon"></i>{{ $category['name'] }}</a>
                <div class="panel">
                  <ul class="mobile-dropdown">
                    @foreach($category['first_category'] as $first_category)
                      <li><a href="{{route('web.sub_category',['first_id'=>encrypt($first_category->id)])}}"><i class="fa fa-list"></i>{{ $first_category->name }}</a></li>
                    @endforeach              
                  </ul>
                </div>           
              </li>
              @endforeach
            @endif   
              <li>
                <a href="{{route('web.order_history')}}" class="menu-othr"><i class="fa fa-home dropdown-menu-category-icon"></i>My Orders</a>
              </li> 
              @if(Auth::guard('buyer')->id())
                @if (Auth::guard('buyer')->user()->user_role == '1')
                  <li><a class="menu-othr" href="{{route('seller_application')}}" data-effect="mfp-move-from-top" class=""><i class="fa fa-home dropdown-menu-category-icon"></i>Become A seller</a></li>
                  <br>
                @else
                  <li><a class="menu-othr" href="{{url('seller_login')}}" data-effect="mfp-move-from-top" target="_blank" class=""><i class="fa fa-home dropdown-menu-category-icon"></i>Login To Seller Panel</a></li>
                <br>
                @endif
              @else
                <li>
                  <a href="{{url('seller_login')}}" class="menu-othr"><i class="fa fa-home dropdown-menu-category-icon"></i>Seller Login</a>
                </li> 
              @endif
          </ul>
        </div>
      </nav>
      <!--===================== End Mobile Navbar ==============================-->
      <script>
      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var panel = this.nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
          } 
        });
      }
      </script>