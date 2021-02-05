@extends('user.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/timepicker.css">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCanHknp355-rJzwBPbz1FZDWs9t9ym_lY&sensor=false&libraries=places"></script>

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMTNFnPj4AizpevEiZcG77II6MptFemd4&sensor=false&libraries=places"></script> -->
<style type="text/css">
.input-controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}
#searchInput {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 50%;
}
#searchInput:focus {
  border-color: #4d90fe;
}
.hide{
    visibility: hidden;
}
.hide{
visibility: visible;
}

</style> 
<style>
    .pac-container {
        z-index: 10000 !important;
    }
</style>
@endsection
@section('section')
      <!-- Right sidebar Ends-->
      <form id="shipping_form" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>New <span>Shipment  </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/user/dashboard"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item">Shipment</li>
                    <li class="breadcrumb-item active"> </li>
                  </ol>
                </div>
            </div>
        </div>
        <div class="card-footer text-left">
            <!-- <button id="add_new_address" class="btn btn-primary m-r-15" type="button">Create Address</button> -->
          </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h5>From Address <button id="add_from_address" class="btn btn-primary m-r-15" type="button">Create From Address</button></h5>
                    <span>Shipment starting location</span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                      <div class="row">

                        <div class="col-md-12">
                          <label>Search From Address</label>
                          <input class="form-control" id="search_from_address" name="search_from_address" type="text">
                        </div>

                      @foreach($address as $row)
                      @if($user->address_id == $row->id)
                      <br>
                        <div class="col-sm-12 show_from_address">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-primary mr-3">
                                <input checked id="from_address" type="radio" name="from_address" value="{{$row->id}}">
                                <label for="from_address"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">
                                  @if($row->address_type == 1)
                                  Home
                                  @elseif($row->address_type == 2)
                                  Office
                                  @elseif($row->address_type == 3)
                                  Other
                                  @endif
                                  <span class="badge badge-primary pull-right digits">
                                  @foreach($city as $city1)
                                  @if($city1->id == $row->city_id)
                                  {{$city1->city}}
                                  @endif
                                  @endforeach
                                  </span>
                                </h6>
                                <p>{{$row->address1}} {{$row->address2}}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif
                      @endforeach
                        
                        <!-- <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-secondary mr-3">
                                <input id="radio13" type="radio" name="radio1" value="option1">
                                <label for="radio13"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Fast<span class="badge badge-secondary pull-right digits">100 INR</span></h6>
                                <p>Estimated 1 Day Shipping ( Duties end tax may be due delivery )</p>
                              </div>
                            </div>
                          </div>
                        </div> -->

                      </div>
                  </div>
            
                </div>
              </div>

              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h5>To Address <button id="add_to_address" class="btn btn-primary m-r-15" type="button">Create To Address</button></h5
                    ><span>Shipment where to delivery location</span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                    <div class="row">
                        <div class="col-md-12">
                          <label>Search To Address</label>
                          <input autocomplete="off" class="form-control" id="search_to_address" name="search_to_address" type="text">
                        </div>
                        <br>
                        <div class="col-sm-12 show_to_address">
                        <input id="to_address" type="hidden" name="to_address">
                          
                        </div>

                      </div>
                  </div>
              
                </div>
              </div>

              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Shipping Mode</h5>
                    <!-- <span>Shipment Type </span> -->
                  </div>
                    <div class="card-body megaoptions-border-space-sm">
                      <div class="row">
                        
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-secondary mr-3">
                                <input checked id="shipment_mode2" type="radio" name="shipment_mode" value="1">
                                <label for="shipment_mode2"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Standard
                                  <!-- <span class="badge badge-secondary pull-right digits">0 AED</span> -->
                                </h6>
                                <p>Estimated 3 Day Shipping ( Duties end taxes may be due upon delivery )</p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-secondary mr-3">
                                <input id="shipment_mode1" type="radio" name="shipment_mode" value="2">
                                <label for="shipment_mode1"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Express
                                  <!-- <span class="badge badge-secondary pull-right digits">10 AED</span> -->
                                </h6>
                                <p>Estimated 1 Day Shipping ( Duties end taxes may be due upon delivery )</p>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      
                    </div>
                </div>
              </div>

                {{-- Shipment details start --}}
                <div class="row">
                    <div class="col-sm-12 col-xl-12 xl-100">
                        <div class="card">
                          <div class="card-header">
                            <h5>Package & Shipment Details</h5>
                             <!-- <button class="btn btn-warning sweet-5" type="button" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-5']);">Warning alert</button> -->
                          </div>
                          <div class="card-body">

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label class="col-form-label">Number of Packages</label>
                                <input class="form-control" id="no_of_packages" name="no_of_packages" type="number" min="1">
                              </div>
                          
                              <div class="form-group col-md-6">
                                <label class="col-form-label">Declared Value</label>
                                <input class="form-control" id="declared_value" name="declared_value" type="number" >
                                <input type="hidden" name="same_data" id="same_data">                           
                              </div>
                            </div>

                            <div class="row">

                              <div class="form-group col-md-4">
                                <label class="col-form-label">Category</label>
                                <select class="form-control" id="category1" name="category[]">
                                  <option value="">SELECT</option>
                                  @foreach($package_category as $row)
                                  <option value="{{$row->id}}">{{$row->category}}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="form-group col-md-8">
                                <label class="col-form-label">Description</label>
                                <input class="form-control" id="description1" name="description[]" type="text" >
                              </div>

                              <div class="form-group col-md-2">
                                <label class="col-form-label">Actual Weight</label>
                                <input class="form-control" id="weight1" name="weight[]" type="number" >
                              </div>

                              <div class="form-group col-md-8">
                                <div class="col-md-12">
                                  <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label class="kt-label m-label--single">Dimensions&nbsp;<i class="flaticon2-delivery-package"></i>&nbsp;[Length&nbsp;x&nbsp;Width&nbsp;x&nbsp;Height] (cm):</label>
                                    </div>
                                    <div class="kt-form__control">
                                      <div class="input-group">
                        								<div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">
                                                  <input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="length[]" id="length1" style="max-width: 100px;">
                                                </div>
                                            </span>
                                        </div>
                        								<div class="input-group-prepend">
                                          <span class="input-group-text">x</span>
                                        </div>
                        								<div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">
                                                  <input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="width[]" id="width1" style="max-width: 100px;">
                                                </div>
                                            </span>
                                        </div>
                        								<div class="input-group-prepend">
                                          <span class="input-group-text">x</span>
                                        </div>
                        								<div class="input-group-append">
                                            <span class="input-group-text">
                                              <div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected" >
                                                <input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="height[]" id="height1" style="max-width: 100px;">
                                              </div>
                                            </span>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                              <div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected" >
                                                <input onclick="getPrice(1)" value="Get Dim Weight" type="button" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" style="max-width: 100px;">
                                              </div>
                                            </span>
                                        </div>
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">=</span>
                                        </div>
                        								<div class="input-group-append">
                                            <span class="input-group-text">
                                              <div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected" >
                                                <input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="dim_weight[]" id="dim_weight1" style="max-width: 100px;">
                                              </div>
                                            </span>
                                        </div>
                        							</div>
                                    </div>
                                  </div>
                                  <div class="d-md-none kt-margin-b-10"></div>
                                </div>
                              </div>

                              <div class="form-group col-md-2">
                                <label class="col-form-label">Chargeable Weight</label>
                                <input readonly class="form-control" id="chargeable_weight1" name="chargeable_weight[]" type="text" >
                              </div>

                            </div>
                                  
                            <div class="numberpackcreate"></div>
                          </div>
                       
                        </div>
                </div>

