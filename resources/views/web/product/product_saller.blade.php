@extends('web.templet.master')
@section('title','product')

@section('content')
  <style type="text/css">
  .sall{
    font-size: 20px; border: 1px solid #80808069; 
    background-color: #80808069; 
    border-radius: 5px; 
    padding: 7px 10px 7px 10px;     
    position: relative;
    top: 9px;
    }
  .sall1{
    font-size: 12px; 
    margin-left: 30px;
    margin-left: 42px;
    margin-top: -14px;
    } 
    .view{
      font: italic bold 14px/30px Georgia, serif;
    }
  </style>
  <div id="pagination_data">
      @include('web.product.pagination.product_seller')
  </div>
  


  <div class="gap">
  </div>
<hr>

@endsection


