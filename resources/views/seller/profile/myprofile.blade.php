@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>My Profile</h2>
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

                    @if(isset($seller) && !empty($seller))
    	            <div class="x_content">
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'seller.MyprofileUpdate']) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter name" value="{{ $seller->name }}" disabled id="name">
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="tag_name">Email</label>
                                  <input type="email" class="form-control" placeholder="Enter Email" value="{{ $seller->email }}" disabled >

                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="mobile">Mobile</label>
                                  <input type="text" class="form-control" name="mobile"  placeholder="Enter Mobile Number" value="{{ $seller->mobile }}" id="mobile" disabled>
                                   @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                                            
                            </div>

                        

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="dob">Date Of Birth</label>
                                  <input type="date" class="form-control" name="dob" id="dob" disabled value="{{ $seller->dob }}">

                                   @if($errors->has('dob'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="pan">PAN No</label>
                                  <input type="text" class="form-control" name="pan" placeholder="Enter PAN Card Number" value="{{ $seller->pan }}" id="pan" disabled>
                                   @if($errors->has('pan'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pan') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                          
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="gst">GST No.</label>
                                  <input type="text" class="form-control" name="gst" placeholder="Enter GST Number" value="{{ $seller->gst }}" id="gst" disabled>
                                  @if($errors->has('gst'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('gst') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="size_wearing">Gender</label>
                                  @if($seller->gender =="F")
                                  <p>
                                    Male:
                                    <input type="radio" class="flat" name="gender" class="genderM" value="M"  required  /> FeMale:
                                    <input type="radio" class="flat" name="gender" class="genderF" value="F" checked />
                                  </p>
                                  @else
                                    <p>
                                    Male:
                                    <input type="radio" class="flat" name="gender" class="genderM" value="M" checked required /> FeMale:
                                    <input type="radio" class="flat" name="gender" class="genderF" value="F"  />
                                  </p>
                                  @endif
                                   @if($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="well" style="overflow: auto">

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="dob">State</label>
                                  <select class="form-control" name="state" id="state" disabled>
                                      <option value="">Please Select State</option>
                                       @if(isset($state) && !empty($state))
                                        @foreach($state as $states)

                                            @if($seller->state == $states->id)
                                                <option selected value="{{ $states->id }}">{{ $states->name }}</option>
                                            @else

                                                <option  value="{{ $states->id }}">{{ $states->name }}</option>

                                            @endif
                                        @endforeach

                                      @endif
                                  </select>
                                  @if($errors->has('state'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="dob">City</label>
                                  <select class="form-control" name="city" id="city" disabled>
                                      <option value="">Please Select City</option>
                                      @if(isset($city) && !empty($city))

                                        @foreach($city as $cities)
                                           @if($seller->city == $cities->id)
                                            <option value="{{ $cities->id }}" selected>{{ $cities->name }}</option>
                                            @else
                                            <option value="{{ $cities->id }}">{{ $cities->name }}</option>

                                            @endif
                                        @endforeach

                                      @endif
                                     
                                  </select>
                                  @if($errors->has('city'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                          
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="pin">PIN Code </label>
                                  <input type="text" class="form-control" name="pin" placeholder="Enter PIN Code" value="{{ $seller->pin }}" disabled id="pin">
                                  @if($errors->has('pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address" rows="4" disabled id="address">{{ $seller->address }}</textarea>
                                </div>
                            </div>

                        </div>
                       
    

                       <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">    

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="bank_name">Bank Name</label>
                                  <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="{{ $seller->bank_name }}" disabled id="bank_name">
                                  @if($errors->has('bank_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="branch_name">Branch Name</label>
                                  <input type="text" class="form-control" name="branch_name" placeholder="Enter Branch Name" value="{{ $seller->branch_name }}" id="branch_name" disabled>
                                  @if($errors->has('branch_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('branch_name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                          
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="account_no">Account Number</label>
                                  <input type="number" class="form-control" name="account_no" placeholder="Enter Account Number" value="{{ $seller->account }}" id="account_no" disabled>

                                    @if($errors->has('account_no'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('account_no') }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>

                             <div class="form-row mb-10">    

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="ifsc">IFSC COde</label>
                                  <input type="text" class="form-control" name="ifsc" placeholder="Enter IFSC Code" value="{{ $seller->ifsc }}" disabled id="ifsc">
                                  @if($errors->has('ifsc'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('ifsc') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="micr">MICR Code</label>
                                  <input type="text" class="form-control" name="micr" placeholder="Enter MICR Code" value="{{ $seller->micr }}" disabled id="micr">
                                </div>

                            </div>
                       </div>


    	            	<div class="form-group" id="seller_btn">
                            <a  class="btn btn-warning" onclick="sellerValidation()">Edit</a>
    	                   
    	            	</div>
    	            	{{ Form::close() }}

    	            </div>
                    @endif
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

  @section('script')
     <script type="text/javascript">
        var color_html = null;
         var size={};
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
                    url:"{{ url('City/list')}}"+"/"+state+"",
                    success:function(data){
                        // console.log(data);
                        // var cat = JSON.parse(data);
                        $("#city").html("<option value=''>Please Select City</option>");

                        $.each( data, function( key, value ) {
                            $("#city").append("<option value='"+key+"'>"+value+"</option>");
                        });

                    }
                });
            });
        });

    </script>
    <script src="{{ asset('seller_js/sellerValidation.js') }}"></script>
 @endsection


        
    