<div class="col-sm-12 col-xl-12 xl-100">
    <div class="card">
      <div class="card-header">
        <h5>Return package</h5>
      </div>
      <div class="card-body">

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Return Package Cost</label>
            <div class="col-sm-9">
              <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                <div class="radio radio-primary">
                  <input id="return_package_cost_enable1" type="radio" name="return_package_cost_enable" value="1">
                  <label class="mb-0" for="return_package_cost_enable1">Yes</label>
                </div>
                <div class="radio radio-primary">
                  <input id="return_package_cost_enable2" type="radio" name="return_package_cost_enable" value="2">
                  <label class="mb-0" for="return_package_cost_enable2">No</label>
                </div>
              </div>
            </div>
          </div>

      </div>

    </div>
</div>
              
              {{-- Shipment details end --}}

              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Special Services</h5><span>(optional) </span>
                  </div>
                    <div class="card-body megaoptions-border-space-sm">
                      <div class="row">
                        
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="checkbox checkbox-secondary mr-3">
                                <input id="special_cod_enable1" type="checkbox" name="special_cod_enable" value="1">
                                <label for="special_cod_enable1"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Cash on Delivery
                                  <!-- <span class="badge badge-secondary pull-right digits">10 AED</span> -->
                                </h6>
                                <p>(C.O.D)</p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-6 show_special_cod">
                            <label>How Much Amount to Be Collected?</label>
                            <input class="form-control" id="special_cod" name="special_cod" type="text">
                        </div>

                        
                      </div>
                    </div>
                </div>
              </div>                
              

              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Pickup/Drop-off</h5><span>Shipment Type </span>
                  </div>
                    <div class="card-body megaoptions-border-space-sm">
                      <div class="row">
                        
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-secondary mr-3">
                                <input checked id="shipment_type1" type="radio" name="shipment_type" value="1">
                                <label for="shipment_type1"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Pickup
                                  <!-- <span class="badge badge-secondary pull-right digits">10 AED</span> -->
                                </h6>
                                <p>For door to door delivery</p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-secondary mr-3">
                                <input id="shipment_type2" type="radio" name="shipment_type" value="2">
                                <label for="shipment_type2"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Drop Off
                                  <span class="badge badge-secondary pull-right digits">0 AED</span>
                                </h6>
                                <p>For delivery package from office directly</p>
                              </div>
                            </div>
                          </div>
                        </div> -->

                      </div>
                      
                      <div class="row">
                        <div class="col-md-4">
                          <label>Shipment Date</label>
                          <input min="<?php echo date('Y-m-d', strtotime("+0 days")); ?>" max="<?php echo date('Y-m-d', strtotime("+60 days")); ?>" class="form-control" id="shipment_date" name="shipment_date" type="date">
                        </div>

                        <div class="col-md-4">
                          <label>Shipment From Time</label>
                            <input class="form-control" id="shipment_from_time" name="shipment_from_time" type="time">
                        </div>

                        <div class="col-md-4">
                          <label>Shipment To Time</label>
                          <input readonly class="form-control" id="shipment_to_time" name="shipment_to_time" type="time">
                        </div>

                        <!-- <div class="col-md-4">
                          <label>Shipment Time</label>
                          <select class="form-control" id="shipment_time" name="shipment_time">
                            <option value="">Choose Time</option>
                            <option>12:00 AM to 02:00 AM</option>
                            <option>02:00 AM to 04:00 AM</option>
                            <option>04:00 AM to 06:00 AM</option>
                            <option>06:00 AM to 08:00 AM</option>
                            <option>08:00 AM to 10:00 AM</option>
                            <option>10:00 AM to 12:00 PM</option>
                            <option>12:00 PM to 02:00 PM</option>
                            <option>02:00 PM to 04:00 PM</option>
                            <option>04:00 PM to 06:00 PM</option>
                            <option>06:00 PM to 08:00 PM</option>
                            <option>08:00 PM to 10:00 PM</option>
                            <option>10:00 PM to 12:00 AM</option>
                          </select>
                        </div> -->

                        <!-- <div class="col-md-4">
                          <label>Shipment Date</label>
                          <input class="form-control" id="shipment_date" nPMe="shipment_date" type="date">
                        </div> -->

                      </div>

                    </div>
                </div>
              </div>

              <div class="col-sm-12">
                <div class="card">
                <div class="card-header">
                    <h5>Billing</h5><span>Details </span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                  
                    <div class="row">
                      <div class="col">

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Shipment Price (Total Weight = <span id="total_weight_label">0</span> Kg)</label>
                            <div class="col-sm-6">
                              <input type="hidden" name="total_weight" id="total_weight">
                              <input readonly class="form-control" name="shipment_price" id="shipment_price" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Postal Charge <span id="postal_charge_percentage_label">{{$add_rate->postal_charge_percentage}}</span>%</label>
                            <div class="col-sm-6">
                            <input value="{{$add_rate->postal_charge_enable}}" readonly name="postal_charge_enable" id="postal_charge_enable" type="hidden">
                            <input value="{{$add_rate->postal_charge_percentage}}" readonly name="postal_charge_percentage" id="postal_charge_percentage" type="hidden">
                              <input readonly class="form-control" name="postal_charge" id="postal_charge" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Sub Total </label>
                            <div class="col-sm-6">
                              <input readonly class="form-control" name="sub_total" id="sub_total" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">VAT <span id="vat_percentage_label">{{$add_rate->vat_percentage}}</span>%</label>
                            <div class="col-sm-6">
                            <input value="{{$add_rate->vat_enable}}" readonly name="vat_enable" id="vat_enable" type="hidden">
                            <input value="{{$add_rate->vat_percentage}}" readonly name="vat_percentage" id="vat_percentage" type="hidden">
                              <input readonly class="form-control" name="vat_amount" id="vat_amount" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Insurance <span id="insurance_percentage_label">{{$add_rate->insurance_percentage}}</span>%</label>
                            <div class="col-sm-6">
                            <input value="{{$add_rate->insurance_enable}}" readonly name="insurance_enable" id="insurance_enable" type="hidden">
                            <input value="{{$add_rate->insurance_percentage}}" readonly name="insurance_percentage" id="insurance_percentage" type="hidden">
                              <input readonly class="form-control" name="insurance_amount" id="insurance_amount" type="text">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Cash on Delivery </label>
                            <div class="col-sm-6">
                              <input value="{{$add_rate->cod_enable}}" readonly name="cod_enable" id="cod_enable" type="hidden">
                              <input value="{{$add_rate->cod_price}}" readonly name="cod_price" id="cod_price" type="hidden">
                              <input readonly name="before_total" id="before_total" type="hidden">
                              <input readonly class="form-control" name="cod_amount" id="cod_amount" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Total </label>
                            <div class="col-sm-6">
                              <input readonly class="form-control" name="total" id="total" type="text">
                            </div>
                          </div>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
              
                
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-footer text-right">
                    <button onclick="SaveShipment()" class="btn btn-primary m-r-15" type="button">Submit</button>
                    <button class="btn btn-light" type="button">Cancel</button>
                  </div>
                </div>
              </div>

              {{-- delivery type end --}}
                </div>
              </div>
          <!-- Container-fluid Ends-->
        </div>
        </form>


