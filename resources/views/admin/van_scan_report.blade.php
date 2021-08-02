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
                  <h2>Van Scan <span>{{$language[99][Auth::guard('admin')->user()->lang]}}  </span></h2> 
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
                  <form target="_blank" action="/admin/pdf-van-scan-report" method="POST" enctype="multipart/form-data">
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
                        <div class="form-group col-md-3">
                            <label>Choose Driver</label>
                          <select id="agent_id" name="agent_id" class="form-control">
                            <option value="agent">{{$language[76][Auth::guard('admin')->user()->lang]}}</option>
                            @foreach($agent as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                            <button id="search" class="btn btn-primary btn-block mr-10" type="button">{{$language[114][Auth::guard('admin')->user()->lang]}}</button> <br>
                            <button id="pdfdownload" class="btn btn-primary btn-block mr-10" type="submit">PDF</button>
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
                            <th>Date</th>
                            <th>Driver Name</th>
                            <th>AWB No</th>
                            <th>Reference No</th>
                            <th>Ship To</th>
                            <th>To Details</th>
                            <th>Special C.O.P</th>
                            <th>Special C.O.D</th>
                            <th>Delivery Fees</th>
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
$('.van-scan-report').addClass('active');

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
  return '/admin/get-van-scan-report/'+agent_id+'/'+fdate+'/'+tdate;
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
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'date', name: 'date' },
        { data: 'driver_name', name: 'driver_name' },
        { data: 'order_id', name: 'order_id' },
        { data: 'reference_no', name: 'reference_no' },
        { data: 'to_address', name: 'to_address' },
        { data: 'to_details', name: 'to_details' },
        { data: 'special_cop', name: 'special_cop' },
        { data: 'special_cod', name: 'special_cod' },
        { data: 'total', name: 'total' },
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