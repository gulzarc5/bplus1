@extends('web.templet.master')

@section('title', 'login')

@section('content')

  <div id="login">
  	<div class="container">
  		<center>
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" >
                	<div  class="col-md-4"></div>
                    <div id="login-box" class="col-md-4">

                        {{ Form::open(array('url' => 'Seller/Login', 'method' => 'post')) }}
                            <h3 class="text-center text-info" style="text-decoration: underline; margin-top: 20px;">Seller Login From</h3>

                            @if (Session::has('message'))
                                <div class="alert alert-success" >{{ Session::get('message') }}</div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger" >{{ Session::get('error') }}</div>
                            @endif

                            <div style="margin-top: 38px;">
                            <div class="form-group">
                                <label for="email" class="text-info"></label><br>
                                <input type="email" name="email" id="email" class="form-control sell_login" placeholder="Enter Your Email">

                                @if ($message = Session::get('login_error'))
                                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                                @if($errors->has('email'))
        	                    	<span class="invalid-feedback" role="alert" style="color:red">
        		                        <strong>{{ $errors->first('email') }}</strong>
        		                    </span>
        		              	@enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info"></label><br>
                                <input type="text" name="password" id="password" class="form-control sell_login" placeholder="Enter Your Password">
                                @if($errors->has('password'))
        	                    	<span class="invalid-feedback" role="alert" style="color:red">
        		                        <strong>{{ $errors->first('password') }}</strong>
        		                    </span>
        		              	@enderror
                            </div>
                            <div class="form-group">
                            	<input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                                <br><br><a href="{{url('seller_register')}}" class="text-info"> Create your Account here</a>
                                <a href="{{url('forgot_password')}}" class="text-info" style="margin-left: 10px;">Forgot Password?</a>
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