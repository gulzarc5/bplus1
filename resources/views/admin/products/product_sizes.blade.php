@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
      {{-- <div class="col-md-2"></div> --}}
      <div class="col-md-12" style="margin-top:50px;">
          <div class="x_panel">

              <div class="x_title">
                  <h2>Product Sizes</h2>
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
                        @php
                          $id_count = 1;
                          $product_id = null;
                        @endphp
                        @if(isset($sizes) && !empty($sizes))
                          @foreach($sizes as $key => $value)
                            <div class="well" style="overflow: auto">

                              @foreach($value as $size)
                                <div class="form-row mb-10" id="inner_size_add_div'+key+'">
                                  <div class="col-md-12 col-sm-12 col-xs-12 mb-3" id="error{{ $id_count }}">

                                  </div>
                                  <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    
                                    <input type="hidden" name="size_id[]" id="size_id{{$id_count}}" value="{{ $size->id}}">
                                    <input type="hidden"  id="product{{$id_count}}" value="{{ $size->product_id}}">
                                    @php
                                      $product_id = $size->product_id;
                                    @endphp

                                    <input type="hidden"  id="size_name{{$id_count}}" value="{{ $size->size_name_id}}">
                                    <label for="size">{{ $key }}</label>
                                    <select class="form-control" name="size[]" id="size{{$id_count}}" disabled>
                                      <option value="">Please Select Size</option>
                                        @foreach($sizes_options[$key] as $size_option)
                                          @if( $size_option->size_value_id == $size->size_value_id )
                                            <option value="{{ $size_option->size_value_id }}" selected>{{ $size_option->size_value }}</option>
                                          @else
                                            <option value="{{ $size_option->size_value_id }}">{{ $size_option->size_value }}</option>
                                          @endif
                                        @endforeach

                                    </select>
                                  </div>
                                  
                                  <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mrp">Enter M.R.P.</label>
                                      <input type="text" class="form-control" name="mrp[]" value="{{ $size->mrp }}" placeholder="Enter MRP" id="mrp{{$id_count}}" disabled>
                                  </div>
                                  <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="price">Enter Price</label>
                                      <input type="text" class="form-control" name="price[]"  placeholder="Enter Price" value="{{ $size->price }}" id="price{{$id_count}}" disabled>
                                  </div>

                                  <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="stock">Enter Stock</label>
                                    <input type="text" class="form-control" name="stock[]"  placeholder="Enter Stock" value="{{ $size->stock }}" id="stock{{$id_count}}" disabled>
                                  </div>

                                  <div class="col-md-8 col-sm-12 col-xs-12 mb-3">
                                    <span id="edit{{$id_count}}">
                                      <a class="btn btn-sm btn-info" style="margin-top: 25px;" onclick="size_edit({{$id_count}})">Edit</a>
                                    </span>

                                    @if($size->status == 1)
                                      <a href="{{ url('admin/Products/Size/Status/'.encrypt($size->id).'/'.encrypt(2).'/'.encrypt($size->product_id).'') }}" class="btn btn-sm btn-warning" style="margin-top: 25px;">Disable</a>
                                    @else
                                      <a href="{{ url('admin/Products/Size/Status/'.encrypt($size->id).'/'.encrypt(1).'/'.encrypt($size->product_id).'') }}" class="btn btn-sm btn-success" style="margin-top: 25px;">Enable</a>                                       
                                    @endif
                                    {{-- <a class="btn btn-sm btn-danger" style="margin-top: 25px;">Delete</a> --}}
                                  </div>
                                </div>
                                @php
                                  $id_count++;
                                @endphp
                              @endforeach
                            </div>
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
                  <h2>Add New Product Size</h2>
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
                 
                    {{ Form::open(['method' => 'post','route'=>'admin.product_new_size_add']) }}
                    
                       
                      <div  id="size_div">
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        @endif
                        @if(isset($sizes_add) && !empty($sizes_add))
                          @foreach($sizes_add as $key => $value)
                            <div class="well" style="overflow: auto">                              
                                <div class="form-row mb-10">
                                  <div class="col-md-4 col-sm-12 col-xs-12 mb-3">                    
                                    <input type="hidden"  name="product_id[]" value="{{ $product_id }}">
                                    <input type="hidden" name="size_name_id[]" value="{{ current(current($value))->size_id }}">
                                    <label for="size">{{ $key }}</label>
                                    <select class="form-control" name="size[]">
                                      <option value="">Please Select Size</option>
                                        @foreach($value as $key1 => $value1)
                                            <option value="{{ $value1->size_value_id }}">{{ $value1->size_value }}</option>
                                        @endforeach

                                    </select>
                                  </div>
                                  
                                  <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mrp[]">Enter M.R.P.</label>
                                      <input type="text" class="form-control" name="mrp[]"  placeholder="Enter MRP">
                                  </div>
                                  <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="price[]">Enter Price</label>
                                      <input type="text" class="form-control" name="price[]"  placeholder="Enter Price">
                                  </div>

                                  <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="stock">Enter Stock</label>
                                    <input type="text" class="form-control" name="stock[]"  placeholder="Enter Stock" >
                                  </div>
                                </div>
                            </div>
                          @endforeach
                        @endif
                          <div>
                            <button type="submit" class="btn btn-success"> Submit </button>
                          </div>
                      </div>
                    {{ Form::close() }}

                  </div>
              </div>
          </div>
      </div>

      </div>
