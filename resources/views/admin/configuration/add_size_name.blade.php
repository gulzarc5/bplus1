@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
	<div class="col-md-2"></div>
	<div class="col-md-8" style="margin-top:50px;">
	    <div class="x_panel">

	        <div class="x_title">
	            <h2>Add Size Name</h2>
	            <div class="clearfix"></div>
	        </div>
            <div>
                 @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                 @endif
                 @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                 @endif

            </div>
	        <div>
	            <div class="x_content">
	            	@if(isset($size_name_edit) && !empty($size_name_edit))
                        {{Form::model($size_name_edit, ['method' => 'post','route'=>'admin.update_size_name'])}}
                        {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                    @else
	            		{{ Form::open(['method' => 'post','route'=>'admin.add_size_name']) }}
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
                        @if(!empty($first_category))
                        {!! Form::select('first_category',$first_category,null, ['class' => 'form-control','id'=>'first_category']) !!}
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
	            		{{ Form::label('name', 'Size Name')}}
	            	 	{{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
	            	 	@if($errors->has('name'))
	                    	<span class="invalid-feedback" role="alert" style="color:red">
		                        <strong>{{ $errors->first('name') }}</strong>
		                    </span>
		              	@enderror
	            	</div>
	            	<div class="form-group">
	            	 	@if(isset($size_name_edit) && !empty($size_name_edit))
                            {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            <a href="{{ route('admin.add_size_name_form') }}" class="btn btn-warning">Back</a>
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

	<div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Size name</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">name</th>
                                    <th class="column-title">Category</th>
                                    <th class="column-title">First Category</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Action</th>
                            </thead>

                            <tbody>

                            	@if(isset($size_name) && !empty($size_name) && count($size_name) > 0)
                            	@php
                            		$count = 1;
                            	@endphp

                            	@foreach($size_name as $name)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                    <td class=" ">{{ $name['name'] }}</td>
                                    <td class=" ">{{ $name->Category->name }}</td>
                                    <td class=" ">{{ $name->firstCategory->name }}</td>
                                    <td class=" ">
                                        @if($name['status'] == '1')
                                            <button class='btn btn-primary'>Enabled</button>
                                        @else
                                             <button class='btn btn-warning'>Disabled</button>
                                        @endif                                    	
                                    <td class=" ">

                                        @if($name['status'] == '1')
                                            <a href="{{route('admin.update_size_name_status',['size_id' => $name->id,'status' => 2])}}" class="btn btn-danger">Disable</a>
                                        @else
                                             <a href="{{route('admin.update_size_name_status',['size_id' => $name->id,'status' => 1])}}" class="btn btn-success">Enable</a>
                                        @endif
                                       
                                       
                                        <a href="{{route('admin.edit_size_name',['id' => encrypt($name->id)])}}" class="btn btn-warning">Edit</a>
                                        <a href="{{route('admin.add_size_value_form',['size_id' => encrypt($name->id)])}}" class="btn btn-info">Add Size Value</a>
                                        <a href="{{route('admin.delete_size_name',['id' => $name->id])}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                	<tr>
	                                    <td colspan="4" style="text-align: center">Sorry No Data Found</td>
                                	</tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
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

        })
    </script>
 @endsection