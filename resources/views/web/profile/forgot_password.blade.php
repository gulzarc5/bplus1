@extends('web.templet.master')

@section('title', 'forgotPassword')

@section('content')
    <div class="mfp-with-anim mfp-dialog clearfix" >
        <h3 class="widget-title text-center">Forgot Password
        </h3>
        <hr />
        <form>
          <div class="form-group">
            <label>Email or Username
            </label>
            <input class="form-control" type="text" />
          </div>
          <input class="btn btn-primary" type="submit" value="Submit" />
        </form>
        <div class="gap gap-small">
        </div>
    </div>
      
@endsection