@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
<style>
div.dataTables_wrapper div.dataTables_processing {
  top: 0%;
}
</style>
@endsection
@section('section')        
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>Agent <span>{{$language[99][Auth::guard('admin')->user()->lang]}}  </span></h2> 
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
                  <form action="/admin/excel-agent-report" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="card-header">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>{{$language[117][Auth::guard('admin')->user()->lang]}}</label>
                            <input value="<?php echo date('Y-m-d',strtotime('first day of this month')); ?>" autocomplete="off" type="date" id="from_date" name="from_date" class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{$language[118][Auth::guard('admin')->user()->lang]}}</label>
                            <input value="<?php echo date('Y-m-d',strtotime('last day of this month')); ?>" autocomplete="off" type="date" id="to_date" name="to_date" class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Choose Driver</label>
                          <select id="agent_id" name="agent_id" class="form-control">
                            <option value="agent">{{$language[76][Auth::guard('admin')->user()->lang]}}</option>
                            @foreach($agent as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>{{$language[100][Auth::guard('admin')->user()->lang]}}</label>
                            <select id="shipment_status" name="shipment_status" class="form-control">
                              <option value="20">All Data</option>
                              <!-- <option value="0">Ready for Pickup</option> -->
                              <option value="1">Pickup Assigned</option>
                              <option value="2">Package Collected</option>
                              <option value="3">Pickup Exception</option>
                              <option value="4">Transit In From Station</option>
                              <option value="11">Transit In To Station</option>
                              <option value="13">Package at Station From Station</option>
                              <option value="14">Package at Station To Station</option>
                              <option value="6">Transit Out From Station</option>
                              <option value="12">Transit Out To Station</option>
                              <option value="7">In the Van for Delivery</option>
                              <option value="8">Shipment delivered</option>
                              <option value="9">Delivery Exception</option>
                              <!-- <option value="10">Cancel Shipment</option> -->
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <button id="search" class="btn btn-primary btn-block mr-10" type="button">{{$language[114][Auth::guard('admin')->user()->lang]}}
                            </button> <br>
                            <button id="exceldownload" class="btn btn-primary btn-block mr-10" type="submit">Excel
                            </button>
                        </div>
                    </div>
                    
                  </div>
                  </form>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
                          <tr>
                            <!-- <th>#</th> -->
                            <th>Account ID</th>
                            <th>Tracking ID</th>
                            <th>Reference No</th>
                            <th>Date</th>
                            <th>{{$language[32][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[115][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[116][Auth::guard('admin')->user()->lang]}}</th>
                            <th>To Details</th>
                            <th>Special C.O.D</th>
                            <th>Special C.O.P</th>
                            <th>{{$language[70][Auth::guard('admin')->user()->lang]}}</th>
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



@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

  <script type="text/javascript">
$('.agent-report').addClass('active');

function search_url(){
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
  var agent_id = $('#agent_id').val();
  var shipment_status = $('#shipment_status').val();
  return '/admin/get-agent-report/'+agent_id+'/'+fdate+'/'+tdate+'/'+shipment_status;
}

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
       "language": {
          processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
    "serverSide": true,
    "pageLength": 100,
    "ajax":{
        "url": search_url(),
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'account_id', name: 'account_id' },
        { data: 'order_id', name: 'order_id' },
        { data: 'reference_no', name: 'reference_no' },
        { data: 'shipment_date', name: 'shipment_date' },
        { data: 'shipment_mode', name: 'shipment_mode' },
        { data: 'from_address', name: 'from_address' },
        { data: 'to_address', name: 'to_address' },
        { data: 'to_details', name: 'to_details' },
        { data: 'special_cod', name: 'special_cod' },
        { data: 'special_cop', name: 'special_cop' },
        { data: 'total', name: 'total' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action' },
    ]
});

// $('#shipment_status').change(function(){
//     var shipment_status = $('#shipment_status').val();
//     var new_url = '/admin/get-shipment-report/'+shipment_status;
//     orderPageTable.ajax.url(new_url).load();
//     //orderPageTable.draw();
// });


$('#search').click(function(){
  var new_url = search_url();
  orderPageTable.ajax.url(new_url).load(null, false);
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
            var new_url = search_url();
            orderPageTable.ajax.url(new_url).load(null, false);
            }, 250);
        } else {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            var new_url = search_url();
            orderPageTable.ajax.url(new_url).load(null, false);
        }
        //PrintDiv(data);
        
    }
  });
}


</script>
@endsection