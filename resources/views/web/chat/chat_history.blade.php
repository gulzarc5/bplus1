@extends('web.templet.master')
@section('title','chathistory')

@section('content')
<style type="text/css">
.admin{
	font-size: 20px; 
	border: 1px solid #ededed;
    background-color: #ededed; 
	border-radius: 5px; 
	padding: 7px 10px 7px 10px; 
	position: relative;
}
.admin1{
	font-size: 20px; 
	border: 1px solid #ededed;
    background-color: #ededed;
	border-radius: 5px; 
	padding: 7px 10px 7px 10px; 
	position: relative;
}
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    
    /*border-bottom: 1px dotted #B3A9A9;*/
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 500px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

#example2 {
  border: 1px solid;
  padding: 10px;
  box-shadow: 5px 10px 18px #888888;
}
.le{
    margin-left: -15px;
}
.le1{
    /*margin-left: -15px;*/
}
.fchat{
    border: 1px solid #d0d4cf; 
    background-color: #d0d4cf; 
    border-radius: 7px;
    margin-top: 20px;  
}
.lchat{
    border: 1px solid #d0d4cf; 
    background-color: #d0d4cf; 
    border-radius: 7px; 
     margin-top: 15px;
}
</style>

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
                    <ul class="chat">
                        <a href="{{url('chat')}}">
                        <div class="col-md-12 fchat">
                        <li class="left clearfix le"><span class="chat-img pull-left">
                            <i class="fa fa-user admin" style="color: #000;">
    						</i> 
                        </span>
                        
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font " style="color: #000;">Jack Sparrow</strong> <small class="pull-right text-muted"></small>
                                    </div>
                                <p class="p1">
                                    hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
                                </p>
                            </div>
                       

                        </li>
                    </div>
                    </a>
                    <a href="{{url('chat')}}">
                    <div class="col-md-12 lchat">
                        <li class="left clearfix le"><span class="chat-img pull-left">
                             <i class="fa fa-user admin" style="color: #000;">
    						</i> 
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font" style="color: #000;">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span></span></small>
                                    </div>
                                <p class="p1">
                                    hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
                                </p>
                            </div>
                        </li>
                    </div>
                    </a>
                    <a href="{{url('chat')}}">
                    <div class="col-md-12 lchat">
                        <li class="left clearfix le"><span class="chat-img pull-left">
                             <i class="fa fa-user admin" style="color: #000;">
                            </i> 
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font" style="color: #000;">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span></span></small>
                                    </div>
                                <p class="p1">
                                    hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
                                </p>
                            </div>
                        </li>
                    </div>
                    </a>
                    <a href="{{url('chat')}}">
                    <div class="col-md-12 lchat">
                        <li class="left clearfix le"><span class="chat-img pull-left">
                             <i class="fa fa-user admin" style="color: #000;">
                            </i> 
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font" style="color: #000;">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span></span></small>
                                    </div>
                                <p class="p1">
                                    hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
                                </p>
                            </div>
                        </li>
                    </div>
                    </a>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
