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
                  <h2>{{$language[72][Auth::guard('admin')->user()->lang]}} <span>{{$language[91][Auth::guard('admin')->user()->lang]}}  </span></h2> 
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
                            <th>{{$language[326][Auth::guard('admin')->user()->lang]}}</th>
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

@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

  <script type="text/javascript">
$('.cancel-request').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
       "language": {
          processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
    "serverSide": true,
    "pageLength": 100,
    "ajax":{
        "url": "/admin/get-cancel-request",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'order_id', name: 'order_id' },
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
            window.location.href="/admin/cancel-request";
            }, 250);
        } else {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            window.location.href="/admin/cancel-request";
        }
        //PrintDiv(data);
    }
  });
}


function ShipmentCancelled(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/update-cancel-request/'+id,
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

</script>
@endsection