@extends('web.templet.master')
@section('title','product')

@section('content')
<div class="container">
   
  <header class="page-header">
    @if(isset($seller_details) && !empty($seller_details))
     <div>
        <p> <i class="fa fa-user" style="font-size: 20px; border: 1px solid #80808069; background-color: #80808069; border-radius: 5px; padding: 7px 10px 7px 10px;     position: relative;top: 9px">
        </i>{{$seller_details->seller_name}}</p>
        <p style="font-size: 12px; margin-left: 30px;margin-left: 42px;margin-top: -14px;">{{$seller_details->city_name}}, {{$seller_details->state_name}}</p>
    </div>
    @endif
<hr>
    <ol class="breadcrumb page-breadcrumb">
      <li>
        <a href="#">Home
        </a>
      </li>
      <li>
        <a href="#">Clothing, Shoes & Accessories
        </a>
      </li>
      <li>
        <a href="#">Women's Handbags & Bags
        </a>
      </li>
      <li class="active">Vera Bradley Round Travel Bag
      </li>
    </ol>
  </header>

  @if(isset($product) && !empty($product))
    <div class="row">
      <div class="col-md-4">
        <div class="product-page-product-wrap jqzoom-stage">
          <div class="clearfix">
            <a href="{{ asset('images/product/'. $product->main_image.'')}}" id="jqzoom" data-rel="gal-1">
              <img src="{{ asset('images/product/'. $product->main_image.'')}}" alt="Image Alternative text" title="Image Title" />
            </a>
          </div>
        </div>
        <ul class="jqzoom-list">
          @if(isset($product_images) && !empty($product_images))
            @php
              $flag = true;
            @endphp
            @foreach($product_images as $image)
              @if($flag)
                <li>
                  <a class="zoomThumbActive" href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '{{ asset('images/product/'. $image->image.'')}}', largeimage: '{{ asset('images/product/'. $image->image.'')}}'}">
                    <img src="{{ asset('images/product/thumb/'. $image->image.'')}}" alt="Image Alternative text" title="Image Title" />
                  </a>
                </li>
                @php
                $flag = false;
                @endphp
              @else
                <li>
                  <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '{{ asset('images/product/thumb/'. $image->image.'')}}', largeimage: '{{ asset('images/product/'. $image->image.'')}}'}">
                    <img src="{{ asset('images/product/thumb/'. $image->image.'')}}" alt="Image Alternative text" title="Image Title" />
                  </a>
                </li>
              @endif
            @endforeach
          @endif
          {{-- <li>
            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: 'img/test_product_page/verabag/1.jpg', largeimage: 'img/test_product_page/verabag/1-b.jpg'}">
              <img src="{{asset('src/img/test_product_page/verabag/1-s.jpg')}}" alt="Image Alternative text" title="Image Title" />
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: 'img/test_product_page/verabag/1.jpg', largeimage: 'img/test_product_page/verabag/1-b.jpg'}">
              <img src="{{asset('src/img/test_product_page/verabag/1-s.jpg')}}" alt="Image Alternative text" title="Image Title" />
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: 'img/test_product_page/verabag/1.jpg', largeimage: 'img/test_product_page/verabag/1-b.jpg'}">
              <img src="{{asset('src/img/test_product_page/verabag/1-s.jpg')}}" alt="Image Alternative text" title="Image Title" />
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: 'img/test_product_page/verabag/1.jpg', largeimage: 'img/test_product_page/verabag/1-b.jpg'}">
              <img src="{{asset('src/img/test_product_page/verabag/1-s.jpg')}}" alt="Image Alternative text" title="Image Title" />
            </a>
          </li> --}}
        </ul>
      </div>
      {{ Form::open(['method' => 'post','route'=>'web.add_cart']) }}
                
      <div class="col-md-8">
        <div class="_box-highlight">
          {{-- <ul class="product-page-product-rating">
            <li class="rated"><i class="fa fa-star"></i></li>
            <li class="rated"><i class="fa fa-star"></i></li>
            <li class="rated"><i class="fa fa-star"></i></li>
            <li class="rated"><i class="fa fa-star"></i></li>
            <li class="rated"><i class="fa fa-star"></i></li>
          </ul>
          <p class="product-page-product-rating-sign"><a href="#">238 customer reviews</a></p> --}}
          <h1> {{$product->name}}</h1>
          <hr>
          <div class="flex-spc-betw" style="justify-content:flex-start;margin-bottom:20px;">
              <p class="product-page-price">Rs {{ number_format($product->price,2)}}</p>
              <p class="product-page-price product-caption-old-price ml-20">Rs {{ number_format($product->mrp,2)}}</p>
          </div>
          <p class="product-page-desc-lg">{{$product->short_description}}</p>

          @if(isset($product_color) && !empty($product_color) && count($product_color) > 0)
          <ul class="product-page-option-list">
            <li class="clearfix">
              <h5 class="product-page-option-title">Color</h5>
              <select class="product-page-option-select" name="color">
                @foreach($product_color as $color)
                  <option value="{{$color->color_id}}">{{$color->color_name}}</option>    
                @endforeach
              </select>
            </li>
           {{--  <li class="clearfix"><h5 class="product-page-option-title">Size</h5>
              <select class="product-page-option-select">
                <option selected>Normal</option>
                <option>Large</option>
                <option>Small</option>
              </select>
            </li> --}}
          </ul>
          @endif
          <ul class="product-page-actions-list">
            <li class="product-page-qty-item">
              <div id="qtty_section">
                
              </div>
              <button type="button" class="product-page-qty product-page-qty-minus" >-
              </button>
              <input class="product-page-qty product-page-qty-input" name="quantity" type="number" id="quantity" value="{{$product->min_ord_qtty}}" />

              <button type="button" class="product-page-qty product-page-qty-plus"  >+
              </button>
            </li>
            <li>    
                <input type="hidden" name="product_id" value="{{ encrypt($product->id) }}">
                <button type="submit" class="btn btn-lg btn-primary"> <i class="fa fa-shopping-cart">
                </i>Add to Cart</button>  
              
            </li>
            <li>
              <a class="btn btn-lg btn-default" href="chat">
                 <i style="font-size: 14px;" class="fa fa-comments" aria-hidden="true" >
                    </i> Chat
              </a>
            </li>
          </ul>

          <div class="gap gap-small">
          </div>
        </div>
      </div>

