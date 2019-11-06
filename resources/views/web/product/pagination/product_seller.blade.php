@if(isset($products) && !empty($products))
<input type="hidden" id="s_category" value="{{encrypt($second_category)}}">
    @if(count($products) > 0)

        @foreach($products as $seller_product)

            <div class="gap"></div>

            <div class="container">
            <div class="col-md-12" style="display: flex;">
                <div class="col-md-11" style="margin-left: -26px;">
                    <p> <i class="fa fa-user sall"></i>{{ $seller_product['seller_name'] }}</p>
                    <p class="sall1">{{ $seller_product['seller_city'] }}, {{ $seller_product['seller_state'] }}</p>
                </div>
                <div class="col-md-1" style="margin-top: 25px; margin-left: 26px;">
                    <a href="{{route('web.product_view',['seller_id'=>encrypt($seller_product['seller_id']),'second_category'=>encrypt($seller_product['second_category'])])}}" class="view">View all</a>
                </div>
            </div><hr>
            </div>



            <div class="container">
                <h3 class="widget-title"></h3>
            <div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>


                @foreach($seller_product['product'] as $product)

                    <div class="owl-item">
                        <div class="product  owl-item-slide">
                        <ul class="product-labels">
                            <li>hot</li>
                        </ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="{{asset('images/product/thumb/'. $product->main_image.'')}}" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="{{route('web.product_details',['product_id' => encrypt($product->id)])}}">
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
                            <h5 class="product-caption-title">{{$product->name}}
                            </h5>
                            <div class="product-caption-price">
                            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>{{$product->price}}
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
            {{--   <div class="owl-item">
                <div class="product  owl-item-slide">
                    <ul class="product-labels">
                    <li>hot
                    </li>
                    </ul>
                    <div class="product-img-wrap">
                    <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
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
                    <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
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
                    <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
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
                    <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
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
                    <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
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

        @endforeach

    @else
    No Products Available
    @endif
<div>
   <center> {!!$products_sellers->links()!!}

</center>
</div>
    

@endif