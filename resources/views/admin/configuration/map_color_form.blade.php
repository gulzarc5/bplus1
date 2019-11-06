@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Map Color With Category</h2>
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
    	            	@if(isset($first_category) && !empty($first_category))
                            {{Form::model($first_category, ['method' => 'post','route'=>'admin.update_first_category'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                        @else
    	            		{{ Form::open(['method' => 'post','route'=>'admin.add_color_map']) }}
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

                        <div class="form-group">
                            {{ Form::label('second_category', 'Select Second Category')}}
                            @if(!empty($second_category->first_category_id))
                            {!! Form::select('second_category',array($second_category->first_category_id => $second_category->firstCategory->name),null, ['class' => 'form-control','id'=>'first_category']) !!}
                            @else
                            {!! Form::select('second_category',array('' => 'Please Select Second Category'),null, ['class' => 'form-control','id'=>'second_category']) !!}
                            @endif

                            @if($errors->has('second_category'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('second_category') }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            {{ Form::label('color_id', 'Select Color')}}
                            @if(isset($color) && !empty($color))
                                <select class="form-control" name="color_id">
                                    <option value="">Please Select Color</option>
                                    @foreach($color as $colors)
                                        <option value="{{ $colors->id }}" style="background-color: {{$colors->value}}">{{ $colors->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                {!! Form::select('color_id',array('' => 'Please Select Color'),null, ['class' => 'form-control']) !!}
                            @endif

                            @if($errors->has('color_id'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('color_id') }}</strong>
                                </span>
                            @enderror

                        </div>

    	            	<div class="form-group">
    	            	 	@if(isset($first_category) && !empty($first_category))
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
</div>


 @endsection

  @section('script')
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

            $("#first_category").change(function(){
                var category = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('/admin/second/Category/')}}"+"/"+category+"",
                    success:function(data){
                        console.log(data);
                        var cat = JSON.parse(data);
                        $("#second_category").html("<option value=''>Please Select Second Category</option>");

                        $.each( cat, function( key, value ) {
                            $("#second_category").append("<option value='"+key+"'>"+value+"</option>");
                        });

                    }
                });
            });

            $("#color_id").change(function(){
                var color_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('/admin/Ajax/Get/Color')}}"+"/"+color_id+"",
                    success:function(data){
                        console.log(data);
                        var html = '<div class="circle_green" style="padding: 10px 11px;  background: '+data+';"></div>'
                        $("#second_category").html(html);


                    }
                });
            });

        })
    </script>
 @endsection