<div class="modal fade" id="address_modal"  tabindex="-1" role="dialog" aria-labelledby="address_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Add New</h5>
       
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
        <form id="address_form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="from_to" id="from_to">

        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">Address Type</label>
                <select name="address_type" id="address_type" class="form-control">
                    <option disabled="" selected="">Choose Address Type</option>
                    <option value="1">Home</option>
                    <option value="2">Office</option>
                    <option value="3">Other</option>
                </select>
            </div>

            <div class="form-group col-md-6">
              <label class="col-form-label">Select Country</label>
              <select id="country_id" name="country_id" class="form-control">
                  <option value="">SELECT Country</option>
                  @foreach($country as $row)
                  <option value="{{$row->id}}">{{$row->country_name_english}}</option>
                  @endforeach
              </select>
            </div>
        </div>

        <div class="row">
            
            <div class="form-group col-md-6">
              <label class="col-form-label">Select City</label>
              <select id="city_id" name="city_id" class="form-control">
                  <option value="">SELECT City</option>
                  @foreach($city as $row)
                  <option value="{{$row->id}}">{{$row->city}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group col-md-6">
              <label class="col-form-label">Select Area</label>
              <select id="area_id" name="area_id" class="form-control">
                  <option value="">SELECT Area</option>
                  @foreach($area as $row)
                  <option value="{{$row->id}}">{{$row->city}}</option>
                  @endforeach
              </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">Contact Name</label>
                <input type="text" id="contact_name" name="contact_name" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label class="col-form-label">Contact Mobile</label>
                <input type="text" id="contact_mobile" name="contact_mobile" class="form-control">
            </div>
        </div> 

        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">Contact Landline</label>
                <input type="text" id="contact_landline" name="contact_landline" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label class="col-form-label">Address 1</label>
                <input type="text" id="address1" name="address1" class="form-control">
            </div>

        </div>

        <div class="row">

            <div class="form-group col-md-6">
                <label class="col-form-label">Address 2</label>
                <input type="text" id="address2" name="address2" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label">Address 3</label>
                <input type="text" id="address3" name="address3" class="form-control">
            </div>

        </div>   
        
        <div class="row">
            <div class="form-group col-md-12">
                <label>Enter a location</label>
                <input id="searchInput" class="input-controls form-control" type="text" placeholder="Enter a location">
                <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                <input readonly type="hidden" id="latitude" name="latitude" class="form-control">
                <input readonly type="hidden" id="longitude" name="longitude" class="form-control">
            </div>
        </div>

        </form>
        </div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <button onclick="SaveAddress()" class="btn btn-primary" type="button">Save</button>
        </div>
    </div>
    </div>
</div>        
@endsection
@section('extra-js')
<script src="/assets/app-assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="/assets/app-assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="/assets/app-assets/js/sweet-alert/sweetalert.min.js"></script>
<script src="/assets/app-assets/js/sweet-alert/app.js"></script>

<script src="/assets/app-assets/js/time-picker/jquery-clockpicker.min.js"></script>
<script src="/assets/app-assets/js/time-picker/highlight.min.js"></script>
<script src="/assets/app-assets/js/time-picker/clockpicker.js"></script>

<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">

<script>
/* script */
function initialize() {
   var latlng = new google.maps.LatLng(24.453884,54.3773438);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {        
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng){
   document.getElementById('address1').value = address;
   document.getElementById('latitude').value = lat;
   document.getElementById('longitude').value = lng;
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script type="text/javascript">
$('.new_shipment').addClass('active');


$('#shipment_from_time').blur(function(){
  var shipment_from_time = $("#shipment_from_time").val();
  //alert(shipment_from_time);
  <?php //echo date('H:m a',strtotime($_POST['shipment_from_time']."+2 hour")); ?>

  var to_time = moment.utc(shipment_from_time,'hh:mm').add(2,'hour').format('hh:mm');
  $("#shipment_to_time").val(to_time);
});



$('.show_special_cod').hide();

$('#special_cod_enable1').click(function(){
  if ($(this).is(':checked')) {
    //$(this).prop('checked',false);
    //alert("is checked");
    $('.show_special_cod').show();
  } else {
    //$(this).prop('checked',true);
    //alert("not checked");
    $('.show_special_cod').hide();
  }
});

$('#city_id').change(function(){
  var id = $('#city_id').val();
  $.ajax({
    url : '/get-area/'+id,
    type: "GET",
    success: function(data)
    {
        $('#area_id').html(data);
    }
  });
});

$('#add_from_address').click(function(){
    $('#address_modal').modal('show');
    $("#address_form")[0].reset();
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Address');
    $('#from_to').val('1');
});

$('#add_to_address').click(function(){
    $('#address_modal').modal('show');
    $("#address_form")[0].reset();
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Address');
    $('#from_to').val('2');
});

$( "#search_from_address" ).autocomplete({
    source: function( request, response ) {
      // Fetch data
      $.ajax({
        url:"/user/get-from-address",
        dataType: "json",
        data: request, 
        success: function( data ) {
            if(data.response == 'true') 
            {
                response(data.message);
            }
        }
      });
    },
    select: function (event, ui) {
        $(this).val(ui.item.label); 
        var contact_id = ui.item.id; 
        $.ajax({
            url : '/user/get-from-address-id/'+contact_id,
            type: "GET",
            //dataType: "JSON",
            success:function(response) {
              // $("#address").val(response.address);    
              $('.show_from_address').html(response);
            }
        });
    }       
});

$( "#search_to_address" ).autocomplete({
    source: function( request, response ) {
      // Fetch data
      $.ajax({
        url:"/user/get-to-address",
        dataType: "json",
        data: request, 
        success: function( data ) {
            if(data.response == 'true') 
            {
                response(data.message);
            }
        }
      });
    },
    select: function (event, ui) {
        $(this).val(ui.item.label); 
        var contact_id = ui.item.id; 
        $.ajax({
            url : '/user/get-to-address-id/'+contact_id,
            type: "GET",
            //dataType: "JSON",
            success:function(response) {
              // $("#address").val(response.address);    
              $('.show_to_address').html(response);
            }
        });
    }       
});


function SaveAddress(){
  var formData = new FormData($('#address_form')[0]);
  $.ajax({
      url : '/user/save-new-address',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {                
          $("#address_form")[0].reset();
          $('#address_modal').modal('hide');
          //location.reload();
          //$('.show_from_address').load(location.href+' .show_from_address');
          //$('.show_to_address').load(location.href+' .show_to_address');
          toastr.success(data, 'Successfully Save');
      },error: function (data) {
          var errorData = data.responseJSON.errors;
          $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
    });
  }
  });
}

function SaveShipment(){
  var formData = new FormData($('#shipping_form')[0]);
  $.ajax({
      url : '/user/save-new-shipment',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {                
          $("#shipping_form")[0].reset();
          $('#address_modal').modal('hide');
          
          toastr.success(data, 'Successfully Save');

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

      },error: function (data) {
          var errorData = data.responseJSON.errors;
          $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
    });
  }
  });
}


