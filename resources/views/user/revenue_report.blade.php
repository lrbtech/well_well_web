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
                  <h2>Payment <span>{{$language[99][Auth::user()->lang]}}  </span></h2> 
                  <!-- <h6 class="mb-0">{{$language[9][Auth::user()->lang]}}</h6> -->
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
                <form action="/user/excel-revenue-report" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="card-header">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>{{$language[117][Auth::user()->lang]}}</label>
                            <input autocomplete="off" type="date" id="from_date" name="from_date" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>{{$language[118][Auth::user()->lang]}}</label>
                            <input autocomplete="off" type="date" id="to_date" name="to_date" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <button id="search" class="btn btn-primary btn-block mr-10" type="button">{{$language[114][Auth::user()->lang]}}</button> <br>
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
                            <th>#</th>
                            <th>Tracking ID</th>
                            <th>{{$language[119][Auth::user()->lang]}}</th>
                            <th>{{$language[64][Auth::user()->lang]}}</th>
                            <th>{{$language[66][Auth::user()->lang]}}</th>
                            <th>{{$language[68][Auth::user()->lang]}}</th>
                            <th>{{$language[69][Auth::user()->lang]}}</th>
                            <th>{{$language[54][Auth::user()->lang]}}</th>
                            <th>{{$language[70][Auth::user()->lang]}}</th>
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
$('.revenue-report').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/user/get-revenue-report/1/1",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
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
    if(from_date!="" && from_date!=null){
      fdate = from_date;
    }else{
      fdate = '1';
    }
    if(to_date!="" && to_date!=null){
      tdate = to_date;
    }else{
      tdate = '1';
    }
    var new_url = '/user/get-revenue-report/'+fdate+'/'+tdate;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
});


// $('#downloadexcel').click(function(){
//   var formData = new FormData($('#form')[0]);
//     $.ajax({
//         url : '/admin/excel-revenue-report',
//         type: "POST",
//         data: formData,
//         contentType: false,
//         processData: false,
//         dataType: "JSON",
//         success: function(data)
//         {                
//             $("#form")[0].reset();
//             toastr.success(data, 'Successfully Export');
//         },error: function (data) {
//             var errorData = data.responseJSON.errors;
//             $.each(errorData, function(i, obj) {
//             toastr.error(obj[0]);
//       });
//     }
//     });
// });

</script>
@endsection