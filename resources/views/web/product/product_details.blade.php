@extends('web.templet.master')
@section('title','Bplus || OnLine Shoping For Branded Electronics, Fashion and Household items')

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
        </ul>
      </div>
      {{ Form::open(['method' => 'post','route'=>'web.add_cart']) }}
                
      <div class="col-md-8">
        <div class="_box-highlight">
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
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab-1">
          <p>{{$product->long_description}}</p>
        </div>
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
      
    </div>
  @endif

</div>
@endsection

