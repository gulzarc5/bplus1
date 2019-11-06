<div class="row" data-gutter="15" id="products_div">
    @if(isset($product_against_seller) && !empty($product_against_seller))
      @foreach($product_against_seller as $products)
        <div class="col-md-4">
          <div class="product ">
              <ul class="product-labels">
              </ul>
              <div class="product-img-wrap">
                  <img class="product-img-primary" src="{{asset('images/product/thumb/'. $products->main_image.'')}}" alt="Image Alternative text" title="Image Title" />
                  <img class="product-img-alt" src="{{asset('images/product/thumb/'. $products->main_image.'')}}" alt="Image Alternative text" title="Image Title" />
              </div>
              <a class="product-link" href="{{route('web.product_details',['product_id' => encrypt($products->id)])}}">
              </a>
              <div class="product-caption">
                  <h5 class="product-caption-title">{{$products->name}}</h5>
                  <div class="flex-spc-betw">
                      <div class="product-caption-price">
                          <span class="product-caption-price-new">{{ number_format($products->price,2)}}</span>
                      </div>
                      <div class="product-caption-old-price">
                          <span class="product-caption-old-price"> {{ number_format($products->mrp,2)}}</span>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
  <div class="row">
    {!! $product_against_seller->links() !!}
  </div>