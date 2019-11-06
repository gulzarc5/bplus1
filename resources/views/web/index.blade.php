@extends('web.templet.master')

@section('title', 'home')



@section('content')

<div class="owl-carousel owl-loaded owl-nav-dots-inner" data-options='{"items":1,"loop":true,"autoplay":true,"autoplayTimeout":5000}'>
  <div class="owl-item">
    <div class="slider-item" style="background-image:url('src/img/slider/slider1.jpg');">
      <div class="container">
        <div class="slider-item-inner">
          <div class="slider-item-caption-left">
            <h4 class="slider-item-caption-title" style="font-size: 40px;">Last Chance to Grab These Clearance Items
            </h4>
            <p class="slider-item-caption-desc">Better Living , Better Price
            </p>
            <a class="btn btn-lg btn-ghost btn-black" href="#">Shop Now
            </a>
          </div>
         <!--  <img class="slider-item-img-right" src="img/headphone.jpg" alt="Image Alternative text" title="Image Title" style="top: 60%; width: 56%;" /> -->
        </div>
      </div>
    </div>
  </div>
  <div class="owl-item">
    <div class="slider-item" style="background-image:url('src/img/slider/slider2.png');">
      <div class="container">
        <div class="slider-item-inner">
          <div class="slider-item-caption-right slider-item-caption-white">
            <h4 class="slider-item-caption-title" style="font-size: 40px;">Long Flared Kurtas
            </h4>
            <p class="slider-item-caption-desc">Get One Just from <i class="fa fa-rupee"></i>499
            </p>
            <a class="btn btn-lg btn-ghost btn-white" href="#">Shop Now
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="owl-item">
    <div class="slider-item" style="background-image:url('src/img/slider/slider3.png');">
      <div class="container">
        <div class="slider-item-inner">
          <div class="slider-item-caption-left">
            <h4 class="slider-item-caption-title" style="color: #fff;">Sale! Sale! Sale!
            </h4>
            <p class="slider-item-caption-desc" style="color: #fff;">Your Top Model Leptops, Right Away.
            </p>
            <a class="btn btn-lg btn-ghost btn-black" href="#" style="border-color: #fff;
            color: #fff">Shop Now
            </a>
          </div>
          <!-- <img class="slider-item-img-right" src="img/test_slider/3.png" alt="Image Alternative text" title="Image Title" /> -->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="gap">
</div>
<div class="container">
  <h3 class="widget-title-lg">Shop by Category
  </h3>
  <div class="row row-sm-gap" data-gutter="15">
    <div class="col-md-2">
      <a class="banner-category" href="{{route('web.first_category',['main_category_id'=>encrypt(1)])}}">
        <img class="banner-category-img" src="{{asset('src/img/test_icon/exterior.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Home & Furniture
        </h5>
        {{-- <p class="banner-category-desc">173 products
        </p> --}}
      </a>
    </div>
    <div class="col-md-2">
      <a class="banner-category" href="{{route('web.first_category',['main_category_id'=>encrypt(4)])}}">
        <img class="banner-category-img" src="{{asset('src/img/test_icon/tech.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Electronics & Appliances</h5>
        {{-- <p class="banner-category-desc">599 products</p> --}}
      </a>
    </div>
    <div class="col-md-2">
      <a class="banner-category" href="{{route('web.first_category',['main_category_id'=>encrypt(6)])}}">
        <img class="banner-category-img" src="{{asset('src/img/test_icon/clothes.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Women Clothes & Accessories
        </h5>
        {{-- <p class="banner-category-desc">534 products</p> --}}
      </a>
    </div>
    <div class="col-md-2">
      <a class="banner-category" href="{{route('web.first_category',['main_category_id'=>encrypt(9)])}}">
        <img class="banner-category-img" src="{{asset('src/img/test_icon/art.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Sports, Books & More
        </h5>
        {{-- <p class="banner-category-desc">453 products</p> --}}
      </a>
    </div>
    <div class="col-md-2">
      <a class="banner-category" href="{{route('web.first_category',['main_category_id'=>encrypt(7)])}}">
        <img class="banner-category-img" src="{{asset('src/img/test_icon/garage.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">TVs & Appliances</h5>
        {{-- <p class="banner-category-desc">251 products</p> --}}
      </a>
    </div>
    <div class="col-md-2">
      <a class="banner-category" href="{{route('web.first_category',['main_category_id'=>encrypt(8)])}}">
        <img class="banner-category-img" src="{{asset('src/img/test_icon/baby-room.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Baby & Kids</h5>
        {{-- <p class="banner-category-desc">437 products</p> --}}
      </a>
    </div>
  </div>
