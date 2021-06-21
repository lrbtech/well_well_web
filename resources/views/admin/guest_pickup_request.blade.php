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
                  <h2>Guest <span>Pickup Request</span></h2> 
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
                  @if($role_get->guest_pickup_request_edit == 'on')
                    <div class="row">

                        <div class="col-md-3">
                          <label>Select Station</label>
                          <select id="station_id" name="station_id" class="form-control">
                            <option value="0">All Station</option>
                            @foreach($station as $row)
                            <option value="{{$row->id}}">{{$row->station}}</option>
                            @endforeach
                          </select>
                        </div>

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
                        <div class="form-group col-md-3">
                          <button id="print" class="btn btn-primary btn-block mr-10" type="button">Bulk Print</button>
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
                            <th>User ID</th>
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
$('.guest-pickup-request').addClass('active');


var orderPageTable = $('#datatable').DataTable({
    "processing": true,
       "language": {
          processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
    "serverSide": true,
    "pageLength": 100,
    "ajax":{
        "url": "/admin/get-guest-pickup-request",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        { data: 'checkbox', name: 'checkbox' , orderable:false, searchable:false },
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

$(document).on('click','.order_master_checkbox', function(){
  if($(".order_master_checkbox").prop('checked') == true){
      $(".order_checkbox").prop('checked',true);
  } else{
      $(".order_checkbox").prop('checked',false);
  }
});

$(document).on('click','#print', function(){
    var order_id=[];
    $(".order_checkbox:checked").each(function(){
        order_id.push($(this).val());
    });
    if(order_id.length > 0){
        $.ajax({
            url:"/admin/bulk-print-label",
            method:"GET",
            data:{id:order_id},
            success:function(data){
              var mywindow = window.open('', 'BIlling Application', 'height=600,width=800');
              var is_chrome = Boolean(mywindow.chrome);
              mywindow.document.write(data.html);
              mywindow.document.close(); 
              if (is_chrome) {
                  setTimeout(function() {
                  mywindow.focus(); 
                  mywindow.print(); 
                  mywindow.close();
                  var new_url = '/admin/get-guest-pickup-request';
                  orderPageTable.ajax.url(new_url).load(null, false);
                  }, 250);
              } else {
                  mywindow.focus(); 
                  mywindow.print(); 
                  mywindow.close();
                  var new_url = '/admin/get-guest-pickup-request';
                  orderPageTable.ajax.url(new_url).load(null, false);
              }
            }
        })
    }else{
        toastr.error("Please select atleast one Checkbox");
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
            url:"/admin/checkbox-assign-agent",
            method:"GET",
            data:{id:order_id,agent_id:agent_id},
            success:function(data){
              toastr.success(data);
              //window.location.href="/admin/new-shipment-request";
              var new_url = '/admin/get-guest-pickup-request';
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
            url:"/admin/checkbox-assign-agent",
            method:"GET",
            data:{id:order_id,agent_id:agent_id},
            success:function(data){
              toastr.success(data);
              //window.location.href="/admin/new-shipment-request";
              var new_url = '/admin/get-guest-pickup-request';
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
            window.location.href="/admin/guest-pickup-request";
            }, 250);
        } else {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            window.location.href="/admin/guest-pickup-request";
        }
        //PrintDiv(data);
        
    }
  });
}

$('#station_id').change(function(){
  var id = $('#station_id').val();
  $.ajax({
    url : '/admin/get-agent-details/'+id,
    type: "GET",
    success: function(data)
    {
        $('#agent_id').html(data);
    }
  });
});
</script>
@endsection