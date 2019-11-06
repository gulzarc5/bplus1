
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add App Slider</h2>
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
                        @if(isset($slider_edit) && !empty($slider_edit))
                            {{Form::model($slider_edit, ['method' => 'post','route'=>'admin.sliderUpdate','enctype'=>'multipart/form-data'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.sliderInsert','enctype'=>'multipart/form-data']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('type', 'Select Slider Type')}} 
                            <select class="form-control" name="type">
                                <option value="">Please Select Type</option>
                                @if(isset($slider_edit->type) && !empty($slider_edit))
                                    @if($slider_edit->type == '1')
                                        <option value="1" selected>App</option>
                                        <option value="2">Web</option>
                                    @else
                                        <option value="1">App</option>
                                        <option value="2" selected>Web</option>
                                    @endif

                                @else
                                    <option value="1">App</option>
                                    <option value="2">Web</option>
                                @endif
                                
                            </select>
                            @if($errors->has('type'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('slider', 'Select Image')}} 
                            
                            <input type="file" name="slider" class="form-control">
                            @if($errors->has('slider'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('slider') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            @if(isset($slider_edit) && !empty($slider_edit))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                                <a href="{{ route('admin.SliderFormView') }}" class="btn btn-warning">Back</a>
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
    @if(isset($slider) && !empty($slider))
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Slider list</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Image</th>
                                    <th class="column-title">Type</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Action</th>
                            </thead>

                            <tbody>

                                
                                @php
                                    $count = 1;
                                @endphp

                                @if(count($slider) > 0)
                                @foreach($slider as $sliders)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                     <td class=" "><img src="{{asset('images/slider/thumb/'.$sliders->slider.'')}}" height="80px"></td>
                                    <td class=" ">
                                        @if($sliders->type == '1')
                                            <button class='btn btn-primary'>App</button>
                                        @else
                                             <button class='btn btn-warning'>Web</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sliders->status == '1')
                                            <button class='btn btn-primary'>Enabled</button>
                                        @else
                                             <button class='btn btn-warning'>Disabled</button>
                                        @endif
                                    </td>
                                    <td class=" ">
                                        @if($sliders->status == '1')
                                            <a href="{{route('admin.sliderStatusUpdate',['slider_id' => encrypt($sliders->id), 'status'=>encrypt(2) ])}}" class="btn btn-danger">Disable</a>
                                        @else
                                            <a href="{{route('admin.sliderStatusUpdate',['slider_id' => encrypt($sliders->id), 'status'=>encrypt(1)])}}" class="btn btn-success">Enable</a>
                                        @endif                                       
                                        
                                        <a href="{{route('admin.sliderEdit',['id' => encrypt($sliders->id)])}}" class="btn btn-warning">Edit</a>
                                        <a href="{{route('admin.sliderDelete',['slider_id' => encrypt($sliders->id)])}}" class="btn btn-danger">Delete</a>
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
    @endif
</div>


 @endsection