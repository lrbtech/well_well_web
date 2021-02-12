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
                            <label>{{$language[117][Auth::guard('admin')->user()->lang]}}</label>
                            <input autocomplete="off" type="date" id="from_date" name="from_date" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>{{$language[118][Auth::guard('admin')->user()->lang]}}</label>
                            <input autocomplete="off" type="date" id="to_date" name="to_date" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <button id="search" class="btn btn-primary btn-block mr-10" type="button">{{$language[114][Auth::guard('admin')->user()->lang]}}</button>
                        </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{$language[119][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[64][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[66][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[68][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[69][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[54][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[70][Auth::guard('admin')->user()->lang]}}</th>
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
        "url": "/admin/get-revenue-report/1/1",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        { data: 'order_id', name: 'order_id' },
        { data: 'total_weight', name: 'total_weight' },
        { data: 'shipment_price', name: 'shipment_price' },
        { data: 'postal_charge', name: 'postal_charge' },
        { data: 'vat', name: 'vat' },
        { data: 'insurance', name: 'insurance' },
        { data: 'cod_amount', name: 'cod_amount' },
        { data: 'total', name: 'total' },
    ]
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
    var new_url = '/admin/get-revenue-report/'+fdate+'/'+tdate;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
});

</script>
@endsection