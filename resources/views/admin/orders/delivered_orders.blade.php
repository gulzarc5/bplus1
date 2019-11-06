@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Delivered Orders</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Order Details Id</th>
                              <th>Order Id</th>
                              <th>Product Id</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th>Price</th>
                              <th>Total</th>
                              <th>Status</th>
                              <td>Buyer Name</td>
                              <td>Seller Name</td>
                              <td>Shipping Address</td>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>                       
                          </tbody>
                        </table>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
	</div>


 @endsection

@section('script')
     
     <script type="text/javascript">
         $(function () {
    
            var table = $('#size_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.ajax_delivered_orders') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'order_id', name: 'order_id',searchable: true},
                    {data: 'product_id', name: 'product_id' ,searchable: true},
                    {data: 'p_name', name: 'p_name' ,searchable: true},       
                    {data: 'quantity', name: 'quantity' ,searchable: true},
                    {data: 'price', name: 'price' ,searchable: true},  
                    {data: 'total', name: 'total' ,searchable: true},            
                    {data: 'status_tab', name: 'status_tab',orderable: false, searchable: false},  
                    {data: 'buyer_name', name: 'buyer_name' ,searchable: true},
                    {data: 'seller_name', name: 'seller_name' ,searchable: true},
                    {data: 'shipping_address', name: 'shipping_address' ,searchable: true},
                    {data: 'date', name: 'date' ,searchable: true},                   
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>
    
 @endsection