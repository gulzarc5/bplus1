@extends('web.templet.master')

@section('title','chat')

@section('content')

<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span></span> <i class="fa fa-comments"></i> Chat
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li><a href=""><span>
                            </span><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</a></li>
                            <li class="divider"></li>
                            <li><a href=""><span></span><i class="fa fa-power-off"></i> Sign Out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <center>
                     <img class="product-img-primary" src="{{asset('src/img/test_product/woman_bags/4.jpg')}}" alt="Image Alternative text" title="Image Title"  style="width: 340px; height: 340px;" />
                    </center>
                    <ul class="chat">
                        <div class="col-md-6 fchat">
                        <li class="left clearfix le"><span class="chat-img pull-left">
                            <i class="fa fa-user admin">
                            </i> 
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font ">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span></span><i class="fa fa-clock-o" aria-hidden="true"></i> 12 mins ago</small>
                                    </div>
                                <p class="p1">
                                    hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
                                </p>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-6 lchat">
                        <li class="right clearfix le1"><span class="chat-img pull-right">
                            <i class="fa fa-user admin1">
                            </i> 
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span></span><i class="fa fa-clock-o" aria-hidden="true"></i> 13 mins ago</small>
                                    <strong class="pull-right primary-font" >Bhaumik Patel</strong>
                                </div>
                                <p class="p1">
                                    Hellooooooooooooooooooooooooooooooooooooooooooooooooo
                                </p>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-6 fchat">
                        <li class="left clearfix le"><span class="chat-img pull-left">
                             <i class="fa fa-user admin">
                            </i> 
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span></span><i class="fa fa-clock-o" aria-hidden="true"></i> 14 mins ago</small>
                                    </div>
                                <p class="p1">
                                    hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
                                </p>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-6 lchat" >
                        <li class="right clearfix le1"><span class="chat-img pull-right">
                             <i class="fa fa-user admin1">
                            </i> 
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span></span><i class="fa fa-clock-o" aria-hidden="true"></i> 15 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p class="p1">
                                    Hellooooooooooooooooooooooooooooooooooooooooooooooooo
                                </p>
                            </div>
                        </li>
                    </div>
                </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat">
                                Send</button>
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
