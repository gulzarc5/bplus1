
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
                    <h2>Add New City</h2>
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
                        @if(isset($city) && !empty($city))
                            {{Form::model($city, ['method' => 'post','route'=>'admin.update_city'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.add_city']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('state_id', 'Select State')}}
                            @if(isset($states) && !empty($states))
                                {!! Form::select('state_id', $states, null, ['class' => 'form-control','placeholder'=>'Please Select State','id'=>'category']) !!}
                            @else
                                {!! Form::select('state_id',array('' => 'Please Select Main State'),null, ['class' => 'form-control']) !!}
                            @endif

                            @if($errors->has('state_id'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('state_id') }}</strong>
                                </spanstate>                            
                            @enderror

                        </div>


                        <div class="form-group">
                            {{ Form::label('name', 'City Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter City name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
			                        <strong>{{ $errors->first('name') }}</strong>
			                    </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            @if(isset($city) && !empty($city))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                                <a href="{{ route('admin.city_list')}}" class="btn btn-warning">Back</a>
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

</script>
    
 @endsection