function getPrice(count){
  var to_address = $("#to_address").val();
  var weight = $("#weight"+count).val();
  var length = $("#length"+count).val();
  var width = $("#width"+count).val();
  var height = $("#height"+count).val();
  var shipment_mode = $("input[name='shipment_mode']:checked").val();
  //alert(to_address);
  if(to_address != ''){
    if(weight != '' && length != '' && width != '' && height != ''){
      
        var dimension = (length * width * height) / 5000;
        $("#dim_weight"+count).val(dimension);
        if(dimension > weight)
        {
          $("#chargeable_weight"+count).val(dimension);
        }
        else{
          $("#chargeable_weight"+count).val(weight);
        }  

        getvalue();
      
    }
    else{
      alert('Please Fill All Data (Weight , Length , Width , Heigth)');
    }
  }
  else{
    alert('Please Choose a To Address');
    $("#search_to_address").focus();
  }
}

function getvalue() {
  var no_of_packages = Number($('#no_of_packages').val());
  var to_address = $('#to_address').val();
  var shipment_mode = $("input[name='shipment_mode']:checked").val();
  var total_weight=0;
  var same_data = $('#same_data').val();
if(same_data == '0'){
  for(let count=1;count<=no_of_packages;count++){
    //total_price = Number(total_price) + Number($("#price"+count).val());
    total_weight = Number(total_weight) + Number($("#chargeable_weight"+count).val());
  }
}
else{
  //total_price = Number($("#price1").val());
  total_weight = no_of_packages * Number($("#chargeable_weight1").val());
}

$("#total_weight_label").html(total_weight);
$("#total_weight").val(total_weight);

  $.ajax({
    url:"/user/get-area-price/"+total_weight+"/"+to_address+"/"+shipment_mode,
    type: "GET",
    dataType: "JSON",
    success: function( data ) 
    {
      subAmount(data.price,total_weight);
    }
  });
}

