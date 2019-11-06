@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Add Size Value</h2>
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
    	            	@if(isset($size_edit_value) && !empty($size_edit_value))
                            {{Form::model($size_edit_value, ['method' => 'post','route'=>'admin.size_value_update'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                        @else
    	            		{{ Form::open(['method' => 'post','route'=>'admin.add_size_value']) }}
    	            	@endif

    	            	<div class="form-group">
                            {{ Form::label('size', 'Size Name')}}
                            @if(isset($sizes) && !empty($sizes))
                                {!! Form::text('size_name', $sizes->name, ['class' => 'form-control','disabled'=>'true']) !!}
                                {!! Form::hidden('size', $sizes->id, ['class' => 'form-control']) !!}
                            @endif

                            @if($errors->has('size'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('size') }}</strong>
                                </span>
                            @enderror

                        </div>

    	            	<div class="form-group">
    	            		{{ Form::label('value', 'Enter Size Value')}}
    	            	 	{{ Form::text('value',null,array('class' => 'form-control','placeholder'=>'Enter Size Value')) }}
    	            	 	@if($errors->has('value'))
    	                    	<span class="invalid-feedback" role="alert" style="color:red">
    		                        <strong>{{ $errors->first('value') }}</strong>
    		                    </span>
    		              	@enderror
    	            	</div>
    	            	<div class="form-group">
    	            	 	@if(isset($size_edit_value) && !empty($size_edit_value))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                                <a href="{{route('admin.add_size_value_form',['size_id' => encrypt($size_edit_value->size)])}}" class="btn btn-warning">Back</a>
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                                <a href="{{ route('admin.add_size_name') }}" class="btn btn-warning">Back</a>
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
                    <h2>Size Values</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Size Name</th>
                                    <th class="column-title">Value</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Action</th>
                            </thead>

                            <tbody>

                                @if(isset($size_value) && !empty($size_value) && count($size_value) > 0)
                                @php
                                    $count = 1;
                                @endphp

                                @foreach($size_value as $sizes)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                    <td class=" ">{{ $sizes->s_name }}</td>
                                    <td class=" ">{{ $sizes->value }}</td>
                                    <td class=" ">
                                        @if($sizes->status == '1')
                                            <button class='btn btn-primary'>Enabled</button>
                                        @else
                                             <button class='btn btn-warning'>Disabled</button>
                                        @endif
                                        
                                    <td>
                                        @if($sizes->status == '1')
                                           <a href="{{route('admin.size_value_status_update',['value_id' => $sizes->id,'size_id' => $sizes->size,'status' => 2])}}" class="btn btn-danger">Disable</a>
                                        @else
                                             <a href="{{route('admin.size_value_status_update',['value_id' => $sizes->id,'size_id' => $sizes->size,'status' => 1])}}" class="btn btn-success">Enable</a>
                                        @endif
                                       
                                        
                                        <a href="{{route('admin.size_value_edit',['value_id' => $sizes->id,'size_id' => $sizes->size])}}" class="btn btn-warning">Edit</a>
                                        <a href="{{route('admin.size_value_delete',['value_id' => $sizes->id,'size_id' => $sizes->size])}}" class="btn btn-danger">Delete</a>
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

  
