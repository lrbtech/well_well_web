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
                  <h2>Future Bulk <span>Pickup Request</span></h2> 
                  <!-- <h6 class="mb-0">View Shipment</h6>-->
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
                <div class="card-header">
                  @if($role_get->today_bulk_pickup_request_edit == 'on')
                    <div class="row">

                        <div class="col-md-3">
                          <label>{{$language[75][Auth::guard('admin')->user()->lang]}}</label>
                          <select id="agent_id" name="agent_id" class="form-control">
                            <option value="">{{$language[76][Auth::guard('admin')->user()->lang]}}</option>
                            @foreach($agent as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                            <button id="save" class="btn btn-primary btn-block mr-10" type="button">{{$language[77][Auth::guard('admin')->user()->lang]}}</button>
                        </div>
                    </div>
                  @endif
                  </div>

                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
              <tr>
                            <th><input type="checkbox" name="order_master_checkbox" class="order_master_checkbox" value=""/></th>
                            <th>User Id</th>
                            <th>Shipment Date</th>
                            <th>No of Shipments</th>
                            <th>No of Packages</th>
                            <th>Pickup Location</th>
                            <th>{{$language[15][Auth::guard('admin')->user()->lang]}}</th>
                            <!-- <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th> -->
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
<div class="modal fade" id="agent-model" tabindex="-1" role="dialog" aria-labelledby="agent-model" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title " id="modal-title">View Agent Details</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="agent-form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>No of Shipments</label>
                        <input readonly type="text" name="no_of_shipments" id="no_of_shipments" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label>No of Packages</label>
                        <input readonly type="text" name="no_of_packages" id="no_of_packages" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label>Total Weight</label>
                        <input readonly type="text" name="total_weight" id="total_weight" class="form-control" >
                    </div>

                    <div class="form-group">
                        <button id="assignagent" class="btn btn-primary btn-block mr-10" type="button">Assign Agent</button>
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
  <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<script type="text/javascript">
$('.future-pickup-request').addClass('active');


var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/admin/get-future-pickup-request",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        { data: 'checkbox', name: 'checkbox' , orderable:false, searchable:false },
        { data: 'user_id', name: 'user_id' },
        { data: 'shipment_date', name: 'shipment_date' },
        { data: 'no_of_shipments', name: 'no_of_shipments' },
        { data: 'no_of_packages', name: 'no_of_packages' },
        { data: 'from_address', name: 'from_address' },
        { data: 'status', name: 'status' },
        // { data: 'action', name: 'action' },
    ]
});

$(document).on('click','.order_master_checkbox', function(){
  if($(".order_master_checkbox").prop('checked') == true){
      $(".order_checkbox").prop('checked',true);
  } else{
      $(".order_checkbox").prop('checked',false);
  }
});


$(document).on('click','#save', function(){
    var order_id=[];
    var agent_id = $('#agent_id').val();

  if(agent_id != ''){
    $(".order_checkbox:checked").each(function(){
        order_id.push($(this).val());
    });
    if(order_id.length > 0){
        $.ajax({
            url:"/admin/bulk-checkbox-assign-agent",
            method:"GET",
            data:{id:order_id,agent_id:agent_id},
            success:function(data){
              toastr.success(data);
              //window.location.href="/admin/new-shipment-request";
              var new_url = '/admin/get-future-pickup-request';
              orderPageTable.ajax.url(new_url).load();
            }
        })
    }else{
        toastr.error("Please select atleast one Checkbox");
    }
  }else{
    toastr.error("Please select Agent");
  }
});



$(document).on('click','#assignagent', function(){
    var order_id=[];
    var agent_id = $('#agent_id').val();

  if(agent_id != ''){
    $(".order_checkbox:checked").each(function(){
        order_id.push($(this).val());
    });
    if(order_id.length > 0){
        $.ajax({
            url:"/admin/bulk-checkbox-assign-agent",
            method:"GET",
            data:{id:order_id,agent_id:agent_id},
            success:function(data){
              toastr.success(data);
              //window.location.href="/admin/new-shipment-request";
              var new_url = '/admin/get-future-pickup-request';
              orderPageTable.ajax.url(new_url).load();
              $('#agent-model').modal('hide');
            }
        })
    }else{
        toastr.error("Please select atleast one Checkbox");
    }
  }else{
    toastr.error("Please select Agent");
  }
});


$(document).on('change','#agent_id', function(){
  var agent_id = $('#agent_id').val();
  $.ajax({
    url : '/admin/get-agent-shipment/'+agent_id,
    type: "GET",
    dataType: "JSON",
    success:function(data) {
      $("#no_of_packages").val(data.shipment.no_of_packages);
      $("#no_of_shipments").val(data.shipment.no_of_shipments);
      $("#total_weight").val(data.shipment.total_weight);
      $('#agent-model').modal('show');
    }
  });
});
</script>
@endsection