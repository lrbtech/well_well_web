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
                  <h2>{{$language[3][Auth::user()->lang]}} <span>{{$language[18][Auth::user()->lang]}}  </span></h2> 
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
                      <div class="form-group col-md-3">
                          <button id="print" class="btn btn-primary btn-block mr-10" type="button">Print</button>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th></th>
                            <th>Tracking ID</th>
                            <th>{{$language[59][Auth::user()->lang]}}</th>
                            <th>Reference No</th>
                            <th>C.O.D Value</th>
                            <th>{{$language[32][Auth::user()->lang]}}</th>
                            <th>{{$language[24][Auth::user()->lang]}}</th>
                            <th>{{$language[28][Auth::user()->lang]}}</th>
                            <th>{{$language[15][Auth::user()->lang]}}</th>
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



<!-- Bootstrap Modal -->
<div class="modal fade" id="cancel_modal" tabindex="-1" role="dialog" aria-labelledby="cancel_modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title " id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cancel_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="shipment_id" id="shipment_id">

                    <div class="form-group">
                        <label>Remark</label>
                        <textarea id="cancel_remark" name="cancel_remark" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button onclick="SaveCancelRequest()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Add</button>
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
$('.view_shipment').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/user/get-shipment",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'checkbox', name: 'checkbox' },
        { data: 'order_id', name: 'order_id' },
        { data: 'shipment_date', name: 'shipment_date' },
        { data: 'reference_no', name: 'reference_no' },
        { data: 'cod_value', name: 'cod_value' },
        { data: 'shipment_mode', name: 'shipment_mode' },
        { data: 'from_address', name: 'from_address' },
        { data: 'to_address', name: 'to_address' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action' },
    ]
});


function PrintLabel(id){
  $.ajax({
    url : '/user/print-label/'+id,
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
            window.location.href="/user/shipment";
            }, 250);
        } else {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            window.location.href="/user/shipment";
        }
        //PrintDiv(data);
        
    }
  });
}

$(document).on('click','#print', function(){
    var order_id=[];
    $(".order_checkbox:checked").each(function(){
        order_id.push($(this).val());
    });
    if(order_id.length > 0){
        $.ajax({
            url:"/user/bulk-print-label",
            method:"GET",
            data:{id:order_id},
            success:function(data){
              var mywindow = window.open('', 'BIlling Application', 'height=600,width=800');
              var is_chrome = Boolean(mywindow.chrome);
              mywindow.document.write(data.html);
              mywindow.document.close(); 
              if (is_chrome) {
                  setTimeout(function() {
                  mywindow.focus(); 
                  mywindow.print(); 
                  mywindow.close();
                  window.location.href="/user/shipment";
                  }, 250);
              } else {
                  mywindow.focus(); 
                  mywindow.print(); 
                  mywindow.close();
                  window.location.href="/user/shipment";
              }
            }
        })
    }else{
        toastr.error("Please select atleast one Checkbox");
    }
});

function activeholdshipment(id){
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url : '/user/active-hold-shipment/'+id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        toastr.success(data, 'Successfully Update');
        window.location.href="/user/shipment";
      }
    });
  }
}

function cancelholdshipment(id){
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url : '/user/cancel-hold-shipment/'+id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        toastr.success(data, 'Successfully Update');
        window.location.href="/user/shipment";
      }
    });
  }
}


function CancelRequest(id){
    $('#modal-title').text('Add Remark');
    $('#save').text('Save Change');
    $('input[name=shipment_id]').val(id);
    $('#cancel_modal').modal('show');
}

function SaveCancelRequest(){
  var formData = new FormData($('#cancel_form')[0]);
    $.ajax({
        url : '/user/save-cancel-request',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#cancel_form")[0].reset();
            $('#cancel_modal').modal('hide');
            location.reload();
            toastr.success(data, 'Successfully Save');
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