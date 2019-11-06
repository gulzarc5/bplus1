@extends('admin.template.admin_master')

@section('content')

         <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          @if(isset($data))
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Buyers</span>
              <div class="count green">
                @if(isset($data['total_buyers']) && !empty($data['total_buyers']))
                  {{ $data['total_buyers'] }}
                @else
                  0
                @endif
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Sellers</span>
              <div class="count green">
                @if(isset($data['total_sellers']) && !empty($data['total_sellers']))
                  {{ $data['total_sellers'] }}
                @else
                  0
                @endif
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Brands</span>
              <div class="count green">
                @if(isset($data['total_brands']) && !empty($data['total_brands']))
                  {{ $data['total_brands'] }}
                @else
                  0
                @endif
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Products</span>
              <div class="count green">
                @if(isset($data['total_products']) && !empty($data['total_products']))
                  {{ $data['total_products'] }}
                @else
                  0
                @endif
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Pending Orders</span>
              <div class="count green">
                @if(isset($data['total_pending_orders']) && !empty($data['total_pending_orders']))
                  {{ $data['total_pending_orders'] }}
                @else
                  0
                @endif
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Seltteled Orders</span>
              <div class="count green">
                @if(isset($data['total_delivered_orders']) && !empty($data['total_delivered_orders']))
                  {{ $data['total_delivered_orders'] }}
                @else
                  0
                @endif
              </div>
            </div>
          </div>
          @endif
          <!-- /top tiles -->

        <div class="clearfix"></div>
       <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Last 10 Added Users</h2>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                   <thead>
                      <tr class="headings">                
                        <th class="column-title">Sl No. </th>
                        <th class="column-title">Name</th>
                        <th class="column-title">Mobile</th>
                        <th class="column-title">User Type</th>
                        <th class="column-title">Date</th>
                   </thead>

                   <tbody>

                    @if(isset($data['last_10_users']) && !empty($data['last_10_users']) && count($data['last_10_users']) > 0)
                      @php
                        $count = 1;
                      @endphp

                      @foreach($data['last_10_users'] as $user)
                        <tr class="even pointer">
                          <td class=" ">{{ $count++ }}</td>
                          <td class=" ">{{ $user->name }}</td>
                          <td class=" ">{{ $user->mobile }}</td>
                          <td class=" ">
                             @if($user->user_role == '1')
                                <button class='btn btn-info'>Buyer</button>
                             @else
                                <button class='btn btn-primary'>Seller</button>
                             @endif
                          </td>
                          <td class=" ">{{ $user->created_at }}</td>
                          
                        </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="5" style="text-align: center">Sorry No Data Found</td>
                      </tr>
                      @endif
                   </tbody>
                </table>
                </div>

            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Last 10 Added Products</h2>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                   <thead>
                      <tr class="headings">                
                        <th class="column-title">Sl No. </th>
                        <th class="column-title">Title</th>
                        <th class="column-title">Main Category</th>
                        <th class="column-title">First Category</th>
                        <th class="column-title">Second Category</th>
                        <th class="column-title">Brand</th>
                        <th class="column-title">Status</th>
                   </thead>

                   <tbody>

                    @if(isset($data['last_10_product']) && !empty($data['last_10_product']) && count($data['last_10_product']) > 0)
                      @php
                        $count = 1;
                      @endphp

                      @foreach($data['last_10_product'] as $product)
                        <tr class="even pointer">
                          <td class=" ">{{ $count++ }}</td>
                          <td class=" ">{{ $product->name }}</td>
                          <td class=" ">{{ $product->c_name }}</td>
                          <td class=" ">{{ $product->first_c_name }}</td>
                          <td class=" ">{{ $product->second_c_name }}</td>
                          <td class=" ">{{ $product->brand_name }}</td>
                          <td class=" ">
                             @if($product->status == '1')
                                <button class='btn btn-primary'>Approved</button>
                             @else
                                <button class='btn btn-warning'>Waiting For Approval</button>
                             @endif
                           </td>
                        </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="7" style="text-align: center">Sorry No Data Found</td>
                      </tr>
                      @endif
                   </tbody>
                </table>
                </div>

            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Last 10 Orders</h2>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                   <thead>
                      <tr class="headings">                
                        <th class="column-title">Sl No. </th>
                        <th class="column-title">Order Details Id</th>
                        <th class="column-title">Order Id</th>
                        <th class="column-title">Product Name</th>
                        <th class="column-title">Quantity</th>
                        <th class="column-title">Price</th>
                        <th class="column-title">Status</th>
                   </thead>

                   <tbody>

                    @if(isset($data['last_10_orders']) && !empty($data['last_10_orders']) && count($data['last_10_orders']) > 0)
                      @php
                        $count = 1;
                      @endphp

                      @foreach($data['last_10_orders'] as $order)
                        <tr class="even pointer">
                          <td class=" ">{{ $count++ }}</td>
                          <td class=" ">{{ $order->id }}</td>
                          <td class=" ">{{ $order->order_id }}</td>
                          <td class=" ">{{ $order->p_name }}</td>
                          <td class=" ">{{ $order->quantity }}</td>
                          <td class=" ">{{ $order->price }}</td>
                          <td class=" ">
                            @if($order->status == '1')
                              <button class='btn btn-warning'>Pending</button>
                            @elseif($order->status == '2')
                              <button class='btn btn-info'>Shipped</button>
                            @elseif($order->status == '3')
                              <button class='btn btn-success'>Delivered</button>
                            @else
                              <button class='btn btn-danger'>Cancelled</button>
                            @endif
                           </td>
                        </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="5" style="text-align: center">Sorry No Data Found</td>
                      </tr>
                      @endif
                   </tbody>
                </table>
                </div>

            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Last 10 Added Brands</h2>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                   <thead>
                      <tr class="headings">                
                        <th class="column-title">Sl No. </th>
                        <th class="column-title">Name</th>
                        <th class="column-title">Main Category</th>
                        <th class="column-title">First Category</th>
                        <th class="column-title">Status</th>
                   </thead>

                   <tbody>

                    @if(isset($data['last_10_Brands']) && !empty($data['last_10_Brands']) && count($data['last_10_Brands']) > 0)
                      @php
                        $count = 1;
                      @endphp

                      @foreach($data['last_10_Brands'] as $brand)
                        <tr class="even pointer">
                          <td class=" ">{{ $count++ }}</td>
                          <td class=" ">{{ $brand->name }}</td>
                          <td class=" ">{{ $brand->c_name }}</td>
                          <td class=" ">{{ $brand->first_c_name }}</td>
                          <td class=" ">
                             @if($brand->status == '1')
                                <button class='btn btn-primary'>Enabled</button>
                             @else
                                <button class='btn btn-warning'>Disabled</button>
                             @endif
                           </td>
                        </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="5" style="text-align: center">Sorry No Data Found</td>
                      </tr>
                      @endif
                   </tbody>
                </table>
                </div>

            </div>
          </div>
        </div>
        </div>
        <!-- /page content -->

 @endsection