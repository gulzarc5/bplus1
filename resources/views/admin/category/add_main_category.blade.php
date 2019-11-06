
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add Main Category</h2>
                    <div class="clearfix"></div>
                </div>

                 <div>
                    @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>

                <div>
                    <div class="x_content">
                        @if(isset($category) && !empty($category))
                            {{Form::model($category, ['method' => 'post','route'=>'admin.updateCategory','enctype'=>'multipart/form-data'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.add_main_category','enctype'=>'multipart/form-data']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Category Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
			                        <strong>{{ $errors->first('name') }}</strong>
			                    </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('name', 'Select Image')}} 
                            
                            <input type="file" name="image" class="form-control">
                            @if($errors->has('image'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            @if(isset($category) && !empty($category))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                                <a href="{{ route('admin.add_main_category_form') }}" class="btn btn-warning">Back</a>
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
                                    <th class="column-title">Main category name</th>
                                    <th class="column-title">Image</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Action</th>
                            </thead>

                            <tbody>

                            	@if(isset($main_category) && !empty($main_category) && count($main_category) > 0)
                            	@php
                            		$count = 1;
                            	@endphp

                            	@foreach($main_category as $category)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                    <td class=" ">{{ $category['name'] }}</td>
                                     <td class=" "><img src="{{asset('images/category/main_category/thumb/'.$category['image'].'')}}" height="80px"></td>
                                    <td class=" ">
                                        @if($category['status'] == '1')
                                            <button class='btn btn-primary'>Enabled</button>
                                        @else
                                             <button class='btn btn-warning'>Disabled</button>
                                        @endif
                                    	
                                    <td class=" ">
                                        @if($category['status'] == '1')
                                            <a href="{{ route('admin.category_status_update',['category_id' => encrypt($category->id),'status' => encrypt(2),]) }}" class="btn btn-danger">Disable</a>
                                        @else
                                            <a href="{{ route('admin.category_status_update',['category_id' => encrypt($category->id),'status' => encrypt(1),]) }}" class="btn btn-success">Enable</a>
                                        @endif                                       
                                        
                                        <a href="{{route('admin.editCategory',['id' => $category->id])}}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('admin.category_delete',['category_id' => encrypt($category->id)]) }}" class="btn btn-danger">Delete</a>
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