@extends('web.templet.master')

@section('title', 'register')

@section('content')
	<div class="mfp-with-anim  mfp-dialog clearfix" >
        <h3 class="widget-title text-center">Create your Account
        </h3>
        @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger" >{{ Session::get('error') }}</div>
        @endif
        <hr />
        {{ Form::open(array('route' => 'web.user_registration', 'method' => 'post')) }}
          <div class="form-group">
              <label>Name</label>
              <input class="form-control" type="text" name="name" />
                
                @if($errors->has('name'))
                    <span class="invalid-feedback" role="alert" style="color:red">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @enderror
          </div>
          <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" />

              @if($errors->has('email'))
                  <span class="invalid-feedback" role="alert" style="color:red">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @enderror
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" />
              @if($errors->has('password'))
                  <span class="invalid-feedback" role="alert" style="color:red">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @enderror
          </div>
          <div class="form-group">
            <label>Repeat Password</label>
            <input class="form-control" type="password" name="password_confirmation" />

              @if($errors->has('password_confirmation'))
                  <span class="invalid-feedback" role="alert" style="color:red">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
              @enderror
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input class="form-control" type="number" name="mobile" />

              @if($errors->has('mobile'))
                  <span class="invalid-feedback" role="alert" style="color:red">
                      <strong>{{ $errors->first('mobile') }}</strong>
                  </span>
              @enderror
          </div>
         {{--  <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Subscribe to the Newsletter
            </label>
          </div> --}}
          <input class="btn btn-primary" type="submit" value="Create Account" />
        {{ Form::close() }}
        <div class="gap gap-small">
        </div>
        <ul class="list-inline">
          <li>
            <a href="#" class="popup-text">Already Memeber
            </a>
          </li>
        </ul>
      </div>
@endsection