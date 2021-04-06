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
                  <h2>Pending <span>{{$language[18][Auth::user()->lang]}}  </span></h2> 
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
                    <div class="row">
                        <div class="col-md-3">
                          <label>{{$language[59][Auth::user()->lang]}}</label>
                          <input min="<?php echo date('Y-m-d', strtotime("+0 days")); ?>" max="<?php echo date('Y-m-d', strtotime("+60 days")); ?>" class="form-control" id="shipment_date" name="shipment_date" type="date">
                        </div>

                        <div class="col-md-3">
                          <label>{{$language[60][Auth::user()->lang]}}</label>
                            <!-- <input  min="08:00 AM" max="04:00 PM" class="form-control" id="shipment_from_time" name="shipment_from_time" type="time"> -->
                            <select class="form-control" id="shipment_from_time" name="shipment_from_time">
                              <option value="">Select Time</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                          <label>{{$language[61][Auth::user()->lang]}}</label>
                          <input readonly class="form-control" id="shipment_to_time" name="shipment_to_time" type="text">
                        </div>

                        <div class="form-group col-md-3">
                            <button id="save" class="btn btn-primary btn-block mr-10" type="button">Ready for Pickup</button>
                        </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th><input type="checkbox" name="order_master_checkbox" class="order_master_checkbox" value=""/></th>
                            <th>Reference No</th>
                            <th>C.O.D Value</th>
                            <th>{{$language[32][Auth::user()->lang]}}</th>
                            <th>{{$language[24][Auth::user()->lang]}}</th>
                            <th>{{$language[28][Auth::user()->lang]}}</th>
                            <th>{{$language[70][Auth::user()->lang]}}</th>
                            <th>{{$language[16][Auth::user()->lang]}}</th>
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
  <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<script type="text/javascript">
$('.pending-shipment').addClass('active');

$('#shipment_from_time').blur(function(){
  var shipment_from_time = $("#shipment_from_time").val();
  // //alert(shipment_from_time);

  var to_time = moment.utc(shipment_from_time,'hh:mm A').add(2,'hour').format('hh:mm A');
  $("#shipment_to_time").val(to_time);
});


$('#shipment_date').change(function(){
  var shipment_date = $('#shipment_date').val();
  $.ajax({
    url : '/get-available-time/'+shipment_date,
    type: "GET",
    success: function(data)
    {
        $('#shipment_from_time').html(data);
    }
  });
});

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/user/get-pending-shipment",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'checkbox', name: 'checkbox' , orderable:false, searchable:false },
        { data: 'reference_no', name: 'reference_no' },
        { data: 'cod_value', name: 'cod_value' },
        { data: 'shipment_mode', name: 'shipment_mode' },
        { data: 'from_address', name: 'from_address' },
        { data: 'to_address', name: 'to_address' },
        { data: 'total', name: 'total' },
        { data: 'action', name: 'action' },
    ]
});

function Delete(id){
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url : '/user/delete-pending-shipment/'+id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        toastr.success(data, 'Successfully Delete');
        window.location.href="/user/pending-shipment";
      }
    });
  }
}

$(document).on('click','.order_master_checkbox', function(){
  if($(".order_master_checkbox").prop('checked') == true){
      $(".order_checkbox").prop('checked',true);
  } else{
      $(".order_checkbox").prop('checked',false);
  }
});


$(document).on('click','#save', function(){
    var order_id=[];
    var shipment_date = $('#shipment_date').val();
    var shipment_from_time = $('#shipment_from_time').val();
    var shipment_to_time = $('#shipment_to_time').val();
if(shipment_date != '' && shipment_from_time){
  // if(shipment_from_time >= '08:00 AM' && '06:00 PM' >= shipment_to_time){
    $(".order_checkbox:checked").each(function(){
        order_id.push($(this).val());
    });
    if(order_id.length > 0){
        $.ajax({
            url:"/user/schedule-shipment",
            method:"GET",
            data:{id:order_id,shipment_date:shipment_date,shipment_from_time:shipment_from_time,shipment_to_time:shipment_to_time},
            success:function(data){
              console.log(data);
                toastr.success(data);
                window.location.href="/user/shipment";
            }
        })
    }else{
        toastr.error("Please select atleast one Checkbox");
    }
  // }else{
  //   toastr.error("Kindly contact our customer service for alternative solution. +971569949409");
  // }
}else{
  toastr.error("Please select Date & Time");
}

});
</script>
@endsection