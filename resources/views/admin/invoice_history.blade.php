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
                  <h2>Invoice <span>History</span></h2> 
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
                  <form action="/admin/excel-invoice-history" method="post" enctype="multipart/form-data">
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

                        <div class="form-group col-md-2">
                            <label>{{$language[110][Auth::guard('admin')->user()->lang]}}</label>
                            <select id="user_type" name="user_type" class="form-control">
                              <option value="3">{{$language[101][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="0">{{$language[111][Auth::guard('admin')->user()->lang]}}</option>
                              <option value="1">{{$language[112][Auth::guard('admin')->user()->lang]}}</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <button id="search" class="btn btn-primary btn-block mr-10" type="button">{{$language[114][Auth::guard('admin')->user()->lang]}}
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
                            <th>Date</th>
                            <th>User Details</th>
                            <th>User Type</th>
                            <th>No of Shipments</th>
                            <th>No of Packages</th>
                            <th>Total</th>
                            <th>Status</th>
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


<!-- Bootstrap Modal -->
<div class="modal fade" id="popup_modal" tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title text-white" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" enctype="multipart/form-data">
            	{{ csrf_field() }}
            	<input type="hidden" name="id" id="id">
                <input type="hidden" name="sender_id" id="sender_id">

                    <div class="form-group">
                        <label>Date</label>
                        <input value="{{date('d-m-Y')}}" readonly autocomplete="off" type="text" id="date" name="date" class="form-control">
                    </div>
                    <div class="row">
                    <div class="form-group col-md-4">
                        <label>Total</label>
                        <input readonly autocomplete="off" type="text" id="total" name="total" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Paid</label>
                        <input readonly autocomplete="off" type="text" id="paid" name="paid" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Balance</label>
                        <input readonly autocomplete="off" type="text" id="balance" name="balance" class="form-control">
                    </div>
                    </div>

                    <div class="form-group">
                        <label>Payment Type</label>
                        <select class="form-control" name="payment_type" id="payment_type">
                            <option value="">Payment Type</option>
                            <option selected="">Cash</option>
                            <option>Cheque</option>
                            <option>Bank</option>
                            <option>Others</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Payment Description</label>
                        <textarea rows="3" placeholder="Payment Description" class="form-control" name="payment_description" id="payment_description"></textarea>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label>New Payment</label>
                        <input autocomplete="off" type="text" id="new_payment" name="new_payment" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Remaining pay</label>
                        <input readonly autocomplete="off" type="text" id="next_balance" name="next_balance" class="form-control">
                    </div>

                    </div>
                    

                    <div class="form-group">
                        <button  onclick="Save()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->


<!-- Bootstrap Modal -->
<div class="modal fade" id="view_payment_modal" tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title text-white" id="modal-title">View Payment Details</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="view-invoice-payment" class="table-responsive">

                </div>
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
$('.invoice-history').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
       "language": {
          processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
    "serverSide": true,
    "pageLength": 100,
    "ajax":{
        "url": "/admin/get-invoice-history/3/1/1",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { data: 'invoice_date', name: 'invoice_date' },
        { data: 'user_details', name: 'user_details' },
        { data: 'user_type', name: 'user_type' },
        { data: 'no_of_shipments', name: 'no_of_shipments' },
        { data: 'no_of_packages', name: 'no_of_packages' },
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
    var user_type = $('#user_type').val();
    var new_url = '/admin/get-invoice-history/'+user_type+'/'+fdate+'/'+tdate;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
});


function Save(){
	var formData = new FormData($('#form')[0]);
    $.ajax({
        url : '/admin/save-invoice-payment',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
          console.log(data);                
          // $("#form")[0].reset();
          $('#popup_modal').modal('hide');
          var new_url = "/admin/get-invoice-history/3/1/1";
          orderPageTable.ajax.url(new_url).load();
          toastr.success(data, 'Successfully Save');
        },error: function (data, errorThrown) {
          	var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
              toastr.error(obj[0]);
          	});
        }
    });
}

function newPayment(id){
  $.ajax({
    url : '/admin/new-invoice-payment/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('#modal-title').text('Add New Payment');
        $('#saveButton').text('Save Change');
        $('input[name=id]').val(data.id);
        $('input[name=sender_id]').val(data.sender_id);
        $('input[name=total]').val(data.total);
        $('input[name=paid]').val(data.paid);
        $('input[name=balance]').val(data.balance);

        $('input[name=new_payment]').val('');
        $('input[name=next_balance]').val('');

        $('#popup_modal').modal('show');
    }
  });
}


$( "#new_payment" ).keyup(function() {
    var total = Number($("#total").val());
    var paid = Number($("#paid").val());
    var balance = Number($("#balance").val());
    
    var new_payment = Number($("#new_payment").val());
    if(new_payment > balance){
        alert('Given Amount is high than Pay Amount');
        $("#new_payment").val('');
        $("#new_payment").focus();
        $("#next_balance").val(balance);
    }
    else{
        $("#next_balance").val(balance - new_payment);
    }
});


function viewPayment(id)
{
    $.ajax({
    url : '/admin/view-invoice-payment/'+id,
    type: "GET",
    success: function(data)
    {
        $('#view-invoice-payment').html(data);
        $('#view_payment_modal').modal('show');
    }
  });
}


function PrintInvoice(id){
  $.ajax({
    url : '/admin/invoice-print/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        var mywindow = window.open('', 'Print Invoice', 'height=600,width=800');
        var is_chrome = Boolean(mywindow.chrome);
        mywindow.document.write(data.html);
        mywindow.document.close(); 
        if (is_chrome) {
            setTimeout(function() {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            window.location.href="/admin/invoice-history";
            }, 250);
        } else {
            mywindow.focus(); 
            mywindow.print(); 
            mywindow.close();
            window.location.href="/admin/invoice-history";
        }
        //PrintDiv(data);
    }
  });
}

</script>
@endsection