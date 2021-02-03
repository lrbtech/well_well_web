@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
@endsection
@section('section')        
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>View <span>Customer  </span></h2>
                  <h6 class="mb-0">admin panel</h6>
                </div>
                <!-- <div class="col-lg-6 breadcrumb-right">     
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item">Data Tables</li>
                    <li class="breadcrumb-item active">Basic Init</li>
                  </ol>
                </div> -->
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <!-- <div class="card-header">
                    <h5>Zero Configuration</h5><span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span><span>Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</span>
                  </div> -->
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>Business Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if($role_get->id == 1)
                        @foreach($customer as $key => $row)
                          <tr>
                            <td>
                              @if($row->user_type == 0)
                              Individual
                              @else
                              Business
                              @endif
                            </td>
                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                            <td>
                            @if($row->status == 0)
                                <p class="alert alert-danger dark" >{{$row->email}}</p>
                            @else
                                <p class="alert alert-success dark">{{$row->email}}</p>
                            @endif
                            </td>
                            <td>{{$row->mobile}}</td>
                            <td>
                            @if($row->status == 0)
                            Pending
                            @elseif($row->status == 1)
                            Not Verify
                            @elseif($row->status == 2)
                            Verified
                            @elseif($row->status == 3)
                            Sales team Verified
                            @elseif($row->status == 4)
                            Accounts Team Verified
                            @endif
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                  @if($row->status == 1)
                                    <a onclick="updateStatus({{$row->id}},2)" class="dropdown-item" href="#">Approved</a>
                                    <a onclick="updateStatus({{$row->id}},1)" class="dropdown-item" href="#">Denied</a>
                                  @elseif($row->status == 2)
                                    <a onclick="viewRemark({{$row->id}})" class="dropdown-item" href="#">View Remark</a>
                                    <a onclick="addRate({{$row->id}})" class="dropdown-item" href="#">Add RateCard</a>
                                  @endif
                                </div>
                            </td>
                          </tr>
                        @endforeach
                        @elseif($role_get->id == 2)
                        @foreach($customer as $key => $row)
                        @if($row->status == 1)
                          <tr>
                            <td>
                              @if($row->user_type == 0)
                              Individual
                              @else
                              Business
                              @endif
                            </td>
                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                            <td>
                            @if($row->status == 0)
                                <p class="alert alert-danger dark" >{{$row->email}}</p>
                            @else
                                <p class="alert alert-success dark">{{$row->email}}</p>
                            @endif
                            </td>
                            <td>{{$row->mobile}}</td>
                            <td>
                            @if($row->status == 0)
                            Pending
                            @elseif($row->status == 1)
                            Not Verify
                            @elseif($row->status == 2)
                            Verified
                            @endif
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a onclick="updateStatus({{$row->id}},2)" class="dropdown-item" href="#">Approved</a>
                                    <a onclick="updateStatus({{$row->id}},1)" class="dropdown-item" href="#">Denied</a>
                                </div>
                            </td>
                          </tr>
                        @endif
                        @endforeach
                        @elseif($role_get->id == 3)
                        @foreach($customer as $key => $row)
                        @if($row->status == 2)
                          <tr>
                            <td>
                              @if($row->user_type == 0)
                              Individual
                              @else
                              Business
                              @endif
                            </td>
                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                            <td>
                            @if($row->status == 0)
                                <p class="alert alert-danger dark" >{{$row->email}}</p>
                            @else
                                <p class="alert alert-success dark">{{$row->email}}</p>
                            @endif
                            </td>
                            <td>{{$row->mobile}}</td>
                            <td>
                            @if($row->status == 0)
                            Pending
                            @elseif($row->status == 1)
                            Not Verify
                            @elseif($row->status == 2)
                            Verified
                            @endif
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a onclick="viewRemark({{$row->id}})" class="dropdown-item" href="#">View Remark</a>
                                    <a onclick="addRate({{$row->id}})" class="dropdown-item" href="#">Add RateCard</a>
                                </div>
                            </td>
                          </tr>
                        @endif
                        @endforeach
                        @elseif($role_get->id == 4)
                        @foreach($customer as $key => $row)
                        @if($row->status == 3)
                          <tr>
                            <td>
                              @if($row->user_type == 0)
                              Individual
                              @else
                              Business
                              @endif
                            </td>
                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                            <td>
                            @if($row->status == 0)
                                <p class="alert alert-danger dark" >{{$row->email}}</p>
                            @else
                                <p class="alert alert-success dark">{{$row->email}}</p>
                            @endif
                            </td>
                            <td>{{$row->mobile}}</td>
                            <td>
                            @if($row->status == 0)
                            Pending
                            @elseif($row->status == 1)
                            Not Verify
                            @elseif($row->status == 2)
                            Verified
                            @elseif($row->status == 3)
                            Sales Team Verified
                            @endif
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a onclick="updateAccountStatus({{$row->id}},4)" class="dropdown-item" href="#">Account Verfication Confirm</a>
                                    <a class="dropdown-item" href="/admin/view-profile/{{$row->id}}">View Profile</a>
                                </div>
                            </td>
                          </tr>
                        @endif
                        @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->


            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="popup_modal" tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title " id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="status" id="status">

                    <div class="form-group">
                        <label>Remark</label>
                        <textarea id="deny_remark" name="deny_remark" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button onclick="VerifyCustomer()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal --> 

