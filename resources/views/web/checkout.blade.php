@extends('web.templet.master')
@section('title', 'aboutus')
@section('content')
<div class="container">
            <header class="page-header">
                <h1 class="page-title">Checkout Order</h1>
                    @if (Session::has('message'))
                        <div class="alert alert-success" >{{ Session::get('message') }}</div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
            </header>
            {{-- <p class="checkout-login-text">Sign in or Register to your TheBox profile to faster order checkout.</p> --}}
            <div class="row row-col-gap" data-gutter="60">
            	<div class="col-md-12">
                {{ Form::open(['method' => 'post','route'=>'web.final_checkout']) }}

                    <div class="col-md-6">
                        @if(isset($user_data['shipping_adress']) && !empty($user_data['shipping_adress']) && (count($user_data['shipping_adress']) > 0) )
                		<div class="col-md-12" id="address_div">
                            <h3 class="widget-title">Shipping Details</h3>

                            @foreach($user_data['shipping_adress'] as $address)
                                @php
                                    $flag = true;
                                @endphp
                                <div class="box">
                                    @if ($flag)
                                        <input type="radio" name="address_id" value="{{ $address->id }}" checked> 
                                        @php
                                            $flag = false;
                                        @endphp                                       
                                    @else
                                        <input type="radio" name="address_id" value="{{ $address->id }}"> 
                                    @endif
                                    
                                	<p><b>State:</b> {{ $address->s_name}}</p>
                                    <p><b>City:</b> {{ $address->c_name}}</p>
                                    <p><b>Pin Code:</b> {{ $address->pin}}
                                    <p><b>Address:</b> {{ $address->address}} </p>
                                </div>
                            @endforeach
                            <div style="margin-top: 10px;">
                                <button class="btn btn-info" type="button" id="add_new_address_button">New Address</button>
        					</div>
                        </div>
                        @else
                            <div class="col-md-12" >                                
                                <div class="form-group">
                                    <label>State</label>
                                   <select class="form-control" id="state" name="state">
                                      <option selected disabled>Select State</option>
                                      @if(isset($user_data['state']) && !empty($user_data['state']))
                                        @foreach($user_data['state'] as $state)
                                            <option value="{{ $state->id }}">{{ $state->name}}</option>
                                        @endforeach
                                      @endif
                                      
                                   </select>
                                   @if($errors->has('state'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control" id="city" name="city">
                                              <option selected disabled>Select City</option>
                                           </select>
                                            @if($errors->has('city'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pin Code</label>
                                            <input class="form-control" type="text" name="pin" />
                                            @if($errors->has('pin'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('pin') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address"></textarea>
                                    @if($errors->has('address'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                         @endif
                    </div>
                    
                    <div class="col-md-6">
                        <h3 class="widget-title">Order Info</h3>
                        <div class="box">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>QTY</th>
                                        <th>Price</th>
                                        <th>total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($user_data['cart_data']) && !empty($user_data['cart_data']) && count($user_data['cart_data']) )
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach($user_data['cart_data'] as $product)
                                    <tr>
                                        <td>{{ $product['title'] }}</td>
                                        <td>{{ $product['quantity'] }}</td>
                                        <td>₹{{ number_format($product['price'],2) }}</td>
                                        <td>₹{{number_format($product['quantity']*$product['price'],2) }}</td>
                                    </tr>

                                    @php
                                        $total += ($product['quantity']*$product['price']);
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Subtotal</td>
                                        <td>₹{{ number_format($total,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Shipping</td>
                                        <td>₹0</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td>₹{{ number_format($total,2) }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top: 10px; margin-left: 80%;">
                            <button type="submit" class="btn btn-primary">Place Order</button>
    					{{-- <a href="" style="background-color: green;border: 1px green solid;padding: 5px 10px 5px 10px;border-radius: 4px; color: #fff">Place Order</a> --}}
    					</div>
                    </div>
                {{ Form::close() }}  
               
            </div>
            </div>
        </div>

        {{-- state list stored for jquey new address add --}}
        <div id="state_div" style="display:none">
                <select class="form-control" id="states" onchange="getCity()" name="state" required>
                        <option selected value="">Select State</option>
                        @if(isset($user_data['state']) && !empty($user_data['state']))
                          @foreach($user_data['state'] as $state)
                              <option value="{{ $state->id }}">{{ $state->name}}</option>
                          @endforeach
                        @endif
                </select>
        </div>
@endsection

@section('script')
<script>
    function getCity(){
            var state = $("#states").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('City/list/')}}"+"/"+state+"",
                    success:function(data){
                        // console.log(data);
                        // var cat = JSON.parse(data);
                        $("#city").html("<option value=''>Select City</option>");

                        $.each( data, function( key, value ) {
                            $("#city").append("<option value='"+key+"'>"+value+"</option>");
                        });

                    }
                });
    }
        $(document).ready(function(){
            $("#state").change(function(){
                var state = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('City/list/')}}"+"/"+state+"",
                    success:function(data){
                        // console.log(data);
                        // var cat = JSON.parse(data);
                        $("#city").html("<option value=''>Select City</option>");

                        $.each( data, function( key, value ) {
                            $("#city").append("<option value='"+key+"'>"+value+"</option>");
                        });

                    }
                });
            });

            $("#add_new_address_button").click(function(){
                var state = $("#state_div").html();
                var html = '<h3 class="widget-title">Shipping Details</h3>'+
                            '<div class="col-md-12" >  '+                              
                                '<div class="form-group">'+
                                    '<label>State</label>'+
                                    state+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="col-md-8">'+
                                        '<div class="form-group">'+
                                            '<label>City</label>'+
                                            '<select class="form-control" id="city" name="city" required>'+
                                              '<option selected value="">Select City</option>'+
                                           '</select>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-4">'+
                                        '<div class="form-group">'+
                                                '<label>Pin Code</label>'+
                                            '<input class="form-control" type="text" name="pin" required/>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label>Address</label>'+
                                    '<textarea class="form-control" name="address" required></textarea>'+
                                '</div>'+
                            '</div>';
                $("#address_div").html(html);
            });
        });
</script>
@endsection