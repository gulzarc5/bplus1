
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add New State</h2>
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
                        @if(isset($state_edit) && !empty($state_edit))
                            {{Form::model($state_edit, ['method' => 'post','route'=>'admin.update_state'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.add_state']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'State Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter State name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            @if(isset($state_edit) && !empty($state_edit))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                                <a href="{{ route('admin.view_state_form') }}" class="btn btn-warning">Back</a>
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
                    <h2>All State List</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">State</th>
                                    <th class="column-title">Action</th>
                            </thead>

                            <tbody>

                                @if(isset($state) && !empty($state) && count($state) > 0)
                                @php
                                    $count = 1;
                                @endphp

                                @foreach($state as $state)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                    <td class=" ">{{ $state->name }}</td>
                                 
                                        
                                    <td class=" ">                                  
                                        
                                        <a href="{{route('admin.edit_state',['id' => $state->id])}}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('admin.delete_state',['id' => $state->id]) }}" class="btn btn-danger">Delete</a>
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