</div>
<div class="gap">
</div>
<div class="container" style="margin-top: -85px;">
  <div class="gap">
  </div>
  <div class="row" data-gutter="15">
    <div class="col-md-4">
      <div class="banner banner-o-hid" style="background-image:url(src/img/test_banner/landscape.jpg);">
        <a class="banner-link" href="#"></a>
        <div class="banner-caption-left">
          <h5 class="banner-title">Discover The Mountains
          </h5>
          <p class="banner-desc">Pro Backpacks 70% Off.
          </p>
          <p class="banner-shop-now">Shop Now 
            <i class="fa fa-caret-right">
            </i>
          </p>
        </div>
        <img class="banner-img" src="{{asset('src/img/test_banner/16.png')}}" alt="Image Alternative text" title="Image Title" style="bottom: -68px; right: -32px; width: 200px;" />
      </div>
    </div>
    <div class="col-md-8">
      <div class="banner banner-o-hid" style="background-image:url(src/img/test_banner/sofa.jpg);">
        <a class="banner-link" href="#"></a>
        <div class="banner-caption-left">
          <h5 class="banner-title">Sofas
          </h5>
          <p class="banner-desc">Comfortable Seating 
          </p>
          <p class="banner-shop-now">Shop Now 
            <i class="fa fa-caret-right">
            </i>
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="banner banner-o-hid" style="background-color:#EA873B;">
        <a class="banner-link" href="#"></a>
        <div class="banner-caption-left">
          <h5 class="banner-title">Top Selling Kitchen Accessories
          </h5>
          <p class="banner-desc">Upto 10% off on exch
          </p>
          <p class="banner-shop-now">Shop Now 
            <i class="fa fa-caret-right">
            </i>
          </p>
        </div>
        <img class="banner-img" src="{{asset('src/img/test_banner/17.png')}}" alt="Image Alternative text" title="Image Title" style="top: 17px; right: -45px; width: 350px;" />
      </div>
    </div>
    <div class="col-md-6">
      <div class="banner banner-o-hid" style="background-image:url(src/img/test_banner/19.jpg);">
        <a class="banner-link" href="#"></a>
        <div class="banner-caption-left">
          <h5 class="banner-title">Smartphones Under <i class="fa fa-rupee" style="font-size:24px"></i>8000
          </h5>
          <p class="banner-desc">Low Price for Great Perfomance
          </p>
          <p class="banner-shop-now">Shop Now 
            <i class="fa fa-caret-right">
            </i>
          </p>
        </div>
        <img class="banner-img" src="{{asset('src/img/test_banner/18.png')}}" alt="Image Alternative text" title="Image Title" style="top: 17px; right: -45px; width: 350px;" />
      </div>
    </div>
    <div class="col-md-4">
      <div class="banner banner-o-hid" style="background-image:url(src/img/test_banner/26.jpg);">
        <a class="banner-link" href="#"></a>
        <div class="banner-caption-left">
          <h5 class="banner-title">Top Rated Laptops
          </h5>
          <p class="banner-desc">Best Prices | Top Brands
          </p>
          <p class="banner-shop-now">Shop Now 
            <i class="fa fa-caret-right">
            </i>
          </p>
        </div>
        <img class="banner-img" src="{{asset('src/img/test_banner/20.png')}}" alt="Image Alternative text" title="Image Title" style="bottom: -20px; right: -60px; width: 240px;" />
      </div>
    </div>
    <div class="col-md-4">
      <div class="banner banner-o-hid" style="background-image:url(src/img/test_banner/22.jpg);">
        <a class="banner-link" href="#"></a>
        <div class="banner-caption-left">
          <h5 class="banner-title">New Jeans Collection
          </h5>
          <p class="banner-desc">Exeedingly Good Jeans
          </p>
          <p class="banner-shop-now">Shop Now 
            <i class="fa fa-caret-right">
            </i>
          </p>
        </div>
        <img class="banner-img" src="{{asset('src/img/test_banner/21.png')}}" alt="Image Alternative text" title="Image Title" style="bottom: -29px; right: -51px; width: 240px;" />
      </div>
    </div>
    <div class="col-md-4">
      <div class="banner banner-o-hid" style="background-image:url(src/img/test_banner/light.jpg);">
        <a class="banner-link" href="#"></a>
        <div class="banner-caption-left">
          <h5 class="banner-title">Top Office Furniture
          </h5>
          <p class="banner-desc">Officeized!!
          </p>
          <p class="banner-shop-now">Shop Now 
            <i class="fa fa-caret-right">
            </i>
          </p>
        </div>
        <img class="banner-img" src="{{asset('src/img/test_banner/23.png')}}" alt="Image Alternative text" title="Image Title" style="bottom: -118px; right: 8px; width: 190px;" />
      </div>
    </div>
  </div>
  <div class="gap">
  </div>
  <h3 class="widget-title">New Arrival
  </h3>
  <div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>
    @if(isset($data['newarrival']) && !empty($data['newarrival']))
      @foreach($data['newarrival'] as $newarrival)
        <div class="owl-item">
          <div class="product  owl-item-slide">
            {{-- <ul class="product-labels">
              <li>stuff pick
              </li>
            </ul> --}}
            <div class="product-img-wrap">
              <img class="product-img" src="{{asset('images/product/thumb/'.$newarrival->main_image.'')}}" alt="Image Alternative text" title="Image Title" />
            </div>
            <a class="product-link" href="{{ route('web.product_details',['product_id'=>encrypt($newarrival->id)]) }}">
            </a>
            <div class="product-caption">
              {{-- <ul class="product-caption-rating">
                <li class="rated">
                  <i class="fa fa-star">
                  </i>
                </li>
                <li class="rated">
                  <i class="fa fa-star">
                  </i>
                </li>
                <li class="rated">
                  <i class="fa fa-star">
                  </i>
                </li>
                <li class="rated">
                  <i class="fa fa-star">
                  </i>
                </li>
                <li class="rated">
                  <i class="fa fa-star">
                  </i>
                </li>
              </ul> --}}
              <h5 class="product-caption-title">{{ $newarrival->name }}</h5>
              <div class="product-caption-price">
                <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size: 16px;"></i>{{ $newarrival->price }}
                </span>
              </div>
              <ul class="product-caption-feature-list">
                <li>Free Shipping
                </li>
              </ul>
            </div>
          </div>
        </div>
      @endforeach
    @endif
    {{-- <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/furniture/6.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Modern Parson Dinner Dining Chair High Back Seat Kitchen Living Room Black Brown
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size: 16px;"></i>103
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/woman_heels/1.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">New Authentic Gucci Patent Leather Open Toe Platform Pump,Gren, 309984 3125
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size: 16px;"></i>68
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>1 left
            </li>
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/35.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">LG G3 VS985 - 32GB - Verizon Smartphone - Metallic Black or Silk White - Great
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size: 16px;"></i>86
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>3 left
            </li>
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>stuff pick
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Diesel Not So Basic Brown Leather Analog Mens Watch DZ1206
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size: 16px;"></i>125
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>1 left
            </li>
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>-70%
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/woman_running_shoes/5.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">PUMA Faas 700 v2 Women's Running Shoes
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-old"><i class="fa fa-rupee" style="font-size: 16px;"></i>129
            </span>
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size: 16px;"></i>39
            </span>
          </div>
          <ul class="product-caption-feature-list">
            
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>stuff pick
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/woman_bags/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Vera Bradley Vera Tote Bag
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size: 16px;"></i>65
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div> --}}
  </div>
  <div class="gap">
  </div>
  <div class="row" data-gutter="15">
    <div class="col-md-6">
      <div class="banner banner-o-hid" style="background-image:url(src/img/sunglass.jpg);">
        <a class="banner-link" href="#">
        </a>
        <div class="banner-caption-left">
          <h5 class="banner-title">Woman Sunglasses
          </h5>
          <p class="banner-desc">Up to 70% Off.
          </p>
          <p class="banner-shop-now">Shop Now 
            <i class="fa fa-caret-right">
            </i>
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="banner banner-o-hid" style="background-image:url(src/img/head.jpg);">
        <a class="banner-link" href="#">
        </a>
        <div class="banner-caption-left">
          <h5 class="banner-title">Headphones
          </h5>
          <p class="banner-desc">Sony, Sennheiser & more
          </p>
          <p class="banner-shop-now">Shop Now 
            <i class="fa fa-caret-right">
            </i>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="gap">
