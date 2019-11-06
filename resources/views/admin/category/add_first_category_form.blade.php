@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
	<div class="col-md-2"></div>
	<div class="col-md-8" style="margin-top:50px;">
	    <div class="x_panel">

	        <div class="x_title">
	            <h2>Add First Sub Category</h2>
	            <div class="clearfix"></div>
	        </div>
            <div>
                 @if (Session::has('message'))
                    <div class="alert alert-success" >{{ Session::get('message') }}</div>
                 @endif
                 @if (Session::has('error'))
                    <div class="alert alert-danger" >{{ Session::get('error') }}</div>
                 @endif

            </div>
	        <div>
	            <div class="x_content">
	            	@if(isset($first_category) && !empty($first_category))
                        {{Form::model($first_category, ['method' => 'post','route'=>'admin.update_first_category','enctype'=>'multipart/form-data'])}}
                        {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name','enctype'=>'multipart/form-data')) }}
                    @else
	            		{{ Form::open(['method' => 'post','route'=>'admin.add_first_category','enctype'=>'multipart/form-data']) }}
	            	@endif

	            	<div class="form-group">
	            		{{ Form::label('category_id', 'Select Main Category')}}

	            		@if(!empty($category))
	            			{!! Form::select('category_id', $category, null, ['class' => 'form-control','placeholder' => 'Please Select Main category']) !!}
	            		@else
	            			{!! Form::select('category_id',array('' => 'Please Select Main Category'),null, ['class' => 'form-control']) !!}
	            		@endif

	            		@if($errors->has('category_id'))
	                    	<span class="invalid-feedback" role="alert" style="color:red">
		                        <strong>{{ $errors->first('category_id') }}</strong>
		                    </span>
		              	@enderror
	            	 
	            	</div>

	            	<div class="form-group">
	            		{{ Form::label('name', 'First Sub Category Name')}}
	            	 	{{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
	            	 	@if($errors->has('name'))
	                    	<span class="invalid-feedback" role="alert" style="color:red">
		                        <strong>{{ $errors->first('name') }}</strong>
		                    </span>
		              	@enderror
	            	</div>

                    <div class="form-group">
                        {{ Form::label('image', 'Select Image')}}
                        <input type="file" name="image" class="form-control">
                        @if($errors->has('image'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @enderror
                    </div>
	            	<div class="form-group">
	            	 	@if(isset($first_category) && !empty($first_category))
                            {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            <a href="{{ route('admin.add_first_category_form') }}" class="btn btn-warning">Back</a>
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
                    <h2>Main Category List</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">First category name</th>
                                    <th class="column-title">category name</th>
                                    <th class="column-title">Image</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Action</th>
                            </thead>

                            <tbody>

                            	@if(isset($firstCategoryList) && !empty($firstCategoryList) && count($firstCategoryList) > 0)
                            	@php
                            		$count = 1;
                            	@endphp

                            	@foreach($firstCategoryList as $category)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                    <td class=" ">{{ $category->name }}</td>
                                    <td>{{ $category->Category->name}}</td>
                                     <td><img src="{{ asset('images/category/first_category/thumb/'.$category->image.'') }}" height="80px"></td>
                                    <td class=" ">
                                        @if($category['status'] == '1')
                                            <button class='btn btn-primary'>Enabled</button>
                                        @else
                                             <button class='btn btn-warning'>Disabled</button>
                                        @endif                                    	
                                    <td class=" ">
                                        @if($category['status'] == '1')
                                           <a href="{{ route('admin.first_category_status_update',['first_id' => encrypt($category->id),'status' => encrypt(2),]) }}" class="btn btn-danger">Disable</a>
                                        @else
                                            <a href="{{ route('admin.first_category_status_update',['first_id' => encrypt($category->id),'status' => encrypt(1),]) }}" class="btn btn-success">Enable</a>
                                        @endif 
                                       
                                        
                                        <a href="{{route('admin.edit_first_category',['id' => $category->id])}}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('admin.first_category_delete',['first_id' => encrypt($category->id)]) }}" class="btn btn-danger">Delete</a>
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