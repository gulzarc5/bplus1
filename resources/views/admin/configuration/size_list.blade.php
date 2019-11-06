@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Size List</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Name</th>
                              <th>Value</th>
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
                ajax: "{{ route('admin.size_lists') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 's_name', name: 's_name',searchable: true},
                    {data: 's_value', name: 's_value' ,searchable: true},
                    {data: 'category_name', name: 'category_name' ,searchable: true},
                    {data: 'first_category_name', name: 'first_category_name' ,searchable: true},       
                    {data: 'second_category_name', name: 'second_category_name' ,searchable: true},             
                    {data: 'status_tab', name: 'status_tab',orderable: false, searchable: false},                    
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>
    
 @endsection