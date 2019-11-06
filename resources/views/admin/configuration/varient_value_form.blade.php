@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Add Varient Value</h2>
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
                            {{Form::model($first_category, ['method' => 'post','route'=>'admin.update_first_category'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                        @else
    	            		{{ Form::open(['method' => 'post','route'=>'admin.add_varient_value']) }}
    	            	@endif

    	            	<div class="form-group">
                            
                            @if(isset($varient_name) && !empty($varient_name))
                                {{ Form::hidden('varient_id',$varient_name->id,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                                {{ Form::label('Varient_name', 'Varient Name')}}
                                {{ Form::text('Varient_name',$varient_name->name,array('class' => 'form-control','placeholder'=>'Varient Name','disabled'=>'true')) }}

                            @endif
                            @if($errors->has('varient_id'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('varient_id') }}</strong>
                                </span>
                            @enderror

                        </div>

    	            	<div class="form-group">
    	            		{{ Form::label('value', 'Enter Varient Value')}}
    	            	 	{{ Form::text('value',null,array('class' => 'form-control','placeholder'=>'Enter Varient Value')) }}
    	            	 	@if($errors->has('value'))
    	                    	<span class="invalid-feedback" role="alert" style="color:red">
    		                        <strong>{{ $errors->first('value') }}</strong>
    		                    </span>
    		              	@enderror
    	            	</div>
    	            	<div class="form-group">
    	            	 	@if(isset($first_category) && !empty($first_category))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif

                            <a href="{{ route('admin.varient_name_list') }}" class="btn btn-warning ">Back</a>
    	                	
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
                    <h2>Varient Values</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Varient Name</th>
                                    <th class="column-title">Value</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Action</th>
                            </thead>

                            <tbody>

                                @if(isset($varient_value) && !empty($varient_value) && count($varient_value) > 0)
                                @php
                                    $count = 1;
                                @endphp

                                @foreach($varient_value as $varient_values)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                    <td class=" ">{{ $varient_values->v_name }}</td>
                                    <td class=" ">{{ $varient_values->value }}</td>
                                    <td class=" ">
                                        @if($varient_values->status == '1')
                                            <button class='btn btn-primary'>Enabled</button>
                                        @else
                                             <button class='btn btn-warning'>Disabled</button>
                                        @endif
                                        
                                    <td>
                                        <a href="#" class="btn btn-success">Enable</a>
                                        <a href="#" class="btn btn-danger">Disable</a>
                                        <a href="#" class="btn btn-warning">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="text-align: center">Sorry No Data Found</td>
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

  
