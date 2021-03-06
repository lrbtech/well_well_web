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
                  <h2>Pickup Assigned </h2> 
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
                <form action="/admin/excel-shipment-report" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="card-header">
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

                        <div class="form-group col-md-2">
                            <label>{{$language[117][Auth::guard('admin')->user()->lang]}}</label>
                            <input autocomplete="off" type="date" id="from_date" name="from_date" class="form-control">
                        </div>

                        <div class="form-group col-md-2">
                            <label>{{$language[118][Auth::guard('admin')->user()->lang]}}</label>
                            <input autocomplete="off" type="date" id="to_date" name="to_date" class="form-control">
                        </div>
                        
                        <div class="form-group col-md-2">
                            <button id="search" class="btn btn-primary btn-block mr-10" type="button">{{$language[114][Auth::guard('admin')->user()->lang]}}
                            </button> <br>
                            <!-- <button id="exceldownload" class="btn btn-primary btn-block mr-10" type="submit">Excel
                            </button> -->
                        </div>
                    </div>
                    
                  </div>
                  </form>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
                          <tr>
                          <th><input type="checkbox" name="order_master_checkbox" class="order_master_checkbox" value=""/></th>
                            <th>Tracking ID</th>
                            <th>Shipment Details</th>
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

  <script type="text/javascript">
$('.schedule-for-pickup').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
       "language": {
          processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
    "serverSide": true,
    "pageLength": 100,
    "ajax":{
        "url": "/admin/get-schedule-for-pickup/1/1",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'checkbox', name: 'checkbox' , orderable:false, searchable:false },
        { data: 'order_id', name: 'order_id' },
        { data: 'total_weight', name: 'total_weight' },
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
              var new_url = '/admin/get-schedule-for-pickup/1/1';
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
              var new_url = '/admin/get-schedule-for-pickup/1/1';
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

$('#search').click(function(){
    //alert('hi');
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var fdate;
    var tdate;
    if(from_date!=""){
      fdate = from_date;
    }else{
      fdate = '1';
    }
    if(to_date!=""){
      tdate = to_date;
    }else{
      tdate = '1';
    }
    var new_url = '/admin/get-schedule-for-pickup/'+fdate+'/'+tdate;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
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
            window.location.href="/admin/schedule-for-pickup";
            }, 250);
        } else {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            window.location.href="/admin/schedule-for-pickup";
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