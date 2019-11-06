@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
  @if(isset($product) && !empty($product))
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Product Details</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <table class="table table-striped">
                    <caption>Product Deails</caption>
                    <tr>
                      <th style="width:150px;">Name : </th>
                      <td>{{ $product->name }}</td>
                    </tr>

                    @if(!empty($product->tag_name))
                      <tr>
                        <th>Tag Name : </th>
                        <td>{{ $product->tag_name }}</td>
                      </tr>
                    @endif

                    <tr>
                      <th>Brand : </th>
                      <td>{{ $product->brand_name }}</td>
                    </tr>
                    <tr>
                      <th>Catgory : </th>
                      <td> {{ $product->c_name }} </td>
                    </tr>
                    <tr>
                      <th>First Category : </th>
                      <td> {{ $product->first_c_name }} </td>
                    </tr>
                    <tr>
                      <th>Second Category : </th>
                      <td> {{ $product->second_c_name }} </td>
                    </tr>

                    <tr>
                      <th>M.R.P : </th>
                      <td>{{ number_format( $product->mrp,2,".",'')}}</td>
                    </tr>
                    <tr>
                      <th>Selling Price : </th>
                      <td> {{ number_format($product->price,2,".",'')}} </td>
                    </tr>
                    <tr>
                      <th>Minimum Order Quantity : </th>
                      <td> {{ $product->min_ord_qtty }} </td>
                    </tr>

                    @if(!empty($product->short_description))
                    <tr>
                      <th>Short Description : </th>
                      <td>{{ $product->short_description }}</td>
                    </tr>
                    @endif

                    @if(!empty($product->long_description))
                    <tr>
                      <th>Long Description : </th>
                      <td>{!! $product->long_description !!}</td>
                    </tr>
                    @endif

                  </table>
                </div>
                <div class="col-sm-6 invoice-col">
                  @if(!empty($product->main_image))
                    <table class="table table-striped">
                      <caption>Product Image</caption>                     
                        <tr>
                          <td colspan="2"><img src="{{ asset('images/product/'.$product->main_image.'')}}" height="400px" width="300px"></td>
                        </tr>                   
                    </table>
                  @endif

                </div>
              </div>
              <!-- /.row -->
              <hr>

              @if(isset($colors) && !empty($colors))
              <div class="row">
                <div class="col-xs-12 table">
                  <h5>Color Details</h5>
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                        @php
                        $count_color = 1;
                        @endphp
                        @foreach($colors as $color)
                          <tr>
                            <td> {{ $count_color++ }} </td>
                            <td> {{ $color->c_name }} </td>
                            <td><div class="circle_green" style="padding: 10px 11px; background:{{ $color->c_value }}"></div></td>
                            <td>
                               @if($color->status == '1')
                                  <a class="btn btn-sm btn-success">Enabled</a>
                                @else
                                  <a class="btn btn-sm btn-danger">Disabled</a>
                                @endif
                            </td>
                          </tr>
                        @endforeach
                     
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              @endif


              <div class="row">
                <button class="btn btn-primary" onclick="javascript:window.close()">Window Close</button>
              </div>
              <!-- /.row -->
            </section>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>


 @endsection

@section('script')
     

    
 @endsection