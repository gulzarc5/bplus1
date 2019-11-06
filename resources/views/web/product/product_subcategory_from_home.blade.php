@extends('web.templet.master')
@section('title','product')
@section('content')
<div class="container">
  <header class="page-header">
    <h2 class="page-title">
        @if (isset($main_category) && !empty($main_category))
          {{ $main_category->name }}
        @endif
    </h2>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Home</a></li>
      <li>
        <a class="active">
          @if (isset($main_category) && !empty($main_category))
              {{ $main_category->name }}
          @endif
        </a>
      </li>
    </ol>
  </header>
</div>
<div class="gap" style="margin-top: -20px;"></div>
<div class="container">
  {{-- <h4 >kitchen, Cookware & Serveware</h4> --}}
  <hr>
  <div class="row row-sm-gap" data-gutter="15">
    @if (isset($first_category) && !empty($first_category))
        @foreach ($first_category as $category)
          <div class="col-md-3">
            <a class="banner-category" href="{{route('web.sub_category',['first_id'=>encrypt($category['id'])])}}">
              <img class="banner-category-img" src="{{asset('images/category/first_category/thumb/'.$category['image'].'')}}" alt="Image Alternative text" title="Image Title" height="80px" width="80px" />
              <h5 class="banner-category-title">{{ $category['name'] }}</h5>
              <p class="banner-category-desc">{{ $category['total_product'] }} products</p>
            </a>
          </div>
        @endforeach
    @endif
    
    {{-- <div class="col-md-3">
      <a class="banner-category" href="">
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