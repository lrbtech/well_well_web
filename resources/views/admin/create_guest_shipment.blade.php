@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/timepicker.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/select2.css">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcmxZ2i6FQ0--w87BgqBoTxfpOCsbq3tw&sensor=false&libraries=places"></script>

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

        #searchInput1 {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 50%;
        }
        
        #searchInput1:focus {
            border-color: #4d90fe;
        }
        
        .hide {
            visibility: hidden;
        }
        
        .hide {
            visibility: visible;
        }
        .pac-container {
            z-index: 1200 !important;
        }

</style>
@endsection
@section('section')
      <!-- Right sidebar Ends-->
      <form id="shipping_form" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" value="0" name="user_id" id="user_id">
      <div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>Guest <span>{{$language[18][Auth::guard('admin')->user()->lang]}}  </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item">{{$language[18][Auth::guard('admin')->user()->lang]}}</li>
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

              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Pickup Address</h5>
                    <span>{{$language[26][Auth::user()->lang]}}</span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                      <div class="row">
                          <div class="form-group col-md-4">
                              <label class="col-form-label">Country</label>
                              <select name="from_country_id" id="from_country_id" class="form-control">
                                <option disabled="" selected="">Choose Country</option>
                                @foreach($country as $row)
                                <option value="{{$row->id}}"> {{$row->country_name_english}} </option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                              <label class="col-form-label">City</label>
                              <select name="from_city_id" id="from_city_id" class="form-control" aria-required="true" onChange="applyMyLocation(this);">
                                <option disabled="" selected="">Choose City</option>
                                @foreach($city as $row)
                                <option value="{{$row->id}}"> {{$row->city}} </option>
                                @endforeach
                            </select>
                          </div>

                          <div class="form-group col-md-4">
                              <label class="col-form-label">Area</label>
                              <select name="from_area_id" id="from_area_id" class="form-control" aria-required="true" onChange="applyMyLocationCity(this);">
                                  <option disabled="" selected="">Choose City</option>
                                  @foreach($area as $row)
                                  <option value="{{$row->id}}"> {{$row->city}} </option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="form-group col-md-4">
                              <label class="col-form-label">Name</label>
                              <input autocomplete="off" name="from_name" id="from_name" type="text" class="form-control">
                          </div>

                          <div class="form-group col-md-4">
                              <label class="col-form-label">Mobile</label>
                              <input autocomplete="off" name="from_mobile" id="from_mobile" class="form-control" type="text">
                          </div>

                          <div class="form-group col-md-4">
                              <label class="col-form-label">Landline</label>
                              <input name="from_landline" id="from_landline" type="text" class="form-control">
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Enter a location</label>
                                  <input id="searchInput" name="searchInput" class="input-controls form-control" type="text" placeholder="Enter a location">
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Address</label>
                                  <input autocomplete="false" id="from_address" name="from_address" class="form-control"></input>
                                  <input readonly type="hidden" id="from_latitude" name="from_latitude" class="form-control">
                                  <input readonly type="hidden" id="from_longitude" name="from_longitude" class="form-control">
                              </div>
                          </div>

                      </div>
                  </div>
            
                </div>
              </div>

              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>{{$language[28][Auth::guard('admin')->user()->lang]}}</h5
                    ><span>{{$language[30][Auth::guard('admin')->user()->lang]}}</span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                    
                      <div class="row">
                          <div class="form-group col-md-4">
                              <label class="col-form-label">Country</label>
                              <select name="to_country_id" id="to_country_id" class="form-control">
                                <option disabled="" selected="">Choose Country</option>
                                @foreach($country as $row)
                                <option value="{{$row->id}}"> {{$row->country_name_english}} </option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                              <label class="col-form-label">City</label>
                              <select name="to_city_id" id="to_city_id" class="form-control" aria-required="true" onChange="applyMyLocation1(this);">
                                <option disabled="" selected="">Choose City</option>
                                @foreach($city as $row)
                                <option value="{{$row->id}}"> {{$row->city}} </option>
                                @endforeach
                            </select>
                          </div>

                          <div class="form-group col-md-4">
                              <label class="col-form-label">Area</label>
                              <select name="to_area_id" id="to_area_id" class="form-control" aria-required="true" onChange="applyMyLocationCity1(this);">
                                  <option disabled="" selected="">Choose City</option>
                                  @foreach($area as $row)
                                  <option value="{{$row->id}}"> {{$row->city}} </option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="form-group col-md-4">
                              <label class="col-form-label">Name</label>
                              <input autocomplete="off" name="to_name" id="to_name" type="text" class="form-control">
                          </div>

                          <div class="form-group col-md-4">
                              <label class="col-form-label">Mobile</label>
                              <input autocomplete="off" name="to_mobile" id="to_mobile" class="form-control" type="text">
                          </div>

                          <div class="form-group col-md-4">
                              <label class="col-form-label">Landline</label>
                              <input name="to_landline" id="to_landline" type="text" class="form-control">
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Enter a location</label>
                                  <input id="searchInput1" name="searchInput1" class="input-controls form-control" type="text" placeholder="Enter a location">
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="map" id="map1" style="width: 100%; height: 300px;"></div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Address</label>
                                  <input autocomplete="false" id="to_address" name="to_address" class="form-control"></input>
                                  <input readonly type="hidden" id="to_latitude" name="to_latitude" class="form-control">
                                  <input readonly type="hidden" id="to_longitude" name="to_longitude" class="form-control">
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
                            <h5>{{$language[37][Auth::guard('admin')->user()->lang]}}</h5>
                             <!-- <button class="btn btn-warning sweet-5" type="button" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-5']);">Warning alert</button> -->
                          </div>
                          <div class="card-body">

          <!-- <div class="form-group row">
            <div class="col-sm-6">
              <label>Special Service</label>
              <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                <div class="radio radio-primary">
                  <input id="special_service1" type="radio" name="special_service" value="1">
                  <label class="mb-0" for="special_service1">{{$language[51][Auth::user()->lang]}}</label>
                </div>
                <div class="radio radio-primary">
                  <input checked id="special_service2" type="radio" name="special_service" value="2">
                  <label class="mb-0" for="special_service2">{{$language[52][Auth::user()->lang]}}</label>
                </div>
              </div>
            </div>
            <div class="col-sm-6 show_special_service">
                <label>Description</label>
                <input class="form-control" id="special_service_description" name="special_service_description" type="text">
            </div>
          </div> -->

                            <div class="row">
                              <div class="form-group col-md-4">
                                <label class="col-form-label">{{$language[38][Auth::guard('admin')->user()->lang]}}</label>
                                <input class="form-control" id="no_of_packages" name="no_of_packages" type="number" min="1">
                              </div>
                          
                              <div class="form-group col-md-4">
                                <label class="col-form-label">{{$language[39][Auth::guard('admin')->user()->lang]}}</label>
                                <input class="form-control" id="declared_value" name="declared_value" type="number" >
                                <input type="hidden" name="same_data" id="same_data">                           
                              </div>
                              <div class="form-group col-md-4">
                                <label class="col-form-label">Reference No</label>
                                <input class="form-control" id="reference_no" name="reference_no" type="number" >
                              </div>
                            </div>


                            <div class="row">

                              <div class="form-group col-md-4">
                                <label class="col-form-label">{{$language[40][Auth::guard('admin')->user()->lang]}}</label>
                                <select class="form-control" id="category1" name="category[]">
                                  <option value="">{{$language[46][Auth::guard('admin')->user()->lang]}}
                                  </option>
                                  @foreach($package_category as $row)
                                  <option value="{{$row->id}}">{{$row->category}}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="form-group col-md-4">
                                <label class="col-form-label">{{$language[41][Auth::guard('admin')->user()->lang]}}
                                </label>
                                <input class="form-control" id="description1" name="description[]" type="text" >
                              </div>

                              

                              <div class="form-group col-md-4">
                                <label class="col-form-label">{{$language[42][Auth::guard('admin')->user()->lang]}}
                                </label>
                                <input class="form-control" id="weight1" name="weight[]" type="number" min="1" >
                              </div>

                              <div class="form-group col-md-10">
                                <div class="col-md-12">
                                  <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label class="kt-label m-label--single">{{$language[43][Auth::guard('admin')->user()->lang]}}
                                          &nbsp;<i class="flaticon2-delivery-package"></i>&nbsp;[{{$language[44][Auth::guard('admin')->user()->lang]}}&nbsp;x&nbsp;{{$language[45][Auth::guard('admin')->user()->lang]}}&nbsp;x&nbsp;{{$language[47][Auth::guard('admin')->user()->lang]}}] (cm) = Dimension Weight</label>
                                    </div>
                                    <div class="kt-form__control">
                                      <div class="input-group">
                        								<div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">
                                                  <input type="number" min="1" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="length[]" id="length1" style="max-width: 100px;">
                                                </div>
                                            </span>
                                        </div>
                        								<div class="input-group-prepend">
                                          <span class="input-group-text">x</span>
                                        </div>
                        								<div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">
                                                  <input type="number" min="1" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="width[]" id="width1" style="max-width: 100px;">
                                                </div>
                                            </span>
                                        </div>
                        								<div class="input-group-prepend">
                                          <span class="input-group-text">x</span>
                                        </div>
                        								<div class="input-group-append">
                                            <span class="input-group-text">
                                              <div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected" >
                                                <input type="number" min="1" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="height[]" id="height1" style="max-width: 100px;">
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
                                <label class="col-form-label">{{$language[48][Auth::guard('admin')->user()->lang]}}</label>
                                <input class="form-control" id="chargeable_weight1" name="chargeable_weight[]" type="text" >
                              </div>

                            </div>
                                  
                            <div class="numberpackcreate"></div>
                          </div>
                       
                        </div>
                </div>

