@if(isset($products) && !empty($products))
<input type="hidden" id="s_category" value="{{encrypt($second_category)}}">
    @if(count($products) > 0)

        @foreach($products as $seller_product)

            <div class="gap"></div>

            <div class="container">
            <div class="col-md-12" style="display: flex;">
                <div class="col-md-11" style="margin-left: -26px;">
                    <p style="font-weight: bold"> <i class="fa fa-user sall" style="margin-right: 5px;"></i>{{ $seller_product['seller_name'] }}</p>
                    <p class="sall1">{{ $seller_product['seller_city'] }}, {{ $seller_product['seller_state'] }}</p>
                </div>
                <div class="col-md-1" style="margin-top: 14px; margin-left: 26px;">
                    <a class="btn btn-primary" href="{{route('web.product_view',['seller_id'=>encrypt($seller_product['seller_id']),'second_category'=>encrypt($seller_product['second_category'])])}}" class="view">View all</a>
                </div>
            </div><hr>
            </div>



            <div class="container">
                <h3 class="widget-title"></h3>
                <div class="row">
                    @foreach($seller_product['product'] as $product)

                        <div class="col-md-2 col-xs-6 seller-product mb-10">
                            <div class="product">
                                <div class="product-img-wrap">
                                    <img class="product-img" src="{{asset('images/product/thumb/'. $product->main_image.'')}}" alt="Image Alternative text" title="Image Title" />
                                </div>
                                <a class="product-link" href="{{route('web.product_details',['product_id' => encrypt($product->id)])}}">
                                </a>
                                <div class="product-caption">
                                    <h5 class="product-caption-title">{{$product->name}}</h5>
                                    <div class="flex-spc-betw">
                                        <div class="product-caption-price">
                                            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size: 16px;margin-top: 0"></i>{{ number_format($product->mrp,2)}}</span>
                                        </div>
                                        <div class="product-caption-old-price">
                                            <span class="product-caption-old-price"> {{ number_format($product->mrp,2)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
           
            </div>

        @endforeach

    @else
    No Products Available
    @endif
<div>
   <center> {!!$products_sellers->links()!!}

</center>
</div>
    

@endif