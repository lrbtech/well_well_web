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
                  <h2>{{$language[18][Auth::guard('admin')->user()->lang]}} <span>{{$language[99][Auth::guard('admin')->user()->lang]}}  </span></h2> 
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
                  <div class="card-header">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>{{$language[100][Auth::guard('admin')->user()->lang]}}</label>
                            <select id="shipment_status" name="shipment_status" class="form-control">
                              <option value="9">{{$language[101][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="0">{{$language[102][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="1">{{$language[103][Auth::guard('admin')->user()->lang]}}/option>
                              <option value="2">{{$language[104][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="3">{{$language[81][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="4">{{$language[105][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="5">{{$language[106][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="6">{{$language[107][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="7">{{$language[108][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="8">{{$language[109][Auth::guard('admin')->user()->lang]}}</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>{{$language[110][Auth::guard('admin')->user()->lang]}}</label>
                            <select id="user_type" name="user_type" class="form-control">
                              <option value="3">{{$language[101][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="0">{{$language[111][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="1">{{$language[112][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="2">{{$language[113][Auth::guard('admin')->user()->lang]}}</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <button id="search" class="btn btn-primary btn-block mr-10" type="button">{{$language[114][Auth::guard('admin')->user()->lang]}}
                            </button>
                        </div>
                    </div>
                    
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{$language[114][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[32][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[115][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[116][Auth::guard('admin')->user()->lang]}}</th>
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
$('.shipment').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/admin/get-shipment-report/9/3",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        { data: 'order_id', name: 'order_id' },
        { data: 'shipment_date', name: 'shipment_date' },
        { data: 'shipment_mode', name: 'shipment_mode' },
        { data: 'from_address', name: 'from_address' },
        { data: 'to_address', name: 'to_address' },
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
    //alert('hi');
    var shipment_status = $('#shipment_status').val();
    var user_type = $('#user_type').val();
    var new_url = '/admin/get-shipment-report/'+shipment_status+'/'+user_type;
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
            window.location.href="/admin/shipment-report";
            }, 250);
        } else {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            window.location.href="/admin/shipment-report";
        }
        //PrintDiv(data);
        
    }
  });
}


</script>
@endsection