<!-- <div class="col-sm-12 col-xl-12 xl-100">
    <div class="card">
       <div class="card-header">
        <h5>{{$language[49][Auth::guard('admin')->user()->lang]}}</h5>
      </div>
      <div class="card-body">

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">{{$language[204][Auth::guard('admin')->user()->lang]}}</label>
            <div class="col-sm-9">
              <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                <div class="radio radio-primary">
                  <input id="return_package_cost1" type="radio" name="return_package_cost" value="1">
                  <label class="mb-0" for="return_package_cost1">{{$language[51][Auth::guard('admin')->user()->lang]}}</label>
                </div>
                <div class="radio radio-primary">
                  <input checked id="return_package_cost2" type="radio" name="return_package_cost" value="2">
                  <label class="mb-0" for="return_package_cost2">{{$language[52][Auth::guard('admin')->user()->lang]}}</label>
                </div>
              </div>
            </div>
          </div>

      </div>

    </div>
</div> -->
              

              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>{{$language[55][Auth::guard('admin')->user()->lang]}}</h5><span>{{$language[56][Auth::guard('admin')->user()->lang]}} </span>
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
                                <h6 class="mt-0 mega-title-badge">{{$language[57][Auth::guard('admin')->user()->lang]}}
                                  <!-- <span class="badge badge-secondary pull-right digits">10 AED</span> -->
                                </h6>
                                <p>{{$language[58][Auth::guard('admin')->user()->lang]}}</p>
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
                          <label>{{$language[59][Auth::guard('admin')->user()->lang]}}</label>
                          <input min="<?php echo date('Y-m-d', strtotime("+0 days")); ?>" max="<?php echo date('Y-m-d', strtotime("+60 days")); ?>" class="form-control" id="shipment_date" name="shipment_date" type="date">
                        </div>

                        <div class="col-md-4">
                          <label>{{$language[60][Auth::guard('admin')->user()->lang]}}</label>
                            <input class="form-control" id="shipment_from_time" name="shipment_from_time" type="time">
                        </div>

                        <div class="col-md-4">
                          <label>{{$language[61][Auth::guard('admin')->user()->lang]}}</label>
                          <input readonly class="form-control" id="shipment_to_time" name="shipment_to_time" type="text">
                        </div>

                        <!-- <div class="col-md-3">
                          <label>Assign Employee</label>
                          <select class="form-control" id="agent_id" name="agent_id">
                            <option value="">Choose Agent</option>
                            @foreach($agent as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
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
                    <h5>{{$language[62][Auth::guard('admin')->user()->lang]}}</h5><span>{{$language[63][Auth::guard('admin')->user()->lang]}} </span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                  
                    <div class="row">
                      <div class="col">

                          <div class="form-group row">
                          <label class="col-sm-6 col-form-label">{{$language[64][Auth::guard('admin')->user()->lang]}} ({{$language[65][Auth::guard('admin')->user()->lang]}} = <span id="total_weight_label">0</span> Kg)</label>
                            <div class="col-sm-6">
                              <input type="hidden" name="total_weight" id="total_weight">
                              <input class="form-control" name="shipment_price" id="shipment_price" type="text">
                            </div>
                          </div>


                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">{{$language[69][Auth::guard('admin')->user()->lang]}} <span id="insurance_percentage_label">0</span>%</label>
                            <div class="col-sm-6">
                            <input name="insurance_enable" id="insurance_enable" type="hidden">
                            <input name="insurance_percentage" id="insurance_percentage" type="hidden">
                              <input class="form-control" name="insurance_amount" id="insurance_amount" type="text">
                            </div>
                          </div>
                          
                          <!-- <div class="form-group row">
                            <label class="col-sm-6 col-form-label">{{$language[53][Auth::guard('admin')->user()->lang]}} </label>
                            <div class="col-sm-6">
                              <input name="cod_enable" id="cod_enable" type="hidden">
                              <input name="cod_price" id="cod_price" type="hidden">
                              <input name="before_total" id="before_total" type="hidden">
                              <input class="form-control" name="cod_amount" id="cod_amount" type="text">
                            </div>
                          </div> -->

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">{{$language[67][Auth::guard('admin')->user()->lang]}} </label>
                            <div class="col-sm-6">
                              <input class="form-control" name="sub_total" id="sub_total" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">{{$language[68][Auth::guard('admin')->user()->lang]}} <span id="vat_percentage_label">0</span>%</label>
                            <div class="col-sm-6">
                            <input name="vat_enable" id="vat_enable" type="hidden">
                            <input name="vat_percentage" id="vat_percentage" type="hidden">
                              <input class="form-control" name="vat_amount" id="vat_amount" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">{{$language[66][Auth::guard('admin')->user()->lang]}} <span id="postal_charge_percentage_label">0</span>%</label>
                            <div class="col-sm-6">
                            <input name="postal_charge_enable" id="postal_charge_enable" type="hidden">
                            <input name="postal_charge_percentage" id="postal_charge_percentage" type="hidden">
                              <input class="form-control" name="postal_charge" id="postal_charge" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">{{$language[70][Auth::guard('admin')->user()->lang]}} </label>
                            <div class="col-sm-6">
                              <input class="form-control" name="total" id="total" type="text">
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
                    <button id="saveshipment" onclick="SaveShipment()" class="btn btn-primary m-r-15" type="button">{{$language[71][Auth::guard('admin')->user()->lang]}}</button>
                    <button class="btn btn-light" type="button">{{$language[72][Auth::guard('admin')->user()->lang]}}</button>
                  </div>
                </div>
              </div>

              {{-- delivery type end --}}
                </div>
              </div>
          <!-- Container-fluid Ends-->
        </div>
        </form>
     
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

<script src="/assets/app-assets/js/select2/select2.full.min.js"></script>
<script src="/assets/app-assets/js/select2/select2-custom.js"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">

<script>

    var from_lat='24.453884';
    var from_lng='54.3773438';
    var to_lat='24.453884';
    var to_lng='54.3773438';

var select_location='';
$("#from_city_id").change(function(){
  var id = $('#from_city_id').val();
//   console.log(id);
  $.ajax({
    url : '/get-area/'+id,
    type: "GET",
    success: function(data)
    {
        $('#from_area_id').html(data);
        get_from_latlng(id);
    }
  });
});

function applyMyLocation(sel){
    select_location='';
    var id = $('#from_city_id').val();
    // console.log($( "#from_city_id option:selected" ).text());
  $('#searchInput').val($( "#from_city_id option:selected" ).text()); 
//   console.log($('#searchInput option:selected').text())
$('#searchInput').focus(); 
select_location = $( "#from_city_id option:selected" ).text();
// if(sel ="Abu Dhabi"){
    
// }
}
function applyMyLocationCity(sel){
//     var id = $('#from_city_id').val();
//     // console.log($( "#from_city_id option:selected" ).text());
//   $('#searchInput').val($( "#from_area_id option:selected" ).text()); 
//   console.log($('#searchInput option:selected').text())
if(select_location !=''){
      $('#searchInput').val( select_location+' '+$( "#from_area_id option:selected" ).text()); 
// select_location = select_location+' '+$( "#from_area_id option:selected" ).text();
    $('#searchInput').focus(); 
}
select_location = $( "#from_city_id option:selected" ).text();
// if(sel ="Abu Dhabi"){
    
// }
}


function applyMyLocation1(sel){
    select_location='';
    var id = $('#to_city_id').val();
    // console.log($( "#from_city_id option:selected" ).text());
  $('#searchInput1').val($( "#to_city_id option:selected" ).text()); 
//   console.log($('#searchInput option:selected').text())
$('#searchInput1').focus(); 
select_location = $( "#to_city_id option:selected" ).text();
// if(sel ="Abu Dhabi"){
    
// }
}
function applyMyLocationCity1(sel){
//     var id = $('#from_city_id').val();
//     // console.log($( "#from_city_id option:selected" ).text());
//   $('#searchInput').val($( "#from_area_id option:selected" ).text()); 
//   console.log($('#searchInput option:selected').text())
if(select_location !=''){
      $('#searchInput1').val( select_location+' '+$( "#to_area_id option:selected" ).text()); 
// select_location = select_location+' '+$( "#from_area_id option:selected" ).text();
    $('#searchInput1').focus(); 
}
select_location = $( "#to_city_id option:selected" ).text();
// if(sel ="Abu Dhabi"){
    
// }
}

function get_from_latlng(id){
    window.from_lat;
    window.from_lng;
    $.ajax({
        url : '/get-city-data/'+id,
        type: "GET",
        success: function(data)
        {
            from_lat = data.lat;
            from_lng = data.lng;
            //google.maps.event.addDomListener(initialize);
            //initialize();
        }
    });
}

$('#to_city_id').change(function(){
  var id = $('#to_city_id').val();
  $.ajax({
    url : '/get-area/'+id,
    type: "GET",
    success: function(data)
    {
        $('#to_area_id').html(data);
        get_to_latlng(id);
    }
  });
});

function get_to_latlng(id){
    $.ajax({
        url : '/get-city-data/'+id,
        type: "GET",
        success: function(data)
        {
           to_lat = data.lat;
           to_lng = data.lng;
        }
    });
}

    function initialize() {
        var latlng = new google.maps.LatLng(from_lat, from_lng);
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

            bindDataToForm(place.formatted_address, place.geometry.location.lat(), place.geometry.location.lng());
            infowindow.setContent(place.formatted_address);
            infowindow.open(map, marker);

        });
        // this function will work on marker move event into map 
        google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({
                'latLng': marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        bindDataToForm(results[0].formatted_address, marker.getPosition().lat(), marker.getPosition().lng());
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });
        });
    }

    function initialize1() {
        var latlng = new google.maps.LatLng(to_lat, to_lng);

        var map = new google.maps.Map(document.getElementById('map1'), {
            center: latlng,
            zoom: 13
        });
        var marker = new google.maps.Marker({
            map: map,
            position: latlng,
            draggable: true,
            anchorPoint: new google.maps.Point(0, -29)
        });
        var input = document.getElementById('searchInput1');
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

            bindDataToForm1(place.formatted_address, place.geometry.location.lat(), place.geometry.location.lng());
            infowindow.setContent(place.formatted_address);
            infowindow.open(map, marker);

        });
        // this function will work on marker move event into map 
        google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({
                'latLng': marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        bindDataToForm1(results[0].formatted_address, marker.getPosition().lat(), marker.getPosition().lng());
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });
        });
    }

    function bindDataToForm(address, lat, lng) {
        console.log('address');
        console.log(address);
        document.getElementById('from_address').value = address;
        document.getElementById('from_latitude').value = lat;
        document.getElementById('from_longitude').value = lng;
    }
    function bindDataToForm1(address, lat, lng) {
        document.getElementById('to_address').value = address;
        document.getElementById('to_latitude').value = lat;
        document.getElementById('to_longitude').value = lng;
    }
    
    google.maps.event.addDomListener(window, 'load', initialize);
    google.maps.event.addDomListener(window, 'load', initialize1);