function subAmount(total_price1,total_weight1) {
  var total_price = Number(total_price1);
  var total_weight = Number(total_weight1);
  var postal_charge = 0;
  var sub_total = 0;
  var vat_amount = 0;
  var insurance_amount = 0;
  var before_total = 0;
  var cod_amount = 0;
  var total = 0;
    
  $("#shipment_price").val(total_price);
  
  var postal_charge_enable = Number($('#postal_charge_enable').val());
  var postal_charge_percentage =Number($('#postal_charge_percentage').val());
  var insurance_enable = Number($('#insurance_enable').val());
  var insurance_percentage = Number($('#insurance_percentage').val());
  var cod_enable = Number($('#cod_enable').val());
  var cod_price = Number($('#cod_price').val());
  var vat_enable = Number($('#vat_enable').val());
  var vat_percentage = Number($('#vat_percentage').val());

  if(postal_charge_enable == 1){
    if(total_weight >= 30){
      postal_charge = 0;
      $("#postal_charge").val('0');
    }
    else{
      postal_charge = (postal_charge_percentage/100) * total_price;
      postal_charge =  Number(postal_charge.toFixed(2));
      $("#postal_charge").val(postal_charge);
    }
  }

  sub_total = Number(postal_charge + total_price);
  sub_total =  Number(sub_total.toFixed(2));

  $("#sub_total").val(sub_total);

  if(vat_enable == 1){
    vat_amount = Number((vat_percentage/100) * sub_total);
    vat_amount =  Number(vat_amount.toFixed(2));
    $("#vat_amount").val(vat_amount);
  }

  if(insurance_enable == 1){
    insurance_amount = Number((insurance_percentage/100) * sub_total);
    insurance_amount =  Number(insurance_amount.toFixed(2));
    $("#insurance_amount").val(insurance_amount);
  }

  before_total = Number(sub_total + vat_amount + insurance_amount);

  if(cod_enable == 1){
    cod_amount = cod_price;
    $("#cod_amount").val(cod_amount);
  }

  total = Number(before_total + cod_amount);
  total =  Number(total.toFixed(2));

  $("#total").val(total);

}


