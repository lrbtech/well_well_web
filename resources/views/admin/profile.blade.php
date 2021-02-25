@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
@endsection
@section('section') 
<!-- Right sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>View<span>Profile</span></h2>
          <h6 class="mb-0">admin panel</h6>
        </div>
        <!-- <div class="col-lg-6 breadcrumb-right">     
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
            <li class="breadcrumb-item">Apps    </li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active"> Edit Profile</li>
          </ol>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title mb-0">My Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <form class="theme-form">
                <div class="row mb-2">
                  <div class="col-auto"><img class="img-70 rounded-circle" alt="" src="/upload_files/{{$customer->profile_image}}"></div>
                  <div class="col">
                    <h3 class="mb-1">{{$customer->first_name}} {{$customer->last_name}}</h3>
                    <!-- <p class="mb-4">DESIGNER</p> -->
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Email-Address</label>
                  <input class="form-control" type="email" value="{{$customer->email}}">
                </div>
                <div class="form-group">
                  <label class="form-label">Mobile</label>
                  <input class="form-control" type="text" value="{{$customer->mobile}}">
                </div>
                <div class="form-group">
                  <label class="form-label">Website</label>
                  <input class="form-control" type="text" value="{{$customer->website}}">
                </div>
                <!-- <div class="form-footer">
                  <button class="btn btn-primary btn-block btn-pill">Save</button>
                </div> -->
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <form class="card theme-form">
            <div class="card-header">
              <h4 class="card-title mb-0">View Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Busisness Name</label>
                    <input class="form-control" type="text" value="{{$customer->busisness_name}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">land Line</label>
                    <input class="form-control" type="text" value="{{$customer->landline}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Emirates ID</label>
                    <input class="form-control" type="text" value="{{$customer->emirates_id}}">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">Trade License Number</label>
                    <input class="form-control" type="text" value="{{$customer->trade_license}}">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">Vat Certficate No</label>
                    <input class="form-control" type="text" value="{{$customer->vat_certificate_no}}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">About Me</label>
                    <textarea class="form-control" rows="5" placeholder="Enter About your description">{{$customer->description}}</textarea>
                  </div>
                </div>
                <!-- <div class="col-md-12 text-right">
                  <button class="btn btn-primary btn-pill" type="submit">Update Profile</button>
                </div> -->
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">View Upload Files</h5>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                          <label class="form-label">Emirates ID File</label>
                          <a target="_blank" href="/upload_files/{{$customer->emirates_id_file}}"><img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""></a>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                          <label class="form-label">Vat Certificate File</label>
                          <a target="_blank" href="/upload_files/{{$customer->vat_certificate_file}}"><img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""></a>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                          <label class="form-label">Trade License File</label>
                          <a target="_blank" href="/upload_files/{{$customer->trade_license_file}}"><img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""></a>
                          </div>
                        </div>
                      </div>
            </div>
            @if(Auth::guard('admin')->user()->role_id == 0 || Auth::guard('admin')->user()->role_id == 1)
            <div class="card-header">
              <button onclick="addRate({{$customer->id}})" class="btn btn-primary" type="button">Edit Sales Price</button>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            @endif
            <div class="card-body">
              <div class="table-responsive">
              @if(!empty($rate))
              <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr>
                      <th>Insurance Percentage</th>
                      <th>Cash on Delivery</th>
                      <th>Vat Percentage</th>
                      <th>Postal Charge Percentage</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(!empty($rate))
                    <tr>
                      <td>
                      @if($rate->insurance_enable == '1')
                        {{$settings->insurance_percentage}} %
                      @endif
                      </td>
                      <td>
                      @if($rate->cod_enable == '1')
                        {{$rate->cod_price}} AED
                      @endif
                    </td>
                      <td>
                      @if($rate->vat_enable == '1')
                        {{$settings->vat_percentage}} %
                      @endif
                      </td>
                      <td>
                      @if($rate->postal_charge_enable == '1')
                        {{$settings->postal_charge_percentage}} %
                      @endif
                      </td>
                    </tr>
                  @endif
                  </tbody>
                </table>
                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th colspan="3">
                          <label>Service Area Price Section</label>
                      </th>
                    </tr>
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>0 to 5 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_0_to_5_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>5.1 to 10 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_5_to_10_kg_price}} AED
                      </th>
                    </tr>
                    
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>10.1 to 15 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_10_to_15_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>15.1 to 20 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_15_to_20_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>20.1 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_20_to_1000_kg_price}} AED
                      </th>
                    </tr>
                  </thead>
                </table>

                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th colspan="3">
                          <label>Same Day Delivery Price Section</label>
                      </th>
                    </tr>
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>0 to 5 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_0_to_5_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>5.1 to 10 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_5_to_10_kg_price}} AED
                      </th>
                    </tr>
                    
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>10.1 to 15 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_10_to_15_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>15.1 to 20 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_15_to_20_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>20.1 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_20_to_1000_kg_price}} AED
                      </th>
                    </tr>
                  </thead>
                </table>

                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th colspan="3">
                          <label>Special Service Area Price Section</label>
                      </th>
                    </tr>
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>0 to 5 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_0_to_5_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>5.1 to 10 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_5_to_10_kg_price}} AED
                      </th>
                    </tr>
                    
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>10.1 to 15 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_10_to_15_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>15.1 to 20 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_15_to_20_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>20.1 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_20_to_1000_kg_price}} AED
                      </th>
                    </tr>
                  </thead>
                </table>
                
                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th colspan="4">
                          <label>Non Service Area Price Section</label>
                      </th>
                    </tr>
                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>0 to 5 kg Price = </label>
                          {{$rate->before_5_kg_price}} AED
                      </th>
                      <th colspan="2">
                          <label>Above 5 kg Price (Per kg) = </label>
                          {{$rate->above_5_kg_price}} AED
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>




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
<script src="/assets/app-assets/js/chat-menu.js"></script>

<script type="text/javascript">
$('.view-profile').addClass('active');
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



// $('#service_area').on("click",function(){
//   alert("ok")
// // })
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
