@extends('web.templet.master')
@section('title','Bplus || OnLine Shoping For Branded Electronics, Fashion and Household items')

@section('content')
<div class="container">
  <header class="page-header">
    <h2 class="page-title">
      @if(isset($first_category) && !empty($first_category))
        {{ $first_category->name }}
      @endif
    </h2>
    <ol class="breadcrumb page-breadcrumb">
      <li>
        <a href="#">Home
        </a>
      </li>
      <li>
        <a class="active">
          @if(isset($first_category) && !empty($first_category))
            {{ $first_category->name }}
          @endif
        </a>
      </li> 
    </ol>
  </header>
</div>
<div class="gap" style="margin-top: -20px;">
</div>
<div class="container">
  <div class="row row-sm-gap" data-gutter="15">
    @if(isset($second_category) && !empty($second_category))

    @foreach($second_category as $category)
      <div class="col-md-3">
        <a class="banner-category" href="{{route('web.product_sellers',['second_category'=>encrypt($category['id'])])}}">
          <img class="banner-category-img" src="{{asset('images/category/second_category/thumb/'.$category['image'].'')}}" alt="Image Alternative text" title="Image Title" height="80px" width="80px" />
          <h5 class="banner-category-title">{{ $category['name'] }}
          </h5>
          <p class="banner-category-desc">
            
              {{ $category['total_product'] }} products
         
           
          </p>
        </a>
      </div>
    @endforeach

    @endif
    {{-- <div class="col-md-3">
      <a class="banner-category" href="{{url('product_saller')}}">
        <img class="banner-category-img" src="{{('src/img/kitchen_icon/1.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Tawas
        </h5>
        <p class="banner-category-desc">599 products
        </p>
      </a>
    </div>
    <div class="col-md-3">
      <a class="banner-category" href="{{url('product_saller')}}">
        <img class="banner-category-img" src="{{('src/img/kitchen_icon/3.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Pressure Cookers
        </h5>
        <p class="banner-category-desc">534 products
        </p>
      </a>
    </div>
    <div class="col-md-3">
      <a class="banner-category" href="{{url('product_saller')}}">
        <img class="banner-category-img" src="{{('src/img/kitchen_icon/4.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Kitchen Tools
        </h5>
        <p class="banner-category-desc">453 products
        </p>
      </a>
    </div>
    <div class="col-md-3">
      <a class="banner-category" href="{{url('product_saller')}}">
        <img class="banner-category-img" src="{{('src/img/kitchen_icon/5.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Gas Stoves
        </h5>
        <p class="banner-category-desc">251 products
        </p>
      </a>
    </div>
    <div class="col-md-3">
      <a class="banner-category" href="{{url('product_saller')}}">
        <img class="banner-category-img" src="{{('src/img/kitchen_icon/6.png')}}" alt="Image Alternative text" title="Image Title" />
        <h5 class="banner-category-title">Rice Cookers
        </h5>
        <p class="banner-category-desc">437 products
        </p>
      </a>
    </div> --}}
  </div>
</div>
@endsection