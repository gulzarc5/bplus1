
@extends('admin.template.admin_master')

@section('style')
<link href="{{asset('admin/src_files/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">

@endsection

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add New Brand</h2>
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
                        @if(isset($color) && !empty($color))
                            {{Form::model($color, ['method' => 'post','route'=>'admin.updateCategory'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.add_brand']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('category', 'Select Category')}}
                            @if(isset($main_category) && !empty($main_category))
                                {!! Form::select('category', $main_category, null, ['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'category']) !!}
                            @else
                                {!! Form::select('category',array('' => 'Please Select Main Category'),null, ['class' => 'form-control']) !!}
                            @endif

                            @if($errors->has('category'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            {{ Form::label('first_category', 'Select First Category')}}
                            @if(!empty($second_category->first_category_id))
                            {!! Form::select('first_category',array($second_category->first_category_id => $second_category->firstCategory->name),null, ['class' => 'form-control','id'=>'first_category']) !!}
                            @else
                            {!! Form::select('first_category',array('' => 'Please Select First Sub Category'),null, ['class' => 'form-control','id'=>'first_category']) !!}
                            @endif

                            @if($errors->has('first_category'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('first_category') }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12" id="brand_add_div" style="padding-left:0;">
                            <div class="col-md-10" style="padding-left:0;">
                                {{ Form::label('name', 'Brand Name')}}                             
                                {{ Form::text('name[]',null,array('class' => 'form-control','placeholder'=>'Enter Brand name')) }}
                            </div>  
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-info" style="margin-top: 24px;" onclick="addbrand()">Add More</button>
                            </div>                          
                        </div>
                        @if($errors->has('name'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> 
                        @enderror

                        <div class="form-group col-md-12">
                            @if(isset($color) && !empty($color))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            
                        </div>
                        {{ Form::close() }}

                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="clearfix"></div>
</div>


 @endsection

 @section('script')
  <script src="{{asset('admin/src_files/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>

  <script type="text/javascript">
        $(document).ready(function(){

            $("#category").change(function(){
                var category = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('/admin/first/Category/')}}"+"/"+category+"",
                    success:function(data){
                        console.log(data);
                        var cat = JSON.parse(data);
                        $("#first_category").html("<option value=''>Please Select Sub Category</option>");

                        $.each( cat, function( key, value ) {
                            $("#first_category").append("<option value='"+key+"'>"+value+"</option>");
                        });

                    }
                });
            });

        })


        var brand_add_count = 1;
        function addbrand() {
            var html = '<div id="brand_add_div'+brand_add_count+'" style="padding-left:0;">'+
                            '<div id="brand_add_div" class="col-md-10" style="padding-left:0;">'+
                                '<label for="name">Brand Name</label>'+
                                '<input class="form-control" placeholder="Enter Brand name" name="name[]" type="text" id="name">'+
                            '</div>'+
                            '<div class="col-md-2">'+
                                '<button type="button" onclick="removebrand('+brand_add_count+')" class="btn btn-sm btn-danger" style="margin-top: 24px;">Remove</button>'+
                            '</div>'+
                        '</div>';
            $("#brand_add_div").append(html);
            brand_add_count++;
        }

        function removebrand(brand_name_id) {
            $("#brand_add_div"+brand_name_id).remove();
        }
    </script>

    
    
 @endsection