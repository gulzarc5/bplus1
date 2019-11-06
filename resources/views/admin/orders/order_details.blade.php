@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Order Details</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              <div class="row invoice-info">
                @if (isset($data['buyer_info']) && !empty($data['buyer_info']))               
                    <div class="col-sm-6 invoice-col">
                    <table class="table table-striped">
                        <caption>Buyer Deails</caption>
                        <tr>
                            <th style="width:150px;">Name : </th>
                            <td>{{ $data['buyer_info']->name }}</td>
                        </tr>
                        <tr>
                            <th>Email : </th>
                            <td>{{ $data['buyer_info']->email }}</td>
                        </tr>
                        <tr>
                            <th>Mobile No : </th>
                            <td> {{ $data['buyer_info']->mobile }} </td>
                        </tr>
                    </table>
                    </div>
                @endif

                @if (isset($data['seller_info']) && !empty($data['seller_info']))
                    <div class="col-sm-6 invoice-col">
                    <table class="table table-striped">
                        <caption>Seller Deails</caption>
                        <tr>
                        <th>Seller Name : </th>
                        <td>{{ $data['seller_info']->name }}</td>
                        </tr>
                        <tr>
                        <th>Email : </th>
                        <td> {{ $data['seller_info']->email }} </td>
                        </tr>
                        <tr>
                        <th>Mobile : </th>
                        <td>  {{ $data['seller_info']->email }} </td>
                        </tr>
                    </table>
                    </div>
                @endif
              </div>
              <!-- /.row -->
              <hr>
              @if(isset($data['shipping_info']) && !empty($data['shipping_info']))
              <div class="row">
                <div class="col-xs-12 table">
                  <h5>Shipping Details</h5>
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Pin</th>
                      </tr>
                    </thead>
                    <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> {{ $data['shipping_info']->s_name }} </td>
                            <td>{{ $data['shipping_info']->c_name }}</td>
                            <td>{{ $data['shipping_info']->address }}</td>
                            <td>{{ $data['shipping_info']->pin }}</td>
                          </tr>                     
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
               @endif

               @if(isset($data['orders']) && !empty($data['orders']))
              <div class="row">
                <div class="col-xs-12 table">
                  <h5>Product Details</h5>
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Order Details Id</th>
                        <th>Order Id</th>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Color</th>
                        <th>Quantiy</th>
                        <th>Price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> {{ $data['orders']->id }} </td>
                            <td>{{ $data['orders']->order_id }}</td>
                            <td>{{ $data['orders']->product_id }}</td>
                            <td>{{ $data['orders']->p_name }}</td>
                            <td>
                                @if (isset($data['color']) && !empty($data['color']) )
                                ({{ $data['color']->name }})<div class="circle_green" style="padding: 10px 11px; background:{{ $data['color']->value }}">
                                @else
                                    ----                                    
                                @endif
                            </td>
                            <td>{{ $data['orders']->quantity }}</td>
                            <td>{{ number_format($data['orders']->price,2) }}</td>
                            <td>{{ number_format(($data['orders']->price*$data['orders']->quantity),2) }}</td>
                          </tr>                     
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
 
</div>


 @endsection