</div>


 @endsection

  @section('script')
     <script type="text/javascript">

      function size_edit(id) {
        $("#size"+id).attr('disabled',false);
        $("#mrp"+id).attr('disabled',false);
        $("#price"+id).attr('disabled',false);
        $("#stock"+id).attr('disabled',false);
        $("#edit"+id).html('<a class="btn btn-sm btn-success" style="margin-top: 25px;" onclick="size_save('+id+')">Save</a>');
      }

      function size_save(id) {

        var product_id =  $('#product'+id).val();
        var size_name_id = $('#size_name'+id).val();
        var size_id = $('#size_id'+id).val();
        var size = $("#size"+id).find(":selected").val();
        var mrp = $("#mrp"+id).val();
        var price = $("#price"+id).val();
        var stock = $("#stock"+id).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"POST",
            url:"{{ route('admin.product_size_update')}}",
            data:{ size_id:size_id, size:size, mrp:mrp, price:price, stock:stock, product_id:product_id, size_name_id:size_name_id },
            success:function(data){
              console.log(data);
              if (data == 1) {
                $("#error"+id).html("<p class='alert alert-danger'>Please Enter Required Field</p>");
              }else if (data == 3) {
                 $("#error"+id).html("<p class='alert alert-danger'>Something Went Wrong Please Try Again</p>");
              }else if (data == 4) {
                 $("#error"+id).html("<p class='alert alert-danger'>This Size Already Exist</p>");
              }else{
                $("#size"+id).attr('disabled',true);
                $("#mrp"+id).attr('disabled',true);
                $("#price"+id).attr('disabled',true);
                $("#stock"+id).attr('disabled',true);
                $("#edit"+id).html('<a class="btn btn-sm btn-info" style="margin-top: 25px;" onclick="size_edit('+id+')">Edit</a>');
                $("#error"+id).html('');
              }
              
            }
        });        
      }


        var color_html = null;
         var size={};
        $(document).ready(function(){
            $("#second_category").change(function(){
                        
                var category = $('#category').val();
                var first_category = $('#first_category').val();
                var second_category = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('/admin/Products/ajax/form/load/data')}}"+"/"+category+"/"+first_category+"/"+second_category+"",
                    success:function(data){
 
                        if (data.sizes != null) {
                            $.each( data.sizes, function( key, value ) {
                              
                                var size_div_html = '<div class="well" style="overflow: auto"><div class="form-row mb-10" id="inner_size_add_div'+key+'">'+
                                    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">';
                                    if(value.length > 0 ) {
                                       size_div_html +='<input type="hidden" name="size_id[]" value="'+value[0]['size_id']+'">';
                                   }
                                    size_div_html +='<label for="size">'+key+'</label>'+
                                        '<select class="form-control" name="size[]">'+
                                        '<option value="">Please Select Size</option>';
                                         size[key] = '<option value="">Please Select Size</option>';
                                    if (value.length > 0 ) {
                                         $.each( value, function( key1, value ) {
                                           size_div_html += "<option value='"+value.size_value_id+"'>"+value.size_value+"</option>";
                                           size[key] += "<option value='"+value.size_value_id+"'>"+value.size_value+"</option>";
                                        });
                                    }
                                size_div_html +='</select>'+
                                    '</div>'+
                                    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
                                      '<label for="mrp">Enter M.R.P.</label>'+
                                      '<input type="text" class="form-control" name="mrp[]"  placeholder="Enter MRP" >'+

                                    '</div>'+
                                    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
                                      '<label for="price">Enter Price</label>'+
                                      '<input type="text" class="form-control" name="price[]"  placeholder="Enter Price" >'+
                                    '</div>'+

                                    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
                                      '<label for="stock">Enter Stock</label>'+
                                      '<input type="text" class="form-control" name="stock[]"  placeholder="Enter Stock" >'+
                                    '</div>'+

                                    '<div class="col-md-8 col-sm-12 col-xs-12 mb-3">'+
                                       '<a class="btn btn-sm btn-primary" style="margin-top: 25px;" onclick="add_more_inner_size_div(\''+key+'\',\''+value[0]['size_id']+'\')">Add More</a>'+
                                    '</div>'+
                                '</div></div>';
                                $("#size_div").show();
                                $("#size_div").append(size_div_html);
                            });
                        }

                    }
                });
            });
        });

    </script>
    <script src="{{ asset('admin/javascript/product.js') }}"></script>
 @endsection


        
    