</script>

<script type="text/javascript">
$('.guest-shipment').addClass('active');

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

$('#shipment_from_time').blur(function(){
  var shipment_from_time = $("#shipment_from_time").val();
  // //alert(shipment_from_time);

  var to_time = moment.utc(shipment_from_time,'hh:mm A').add(2,'hour').format('hh:mm A');
  $("#shipment_to_time").val(to_time);
});


$(document).ready(function() {
    $('.js-example-basic-single').select2();
});


function SaveShipment(){
  $("#saveshipment").attr("disabled", true);
  var formData = new FormData($('#shipping_form')[0]);
  $.ajax({
      url : '/save-new-shipment',
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
          $("#saveshipment").attr("disabled", false);

          var mywindow = window.open('', 'BIlling Application', 'height=600,width=800');
          var is_chrome = Boolean(mywindow.chrome);
          mywindow.document.write(data.html);
          mywindow.document.close(); 
          if (is_chrome) {
              setTimeout(function() {
              mywindow.focus(); 
              mywindow.print(); 
              mywindow.close();
              window.location.href="/admin/shipment";
              }, 250);
          } else {
              mywindow.focus(); 
              mywindow.print(); 
              mywindow.close();
              window.location.href="/admin/shipment";
          }

      },error: function (data) {
          var errorData = data.responseJSON.errors;
          $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
          });
          $("#saveshipment").attr("disabled", false);
      }
  });
}


