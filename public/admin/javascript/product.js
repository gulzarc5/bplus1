
color_id = 1;
function addMoreColor(){
    var html_color = null;
    if (color_html) {
        html_color = color_html;
    }else{
        html_color = $("#color").html();
    }
    var temp_color = '<div class="form-row mb-3" id="color_remove'+color_id+'">'+
    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3" >'+
                            '<label for="color">Select Color</label>'+
                            '<select class="form-control color" name="color[]" id="color">'+
                              html_color+
                            '</select>'+
                        '</div>'+
                        '<div class="col-md-2 col-sm-12 col-xs-12 mb-3">'+
                           '<a class="btn btn-sm btn-danger" style="margin-top: 25px;" onclick="removeColorDiv('+color_id+')">Remove</a>'+
                        '</div>'+
                        '<div>';
    $("#color_div").append(temp_color);
    color_id++;
}

function removeColorDiv(id) {
    $("#color_remove"+id).remove();
}


// var inner_size_div_count = 1;
// function add_more_inner_size_div(size_key,size_id){
//    var temp_size_html = '<div id="inner_size_add_div'+inner_size_div_count+'"><div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
//                                 '<input type="hidden" name="size_id[]" value="'+size_id+'">'+
//                                 '<label for="size">'+size_key+'</label>'+
//                                 '<select class="form-control" name="size[]">'+size[size_key]+
//                                 '</select>'+
//                                     '</div>'+
//                                     '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
//                                       '<label for="mrp">Enter M.R.P.</label>'+
//                                       '<input type="text" class="form-control" name="mrp[]"  placeholder="Enter MRP" >'+

//                                     '</div>'+
//                                     '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
//                                       '<label for="price">Enter Price</label>'+
//                                       '<input type="text" class="form-control" name="price[]"  placeholder="Enter Price" >'+
//                                     '</div>'+

//                                     '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
//                                       '<label for="stock">Enter Stock</label>'+
//                                       '<input type="text" class="form-control" name="stock[]"  placeholder="Enter Stock" >'+
//                                     '</div>'+

//                                     '<div class="col-md-8 col-sm-12 col-xs-12 mb-3">'+
//                                        '<a class="btn btn-sm btn-danger" style="margin-top: 25px;" onclick="removeInnerSizeDiv(\''+inner_size_div_count+'\')">Remove</a>'+
//                                     '</div>'+
//                                 '</div></div>';
//     $("#inner_size_add_div"+size_key).append(temp_size_html);
//     inner_size_div_count++;
// }

// function removeInnerSizeDiv(id) {
//     $("#inner_size_add_div"+id).remove();
// }


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