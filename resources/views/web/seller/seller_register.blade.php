@extends('web.templet.master')

@section('title', 'register')

@section('content')

  <div id="login">
  	<div class="container">
  		<center>
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" >
                	<div  class="col-md-4"></div>
                    <div id="login-box" class="col-md-4">
                        {{ Form::open(['method' => 'post','route'=>'seller.registration']) }}
                            <h3 class="text-center text-info" style="text-decoration: underline;margin-top: 20px;">Seller Registration From</h3>
                            @if (Session::has('message'))
                                <div class="alert alert-success" >{{ Session::get('message') }}</div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger" >{{ Session::get('error') }}</div>
                            @endif
                            <div style="margin-top: 38px;">
                            <div class="form-group">
                                <label for="username" class="text-info"></label><br>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" placeholder="Enter Your Name" >

                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @enderror
                                {{-- <input type="text" name="username" id="username" class="form-control sell_login" placeholder="Enter Your Name">
                                @if($errors->has('username'))
        	                    	<span class="invalid-feedback" role="alert" style="color:red">
        		                        <strong>{{ $errors->first('username') }}</strong>
        		                    </span>
        		              	@enderror --}}
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info"></label><br>
                                <input type="email" name="email" id="email" class="form-control sell_login @error('email') is-invalid @enderror" placeholder="Enter Your Email" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="text-info"></label><br>
                                <input type="mobile" name="mobile" id="mobile" class="form-control sell_login @error('mobile') is-invalid @enderror" placeholder="Enter Your Mobile No" value="{{ old('mobile') }}">
                                @if($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info"></label><br>
                                <input type="text" name="password" id="password" class="form-control sell_login" placeholder="Enter Password">
                                @if($errors->has('password'))
        	                    	<span class="invalid-feedback" role="alert" style="color:red">
        		                        <strong>{{ $errors->first('password') }}</strong>
        		                    </span>
        		              	@enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="text-info"></label><br>
                                <input type="text" name="password_confirmation"  class="form-control sell_login" placeholder="Re Enter Password">
                                @if($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                            	<input type="submit" name="submit" class="btn btn-info btn-md" value="Register">
                               &nbsp; &nbsp; &nbsp;<a href="{{url('seller_login')}}" class="text-info"> Login Here</a>
                            </div>
                        </div>
                        {{ Form::close() }}


                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </center>
       
        </div>
    </div>
@endsection