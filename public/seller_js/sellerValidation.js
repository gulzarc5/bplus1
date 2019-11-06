function sellerValidation() {
	$("#seller_btn").html('<button class="btn btn-success" type="submit" name="seller_info">Save</button>');
	$("#name").attr('disabled',false);
	$("#mobile").attr('disabled',false);
	$("#dob").attr('disabled',false);
	$("#pan").attr('disabled',false);
	$("#gst").attr('disabled',false);
	$("#state").attr('disabled',false);
	$("#city").attr('disabled',false);
	$("#pin").attr('disabled',false);
	$("#address").attr('disabled',false);
	$("#bank_name").attr('disabled',false);
	$("#branch_name").attr('disabled',false);
	$("#account_no").attr('disabled',false);
	$("#ifsc").attr('disabled',false);
	$("#micr").attr('disabled',false);
}