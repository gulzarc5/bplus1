@extends('web.templet.master')
@section('title', 'orderhistory')
@section('content')
<div class="container">
   <header class="page-header">
      <h2>Your Order History</h2>
   </header>
   <div class="row">
      <div class="col-md-12">
         <table class="table table table-shopping-cart">
            <thead>
               <tr>
                  <th>Product Id</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Status</th>
               </tr>
            </thead>
            <tbody>
               @if (isset($order_data) && !empty($order_data))
                   @foreach ($order_data as $order)
                     <tr>
                        <td class="table-shopping-cart-title" colspan="6">Order ID : {{ $order['order_id'] }}
                           </td>
                     </tr>
                     @foreach ($order['order_details'] as $product)
                        <tr>
                           <td>{{ $product->product_id }}</td>
                           <td class="table-shopping-cart-title"><a href="#">{{ $product->p_name }}</a></td>
                           <td>₹{{ number_format($product->price,2) }}</td>
                           <td>{{ $product->quantity }}</td>
                           <td>₹{{ number_format(($product->price*$product->quantity),2) }}</td>
                           <td>
                              @if ($product->status == '1')
                                  <button class="btn btn-warning">Waiting For Dispatch</button>
                              @elseif( $product->status == '2' )
                                 <button class="btn btn-info">Shipped</button>
                              @elseif( $product->status == '3' )
                                 <button class="btn btn-primary">Delivered</button>
                              @else
                                 <button class="btn btn-danger">Cancelled</button>
                              @endif
                           </td>
                        </tr>
                     @endforeach                     
                   @endforeach
               @endif
               
               {{-- <tr>
                  <td class="table-shopping-cart-img">
                     <a href="#">
                     <img src="img/cart/2.jpg" alt="Image Alternative text" title="Image Title" />
                     </a>
                  </td>
                  <td class="table-shopping-cart-title"><a href="#">Nikon D5200 24.1 MP Digital SLR Camera</a>
                  </td>
                  <td>₹350</td>
                  <td>1</td>
                  <td>₹350</td>
                   <td><a class="order-status-pending">Panding</a></td>
               </tr>
               <tr>
                  <td class="table-shopping-cart-img">
                     <a href="#">
                     <img src="img/cart/3.jpg" alt="Image Alternative text" title="Image Title" />
                     </a>
                  </td>
                  <td class="table-shopping-cart-title"><a href="#">Apple 11.6" MacBook Air Notebook</a>
                  </td>
                  <td>₹1100</td>
                  <td>1</td>
                  <td>₹1100</td>
                   <td><a class="order-status-pay">Pay</a></td>
               </tr>
               <tr>
                  <td class="table-shopping-cart-img">
                     <a href="#">
                     <img src="img/cart/4.jpg" alt="Image Alternative text" title="Image Title" />
                     </a>
                  </td>
                  <td class="table-shopping-cart-title"><a href="#">Fossil Women's Original Boyfriend</a>
                  </td>
                  
                  <td>₹250</td>
                  <td>3</td>
                  <td>₹250</td>
                  <td><a class="order-status-pending">Panding</a></td>
               </tr> --}}
            </tbody>
         </table>
         <div class="gap gap-small"></div>
      </div>
      
   </div>
   <ul class="list-inline">
      <li><a class="btn btn-default" href="{{route('index_page')}}">Continue Shopping</a>
      </li>
   </ul>
</div>

@endsection