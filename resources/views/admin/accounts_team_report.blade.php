@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/select2.css">
@endsection
@section('section')        
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>Accounts Team <span>Report </span></h2> 
                  <h6 class="mb-0">{{$language[9][Auth::guard('admin')->user()->lang]}}</h6>
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

                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>User Details</th>
                            <th>Collect Amount</th>
                            <th>Paid</th>
                            <th>Balance</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

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
<div class="modal fade" id="popup-modal" tabindex="-1" role="dialog" aria-labelledby="popup-modal" aria-hidden="true">
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
                <input type="hidden" name="admin_id" id="admin_id">
                    <div class="form-group">
                      <label>Date</label>
                      <input type="date" id="date" name="date" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Payment Mode</label>
                      <select id="mode" name="mode" class="form-control">
                      <option value="">SELECT</option>
                      <option value="1">COD</option>
                      <option value="2">GUEST</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Amount</label>
                      <input type="number" id="amount" name="amount" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Upload Slip</label>
                      <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <button onclick="SaveSettlement()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Save Settlement</button>
                    </div>
                </form>
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

  <script src="/assets/app-assets/js/select2/select2.full.min.js"></script>
<script src="/assets/app-assets/js/select2/select2-custom.js"></script>

  <script type="text/javascript">
$('.accounts-team-report').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/admin/get-accounts-team-report",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'admin_details', name: 'admin_details' },
        { data: 'collect_amount', name: 'collect_amount' },
        { data: 'paid', name: 'paid' },
        { data: 'balance', name: 'balance' },
        { data: 'action', name: 'action' },
    ]
});


function Settlement(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $('#admin_id').val(id);
      $('#popup-modal').modal('show');
    } 
}

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

function SaveSettlement(){
  var formData = new FormData($('#form')[0]);
    $.ajax({
      url : '/admin/accounts-settlement',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {                
          $("#form")[0].reset();
          $('#popup-modal').modal('hide');
          toastr.success(data, 'Successfully Save');
          location.reload();
      },error: function (data) {
          var errorData = data.responseJSON.errors;
          $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
          });
      }
    });
}


</script>
@endsection