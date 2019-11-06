@extends('web.templet.master')
@section('title', 'cart')
@section('content')
@if ( isset($cart_data) && !empty($cart_data) && (count($cart_data) > 0))
<div class="container">
   <header class="page-header">
      <h2 >My Shopping Bag</h2>
   </header>
   <div class="row">
      <div class="col-md-10">
            @if (Session::has('message'))
               <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif 
            @if (Session::has('error'))
                 <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
         <table class="table table table-shopping-cart">
            <thead>
               <tr>
                  <th>Product</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @php
                  $total = 0; 
               @endphp
               @foreach($cart_data as $cart)
               {{ Form::open(['method' => 'post','route'=>'web.updateCart']) }}
               <tr>
                  <td class="table-shopping-cart-img">
                     <a href="#">
                     <img src="{{ asset('images/product/thumb/'.$cart['image'].'')}}" alt="Image Alternative text" title="Image Title" />
                     </a>
                  </td>
                  <td class="table-shopping-cart-title"><a href="#">{{ $cart['title'] }}</a>
                  </td>
                  <td>₹{{ number_format($cart['price'],2) }}</td>
                  <td>
                     
                        <input class="form-control table-shopping-qty" type="number" name="quantity" value="{{ $cart['quantity'] }}" min="1" />
                        <input type="hidden" name="p_id" value="{{ encrypt($cart['product_id']) }}">
                     
                  </td>
                  <td>
                     @php
                        print number_format((floatval($cart['quantity']) * floatval($cart['price'])),2);
                        $total = $total + (floatval($cart['quantity']) * floatval($cart['price']));
                     @endphp
                  </td>
                  <td class="table-shopping-check-remove">
                     <a class="fa fa-close table-shopping-remove" href="{{ route('cartItemRemove',['p_id'=> encrypt($cart['product_id'])]) }}"></a>
                     <button type="submit" class="fa fa-check table-shopping-check"></button>
                  </td>
               </tr>
               {{ Form::close() }}
               @endforeach
            </tbody>
         </table>
         <div class="gap gap-small"></div>
      </div>
      <div class="col-md-2">
         <ul class="shopping-cart-total-list">
            <li><span>Subtotal</span><span>₹{{ number_format($total,2) }}</span></li>
            <li><span>Shopping</span><span>Free</span></li>
           {{--  <li><span>Taxes</span><span>₹0</span></li> --}}
            <li><span>Total</span><span>₹{{ number_format($total,2) }}</span></li>
         </ul>
         <a class="btn btn-primary" href="{{route('web.checkout')}}">Checkout</a>
      </div>
   </div>
   <ul class="list-inline">
      <li><a class="btn btn-default" href="#">Continue Shopping</a></li>
      {{-- <li><a class="btn btn-default" href="#">Update Bag</a></li> --}}
   </ul>
</div>
@else
<div class="container">
   <div class="text-center"><i class="fa fa-cart-arrow-down empty-cart-icon"></i>
       <p class="lead">You haven't Fill Your Shopping Cart Yet</p><a class="btn btn-primary btn-lg" href="#">Start Shopping <i class="fa fa-long-arrow-right"></i></a>
   </div>
   <div class="gap"></div>
</div>
@endif
@endsection