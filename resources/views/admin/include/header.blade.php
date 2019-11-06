<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Bplus</title>
    <link rel="icon" href="{{ asset('images/logo_icon.png')}}" type="image/icon type">


    <!-- Bootstrap -->
    <link href="{{asset('admin/src_files/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/src_files/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin/src_files/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('admin/src_files/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="{{asset('admin/src_files/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('admin/src_files/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('admin/src_files/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    {{-- Datatables --}}
     <link href="{{asset('admin/src_files/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    {{-- pnotify --}}
    
   {{--  <link href="{{asset('admin/src_files/vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet"> --}}

    <!-- Custom Theme Style -->
    <link href="{{asset('admin/src_files/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('admin.deshboard')}}" class="site_title">
                <img src="{{ asset('images/logo.png')}}" height="70">
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            {{--   <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div> --}}
              <div class="profile_info">
                <span>Welcome,<b>Admin</b></span>
                
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ route('admin.deshboard')}}"><i class="fa fa-home"></i> Home </span></a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li class="sub_menu"><a href="{{route('admin.allSellers')}}">Sellers</a></li>
                        <li><a href="{{route('admin.allBuyers')}}">Buyers</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i>Products<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      {{-- <li><a href="{{route('admin.add_product_form')}}">Add New Product</a></li> --}}
                      <li><a href="{{route('admin.product_list')}}">List Of Products</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Orders <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('admin.all_orders') }}">All Orders</a></li>
                      <li><a href="{{ route('admin.pending_orders') }}">Pending Orders</a></li>
                      <li><a href="{{ route('admin.delivered_orders') }}">Delivered Orders</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-bar-chart-o"></i> Configuration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a><i class="fa fa-bar-chart-o"></i>Category <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.add_main_category_form')}}">Add Category</a></li>
                          <li><a href="{{route('admin.add_first_category_form')}}">Add First Category</a></li>
                          <li><a href="{{route('admin.add_second_category_form')}}">Add Second Category</a></li>
                        </ul>
                      </li>

                      {{-- <li><a><i class="fa fa-bar-chart-o"></i>Sizes <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.add_size_name_form')}}">Add Size Name</a></li>
                          <li><a href="{{route('admin.add_size_form')}}">Add Size</a></li>
                          <li><a href="{{route('admin.size_list')}}">Size List</a></li>
                        </ul>
                      </li> --}}

                      <li><a><i class="fa fa-bar-chart-o"></i>Colors <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.add_color_name_form')}}">Add New Color</a></li>
                          <li><a href="{{route('admin.view_color_list')}}">Colors List</a></li>
                        </ul>
                      </li>

                     {{--  <li><a><i class="fa fa-bar-chart-o"></i>Varients <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.add_varient_name_form')}}">Add Varient Name</a></li>
                           <li><a href="{{route('admin.varient_name_list')}}">Varient Name List</a></li>
                           <li><a href="{{route('admin.map_varient_form')}}">Map Varient</a></li>
                          <li><a href="{{route('admin.view_mapped_varient_list')}}">Mapped Varient List</a></li>
                        </ul>
                      </li> --}}

                      <li><a><i class="fa fa-bar-chart-o"></i>Brand <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.add_brand_name_form')}}">Add Brand Name</a></li>
                           <li><a href="{{route('admin.brand_name_list')}}">Brand Name List</a></li>
                        </ul>
                      </li>

                      <li><a><i class="fa fa-bar-chart-o"></i>State <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.view_state_form')}}">Add New State</a></li>
                        </ul>
                      </li>

                      <li><a><i class="fa fa-bar-chart-o"></i>City <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.view_city_form')}}">Add New City</a></li>
                          <li><a href="{{route('admin.city_list')}}">City List</a></li>
                        </ul>
                      </li>

                      <li><a><i class="fa fa-bar-chart-o"></i>Sliders<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.SliderFormView')}}">Sliders</a></li>
                        </ul>
                      </li>

                    </ul>
                  </li>


                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
             <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->