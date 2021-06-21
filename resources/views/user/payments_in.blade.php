@extends('user.layouts')
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
                  <h2>Payments In <span>Report </span></h2> 
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
                            <label>{{$language[117][Auth::user()->lang]}}</label>
                            <input autocomplete="off" type="date" id="from_date" name="from_date" class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{$language[118][Auth::user()->lang]}}</label>
                            <input autocomplete="off" type="date" id="to_date" name="to_date" class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <button id="search" class="btn btn-primary btn-block mr-10" type="button">{{$language[114][Auth::user()->lang]}}
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
                            <th>#</th>
                            <th>Tracking ID</th>
                            <th>Date</th>
                            <th>{{$language[32][Auth::user()->lang]}}</th>
                            <th>{{$language[115][Auth::user()->lang]}}</th>
                            <th>{{$language[116][Auth::user()->lang]}}</th>
                            <th>Special C.O.D</th>
                            <th>{{$language[70][Auth::user()->lang]}}</th>
                            <th>Status</th>
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
$('.payments-out-report').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
       "language": {
          processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
    "serverSide": true,
    "pageLength": 100,
    "ajax":{
        "url": "/user/get-payments-in-report/1/1",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'order_id', name: 'order_id' },
        { data: 'shipment_date', name: 'shipment_date' },
        { data: 'shipment_mode', name: 'shipment_mode' },
        { data: 'from_address', name: 'from_address' },
        { data: 'to_address', name: 'to_address' },
        { data: 'special_cod', name: 'special_cod' },
        { data: 'total', name: 'total' },
        { data: 'paid_status', name: 'paid_status' },
    ]
});

// $('#shipment_status').change(function(){
//     var shipment_status = $('#shipment_status').val();
//     var new_url = '/admin/get-shipment-report/'+shipment_status;
//     orderPageTable.ajax.url(new_url).load();
//     //orderPageTable.draw();
// });

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
    var new_url = '/user/get-payments-in-report/'+fdate+'/'+tdate;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
});


</script>
@endsection