<!-- Bootstrap Modal -->
<div class="modal fade" id="remark_modal" tabindex="-1" role="dialog" aria-labelledby="remark_modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title " id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
        
                <div class="form-group">
                    <label>View Remark</label>
                    <textarea rows="5" id="view_remark" name="view_remark" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal --> 

<!-- Bootstrap Modal -->
<div class="modal fade" id="price_modal" tabindex="-1" role="dialog" aria-labelledby="price_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                     <div class="card-body">
                    <div class="u-steps row">
                      <div class="u-step col-md-4 current" id="service_area"><span class="u-step-icon icon-shopping-cart-full" aria-hidden="true"></span>
                        <div class="u-step-desc"><span class="u-step-title">Service Area</span></div>
                      </div>
                      <div class="u-step col-md-4 " id="non_service_area"><span class="u-step-icon icon-notepad" aria-hidden="true"></span>
                        <div class="u-step-desc"><span class="u-step-title">Non Service Area</span></div>
                      </div>
                  
                    </div>
                  </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              
                <form id="price_form" method="POST" enctype="multipart/form-data">
                         
                {{ csrf_field() }}
                <input type="hidden" name="customer_id" id="customer_id">
                <div class="form-inline theme-form service_area">
                          <div class="form-group">
                            <input class="form-control" type="text" name="insurance" placeholder="Insurence Value">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="cod" placeholder="Cash on Delivery">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="vat" placeholder="vat">
                          </div>
                         <div class="form-group">
                            <input class="form-control" type="text" name="postal_charge" placeholder="Postal Charges">
                          </div>
                        </div>
                <div class="form-inline theme-form non_service_area hide">
                          <div class="form-group">
                            <input class="form-control" type="text" name="insurance1" placeholder="Insurence Value">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="cod1" placeholder="Cash on Delivery">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="vat1" placeholder="vat">
                          </div>
                         <div class="form-group">
                            <input class="form-control" type="text" name="postal_charge1" placeholder="Postal Charges">
                          </div>
                        </div>
                    {{-- <div id="remote_aera"></div> --}}
                    <div class="row services_area_table">
                      <table id="productTable" class="table">
                        <thead class="thead-primary">
                            <tr style="text-align: center;">
                                <th>Weight from</th>
                                <th>Weight to</th>
                                <th>Price</th>
                                <th style="width: 3%;padding: .0rem !important;">
                                    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus" aria-hidden="true"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="productTabletbody">
                          
                        </tbody>
                      </table>
                    </div>
                    <div class="row non_services_area_table hide">
                      <table id="productTable1" class="table">
                        <thead class="thead-primary">
                            <tr style="text-align: center;">
                                <th>Weight from</th>
                                <th>Weight to</th>
                                <th>Price</th>
                                <th style="width: 3%;padding: .0rem !important;">
                                    <button type="button" class="btn btn-default" onclick="addRow1()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus" aria-hidden="true"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="productTabletbody1">
                          
                        </tbody>
                      </table>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button onclick="SavePrice()" class="btn btn-primary" type="button">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal --> 
@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

<script type="text/javascript">

function updateStatus(id,status){
    $('#modal-title').text('Add Remark');
    $('#save').text('Save Change');
    $('input[name=id]').val(id);
    $('input[name=status]').val(status);
    $('#popup_modal').modal('show');
}

function addRate(id){
    $('#modal-title').text('Add Rate Card');
    $('#save').text('Save Change');
    $('input[name=customer_id]').val(id);
    $('#price_modal').modal('show');
}


function updateAccountStatus(id,status){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/update-account-status/'+id+'/'+status,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Update');
          location.reload();
        }
      });
    } 
}

