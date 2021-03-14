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
                  <h2>{{$language[3][Auth::guard('admin')->user()->lang]}} <span>{{$language[8][Auth::guard('admin')->user()->lang]}}  </span></h2>
                  <h6 class="mb-0">{{$language[8][Auth::guard('admin')->user()->lang]}}</h6>
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
                    <h5>Zero Configuration</h5><span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span><span>Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</span>
                  </div> -->
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{$language[203][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[202][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[12][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[13][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[14][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[15][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $x = 0; ?>
                        @foreach($customer as $key => $row)
                        @if($row->status == 2)
                        <?php $x++; ?>
                          <tr>
                            <td>{{$x}}</td>
                            <td>{{$row->customer_id}}</td>
                            <td>
                              @if($row->user_type == 0)
                              Individual Business
                              @else
                              Commercial Business
                              @endif
                            </td>
                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                            <td>
                            @if($row->status == 0)
                                <p class="alert alert-danger dark" >{{$row->email}}</p>
                            @else
                                <p class="alert alert-success dark">{{$row->email}}</p>
                            @endif
                            </td>
                            <td>{{$row->mobile}}</td>
                            <td>
                            @if($row->status == 0)
                            Pending
                            @elseif($row->status == 1)
                            Not Verify
                            @elseif($row->status == 2)
                            Verified
                            @elseif($row->status == 3)
                            Sales team Verified
                            @elseif($row->status == 4)
                            Accounts Team Verified
                            @endif
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a onclick="viewRemark({{$row->id}})" class="dropdown-item" href="#">View Remark</a>
                                    @if($role_get->sales_team_edit == 'on')
                                    <a onclick="addRate({{$row->id}})" class="dropdown-item" href="#">Add RateCard</a>
                                    @endif
                                    @if($role_get->sales_team_edit == 'on')
                                    <a onclick="sendMail({{$row->id}})" class="dropdown-item" href="#">Send Mail</a>
                                    @endif
                                    @if($role_get->sales_team_edit == 'on')
                                    <a onclick="updateSalesStatus({{$row->id}},3)" class="dropdown-item" href="#">Approved</a>
                                    @endif
                                    <a class="dropdown-item" href="/admin/view-profile/{{$row->id}}">View Profile</a>
                                </div>
                            </td>
                          </tr>
                        @endif
                        @endforeach
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
<div class="modal fade" id="remark_modal" tabindex="-1" role="dialog" aria-labelledby="remark_modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title " id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
        
                <div class="form-group">
                    <label>View Remark</label>
                    <textarea rows="5" id="view_remark" name="view_remark" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal --> 

<!-- Bootstrap Modal -->
<div class="modal fade" id="price_modal" tabindex="-1" role="dialog" aria-labelledby="price_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                  <div class="card-body">
                    <div class="u-steps row">

                      <div class="u-step col-md-3 current" id="service_area"><span class="u-step-icon icon-shopping-cart-full" aria-hidden="true"></span>
                        <div class="u-step-desc"><span class="u-step-title">Service Area</span></div>
                      </div>

                      <div class="u-step col-md-3 " id="non_service_area"><span class="u-step-icon icon-notepad" aria-hidden="true"></span>
                        <div class="u-step-desc"><span class="u-step-title">Non Service Area</span></div>
                      </div>

                      <div class="u-step col-md-3 " id="same_day_delivery"><span class="u-step-icon icon-notepad" aria-hidden="true"></span>
                        <div class="u-step-desc"><span class="u-step-title">Same Day Delivery</span></div>
                      </div>

                      <div class="u-step col-md-3 " id="special_service"><span class="u-step-icon icon-notepad" aria-hidden="true"></span>
                        <div class="u-step-desc"><span class="u-step-title">Special Service</span></div>
                      </div>
                  
                    </div>
                  </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="price_form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="customer_id" id="customer_id">
            <div class="modal-body edit_rate_card">
                <div class="row" id="service_area_show">
                    <div class="form-group col-md-3">
                      <div class="checkbox checkbox-primary">
                        <input value="1" id="insurance_enable" name="insurance_enable" type="checkbox">
                        <label for="insurance_enable">Insurance (%)</label>
                      </div>
                      <input value="{{$settings->insurance_percentage}}" readonly autocomplete="off" type="text" id="insurance_percentage" name="insurance_percentage" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                      <div class="checkbox checkbox-primary">
                        <input value="1" id="vat_enable" name="vat_enable" type="checkbox">
                        <label for="vat_enable">Vat (%)</label>
                      </div>
                      <input value="{{$settings->vat_percentage}}" readonly autocomplete="off" type="text" id="vat_percentage" name="vat_percentage" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                      <div class="checkbox checkbox-primary">
                        <input value="1" id="postal_charge_enable" name="postal_charge_enable" type="checkbox">
                        <label for="postal_charge_enable">Postal Charge (%)</label>
                      </div>
                      <input value="{{$settings->postal_charge_percentage}}" readonly autocomplete="off" type="text" id="postal_charge_percentage" name="postal_charge_percentage" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                      <div class="checkbox checkbox-primary">
                        <input value="1" id="cod_enable" name="cod_enable" type="checkbox">
                        <label for="cod_enable">Cash on Delivery</label>
                      </div>
                      <input autocomplete="off" type="number" id="cod_price" name="cod_price" class="form-control">
                    </div>
                </div>
                
                <div class="row" id="non_service_area_table">
                    <div class="form-group col-md-6">
                      <label>0 to 5 kg Price</label>
                      <input autocomplete="off" type="text" id="before_5_kg_price" name="before_5_kg_price" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Above 5 kg Price (Per kg)</label>
                      <input autocomplete="off" type="text" id="above_5_kg_price" name="above_5_kg_price" class="form-control">
                    </div>
                </div>

                <div class="row" id="service_area_table">
                <table id="productTable" class="table">
                <thead class="thead-primary">
                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>0 to 5 kg Price</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="service_area_0_to_5_kg_price" name="service_area_0_to_5_kg_price" class="form-control">
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>5.1 to 10 kg Price</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="service_area_5_to_10_kg_price" name="service_area_5_to_10_kg_price" class="form-control">
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>10.1 to 15 kg Price</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="service_area_10_to_15_kg_price" name="service_area_10_to_15_kg_price" class="form-control">
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>15.1 to 20 kg Price</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="service_area_15_to_20_kg_price" name="service_area_15_to_20_kg_price" class="form-control">
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>20.1 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="service_area_20_to_1000_kg_price" name="service_area_20_to_1000_kg_price" class="form-control">
                      </th>
                    </tr>

                </thead>
                </table>
                </div>



                <div class="row" id="special_service_table">
                <table id="productTable" class="table">
                <thead class="thead-primary">
                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>0 to 5 kg Price</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="special_service_0_to_5_kg_price" name="special_service_0_to_5_kg_price" class="form-control">
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>5.1 to 10 kg Price</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="special_service_5_to_10_kg_price" name="special_service_5_to_10_kg_price" class="form-control">
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>10.1 to 15 kg Price</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="special_service_10_to_15_kg_price" name="special_service_10_to_15_kg_price" class="form-control">
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>15.1 to 20 kg Price</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="special_service_15_to_20_kg_price" name="special_service_15_to_20_kg_price" class="form-control">
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>20.1 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          <input autocomplete="off" type="text" id="special_service_20_to_1000_kg_price" name="special_service_20_to_1000_kg_price" class="form-control">
                      </th>
                    </tr>

                </thead>
                </table>
                </div>

                <div id="same_day_delivery_table" class="row">
                <table id="productTable1" class="table">
                <thead class="thead-primary">
                  <tr style="text-align: center;">
                  <th colspan="2">
                      <label>0 to 5 kg Price</label>
                  </th>
                  <th colspan="2">
                      <input autocomplete="off" type="text" id="same_day_delivery_0_to_5_kg_price" name="same_day_delivery_0_to_5_kg_price" class="form-control">
                  </th>
                  </tr>

                  <tr style="text-align: center;">
                  <th colspan="2">
                      <label>5.1 to 10 kg Price</label>
                  </th>
                  <th colspan="2">
                      <input autocomplete="off" type="text" id="same_day_delivery_5_to_10_kg_price" name="same_day_delivery_5_to_10_kg_price" class="form-control">
                  </th>
                  </tr>

                  <tr style="text-align: center;">
                  <th colspan="2">
                      <label>10.1 to 15 kg Price</label>
                  </th>
                  <th colspan="2">
                      <input autocomplete="off" type="text" id="same_day_delivery_10_to_15_kg_price" name="same_day_delivery_10_to_15_kg_price" class="form-control">
                  </th>
                  </tr>

                  <tr style="text-align: center;">
                  <th colspan="2">
                      <label>15.1 to 20 kg Price</label>
                  </th>
                  <th colspan="2">
                      <input autocomplete="off" type="text" id="same_day_delivery_15_to_20_kg_price" name="same_day_delivery_15_to_20_kg_price" class="form-control">
                  </th>
                  </tr>

                  <tr style="text-align: center;">
                  <th colspan="2">
                      <label>20.1 to 1000 kg Price (Per kg)</label>
                  </th>
                  <th colspan="2">
                      <input autocomplete="off" type="text" id="same_day_delivery_20_to_1000_kg_price" name="same_day_delivery_20_to_1000_kg_price" class="form-control">
                  </th>
                  </tr>
                    
                </thead>
                </table>
                </div>
                
            </div>
            </form>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button onclick="SavePrice()" class="btn btn-primary" type="button">Save</button>
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
$('.view-customer').addClass('active');
var add_rate;
function addRate(id){
    $('#modal-title').text('Add Rate Card');
    $('#save').text('Save Change');
    
    add_rate = 1;

    $.ajax({
      url : '/admin/get-rate-card-staus/'+id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        if(data.status == 1){
          $('input[name=customer_id]').val(id);
          $('#price_modal').modal('show');
        }
        else if(data.status == 2){
          editRateCard(id);
        }
        $("#non_service_area").removeClass('current');
        $('#same_day_delivery').removeClass('current');
        $('#service_area').addClass('current');
        $('#special_service').removeClass('current');
        $('#service_area_show').show();
        $('#service_area_table').show();
        $('#non_service_area_table').hide();
        $('#same_day_delivery_table').hide();
        $('#special_service_table').hide();
      }
    });
    
}

function editRateCard(id){
  //alert(id);
  $.ajax({
      url : '/admin/edit-rate-card/'+id,
      type: "GET",
      //dataType: "JSON",
      success:function(data) {
        $('input[name=customer_id]').val(id);
        $('#price_modal').modal('show');
        $('.edit_rate_card').html(data);
        add_rate = 2;

        $("#non_service_area").removeClass('current');
        $('#same_day_delivery').removeClass('current');
        $('#service_area').addClass('current');
        $('#special_service').removeClass('current');
        $('#service_area_show').show();
        $('#service_area_table').show();
        $('#non_service_area_table').hide();
        $('#same_day_delivery_table').hide();
        $('#special_service_table').hide();
      }
  });
}


function SavePrice(){
  var formData = new FormData($('#price_form')[0]);
  if(add_rate == 1){
    $.ajax({
        url : '/admin/save-sales-team-process',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#price_form")[0].reset();
            $('#price_modal').modal('hide');
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
  else{
    $.ajax({
        url : '/admin/update-sales-team-process',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#price_form")[0].reset();
            $('#price_modal').modal('hide');
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
}


function viewRemark(id){
  $.ajax({
    url : '/admin/edit-customer/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('View Remark');
      $('#save').text('Save Change');
      $('textarea[name=view_remark]').val(data.verify_remark);
      $('#remark_modal').modal('show');
      action_type = 2;
    }
  });
}

function updateSalesStatus(id,status){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/update-sales-status/'+id+'/'+status,
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


function sendMail(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/send-mail-sales-team/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Send');
          location.reload();
        }
      });
    } 
}



$('#service_area').on("click",function(){
  $("#non_service_area").removeClass('current');
  $('#same_day_delivery').removeClass('current');
  $('#service_area').addClass('current');
  $('#special_service').removeClass('current');

  $('#service_area_show').show();
  $('#service_area_table').show();
  $('#non_service_area_table').hide();
  $('#same_day_delivery_table').hide();
  $('#special_service_table').hide();
});

$('#same_day_delivery').on('click',function(){
  $("#non_service_area").removeClass('current');
  $('#same_day_delivery').addClass('current');
  $('#service_area').removeClass('current');
  $('#special_service').removeClass('current');

  $('#service_area_show').hide();
  $('#service_area_table').hide();
  $('#non_service_area_table').hide();
  $('#same_day_delivery_table').show();
  $('#special_service_table').hide();
});

$('#non_service_area').on('click',function(){
  $("#non_service_area").addClass('current');
  $('#same_day_delivery').removeClass('current');
  $('#service_area').removeClass('current');
  $('#special_service').removeClass('current');

  $('#service_area_show').hide();
  $('#service_area_table').hide();
  $('#non_service_area_table').show();
  $('#same_day_delivery_table').hide();
  $('#special_service_table').hide();
});

$('#special_service').on('click',function(){
  $("#non_service_area").removeClass('current');
  $('#same_day_delivery').removeClass('current');
  $('#service_area').removeClass('current');
  $('#special_service').addClass('current');

  $('#service_area_show').hide();
  $('#service_area_table').hide();
  $('#non_service_area_table').hide();
  $('#same_day_delivery_table').hide();
  $('#special_service_table').show();
});
</script>
@endsection