</div>
<div class="container">
  <h3 class="widget-title">Best Selling
  </h3>
  <div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>

    @if(isset($data['best_selling']) && !empty($data['best_selling']))
      @foreach($data['best_selling'] as $best_selling)
        <div class="owl-item">
          <div class="product  owl-item-slide">
            <ul class="product-labels">
            </ul>
            <div class="product-img-wrap">
              <img class="product-img" src="{{asset('images/product/thumb/'.$best_selling->main_image.'')}}" alt="Image Alternative text" title="Image Title" />
            </div>
            <a class="product-link" href="{{ route('web.product_details',['product_id'=>encrypt($best_selling->id)]) }}">
            </a>
            <div class="product-caption">
              <ul class="product-caption-rating">
                <li class="rated">
                  <i class="fa fa-star">
                  </i>
                </li>
                <li class="rated">
                  <i class="fa fa-star">
                  </i>
                </li>
                <li class="rated">
                  <i class="fa fa-star">
                  </i>
                </li>
                <li>
                  <i class="fa fa-star">
                  </i>
                </li>
                <li>
                  <i class="fa fa-star">
                  </i>
                </li>
              </ul>
              <h5 class="product-caption-title">{{ $best_selling->name }}</h5>
              <div class="product-caption-price">
                <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>{{ $best_selling->price }}</span>
              </div>
              <ul class="product-caption-feature-list">
                <li>Free Shipping
                </li>
              </ul>
            </div>
          </div>
        </div>
      @endforeach
    @endif
    {{-- <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Diesel Not So Basic Brown Leather Analog Mens Watch DZ1206
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>102
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/furniture/5.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Metal Portable Bar Table w/ Carrying Case - Metal Construction Party
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>72
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/1.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Alpine Swiss Beck Mens Suede Chukka Desert Boots Lace Up Shoes Crepe Sole Oxford
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>129
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>3 left
            </li>
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>-50%
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/sports/6.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">72 Sq Ft Black Foam Interlocking Exercise Protective Tile Flooring Gym Floor Mat
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-old"><i class="fa fa-rupee" style="font-size:16px"></i>130
            </span>
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>65
            </span>
          </div>
          <ul class="product-caption-feature-list">
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/32.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">LG G Flex D959 - 32GB - Titan Silver GSM Unlocked Android Smartphone (B)
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>147
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>-40%
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/laptops/5.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="#">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Lenovo ThinkPad 11e 11.6" Notebook, AMD A4-6210 1.8GHz, 4GB RAM, 500GBHDD, W7Pro
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-old"><i class="fa fa-rupee" style="font-size:16px"></i>74
            </span>
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>45
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div> --}}
  </div>
</div>


@endsection