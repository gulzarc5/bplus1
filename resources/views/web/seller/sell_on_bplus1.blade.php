@extends('web.templet.master')
@section('title', 'sell_on_bplus1')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <div class="panel panel-login" style="margin-top: 20px;">
            <div class="panel-heading" style="margin-top: 10px;">
               <div class="row">
                  <center>
                     <div class="col-md-12">
                        <h2>Sell On Bplus</h2>
                     </div>
                  </center>
               </div>
               <hr>
            </div>
            <div class="mfp-with-anim" id="myprofile-form" style=" display: block;">

               @if (Session::has('message'))
                  <div class="alert alert-success" >{{ Session::get('message') }}</div>
               @elseif(Auth::guard('buyer')->user()->user_role == '1')
               @if(isset($user_data) && !empty($user_data))
               {{ Form::open(['method' => 'post','route'=>'web.seller_application_submit']) }}
                  <div class="row">
                     <div class="col-lg-12">
                        <h3 style="margin-left: 15px;">Personal Information</h3>
                        <div style="margin-top: 30px;">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Name</label>
                                 <input class="form-control" type="text" name="name" id="name" value="{{ $user_data['user']->name }}"/>
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Email</label>
                                 <input class="form-control" type="email" value="{{ $user_data['user']->email }}"  disabled/>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Mobile
                                 </label>
                                 <input class="form-control" type="text"  value="{{ $user_data['user']->mobile }}" disabled/>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Date of Birth</label>
                                 <input class="form-control" type="date" name="dob" id="dob" value="{{ $user_data['user_details']->dob }}"/>
                                    @if($errors->has('dob'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Gender</label>
                                 <div style="display: flex;">
                                       @if(!empty($user_data['user_details']->dob) && ($user_data['user_details']->dob == 'F') )
                                       <label class="container">
                                          <input type="radio" checked="checked" name="gender" value="M"  id="m" > Male
                                          <span class="checkmark"></span>
                                       </label>
                                       <label class="container">
                                          <input type="radio" name="gender" value="F"  id="f" checked> Female
                                          <span class="checkmark"></span>
                                       </label>
                                       @else
                                           <label class="container">
                                                <input type="radio" checked="checked" name="gender" value="M"  id="m" checked> Male
                                                <span class="checkmark"></span>
                                             </label>
                                             <label class="container">
                                                <input type="radio" name="gender" value="F"  id="f" > Female
                                                <span class="checkmark"></span>
                                             </label>
                                       @endif

                                       @if($errors->has('gender'))
                                           <span class="invalid-feedback" role="alert" style="color:red">
                                               <strong>{{ $errors->first('gender') }}</strong>
                                           </span>
                                       @enderror
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-lg-12">
                        <h3 style="margin-left: 15px;">Address </h3>
                        <div style="margin-top: 30px;">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>State</label>
                                 <select class="form-control" name="state" id="state">
                                    <option selected disabled>...Select State...</option>
                                       @if(isset($states) && !empty($states))
                                       @foreach($states as $state)
                                          @if($user_data['user_details']->state_id == $state->id)
                                             <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                                          @else
                                             <option value="{{ $state->id }}">{{ $state->name }}</option>
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
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>City</label>
                                 <select class="form-control" name="city" id="city">
                                    <option selected disabled>...Select City...</option>
                                    @if(!empty($user_data['city_list']))
                                       @foreach($user_data['city_list'] as $city)
                                          @if( $user_data['user_details']->city_id == $city->id)
                                             <option  value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                          @else
                                             <option  value="{{ $city->id }}">{{ $city->name }}</option>
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
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Pin Code</label>
                                 <input class="form-control" type="text" name="pin" value="{{ $user_data['user_details']->pin  }}" id="pin" />
                                    @if($errors->has('pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                           <textarea rows="3" cols="45" class="form-control" placeholder="address" name="address" id="address" >{{ $user_data['user_details']->address  }}</textarea>
                        </div>
                  </div>
                     </div>
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-lg-12">
                        <h3 style="margin-left: 15px;">Bank</h3>
                        <div style="margin-top: 30px;">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Bank Name</label>
                                 <input class="form-control" type="text" name="bank_name" />
                                    @if($errors->has('bank_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Branch Name</label>
                                 <input class="form-control" type="text" name="branch_name"/>
                                    @if($errors->has('branch_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('branch_name') }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Account Number</label>
                                 <input class="form-control" type="number" name="account_no" />
                                    @if($errors->has('account_no'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('account_no') }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>IFSC Code</label>
                                 <input class="form-control" type="text" name="ifsc" />
                                    @if($errors->has('ifsc'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('ifsc') }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>MICR Code</label>
                                 <input class="form-control" type="text" name="micr" />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <button type="submit" class="btn btn-primary">Send Seller Request</button>
                  </div>
               {{ Form::close() }}
               @endif
               @endif
               <div class="gap gap-small">
               </div>
            </div>
            <div class="mfp-with-anim mfp-dialog clearfix" id="changepass-form" style="margin-top: -20px; display: none;">
               <form>
                  <div class="form-group">
                     <label>Recent Password
                     </label>
                     <input class="form-control" type="text" />
                  </div>
                  <div class="form-group">
                     <label>New Password
                     </label>
                     <input class="form-control" type="text" />
                  </div>
                  <div class="form-group">
                     <label>Comfirm Password
                     </label>
                     <input class="form-control" type="text" />
                  </div>
                  <input class="btn btn-primary" type="submit" value="Sign In" />
               </form>
               <div class="gap gap-small">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
   $(function() {
   
       $('#myprofile-form-link').click(function(e) {
   		$("#myprofile-form").delay(100).fadeIn(100);
    		$("#changepass-form").fadeOut(100);
   		$('#changepass-form-link').removeClass('active');
   		$(this).addClass('active');
   		e.preventDefault();
   	});
   	$('#changepass-form-link').click(function(e) {
   		$("#changepass-form").delay(100).fadeIn(100);
    		$("#myprofile-form").fadeOut(100);
   		$('#myprofile-form-link').removeClass('active');
   		$(this).addClass('active');
   		e.preventDefault();
   	});
   
   });

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
   })
</script>
@endsection