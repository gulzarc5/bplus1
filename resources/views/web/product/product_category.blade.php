@extends('web.templet.master')
@section('title','product')

@section('content')

<div class="container">
  <div class="mfp-content">
<div class="mfp-with-anim mfp-hide mfp-dialog1 clearfix" id="myModal">
  <img src="{{asset('src/img/product_loader.gif')}}"style='position:relative;top:250px;left:230px;z-index:2000'> 
        </div>
      </div>
  <header class="page-header">
    <h1 class="page-title">
      @if(isset($second_category_name) && !empty($second_category_name))
        @if(!empty($second_category_name->name))
          {{ $second_category_name->name }}
          <input type="hidden" id="category_id_filter" value="{{$second_category_name->id}}">
        @endif
      @endif
    </h1>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Fasion</a></li>
      <li><a href="#">Women</a></li>
      <li><a href="#">Accessories</a></li>
      <li class="active">Handbags</li>
    </ol>
    <ul class="category-selections clearfix">
      <li><a class="fa fa-th-large category-selections-icon active" href="#"></a></li>
      <li><a class="fa fa-th-list category-selections-icon" href="#"></a></li>
      <li>
        <span class="category-selections-sign">Sort by :</span>
        <select class="category-selections-select" id="product_sort">
        <option selected value="newest">Newest First</option>
          <option value="low">Price : Lowest First</option>
          <option value="high">Price : Highest First</option>
          <option value="title_asc">Title : A - Z </option>
          <option value="title_dsc">Title : Z - A</option>
        </select>
      </li>
     {{--  <li>
        <span class="category-selections-sign">Items :
        </span>
        <select class="category-selections-select">
          <option>9 / page
          </option>
          <option selected>12 / page
          </option>
          <option>18 / page
          </option>
          <option>All
          </option>
        </select>
      </li> --}}
    </ul>
  </header>
  <div class="row">
    <div class="col-md-3">
      <aside class="category-filters category-filters-color">

        {{-- FIlter Category Section  --}}
        @if(isset($seller_second_category) && !empty($seller_second_category))
          <div class="category-filters-section">
            <h3 class="widget-title-sm">Category</h3>
            <ul class="cateogry-filters-list">
              @foreach($seller_second_category as $second_category)
                <li><a href="{{route('web.product_view',['seller_id'=>encrypt($second_category->seller_id),'second_category'=>encrypt($second_category->second_category)])}}">{{$second_category->category_name}}</a>
                  
                </li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="category-filters-section popup-text" data-effect="mfp-move-from-top" >
          <h3 class="widget-title-sm">Price</h3>
          <input type="hidden" id="price-slider" />
        </div>


        @if(isset($products_sellers) && !empty($products_sellers))
        <div id="sellers_div">
          <div class="category-filters-section">
            <h3 class="widget-title-sm">Sallers</h3>

            @foreach($products_sellers as $products_seller)
              <div class="checkbox">
                <label onclick="sellersCheckbox()">
                  @if(isset($seller_id) && !empty($seller_id) && ($seller_id == $products_seller->seller_id ))
                  <input class="i-check"  checked type="checkbox"  name="sellers" value="{{ $products_seller->seller_id }}" />{{$products_seller->seller_name}}
                  @else
                    <input class="i-check"  type="checkbox"  name="sellers" value="{{ $products_seller->seller_id }}" />{{$products_seller->seller_name}}
                  @endif
                  <!-- <span class="category-filters-amount">(55)
                  </span> -->
                </label>
              </div>
            @endforeach

          </div>
        </div>

        @endif


        @if(isset($products_brands) && !empty($products_brands))
        <div id="brands_div">
          <div class="category-filters-section">
            <h3 class="widget-title-sm">Brands</h3>

            @foreach($products_brands as $products_brand)
            <div class="checkbox">
              <label onclick="brandsCheckbox()">
                <input class="i-check" type="checkbox"  name="brand" value="{{$products_brand->brand_id}}" />{{$products_brand->brand_name}}
                {{-- <span class="category-filters-amount">({{$products_brand->total}})</span> --}}
              </label>
            </div>
            @endforeach

          </div>
        </div>
        @endif

        @if(isset($product_colors) && !empty($product_colors))
        <div id="colors_div">
          <div class="category-filters-section">
            <h3 class="widget-title-sm">Colors</h3>
            @foreach($product_colors as $product_color)
            <div class="checkbox">
              <label>
                <input class="i-check" type="checkbox" name="color"  value="{{ $product_color->color_id }}" />{{ $product_color->color_name }}<span style="height: 15px; width: 30px;   background-color: {{ $product_color->color_value }}; border-radius: 30%; display: inline-block;"></span>
                {{-- <span class="category-filters-amount">({{ $product_color->total }})
                </span> --}}
              </label>
            </div>
            @endforeach
          </div> 
        </div>

        @endif


    </aside>
    </div>
    <div class="col-md-9" id="pagination_div">
      {{-- //product list Page --}}
      @include('web.product.pagination.product_with_category')
    </div>
  </div>
</div>
@endsection


@section('script')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

@if(isset($product_min_max_price) && !empty($product_min_max_price) && !empty($product_min_max_price->min_price) && !empty($product_min_max_price->max_price))
<script type="text/javascript">
 var prices = null;
  $("#price-slider").ionRangeSlider({
    min: {{ $product_min_max_price->min_price }},
    max: {{ $product_min_max_price->max_price }},
    type: 'double',
    prefix: "Rs ",
    prettify: false,
    hasGrid: false,
     onFinish: function (data) {
      prices = data.from+";"+data.to;
      filterProduct(prices);
    },
});
</script>
@else
<script type="text/javascript">
  $("#price-slider").ionRangeSlider({
    min: 0,
    max: 1000,
    type: 'double',
    prefix: "Rs ",
    prettify: false,
    hasGrid: false,
    onFinish: function (data) {
      prices = data.from+";"+data.to;
      filterProduct(prices);
    },
});
@endif
</script>

<script>

$(".iCheck-helper").click(function () { 
  filterProduct();
})

function sellersCheckbox() {
  filterProduct();
}

function brandsCheckbox() {
  filterProduct();
}

$("#product_sort").change(function(){
  filterProduct();
})



$(document).ready(function () {
    $(document).on('click','.pagination a',function(event){
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      filterProduct(prices,page);
    });
  });


  function filterProduct(prices,page) {
      var category_id_filter = $("#category_id_filter").val();

      var sort = $("#product_sort").val();    

      var filter_color = $("input[name='color']:checked").map(function(){return $(this).val();}).get();

      var filter_sellers = new Array();
      $("input:checkbox[name=sellers]:checked").each(function(){
          filter_sellers.push($(this).val());
      });
      console.log(filter_sellers);
      var filter_brands = new Array();
      $("input:checkbox[name=brand]:checked").each(function(){
          filter_brands.push($(this).val());
      });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    var url_route = null;
    if (page) {
       url_route = "{{ route('web.product_filter')}}?page="+page;
    } else {
      url_route = "{{ route('web.product_filter')}}";
    }

    $.ajax({
        type:"POST",
        url:url_route,
        data:{
          "_token": "{{ csrf_token() }}",
          category:category_id_filter,
          prices:prices,
          colors:filter_color,
          sellers:filter_sellers,
          brands:filter_brands,
          sort:sort,
        },
        beforeSend:function() { 
             $('#myModal').modal('show');
             $("#myModal").removeClass("mfp-hide");


        },
        complete:function() {
          $('#myModal').modal('hide');
          $("#myModal").addClass("mfp-hide");
        },
        success:function(data){
           $("#pagination_div").html(data);
        }
    });
  }



  // function product_Html(products){
  //   var products_html = '';
  //   if (products.length > 0) {
  //     $.each(products, function(key,products){
  //       var product_route = '{{route('web.product_details',['product_id' => encrypt(':id')])}}';
  //       product_route = product_route.replace(':id', products.id);
  //     products_html +='<div class="col-md-4">'+
  //             '<div class="product ">'+
  //                 '<ul class="product-labels"></ul>'+
  //                 '<div class="product-img-wrap">'+
  //                     '<img class="product-img-primary" src="{{asset('images/product/thumb/')}}'+'/'+products.main_image+'" alt="Image Alternative text" title="Image Title" />'+
  //                     '<img class="product-img-alt" src="{{asset('images/product/thumb/')}}'+'/'+products.main_image+'" alt="Image Alternative text" title="Image Title" />'+
  //                 '</div>'+
  //                 '<a class="product-link" href="">'+
  //                 '</a>'+
  //                 '<div class="product-caption">'+
  //                 '<h5 class="product-caption-title">'+products.name+'</h5>'+
  //                     '<div class="product-caption-price">'+
  //                         '<span class="product-caption-price-new">'+products.price+'</span>'+
  //                     '</div>'+
  //                     '<ul class="product-caption-feature-list">'+
  //                         {{-- <li>3 left
  //                         </li> --}}
  //                         '<li>Free Shipping</li>'+
  //                     '</ul>'+
  //                 '</div>'+
  //             '</div>'+
  //           '</div>';
  //     })

  //   }
  //   $("#products_div").html(products_html);
  // }
</script>



@endsection


<script type="text/javascript">
   //*************Sellers Data Add In Html Seller Div***************
           
            // if (response.sellers && (response.sellers.length > 0)) {

            // }
            // if (response.brands) {
            //   brands_html(response.brands);
            // }
            // if (response.colors) {
            //   colors_html(response.colors);
            // }
            // if (response.sellers) {
            //   sallers_html(response.sellers);
            // }
    // function brands_html(brands) {
  //   if (brands.length > 0) {
  //     var brand_html = '<div class="category-filters-section">'+
  //         '<h3 class="widget-title-sm">Brands</h3>';
  //     $.each(brands, function(key,brand){
  //       brand_html +='<div class="checkbox">'+
  //           '<label>'+
  //             '<input class="i-check" style="    position: absolute;margin-left: 5px;margin-top: 1px;" type="checkbox"  name="brand" value="'+brand.brand_id+'" />'+brand.brand_name+''+
  //             '<span class="category-filters-amount">('+brand.total+')</span>'+
  //           '</label>'+
  //         '</div>'; 
  //     });
  //     brand_html +='</div>';
  //     $("#brands_div").html(brand_html);
  //   }else{

  //   }
  // }

  //  function colors_html(colors) {
  //   if (colors.length > 0) {
  //     var colors_html = '<div class="category-filters-section">'+
  //         '<h3 class="widget-title-sm">Colors</h3>';
  //     $.each(colors, function(key,color){
  //       colors_html +='<div class="checkbox">'+
  //           '<label>'+
  //             '<input class="i-check" style="position: absolute;margin-left: 5px;margin-top: 1px;" type="checkbox"  name="brand" value="'+color.color_id+'" />'+color.color_name+''+
  //             '<span style="height: 15px; width: 30px;   background-color: '+color.color_value+'; border-radius: 30%; display: inline-block;"></span><span class="category-filters-amount">('+color.total+')</span>'+
  //           '</label>'+
  //         '</div>'; 
  //     });
  //     colors_html +='</div>';
  //     $("#colors_div").html(colors_html);
  //   }else{

  //   }
  // }

  //  function sallers_html(sellers) {
  //   if (sellers.length > 0) {
  //     var sellers_Html = '<div class="category-filters-section">'+
  //         '<h3 class="widget-title-sm">Colors</h3>';
  //     $.each(sellers, function(key,seller){
  //       sellers_Html +='<div class="checkbox">'+
  //           '<label>'+
  //             '<input class="i-check" style="position: absolute;margin-left: 5px;margin-top: 1px;" type="checkbox"  name="brand" value="'+seller.seller_id+'" />'+seller.seller_name+
  //           '</label>'+
  //         '</div>'; 
  //     });
  //     sellers_Html +='</div>';
  //     $("#sellers_div").html(sellers_Html);
  //   }else{

  //   }
  // }
</script>