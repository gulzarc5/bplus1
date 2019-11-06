@extends('web.templet.master')

@section('title', 'login')

@section('content')
	<div class="mfp-with-anim mfp-dialog clearfix" >
        <h3 class="widget-title text-center">User Login
        </h3>
        @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger" >{{ Session::get('error') }}</div>
        @endif
        <hr />


       {{ Form::open(array('route' => 'web.buyerLogin', 'method' => 'post')) }}
          <div class="form-group">
            <label>Email or Username</label>
            <input class="form-control" type="text" name="email" />
                @if ($message = Session::get('login_error'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @endif
                @if($errors->has('email'))
                    <span class="invalid-feedback" role="alert" style="color:red">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @enderror
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="text" name="password" />
              @if($errors->has('password'))
                  <span class="invalid-feedback" role="alert" style="color:red">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @enderror
          </div>
        {{--   <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Remeber Me
            </label>
          </div> --}}
          <input class="btn btn-primary" type="submit" value="Sign In" />

        {{ Form::close() }}


        <div class="gap gap-small">
        </div>
        <ul class="list-inline">
          <li>
            <a href="{{ route('web.userRegistrationForm')}}" >Not Member Yet
            </a>
          </li>
          <li>
            <a href="{{url('forgot_password')}}" >Forgot Password?
            </a>
          </li>
        </ul>
      </div>
      
@endsection