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
                          <th>ID</th>
                            <th>Business Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($customer as $key => $row)
                        @if($row->status == 1)
                          <tr>
                          <td>{{$row->customer_id}}</td>
                            <td>
                              @if($row->user_type == 0)
                              Individual Business
                              @else
                              Commercial Business
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
                            <td>+971 {{$row->mobile}}</td>
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
                                    <a onclick="updateStatus({{$row->id}},2)" class="dropdown-item" href="#">Approved</a>
                                    <a onclick="updateStatus({{$row->id}},1)" class="dropdown-item" href="#">Denied</a>
                                    <a class="dropdown-item" href="/admin/view-profile/{{$row->id}}">View Profile</a>
                                </div>
                            </td>
                          </tr>
                        @endif
                        @endforeach
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

@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

<script type="text/javascript">
$('.view-customer').addClass('active');
function updateStatus(id,status){
    $('#modal-title').text('Add Remark');
    $('#save').text('Save Change');
    $('input[name=id]').val(id);
    $('input[name=status]').val(status);
    $('#popup_modal').modal('show');
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

</script>
@endsection