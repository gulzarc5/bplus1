@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Change Password</h2>
    	            <div class="clearfix"></div>
    	        </div>
                <div>
                     @if (Session::has('message'))
                        <div class="alert alert-success" >{{ Session::get('message') }}</div>
                     @endif
                     @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                     @endif

                </div>
    	        <div>

                    
    	            <d iv class="x_content">
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'seller.change_password']) }}
    	            	
                      <div class="well" style="overflow: auto">

                        <div class="form-group row">
                          <label for="current_password" class="col-sm-4 col-form-label">Enter Current Password</label>                          
                          <div class="col-sm-8">
                             <input type="password" class="form-control" name="current_password"  placeholder="Enter Current Password" >
                              @if($errors->has('current_password'))
                                  <span class="invalid-feedback" role="alert" style="color:red">
                                      <strong>{{ $errors->first('current_password') }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">

                          <label for="tag_name" class="col-sm-4 col-form-label">Enter New Password</label>                          
                          <div class="col-sm-8">
                            <input type="password" name="new_password" class="form-control" placeholder="Enter New Password">

                            @if($errors->has('new_password'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('new_password') }}</strong>
                              </span>
                            @enderror
                          </div>

                        </div>

                        <div class="form-group row">
                          <label for="tag_name" class="col-sm-4 col-form-label">Enter Confirm Password</label>

                          <div class="col-sm-8">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Re Enter New Password">

                            @if($errors->has('confirm_password'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                              </span>
                            @enderror
                          </div>

                        </div>

                     </div>

    	            	<div class="form-group" id="seller_btn">
                         <button type="submit" name="submit" class="btn btn-success">Submit</button> 
    	            	</div>
    	            	{{ Form::close() }}

    	            </div>
    	        </div>
    	    </div>
    	</div>
    	<div class="col-md-2"></div>
    </div>
</div>


 @endsection


        
    