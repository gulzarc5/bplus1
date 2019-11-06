@extends('web.templet.master')
@section('title'.'contactus')
@section('content')
<div class="container">
  <header class="page-header">
    <h1 class="page-title">Contact Us
    </h1>
  </header>
  <div class="gap gap-small">
  </div>
  <div class="row" data-gutter="60">
    <div class="col-md-5">
      <h3 class="widget-title">Leave a Message
      </h3>
      <hr>
      <form>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name
              </label>
              <input class="form-control" type="text" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>E-mail
              </label>
              <input class="form-control" type="text" />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Message
          </label>
          <textarea class="form-control">
          </textarea>
        </div>
        <input class="btn btn-primary" type="submit" value="Send a Message" />
      </form>
    </div>
    <div class="col-md-7">
      <div class="row">
        <div class="col-md-4">
          <h3 class="widget-title">Assam
          </h3>
          <ul class="contact-list">
            <li>
              <h5>Email
              </h5>
              <a href="#">usa@bplus.com
              </a>
            </li>
            <li>
              <h5>Phone Number
              </h5>
              <p>+91-7676545654
              </p>
            </li>
            <li>
              <h5>Skype
              </h5>
              <p>Bplus
              </p>
            </li>
            <li>
              <h5>Address
              </h5>
              <address>Kamrup
                <br/>Guwahati, Assam
              </address>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <h3 class="widget-title">Meghalaya
          </h3>
          <ul class="contact-list">
            <li>
              <h5>Email
              </h5>
              <a href="#">usa@bplus.com
              </a>
            </li>
            <li>
              <h5>Phone Number
              </h5>
              <p>+91-7676545654
              </p>
            </li>
            <li>
              <h5>Skype
              </h5>
              <p>Bplus
              </p>
            </li>
            <li>
              <h5>Address
              </h5>
              <address>Shillong
                <br />Shillong, Meghalaya
              </address>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <h3 class="widget-title">Sikkim
          </h3>
          <ul class="contact-list">
            <li>
              <h5>Email
              </h5>
              <a href="#">usa@bplus.com
              </a>
            </li>
            <li>
              <h5>Phone Number
              </h5>
              <p>+91-7676545654
              </p>
            </li>
            <li>
              <h5>Skype
              </h5>
              <p>Bplus
              </p>
            </li>
            <li>
              <h5>Address
              </h5>
              <address>Sikkim
                <br/>Sikkim, Sikkim
              </address>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection