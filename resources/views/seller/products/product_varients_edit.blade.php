@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>All Varients</h2>
    	            <div class="clearfix"></div>
    	        </div>
              
    	        <div>
    	            <div class="x_content">

                        @if(isset($product_varients) && !empty($product_varients) && isset($varients) && !empty($varients))

                       @php
                        $count_varient = 1;
                       @endphp
                        @foreach($product_varients as $key => $value)
                           <div class="well" style="overflow: auto">
                                <div class="form-row mb-10" id="varient_div"> 

                                    <div id="error{{$count_varient}}"></div>
                                <input type="hidden" name="product_varient_id" id="product_varient_id{{$count_varient}}" value="{{ current(current($value))->id }}">  


                                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                        <label for="varients">Select {{$key}} </label>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <select class="form-control" name="varients" id="varient_value{{$count_varient}}" disabled>

                                            <option value="">Please Select {{$key}}</option>

                                            @foreach($varients[$key] as $value1)
                                              @if(current(current($value))->varient_value_id == $value1->varient_value_id)
                                                    <option value="{{ $value1->varient_value_id }}" selected>{{ $value1->varient_value }}</option>
                                                @else
                                                    <option value="{{ $value1->varient_value_id }}" >{{ $value1->varient_value }}</option>
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
</div>


 @endsection

  @section('script')
     <script type="text/javascript">

        function editVarient(id) {
           $("#varient_value"+id).attr('disabled',false);
            $("#btn_action"+id).html('<a class="btn btn-primary" onclick="saveVarient('+id+')"> Save </a>');
        }

        function saveVarient(id) {
            var product_varient_id = $("#product_varient_id"+id).val();
            var varient_value_id = $("#varient_value"+id).find(":selected").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:"{{ route('seller.product_varient_update')}}",
                data:{ product_varient_id:product_varient_id, varient_value_id:varient_value_id },
                success:function(data){
                  console.log(data);
                  if (data == 1) {
                    $("#error"+id).html("<p class='alert alert-danger'>Please Enter Required Field</p>");
                  }else if (data == 3) {
                     $("#error"+id).html("<p class='alert alert-danger'>Something Went Wrong Please Try Again</p>");
                  }else{
                    $("#varient_value"+id).attr('disabled',true);                   
                    $("#btn_action"+id).html('<a class="btn btn-success" onclick="editVarient('+id+')"> Edit </a>');
                    $("#error"+id).html('');
                  }
                  
                }
            });
        }
    </script>
 @endsection


        
    