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
                  <h2>Courier Team Guest <span>Settlement </span></h2> 
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
                            <input autocomplete="off" type="date" id="from_date" name="from_date" class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{$language[118][Auth::guard('admin')->user()->lang]}}</label>
                            <input autocomplete="off" type="date" id="to_date" name="to_date" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Select Courier</label>
                          <select id="agent_id" name="agent_id" class="form-control">
                            <option value="agent">Select Courier</option>
                            @foreach($agent as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                            <button id="search" class="btn btn-primary btn-block mr-10" type="button">{{$language[114][Auth::guard('admin')->user()->lang]}}
                            </button> <br>
                            <!-- <button id="exceldownload" class="btn btn-primary btn-block mr-10" type="submit">Excel
                            </button> -->
                        </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                          <button id="paid" class="btn btn-primary btn-block mr-10" type="button">Paid
                          </button> <br>
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
                            <th>{{$language[32][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[115][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[116][Auth::guard('admin')->user()->lang]}}</th>
                            <th>Special C.O.D</th>
                            <th>Collected C.O.D</th>
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
<div class="modal fade" id="popup-modal" tabindex="-1" role="dialog" aria-labelledby="popup-modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title " id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="delivery_agent_id" id="delivery_agent_id">\
                <input value="2" type="hidden" name="mode" id="mode">
                <input type="hidden" name="shipment_ids" id="shipment_ids">
                    <div class="form-group">
                      <label>Date</label>
                      <input value="{{date('Y-m-d')}}" type="date" id="date" name="date" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>No Of Shipments</label>
                      <input readonly type="number" id="no_of_shipments" name="no_of_shipments" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Collected Value</label>
                      <input readonly type="number" id="amount" name="amount" class="form-control">
                    </div>

                    <div class="form-group">
                        <button onclick="SaveSettlement()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Save Settlement</button>
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
$('.courier-team-guest-settlement').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/admin/get-courier-team-guest-settlement/agent/1/1",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        { data: 'checkbox', name: 'checkbox' },
        { data: 'order_id', name: 'order_id' },
        { data: 'shipment_date', name: 'shipment_date' },
        { data: 'shipment_mode', name: 'shipment_mode' },
        { data: 'from_address', name: 'from_address' },
        { data: 'to_address', name: 'to_address' },
        { data: 'special_cod', name: 'special_cod' },
        { data: 'collected_value', name: 'collected_value' },
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
    var agent_id = $('#agent_id').val();
    var new_url = '/admin/get-courier-team-guest-settlement/'+agent_id+'/'+fdate+'/'+tdate;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
});



$('#paid').click(function(){
    var order_id=[];
    $(".order_checkbox:checked").each(function(){
        order_id.push($(this).val());
    });
    var mode = 2;
    if(order_id.length > 0){
        $.ajax({
            url:"/admin/get-agent-settlement",
            method:"GET",
            data:{id:order_id,mode:mode},
            success:function(data){
              $('input[name=delivery_agent_id]').val(data.delivery_agent_id);
              $('input[name=shipment_ids]').val(data.shipment_ids);
              $('input[name=no_of_shipments]').val(data.no_of_shipments);
              $('input[name=amount]').val(data.total_value);
              $('#popup-modal').modal('show');
            }
        });
    }else{
        toastr.error("Please select atleast one Checkbox");
    }
});

function Settlement(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $('#delivery_agent_id').val(id);
      $('#popup-modal').modal('show');
    } 
}

function SaveSettlement(){
  var formData = new FormData($('#form')[0]);
    $.ajax({
      url : '/admin/agent-settlement',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {                
          $("#form")[0].reset();
          $('#popup-modal').modal('hide');
          toastr.success(data, 'Successfully Save');
          location.reload();
      },error: function (data) {
          var errorData = data.responseJSON.errors;
          $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
          });
      }
    });
}


</script>
@endsection