$( "#no_of_packages" ).blur(function() {
  var no_of_packages = $('#no_of_packages').val();
  var appendDatacollect;
  if(no_of_packages >1){


    swal.fire({
    buttonsStyling: false,
    html: "<strong>Are all the packages are Identical?</strong>",
    //html: "<strong>Are you sure?",
    type: "warning",

    confirmButtonText: "Yes, confirm!",
    confirmButtonClass: "btn btn-sm btn-bold btn-success",

    showCancelButton: true,
    cancelButtonText: 'No',
    cancelButtonClass: "btn btn-sm btn-bold btn-danger"
}).then(function (result) {
    if (result.value) {
        
      $('.numberpackcreate').empty();
      $('#same_data').val('1');


    } else {
        addpackage(no_of_packages);
        // swal.fire({
        //     title: 'Cancelled',
        //     text: 'Nothing updated! :)',
        //     type: 'error',
        //     buttonsStyling: false,
        //     confirmButtonText: 'OK',
        //     confirmButtonClass: "btn btn-sm btn-bold btn-brand",
        // });
    }
});

 }
 else{
  $('.numberpackcreate').empty();
 }
});

function addpackage(no_of_packages){
  $('#same_data').val('0');
  $('.numberpackcreate').empty();
  for(let count=2;count<=no_of_packages;count++){
        var appendData = '<hr><div class="row">'+
        '<div class="form-group col-md-4">'+
          '<label class="col-form-label">Category</label>'+
          '<select class="form-control" id="category'+count+'" name="category[]">'+
            '<option value="">SELECT</option>'+
            <?php foreach($package_category as $row){ ?>
            '<option value="<?php echo $row->id; ?>"><?php echo $row->category; ?></option>'+
            <?php } ?>
          '</select>'+
        '</div>'+
        '<div class="form-group col-md-8">'+
          '<label class="col-form-label">Description</label>'+
          '<input class="form-control" id="description'+count+'" name="description[]" type="text" >'+
        '</div>'+
        '<div class="form-group col-md-2">'+
          '<label class="col-form-label">Actual Weight</label>'+
          '<input class="form-control" id="weight'+count+'" name="weight[]" type="number" >'+
        '</div>'+
        '<div class="form-group col-md-8">'+
          '<div class="col-md-12">'+
            '<div class="kt-form__group--inline">'+
              '<div class="kt-form__label">'+
                  '<label class="kt-label m-label--single">Dimensions&nbsp;<i class="flaticon2-delivery-package"></i>&nbsp;[Length&nbsp;x&nbsp;Width&nbsp;x&nbsp;Height] (cm):</label>'+
              '</div>'+
              '<div class="kt-form__control">'+
                '<div class="input-group">'+
                  '<div class="input-group-prepend">'+
                      '<span class="input-group-text">'+
                          '<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">'+
                            '<input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="length[]" id="length'+count+'" style="max-width: 100px;">'+
                          '</div>'+
                      '</span>'+
                  '</div>'+
                  '<div class="input-group-prepend">'+
                    '<span class="input-group-text">x</span>'+
                  '</div>'+
                  '<div class="input-group-prepend">'+
                      '<span class="input-group-text">'+
                          '<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">'+
                            '<input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="width[]" id="width'+count+'" style="max-width: 100px;">'+
                          '</div>'+
                      '</span>'+
                  '</div>'+
                  '<div class="input-group-prepend">'+
                    '<span class="input-group-text">x</span>'+
                  '</div>'+
                  '<div class="input-group-append">'+
                      '<span class="input-group-text">'+
                        '<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected" >'+
                          '<input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="height[]" id="height'+count+'" style="max-width: 100px;">'+
                        '</div>'+
                      '</span>'+
                  '</div>'+
                    '<div class="input-group-append">'+
                      '<span class="input-group-text">'+
                        '<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected" >'+
                         '<input onclick="getPrice('+count+')" value="Get DIm Weight" type="button" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" style="max-width: 100px;">'+
                        '</div>'+
                      '</span>'+
                    '</div>'+
                    '<div class="input-group-prepend">'+
                      '<span class="input-group-text">=</span>'+
                    '</div>'+
                    '<div class="input-group-append">'+
                        '<span class="input-group-text">'+
                          '<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected" >'+
                            '<input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="dim_weight[]" id="dim_weight'+count+'" style="max-width: 100px;">'+
                          '</div>'+
                        '</span>'+
                    '</div>'+
                  '</div>'+
              '</div>'+
            '</div>'+
            '<div class="d-md-none kt-margin-b-10"></div>'+
          '</div>'+
        '</div>'+
        '<div class="form-group col-md-2">'+
            '<label class="col-form-label">Chargeable Weight</label>'+
            '<input readonly class="form-control" id="chargeable_weight'+count+'" name="chargeable_weight[]" type="text" >'+
          '</div>'+
      '</div>';
  $('.numberpackcreate').append(appendData);
  }
}
</script>
@endsection