function VerifyCustomer(){
  var formData = new FormData($('#form')[0]);
    $.ajax({
        url : '/admin/update-verify-status',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#popup_modal').modal('hide');
            location.reload();
            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
}

function SavePrice(){
  var formData = new FormData($('#price_form')[0]);
    $.ajax({
        url : '/admin/save-sales-team-process',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#popup_modal').modal('hide');
            location.reload();
            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
}


function viewRemark(id){
  $.ajax({
    url : '/admin/edit-customer/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('View Remark');
      $('#save').text('Save Change');
      $('textarea[name=view_remark]').val(data.verify_remark);
      $('#remark_modal').modal('show');
      action_type = 2;
    }
  });
}







addRow();
function addRow() {
	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		count = 1;
		arrayNumber = 0;
	}


var tr = '<tr value="'+count+'" id="row'+count+'">'+
	'<td>'+
		'<input style="text-align:right;" type="text" name="weight_from[]" id="weight_from'+count+'" autocomplete="off" class="form-control" />  '+
	'</td> '+
	'<td>'+
		' <input style="text-align:right;" type="text" name="weight_to[]" id="weight_to'+count+'" autocomplete="off" class="form-control" />'+
	'</td>'+
	
	'<td> '+
		'<input style="text-align: right;" type="text" name="price[]" id="price'+count+'" autocomplete="off" class="form-control" />'+
	'</td>'+
	'<td align="center">'+
		'<button id="removeProductRowBtn'+count+'" class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="fa fa-minus" aria-hidden="true"></i>'+
'</button>'+
	'</td>'+
'</tr>';


if(tableLength > 0) {							
	$("#productTable tbody tr:last").after(tr);
} else {				
	$("#productTable tbody").append(tr);
}		

} // /add row
// addRow1();
function addRow1() {
	var tableLength = $("#productTable1 tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable1 tbody tr:last").attr('id');
		arrayNumber = $("#productTable1 tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		count = 1;
		arrayNumber = 0;
	}


var tr = '<tr value="'+count+'" id="rows'+count+'">'+
	'<td>'+
		'<input style="text-align:right;" type="text" name="weight_from1[]" id="weight_from1'+count+'" autocomplete="off" class="form-control" />  '+
	'</td> '+
	'<td>'+
		' <input style="text-align:right;" type="text" name="weight_to1[]" id="weight_to1'+count+'" autocomplete="off" class="form-control" />'+
	'</td>'+
	
	'<td> '+
		'<input style="text-align: right;" type="text" name="price1[]" id="price1'+count+'" autocomplete="off" class="form-control" />'+
	'</td>'+
	'<td align="center">'+
		'<button id="removeProductRowBtnn'+count+'" class="btn btn-default removeProductRowBtnn" type="button" onclick="removeProductRows('+count+')"><i class="fa fa-minus" aria-hidden="true"></i>'+
'</button>'+
	'</td>'+
'</tr>';


if(tableLength > 0) {							
	$("#productTable1 tbody tr:last").after(tr);
} else {				
	$("#productTable1 tbody").append(tr);
}		

} // /add row


function removeProductRow(row = null)
{
	if(confirm('Are you sure delete this row?'))
	{
	   	var tableProductLength = $("#productTable tbody tr").length;

		if(tableProductLength > '1') {
			$("#row"+row).remove();
			var previous_row = row - 1;
			var next_row = row + 1;
			$("#product_search"+previous_row).focus();		
			$("#product_search"+next_row).focus();		
		}
	}
}
function removeProductRows(row = null)
{
	if(confirm('Are you sure delete this row?'))
	{
	   	var tableProductLength = $("#productTable1 tbody tr").length;

		if(tableProductLength > '1') {
			$("#rows"+row).remove();
			var previous_row = row - 1;
			var next_row = row + 1;
			$("#product_search"+previous_row).focus();		
			$("#product_search"+next_row).focus();		
		}
	}
}
// $('#service_area').on("click",function(){
//   alert("ok")
// // })
$('#service_area').on("click",function(){
  $('#service_area').addClass('current');
  $('#non_service_area').removeClass('current');
  $(".non_service_area").addClass('hide');
  $(".service_area").removeClass('hide');
  $(".non_services_area_table").addClass('hide');
  $(".services_area_table").removeClass('hide');

});
$('#non_service_area').on('click',function(){
  $('#non_service_area').addClass('current');
  $('#service_area').removeClass('current');
  $('#remote_aera').hide('service_area');
    $(".service_area").addClass('hide');
  $(".non_service_area").removeClass('hide');
   $(".services_area_table").addClass('hide');
  $(".non_services_area_table").removeClass('hide');

});
</script>
@endsection