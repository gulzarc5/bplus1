@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>All Colors</h2>
    	            <div class="clearfix"></div>
    	        </div>
              
    	        <div>
    	            <div class="x_content">
                        @if(isset($product_colors) && !empty($product_colors))

                       @php
                        $count_varient = 1;
                       @endphp
                        @foreach($product_colors as  $color)
                           <div class="well" style="overflow: auto">
                                <div class="form-row mb-10" id="varient_div"> 

                                    <div id="error{{$count_varient}}"></div>
                                    <input type="hidden" id="product_id{{$count_varient}}" value="{{ $product_id_color_add }}">
                                    <input type="hidden" name="color_id" id="color_id{{$count_varient}}" value="{{ $color->id }}">  


                                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                        <label for="color">Select Color </label>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <select class="form-control" name="color" id="color{{$count_varient}}" disabled>
                                            <option value="">Please Select Color</option>
                                                @foreach($color_options as $value1)
                                                @if($color->color_id == $value1->id)
                                                        <option value="{{ $value1->id }}" style="background-color: {{$value1->value}}" selected>{{ $value1->name }}</option>
                                                    @else
                                                        <option value="{{ $value1->id }}" style="background-color: {{$value1->value}}">{{ $value1->name }}</option>
                                                    @endif
                                                @endforeach

                                        </select>

                                    </div> 
                                    <div  class="col-md-6 col-sm-12 col-xs-12 mb-3" id="btn_action{{ $count_varient }}">
                                        <a class="btn btn-success" onclick="editVarient({{$count_varient}})"> Edit </a>
                                    </div>                    
                                </div>
                           </div>
                           @php
                            $count_varient++;
                           @endphp
                        @endforeach
                       @endif

    	            </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>


    <div class="row">
        
        <div class="col-md-12" style="margin-top:50px;">
          <div class="x_panel">

              <div class="x_title">
                  <h2>Add New Colors</h2>
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
                  <div class="x_content">
                 
                    {{ Form::open(['method' => 'post','route'=>'admin.product_new_color_add']) }}
                    
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        @endif

                      <input type="hidden" name="product_id" value="{{$product_id_color_add}}">
                       <div class="well" style="overflow: auto">
                            <div id="color_div">
                                <div class="form-row mb-3" >
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="color">Select Color</label>
                                        <select class="form-control color" name="color[]" id="color">
                                          <option value="">Select Color</option>
                                            @foreach($color_options as $value1)
                                                    <option value="{{ $value1->id }}" style="background-color: {{$value1->value}}">{{ $value1->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>    
                                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                       <a class="btn btn-sm btn-primary" style="margin-top: 25px;" onclick="addMoreColor()">Add More</a>
                                    </div>                     
                                </div>
                              </div>
                            </div>
                        <div>
                          <button type="submit" class="btn btn-success"> Submit </button>
                        </div>

                      
                      
                    {{ Form::close() }}

                  </div>
              </div>
          </div>
      </div>
</div>


 @endsection

  @section('script')
     <script type="text/javascript">

        function editVarient(id) {
           $("#color"+id).attr('disabled',false);
            $("#btn_action"+id).html('<a class="btn btn-primary" onclick="saveVarient('+id+')"> Save </a>');
        }

        function saveVarient(id) {
            var color_id = $("#color_id"+id).val();
            
            var color = $("#color"+id).find(":selected").val();
           
            var product_id = $("#product_id"+id).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:"{{ route('admin.product_color_update')}}",
                data:{
                    color_id:color_id, 
                    color:color,
                    product_id:product_id,
                },
                success:function(data){
                  if (data == 1) {
                    $("#error"+id).html("<p class='alert alert-danger'>Please Enter Required Field</p>");
                  }else if (data == 3) {
                     $("#error"+id).html("<p class='alert alert-danger'>Something Went Wrong Please Try Again</p>");
                  }else{
                   $("#color"+id).attr('disabled',true);                  
                    $("#btn_action"+id).html('<a class="btn btn-success" onclick="editVarient('+id+')"> Edit </a>');
                    $("#error"+id).html('');
                  }
                  
                }
            });
        }

        var color_id = 1;
        function addMoreColor(){

            html_color = $("#color").html();

            var temp_color = '<div class="form-row mb-3" id="color_remove'+color_id+'">'+
            '<div class="col-md-4 col-sm-12 col-xs-12 mb-3" >'+
                                    '<label for="color">Select Color</label>'+
                                    '<select class="form-control color" name="color[]" id="color">'+
                                      html_color+
                                    '</select>'+
                                '</div>'+
                                '<div class="col-md-2 col-sm-12 col-xs-12 mb-3">'+
                                   '<a class="btn btn-sm btn-danger" style="margin-top: 25px;" onclick="removeColorDiv('+color_id+')">Remove</a>'+
                                '</div>'+
                                '<div>';
            $("#color_div").append(temp_color);
            color_id++;
        }

        function removeColorDiv(id) {
            $("#color_remove"+id).remove();
}
    </script>
 @endsection


        
    