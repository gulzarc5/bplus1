@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
  <div class="row">
    <div class="x_panel">
      <div class="x_title">
        <h3>Product Images</h3>
        <div class="clearfix"></div>
          <div>
             @if (Session::has('message'))
                <div class="alert alert-success" >{{ Session::get('message') }}</div>
             @endif
             @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
             @endif
          </div>
      </div>
      <div class="x_content">
        @if(isset($product) && isset($image) && !empty($product) && !empty($image))

        @foreach($image as $image)
        <div class="col-md-4">
          <div class="thumbnail" style="height: 300px; width: 300px;" >
            <div class="image view view-first" style="height: 300px; width: 300px;">
              <img style="width: 100%; display: block;" src="{{ asset('images/product/thumb/'.$image->image.'')}}" />
            </div>
          </div>
          <div>

            @if($product->main_image == $image->image)
              <a href="" class="btn btn-sm btn-primary">Thumb Image</a>
            @else              

                @if($image->status == 1)
                  <a href="{{ route('seller.product_set_thumb',['product_id'=>encrypt($product->id),'image_id' =>encrypt($image->id) ])}}" class="btn btn-sm btn-success">Set As Main Image</a>

                  <a href="{{ route('seller.product_images_status_update',['product_id'=>encrypt($product->id),'image_id' =>encrypt($image->id),'status'=>encrypt(2) ])}}" class="btn btn-sm btn-warning">Disable</a>
                @else
                  <a href="{{ route('seller.product_images_status_update',['product_id'=>encrypt($product->id),'image_id' =>encrypt($image->id),'status'=>encrypt(1) ])}}" class="btn btn-sm btn-info">Enable</a>
                @endif

              <a href="{{ route('seller.product_images_delete',['product_id'=>encrypt($product->id),'image_id' =>encrypt($image->id)])}}" class="btn btn-sm btn-danger" >Delete</a>
            @endif
          </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="x_panel">
        <div class="x_title">
            <h2>Add More Images</h2>
            <div class="clearfix"></div>
        </div>
        <div>
            <div class="x_content">
           
              {{ Form::open(['method' => 'post','route'=>'seller.product_more_image_add' , 'enctype'=>'multipart/form-data']) }}
                <input type="hidden" name="product_id" value="{{ encrypt($product->id)}}">
                 <div class="well" style="overflow: auto" id="image_div">
                      <div class="form-row mb-10">
                          <div class="col-md-8 col-sm-12 col-xs-12 mb-3">
                              <label for="size">Image</label>
                              <input type="file" name="image[]" class="form-control">
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                             <a class="btn btn-sm btn-primary" style="margin-top: 25px;" onclick="add_more_image()">Add More</a>                                 
                          </div>  
                      </div>
                      @if($errors->has('image'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('image') }}</strong>
                          </span>
                      @enderror

                 </div>

              <div class="form-group">
                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
              </div>
              {{ Form::close() }}

            </div>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>


 @endsection

@section('script')
     
<script type="text/javascript">
  var more_image_count = 1;

function add_more_image(){
    var more_image_html = ' <div class="form-row mb-10" id="img_id'+more_image_count+'">'+
    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
        '<label for="size">Image</label>'+
        '<input type="file" name="image[]" class="form-control">'+
    '</div>'+
    
    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
        
    '</div>'+
    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
       '<a class="btn btn-sm btn-danger" style="margin-top: 25px;" onclick="remove_more_image('+more_image_count+')">Remove</a>'+
    '</div>'+
'</div>';
    $("#image_div").append(more_image_html);
    more_image_count++;

}

function remove_more_image(id) {
    $("#img_id"+id).remove();
}
</script>
    
 @endsection