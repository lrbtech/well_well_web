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
                  <h2>{{$language[3][Auth::guard('admin')->user()->lang]}} <span>{{$language[92][Auth::guard('admin')->user()->lang]}}  </span></h2> 
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
                  <!-- <div class="card-header">
                    <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
                    <i class="bx bx-plus"></i>
                    <span>New Users</span>
                    </button>
                  </div> -->
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>User Id</th>
                            <th>{{$language[59][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[78][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[32][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[24][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[28][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[15][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th>
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
<div class="modal fade" id="assign-agent-modal" tabindex="-1" role="dialog" aria-labelledby="assign-agent-modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title " id="modal-title">{{$language[172][Auth::guard('admin')->user()->lang]}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="shipment_id" id="shipment_id">

                    <div class="form-group">
                        <label>{{$language[189][Auth::guard('admin')->user()->lang]}}</label>
                        <select id="pickup_agent_id" name="pickup_agent_id" class="form-control">
                          <option value="">{{$language[190][Auth::guard('admin')->user()->lang]}}</option>
                          @foreach($agent as $row)
                          <option value="{{$row->id}}">{{$row->name}}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button onclick="updateAssignAgent()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">{{$language[271][Auth::guard('admin')->user()->lang]}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal --> 

<!-- Bootstrap Modal -->
<div class="modal fade" id="assign-agent-station-modal" tabindex="-1" role="dialog" aria-labelledby="assign-agent-station-modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title " id="modal-title">{{$language[172][Auth::guard('admin')->user()->lang]}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form1" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="shipment_id1" id="shipment_id1">

                    <div class="form-group">
                        <label>{{$language[189][Auth::guard('admin')->user()->lang]}}</label>
                        <select id="station_agent_id" name="station_agent_id" class="form-control">
                          <option value="">{{$language[190][Auth::guard('admin')->user()->lang]}}</option>
                          @foreach($agent as $row)
                          <option value="{{$row->id}}">{{$row->name}}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button onclick="updateAssignAgentStation()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">{{$language[271][Auth::guard('admin')->user()->lang]}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal --> 

<!-- Bootstrap Modal -->
<div class="modal fade" id="assign-agent-delivery-modal" tabindex="-1" role="dialog" aria-labelledby="assign-agent-delivery-modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title " id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form2" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="shipment_id2" id="shipment_id2">

                    <div class="form-group">
                        <label>Assign Employee</label>
                        <select id="delivery_agent_id" name="delivery_agent_id" class="form-control">
                          <option value="">Select Agent</option>
                          @foreach($agent as $row)
                          <option value="{{$row->id}}">{{$row->name}}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button onclick="updateAssignAgentDelivery()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Update</button>
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
$('.shipment').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
       "language": {
          processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
    "serverSide": true,
    "pageLength": 100,
    "ajax":{
        "url": "/admin/get-shipment",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'user_id', name: 'user_id' },
        { data: 'shipment_date', name: 'shipment_date' },
        { data: 'shipment_time', name: 'shipment_time' },
        { data: 'shipment_mode', name: 'shipment_mode' },
        { data: 'from_address', name: 'from_address' },
        { data: 'to_address', name: 'to_address' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action' },
    ]
});


function PrintLabel(id){
  $.ajax({
    url : '/admin/print-label/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        var mywindow = window.open('', 'BIlling Application', 'height=600,width=800');
        var is_chrome = Boolean(mywindow.chrome);
        mywindow.document.write(data.html);
        mywindow.document.close(); 
        if (is_chrome) {
            setTimeout(function() {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            window.location.href="/admin/shipment";
            }, 250);
        } else {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            window.location.href="/admin/shipment";
        }
        //PrintDiv(data);
    }
  });
}


function AssignAgent(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $('#shipment_id').val(id);
      $('#assign-agent-modal').modal('show');
    } 
}

function AssignAgentStation(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $('#shipment_id1').val(id);
      $('#assign-agent-station-modal').modal('show');
    } 
}

function AssignAgentDelivery(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $('#shipment_id2').val(id);
      $('#assign-agent-delivery-modal').modal('show');
    } 
}

function updateAssignAgent(){
  var formData = new FormData($('#form')[0]);
    $.ajax({
        url : '/admin/assign-agent',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#assign-agent-modal').modal('hide');
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

function updateAssignAgentStation(){
  var formData = new FormData($('#form1')[0]);
    $.ajax({
        url : '/admin/assign-agent-station',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form1")[0].reset();
            $('#assign-agent-station-modal').modal('hide');
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

function updateAssignAgentDelivery(){
  var formData = new FormData($('#form2')[0]);
    $.ajax({
        url : '/admin/assign-agent-delivery',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form2")[0].reset();
            $('#assign-agent-delivery-modal').modal('hide');
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


