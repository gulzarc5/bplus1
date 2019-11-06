@extends('web.templet.master')
@section('title', 'myProfile')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <div class="panel panel-login" style="margin-top: 20px;">
            <div class="panel-heading" style="margin-top: 10px;">
               <div class="row">
                  <center>
                     <div class="col-md-4">
                        <a href="#" class="active" id="myprofile-form-link">My Profile</a>
                     </div>
                     <div class="col-md-4">
                        <a href="#"  id="shippingaddress-form-link">Shipping Address</a>
                     </div>
                     <div class="col-md-4">
                        <a href="#" id="changepass-form-link">Change Password</a>
                     </div>
                  </center>
               </div>
               <hr>
               @if (Session::has('message'))
                  <div class="alert alert-success" >{{ Session::get('message') }}</div>
               @endif
               @if (Session::has('error'))
                  <div class="alert alert-danger">{{ Session::get('error') }}</div>
               @endif
            </div>
            <div class="mfp-with-anim" id="myprofile-form" style=" display: block;">
               @if(isset($user_data) && !empty($user_data))

                 {{ Form::open(['method' => 'post','route'=>'web.myprofile_update']) }}
                     <div class="row">
                        <div class="col-lg-12">
                           <h3 style="margin-left: 15px;">Personal Information</h3>
                           <div style="margin-top: 30px;">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{ $user_data['user']->name }}" disabled/>
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
                                    <label>Mobile</label>
                                    <input class="form-control" type="text"  value="{{ $user_data['user']->mobile }}" disabled/>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input class="form-control" type="date" name="dob" id="dob" value="{{ $user_data['user_details']->dob }}" disabled/>
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
                                       @if(!empty($user_data['user_details']->gender) && ($user_data['user_details']->gender == 'F') )
                                       <label class="container">
                                          <input type="radio" checked="checked" name="gender" value="M" disabled id="m" > Male
                                          <span class="checkmark"></span>
                                       </label>
                                       <label class="container">
                                          <input type="radio" name="gender" value="F" disabled id="f" checked> Female
                                          <span class="checkmark"></span>
                                       </label>
                                       @else
                                           <label class="container">
                                                <input type="radio" checked="checked" name="gender" value="M" disabled id="m" checked> Male
                                                <span class="checkmark"></span>
                                             </label>
                                             <label class="container">
                                                <input type="radio" name="gender" value="F" disabled id="f" > Female
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
                                    <select class="form-control" name="state" id="state" disabled>
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
                                    <select class="form-control" name="city" id="city" disabled>
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
                                    <input class="form-control" type="text" name="pin" value="{{ $user_data['user_details']->pin  }}" id="pin" disabled/>
                                    @if($errors->has('pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <textarea rows="3" cols="45" class="form-control" placeholder="address" name="address" id="address" disabled>{{ $user_data['user_details']->address  }}</textarea>
                        </div>
                     </div>
                     <div class="col-md-12" id="profile_btn">
                        <a class="btn btn-warning" onclick="userProfileValidation()"> Edit </a>
                     </div>
                  {{ Form::close() }}
               @endif
               <div class="gap gap-small">
               </div>
            </div>
            <div class="mfp-with-anim mfp-dialog clearfix" id="changepass-form" style="margin-top: -20px; display: none;">
                  <div id="err_msg"></div>
                  <div class="form-group">
                     <label>Current Password</label>
                     <input class="form-control" type="text" name="current_pass" />
                  </div>
                  <div class="form-group">
                     <label>New Password</label>
                     <input class="form-control" type="text" name="new_pass" />
                  </div>
                  <div class="form-group">
                     <label>Comfirm Password</label>
                     <input class="form-control" type="text" name="confirm_pass" />
                  </div>
                  <input class="btn btn-primary" type="button" value="Submit" id="pass_change" />
              
               <div class="gap gap-small">
               </div>
            </div>
            <div class="mfp-with-anim " id="shippingaddress-form" style="margin-top: -20px; display: none;">
               @if(isset($shipping_adress) && !empty($shipping_adress))
               @php
                   $count = 1;
               @endphp
               @foreach ($shipping_adress as $addr)
               @php
                   $count++;
               @endphp
                  <div class="row">
                     <div class="col-lg-12">
                        <div id="msg{{$count}}"></div>
                        <div style="margin-top: 30px;">
                           <div class="col-md-4">
                           <input type="hidden" value="{{$addr->id}}" id="addr_id{{$count}}">
                              <div class="form-group">
                                 <label>State</label>
                              <select class="form-control" onchange="state_ship({{$count}})" name="state" id="state_ship{{$count}}" disabled>
                                    <option selected disabled value="">...Select State...</option>
                                    @foreach ($states as $state)
                                       @if ($state->id == $addr->state_id)
                                          <option value="{{$state->id}}" selected>{{$state->name}}</option>
                                       @else
                                          <option value="{{$state->id}}">{{$state->name}}</option>
                                       @endif
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>City</label>
                                 <select class="form-control" name="city" id="city_ship{{$count}}" disabled>
                                    <option selected disabled>...Select City...</option>
                                       <option value="{{$addr->city_id}}" selected>{{$addr->c_name}}</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Pin Code</label>
                                 <input class="form-control" type="text" name="pin" value="{{$addr->pin}}" id="pin_ship{{$count}}" disabled/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <textarea rows="3" cols="45" class="form-control" placeholder="address" name="address" id="address_ship{{$count}}" disabled>{{$addr->address}}</textarea>
                     </div>
                  </div>
                  <center>
                     <span id="buttons_addr{{$count}}">
                     <a class="btn btn-primary" onclick="editShippingAddress({{$count}})">Edit</a>
                     </span>
                  <a class="btn btn-danger" href="{{route('web.shipping_address_delete',['address_id'=>encrypt($addr->id)])}}">Delete</a>
                  </center>
                  <div class="gap gap-small"></div>
               @endforeach
               @endif
               
               <form method="POST" action="{{ route('web.shipping_address_add') }}">
                  @csrf
                  <div class="row">
                     <div class="col-lg-12">
                        <div style="margin-top: 30px;">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>State</label>
                                 <select class="form-control" onchange="fetch_city_ship()" name="state" id="state_ship_new" >
                                    <option selected disabled>...Select State...</option>
                                    @foreach ($states as $state)
                                          <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>City</label>
                                 <select class="form-control" name="city" id="city_ship_new" >
                                    <option selected disabled>...Select City...</option>
                                    
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Pin Code</label>
                                 <input class="form-control" type="text" name="pin" value="" id="pin" />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <textarea rows="3" cols="45" class="form-control" placeholder="address" name="address" id="address" ></textarea>
                     </div>
                  </div>
                  <center>
                     <button class="btn btn-primary" type="submit">Add New</button>
                  </center>
               </form>
               <div class="gap gap-small"></div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/web_user_profile.js') }}"></script>
<script type="text/javascript">
   $(function() {
   
       $('#myprofile-form-link').click(function(e) {
   		$("#myprofile-form").delay(100).fadeIn(100);
    		$("#changepass-form").fadeOut(100);
   		$('#changepass-form-link').removeClass('active');
      $("#shippingaddress-form").fadeOut(100);
      $('#shippingaddress-form-link').removeClass('active');
   		$(this).addClass('active');
   		e.preventDefault();
   	});
   	$('#changepass-form-link').click(function(e) {
   		$("#changepass-form").delay(100).fadeIn(100);
    		$("#myprofile-form").fadeOut(100);
   		$('#myprofile-form-link').removeClass('active');
      $("#shippingaddress-form").fadeOut(100);
      $('#shippingaddress-form-link').removeClass('active');
   		$(this).addClass('active');
   		e.preventDefault();
   	});

      $('#shippingaddress-form-link').click(function(e) {
      $("#shippingaddress-form").delay(100).fadeIn(100);
      $("#changepass-form").fadeOut(100);
      $('#changepass-form-link').removeClass('active');
      $("#myprofile-form").fadeOut(100);
      $('#myprofile-form-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });
   
   });
</script>


<script type="text/javascript">

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

      $("#pass_change").click(function(){
         var current_pass = $("input[name='current_pass']").val();
         var new_pass = $("input[name='new_pass']").val();
         var confirm_pass = $("input[name='confirm_pass']").val();
         // alert(current_pass);
            $.ajax({
               type:"POST",
               url:"{{ route('web.user_change_password')}}",
               data:{
                  _token:'{{ csrf_token() }}',
                  current_pass:current_pass,
                  new_pass:new_pass,
                  confirm_pass:confirm_pass
               },
               success:function(data){
                  // console.log(data);
                  if (data == 0) {
                     $("#err_msg").html("<div class='alert alert-danger'>Sorry !! Current Password Does Not Matched</div>");
                  }else if (data == 1) {
                     $("#err_msg").html("<div class='alert alert-success'>Password Changed Successfully</div>");
                  }else if (data == 3) {
                     $("#err_msg").html("<div class='alert alert-danger'>Password Must Be 8 Character Long</div>");
                  }else if (data == 4) {
                     $("#err_msg").html("<div class='alert alert-danger'>Sorry!! New Password is Same With Previous Password</div>");
                  }else{
                     $("#err_msg").html("<div class='alert alert-danger'>Confirm Password Does Not Matched</div>");
                  }

               }
            });
      });
   });

   function editShippingAddress(id){
      // alert(id);
      $('#state_ship'+id).attr('disabled',false);
      $('#city_ship'+id).attr('disabled',false);
      $('#pin_ship'+id).attr('disabled',false);
      $('#address_ship'+id).attr('disabled',false);
      $("#buttons_addr"+id).html('<a class="btn btn-info" onclick="saveShippingUpdate('+id+')">Save</a>');
   }
   
   function fetch_city_ship(){
      var state = $('#state_ship_new').val();
      $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            type:"GET",
            url:"{{ url('City/list/')}}"+"/"+state+"",
            success:function(data){
               $("#city_ship_new").html("<option value=''>Select City</option>");

               $.each( data, function( key, value ) {
                     $("#city_ship_new").append("<option value='"+key+"'>"+value+"</option>");
               });

            }
         });
   }
   function state_ship(id){
      var state = $('#state_ship'+id).val();
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
               $("#city_ship"+id).html("<option value=''>Select City</option>");

               $.each( data, function( key, value ) {
                     $("#city_ship"+id).append("<option value='"+key+"'>"+value+"</option>");
               });

            }
         });
   }
   function saveShippingUpdate(id){
      var state = $('#state_ship'+id).val();
      var city = $('#city_ship'+id).val();
      var pin = $('#pin_ship'+id).val();
      var address = $('#address_ship'+id).val();
      var address_id = $('#addr_id'+id).val();
      
      $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });
      $.ajax({
         type:"POST",
         url:"{{ route('web.shipping_address_update')}}",
         data:{
            "_token": "{{ csrf_token() }}",
            state:state,
            city:city,
            pin:pin,
            address:address,
            address_id:address_id,
         },
         success:function(data){
            console.log(data);
            $("#msg"+id).html("");
            if (data == 2 ) {
               $("#msg"+id).html("<p class='alert alert-danger'>All Fileds Are Required Please Enter Data In All Fields</p>");
            }else{
               $("#msg"+id).html("<p class='alert alert-success'>Shipping Address Updated Successfully</p>");

               $('#state_ship'+id).attr('disabled',true);
               $('#city_ship'+id).attr('disabled',true);
               $('#pin_ship'+id).attr('disabled',true);
               $('#address_ship'+id).attr('disabled',true);
               $("#buttons_addr"+id).html('<a class="btn btn-primary" onclick="editShippingAddress('+id+')">Edit</a>');
            }

         }
      });
   }

</script>
@endsection


     