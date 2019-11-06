@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Mapped Brand List</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Brand Name</th>
                              <th>Category</th>
                              <th>FirstCategory</th>
                              <th>SecondCategory</th>
                              <th>Status</th>
                              <th>action</th>
                            </tr>
                          </thead>
                          <tbody>                       
                          </tbody>
                        </table>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
	</div>


 @endsection

@section('script')
     
     <script type="text/javascript">
         $(function () {
    
            var table = $('#size_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.ajax_mapped_brand_list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'brand_name', name: 'brand_name',searchable: true},
                    {data: 'c_name', name: 'c_name' ,searchable: true},
                    {data: 'first_c_name', name: 'first_c_name' ,searchable: true},       
                    {data: 'second_c_name', name: 'second_c_name' ,searchable: true},             
                    {data: 'status_tab', name: 'status_tab',orderable: false, searchable: false},                    
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>
    
 @endsection