{{ Form::close() }}


    </div>
    <div class="gap">
    </div>
    <div class="tabbable product-tabs">
      <ul class="nav nav-tabs" id="myTab">
        <li class="active">
          <a href="#tab-1" data-toggle="tab">Description
          </a>
        </li>
        {{-- <li>
          <a href="#tab-2" data-toggle="tab">Additional Information
          </a>
        </li> --}}
        {{-- <li>
          <a href="#tab-3" data-toggle="tab">Rating and Reviews
          </a>
        </li> --}}
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab-1">
          <p>{{$product->long_description}}</p>
        </div>
        {{-- <div class="tab-pane fade" id="tab-2">
          <table class="table">
            <tbody>
              <tr>
                <td>Weight:
                </td>
                <td>0.3 kg
                </td>
              </tr>
              <tr>
                <td>Dimensions:
                </td>
                <td>20 ½" W x 12" H x 10 ¾" D with 9" strap drop and 52" removable, adjustable strap
                </td>
              </tr>
              <tr>
                <td>Materials :
                </td>
                <td>100% Cotton
                </td>
              </tr>
              <tr>
                <td>Care Tips:
                </td>
                <td>Machine wash cold, gentle cycle, only non-chlorine bleach when needed; line dry
                </td>
              </tr>
            </tbody>
          </table>
        </div> --}}
        {{-- <div class="tab-pane fade" id="tab-3">
          <div class="row">
            <div class="col-md-8">
              <article class="product-review">
                <div class="product-review-author">
                  <img class="product-review-author-img" src="{{asset('src/img/amaze_70x70.jpg')}}" alt="Image Alternative text" title="Image Title" />
                </div>
                <div class="product-review-content-full">
                  <h5 class="product-review-title">Terrific Buy!
                  </h5>
                  <ul class="product-page-product-rating">
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
                  <p class="product-review-meta">by Leah Kerr on 08/14/2015
                  </p>
                  <p class="product-review-body">Natoque pretium morbi habitasse nec ultricies sodales ligula nullam diam aliquet etiam scelerisque platea vestibulum sagittis porttitor dictumst viverra libero justo tempus
                  </p>
                  <p class="text-success">
                    <strong>
                      <i class="fa fa-check">
                      </i> I would recommend this to a friend!
                    </strong>
                  </p>
                  <ul class="list-inline product-review-actions">
                    <li>
                      <a href="#">
                        <i class="fa fa-flag">
                        </i> Flag this review
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-comment">
                        </i> Comment review
                      </a>
                    </li>
                  </ul>
                </div>
              </article>
              <article class="product-review">
                <div class="product-review-author">
                  <img class="product-review-author-img" src="{{asset('src/img/chiara_70x70.jpg')}}" alt="Image Alternative text" title="Image Title" />
                </div>
                <div class="product-review-content-full">
                  <h5 class="product-review-title">Too Big. Unusable.
                  </h5>
                  <ul class="product-page-product-rating">
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
                    <li>
                      <i class="fa fa-star">
                      </i>
                    </li>
                  </ul>
                  <p class="product-review-meta">by Cyndy Naquin on 08/14/2015
                  </p>
                  <p class="product-review-body">Risus elementum quisque inceptos morbi tempus varius cras dis placerat sapien tristique dictum purus molestie mi luctus parturient tempor hendrerit mus
                  </p>
                  <p class="text-danger">
                    <strong>
                      <i class="fa fa-close">
                      </i> No, I would not recommend this to a friend.
                    </strong>
                  </p>
                  <ul class="list-inline product-review-actions">
                    <li>
                      <a href="#">
                        <i class="fa fa-flag">
                        </i> Flag this review
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-comment">
                        </i> Comment review
                      </a>
                    </li>
                  </ul>
                </div>
              </article>
              <article class="product-review">
                <div class="product-review-author">
                  <img class="product-review-author-img" src="{{asset('src/img/bubbles_70x70.jpg')}}" alt="Image Alternative text" title="Image Title" />
                </div>
                <div class="product-review-content-full">
                  <h5 class="product-review-title">Worth it
                  </h5>
                  <ul class="product-page-product-rating">
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
                  <p class="product-review-meta">by Carol Blevins on 08/14/2015
                  </p>
                  <p class="product-review-body">Placerat vel eu quis rhoncus sociosqu lobortis molestie lacinia metus curabitur nibh iaculis hac scelerisque aliquam sodales dictum imperdiet libero mollis
                  </p>
                  <p class="text-success">
                    <strong>
                      <i class="fa fa-check">
                      </i> I would recommend this to a friend!
                    </strong>
                  </p>
                  <ul class="list-inline product-review-actions">
                    <li>
                      <a href="#">
                        <i class="fa fa-flag">
                        </i> Flag this review
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-comment">
                        </i> Comment review
                      </a>
                    </li>
                  </ul>
                </div>
              </article>
            </div>
            <div class="col-md-4">
              <h3 class="product-tab-rating-title">Overall Customer Rating:
              </h3>
              <ul class="product-page-product-rating product-rating-big">
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
                <li class="count">4.9
                </li>
              </ul>
              <small>238 customer reviews
              </small>
              <p>
                <strong>98%
                </strong> of reviewers would recommend this product
              </p>
              <a class="btn btn-primary" href="#">Write a Review
              </a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p class="category-pagination-sign">238 customer reviews found. Showing 1 - 5
              </p>
            </div>
            <div class="col-md-6">
              <nav>
                <ul class="pagination category-pagination pull-right">
                  <li class="active">
                    <a href="#">1
                    </a>
                  </li>
                  <li>
                    <a href="#">2
                    </a>
                  </li>
                  <li>
                    <a href="#">3
                    </a>
                  </li>
                  <li>
                    <a href="#">4
                    </a>
                  </li>
                  <li>
                    <a href="#">5
                    </a>
                  </li>
                  <li class="last">
                    <a href="#">
                      <i class="fa fa-long-arrow-right">
                      </i>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
    <div class="gap">
    </div>
    <h3 class="widget-title">You Might Also Like
    </h3>
    <div class="row" data-gutter="15">
      @if (isset($related_products) && !empty($related_products))
        @foreach ($related_products as $item)
          <div class="col-md-3">
            <div class="product product-sm-left ">
              <ul class="product-labels">
              </ul>
              <div class="product-img-wrap">
                <img class="product-img" src="{{asset('images/product/thumb/'.$item->main_image.'')}}" alt="Image Alternative text" title="Image Title" />
              </div>
              <a class="product-link" href="product-Details">
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
                  <li>
                    <i class="fa fa-star">
                    </i>
                  </li>
                </ul> --}}
                
                <h3 class="product-caption-title">{{$item->name}}
                </h3>
                <div>
                    <p class="lineclamp3">{{$item->short_description}}</p>
                </div>
                <div class="flex-spc-betw" style="justify-content:flex-start;">
                    <div class="product-caption-price">
                        <span class="product-caption-price-new">{{ number_format($item->price,2)}}</span>
                    </div>
                    <div class="product-caption-old-price">
                        <span class="product-caption-old-price ml-20">{{ number_format($item->mrp,2)}}</span>
                    </div>
                </div>
                </ul>
              </div>
            </div>
          </div>
        @endforeach          
      @endif
      
      {{-- <div class="col-md-3">
        <div class="product product-sm-left ">
          <ul class="product-labels">
          </ul>
          <div class="product-img-wrap">
            <img class="product-img" src="{{asset('src/img/test_product/woman_bags/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
          </div>
          <a class="product-link" href="product-Details">
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
            <h5 class="product-caption-title">Dooney & Bourke Pebble Grain Hobo
            </h5>
            <div class="product-caption-price">
              <span class="product-caption-price-new">Rs 122
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
      <div class="col-md-3">
        <div class="product product-sm-left ">
          <ul class="product-labels">
          </ul>
          <div class="product-img-wrap">
            <img class="product-img" src="{{asset('src/img/test_product/woman_bags/3.jpg')}}" alt="Image Alternative text" title="Image Title" />
          </div>
          <a class="product-link" href="product-Details">
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
            <h5 class="product-caption-title">Dooney & Bourke Pebble Grain Lexington
            </h5>
            <div class="product-caption-price">
              <span class="product-caption-price-new">Rs 131
              </span>
            </div>
            <ul class="product-caption-feature-list">
              <li>Free Shipping
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="product product-sm-left ">
          <ul class="product-labels">
          </ul>
          <div class="product-img-wrap">
            <img class="product-img" src="{{asset('src/img/test_product/woman_bags/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
          </div>
          <a class="product-link" href="product-Details">
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
            <h5 class="product-caption-title">Vera Bradley Vera Tote Bag
            </h5>
            <div class="product-caption-price">
              <span class="product-caption-price-new">Rs 90
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
  @endif

</div>
@endsection