function getPrice(count){
  var weight = $("#weight"+count).val();
  var length = $("#length"+count).val();
  var width = $("#width"+count).val();
  var height = $("#height"+count).val();
    
    if(weight != ''){
      if(length > 0 && width > 0 && height > 0){
        
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
        alert('Please Fill All Data with Proper Value(Length , Width , Heigth)');
      }
    }else{
      alert('Please Fill Weight');
      $("#weight"+count).focus();
    }
  
}

function getvalue() {
  var no_of_packages = Number($('#no_of_packages').val());
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
    url:"/get-area-price/"+total_weight,
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
  
    var postal_charge_percentage =Number($('#postal_charge_percentage').val());
    var insurance_percentage = Number($('#insurance_percentage').val());
    var vat_percentage = Number($('#vat_percentage').val());
    var declared_value = Number($('#declared_value').val());
    var cod_price = Number($('#cod_price').val());

  if($("#special_cod_enable1").is(':checked')){
      cod_amount = cod_price;
      $("#cod_amount").val(cod_amount);
  }
  else{
    $("#cod_amount").val('0');
  }

    insurance_amount = Number((insurance_percentage/100) * declared_value);
    insurance_amount =  Number(insurance_amount.toFixed(2));
    $("#insurance_amount").val(insurance_amount);


    sub_total = Number(insurance_amount + cod_amount + total_price);
    sub_total =  Number(sub_total.toFixed(2));

    $("#sub_total").val(sub_total);

    vat_amount = Number((vat_percentage/100) * sub_total);
    vat_amount =  Number(vat_amount.toFixed(2));
    $("#vat_amount").val(vat_amount);

    

    if(total_weight >= 30){
      postal_charge = 0;
      $("#postal_charge").val('0');
    }
    else{
      postal_charge = (postal_charge_percentage/100) * total_price;
      postal_charge =  Number(postal_charge.toFixed(2));
      if(postal_charge < 2){
        postal_charge = 2;
      }
      $("#postal_charge").val(postal_charge);
    }

    before_total = Number(sub_total + vat_amount + postal_charge);

    total = Number(before_total);
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
        '<div class="form-group col-md-4">'+
          '<label class="col-form-label">Description</label>'+
          '<input class="form-control" id="description'+count+'" name="description[]" type="text" >'+
        '</div>'+
        '<div class="form-group col-md-4">'+
          '<label class="col-form-label">Actual Weight</label>'+
          '<input class="form-control" id="weight'+count+'" name="weight[]" type="number" min="1" >'+
        '</div>'+
        '<div class="form-group col-md-10">'+
          '<div class="col-md-12">'+
            '<div class="kt-form__group--inline">'+
              '<div class="kt-form__label">'+
                  '<label class="kt-label m-label--single">Dimensions&nbsp;<i class="flaticon2-delivery-package"></i>&nbsp;[Length&nbsp;x&nbsp;Width&nbsp;x&nbsp;Height] (cm) = Dimension Weight</label>'+
              '</div>'+
              '<div class="kt-form__control">'+
                '<div class="input-group">'+
                  '<div class="input-group-prepend">'+
                      '<span class="input-group-text">'+
                          '<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">'+
                            '<input  type="number" min="1" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="length[]" id="length'+count+'" style="max-width: 100px;">'+
                          '</div>'+
                      '</span>'+
                  '</div>'+
                  '<div class="input-group-prepend">'+
                    '<span class="input-group-text">x</span>'+
                  '</div>'+
                  '<div class="input-group-prepend">'+
                      '<span class="input-group-text">'+
                          '<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">'+
                            '<input  type="number" min="1" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="width[]" id="width'+count+'" style="max-width: 100px;">'+
                          '</div>'+
                      '</span>'+
                  '</div>'+
                  '<div class="input-group-prepend">'+
                    '<span class="input-group-text">x</span>'+
                  '</div>'+
                  '<div class="input-group-append">'+
                      '<span class="input-group-text">'+
                        '<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected" >'+
                          '<input  type="number" min="1" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="height[]" id="height'+count+'" style="max-width: 100px;">'+
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
            '<input class="form-control" id="chargeable_weight'+count+'" name="chargeable_weight[]" type="text" >'+
          '</div>'+
      '</div>';
  $('.numberpackcreate').append(appendData);
  }
}
</script>
@endsection