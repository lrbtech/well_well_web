@extends('admin.layouts')
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
@endsection
@section('section')
      <!-- Right sidebar Ends-->
      <form id="shipping_form" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input value="{{$shipment->id}}" type="hidden" name="shipment_id" id="shipment_id">
      <div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>View <span>Shipment  </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="pe-7s-home"></i></a></li>
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

            <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Shipment Details </h5>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                      <div class="row">

                      <div class="col-sm-12 show_from_address">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="col-form-label">Shipment ID</label><br>
                                <label class="col-form-label">{{$shipment->order_id}}</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="col-form-label">Shipment Mode</label><br>
                                @if($shipment->shipment_mode == 1)
                                <label class="col-form-label">Standard</label>
                                @else 
                                <label class="col-form-label">Express</label>
                                @endif
                            </div>
                            @if(!empty($user))
                            <div class="form-group col-md-4">
                                <label class="col-form-label">Name</label><br>
                                <label class="col-form-label">{{$user->first_name}} {{$user->last_name}}</label>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Mobile</label><br>
                                <label class="col-form-label">{{$user->mobile}}</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Email</label><br>
                                <label class="col-form-label">{{$user->email}}</label>
                            </div>
                            @endif

                            <div class="form-group col-md-6">
                                <label class="col-form-label">Status</label><br>
                                <label class="col-form-label">
                                <?php
                          if($shipment->status == 0){
                            echo 'Shipment Created';
                        }
                        elseif($shipment->status == 1){
                            echo 'Schedule for Pickup';
                        }
                        elseif($shipment->status == 2){
                            echo 'Package Collected';
                        }
                        elseif($shipment->status == 3){
                            echo '<td>
                            <p>Exception</p>
                            <p>' . $shipment->exception_category. '</p>
                            <p>' . $shipment->exception_remark . '</p>
                            </td>';
                        }
                        elseif($shipment->status == 4){
                            echo 'Transit In ';
                        }
                        elseif($shipment->status == 5){
                            echo 'Assign Agent to Transit Out (Hub)';
                        }
                        elseif($shipment->status == 6){
                            echo 'Transit Out ';
                        }
                        elseif($shipment->status == 7){
                            echo 'In the Van for Delivery';
                        }
                        elseif($shipment->status == 8){
                            echo 'Shipment delivered';
                        }
                          ?>
                                </label>
                            </div>

                            @if($shipment->status == 8)
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Receiver ID Copy</label><br>
                                <label class="col-form-label">
                                <a target="_blank" href="/upload_files/{{$shipment->receiver_id_copy}}"><img src="/assets/images/folder.png" class="picture-src" style="padding: 20px" title=""></a>
                                </label>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="col-form-label">Receiver Signature</label><br>
                                <label class="col-form-label">
                                <img src="{{$shipment->receiver_signature}}" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title="">
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label">Receiver Signature Name</label><br>
                                <label class="col-form-label">
                                {{$shipment->signature_person_name}}
                                </label>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label">Delivery Address</label><br>
                                <label class="col-form-label">
                                {{$shipment->delivery_address}}
                                </label>
                            </div>
                            @endif

                        </div>
                        </div>

                      </div>

                  </div>
            
                </div>
              </div>

              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h5>From Address </h5>
                    <span>Shipment starting location</span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                      <div class="row">

                        <div class="col-sm-12 show_from_address">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">
                                Contact Name : {{$from_address->contact_name}}<br>
                                Contact Mobile : {{$from_address->contact_mobile}}<br>
                                Contact landline : {{$from_address->contact_landline}}
                                </h6>
                                <h6 class="mt-0 mega-title-badge">
                                  @if($from_address->address_type == 1)
                                  Home
                                  @elseif($from_address->address_type == 2)
                                  Office
                                  @elseif($from_address->address_type == 3)
                                  Other
                                  @endif
                                  <span class="badge badge-primary pull-right digits">
                                  @foreach($city as $city1)
                                  @if($city1->id == $from_address->city_id)
                                  {{$city1->city}}
                                  @endif
                                  @endforeach
                                  </span>
                                </h6>
                                <p>{{$from_address->address1}} {{$from_address->address2}}</p>
                              </div>
                        </div>

                      </div>
                  </div>
            
                </div>
              </div>

              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h5>To Address </h5
                    ><span>Shipment where to delivery location</span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                    <div class="row">
                        <div class="col-sm-12 show_to_address">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">
                                Contact Name : {{$to_address->contact_name}}<br>
                                Contact Mobile : {{$to_address->contact_mobile}}<br>
                                Contact landline : {{$to_address->contact_landline}}
                                </h6>
                                <h6 class="mt-0 mega-title-badge">
                                  @if($to_address->address_type == 1)
                                  Home
                                  @elseif($to_address->address_type == 2)
                                  Office
                                  @elseif($to_address->address_type == 3)
                                  Other
                                  @endif
                                  <span class="badge badge-primary pull-right digits">
                                  @foreach($city as $city1)
                                  @if($city1->id == $to_address->city_id)
                                  {{$city1->city}}
                                  @endif
                                  @endforeach
                                  </span>
                                </h6>
                                <p>{{$to_address->address1}} {{$to_address->address2}}</p>
                              </div>
                          
                        </div>

                      </div>
                  </div>
              
                </div>
              </div>

              

              <div class="col-sm-12">
                <div class="card">
                <div class="card-header">
                    <h5>Package</h5><span>Details </span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                    <div class="table-responsive">
                        <table style="color: #fff !important;" class="table">
                          <thead>
                            <tr>
                                <th>No of Packages : {{$shipment->no_of_packages}}</th>
                                <th>Reference No : {{$shipment->reference_no}}</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <th>Info</th>
                                <th>Chargeable Weight</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($shipment_package as $row)
                            <tr>
                              <th scope="row">
                              @foreach($package_category as $cat)
                              @if($cat->id == $row->category)
                              {{$cat->category}}
                              @endif
                              @endforeach
                              </th>
                              <td>{{$row->description}}<br>
                                <b>Weight:</b> {{$row->weight}} kg<br>
                                <b>Dimensions:</b> {{$row->length}} cm x {{$row->width}} cm x {{$row->height}} cm
                              </td>
                              <td>{{$row->chargeable_weight}} Kg</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>

                    <hr>
                    <br>

              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <!-- <h5>Special Services</h5><span>(optional) </span> -->
                  </div>
                    <div class="card-body megaoptions-border-space-sm">
                      <div class="row">
                        
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="checkbox checkbox-secondary mr-3">
                                @if($shipment->special_cod_enable == 1)
                                <input checked id="special_cod_enable1" type="checkbox" name="special_cod_enable" value="1">
                                @else 
                                <input id="special_cod_enable1" type="checkbox" name="special_cod_enable" value="1">
                                @endif
                                <label for="special_cod_enable1"></label>
                                
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">{{$language[53][Auth::guard('admin')->user()->lang]}}
                                  <!-- <span class="badge badge-secondary pull-right digits">10 AED</span> -->
                                </h6>
                                <p>({{$language[54][Auth::guard('admin')->user()->lang]}})</p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-6 show_special_cod">
                            <label>How Much Amount to Be Collected?</label>
                            <input value="{{$shipment->special_cod}}" class="form-control" id="special_cod" name="special_cod" type="text">
                        </div>

                        
                      </div>
                    </div>
                </div>
              </div>    

                    <div class="row">
                      <div class="col">

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Shipment Price</label>
                            <div class="col-sm-6">
                              <input value="{{$shipment->shipment_price}}" readonly class="form-control" name="shipment_price" id="shipment_price" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Insurance <span id="insurance_percentage_lbel">{{$shipment->insurance_percentage}}</span>%</label>
                            <div class="col-sm-6">
                            <input value="{{$shipment->insurance_percentage}}" readonly name="insurance_percentage" id="insurance_percentage" type="hidden">
                              <input value="{{$shipment->insurance_amount}}" readonly class="form-control" name="insurance_amount" id="insurance_amount" type="text">
                            </div>
                          </div>
                          
                          @if($shipment->special_cod_enable == 1)
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Cash on Delivery </label>
                            <div class="col-sm-6">
                              <input value="{{$shipment->cod_price}}" readonly name="cod_price" id="cod_price" type="hidden">
                              <input readonly name="before_total" id="before_total" type="hidden">
                              <input value="{{$shipment->cod_amount}}" readonly class="form-control" name="cod_amount" id="cod_amount" type="text">
                            </div>
                          </div>
                          @endif

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Sub Total </label>
                            <div class="col-sm-6">
                              <input value="{{$shipment->sub_total}}" readonly class="form-control" name="sub_total" id="sub_total" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">VAT <span id="vat_percentage_label">{{$shipment->vat_percentage}}</span>%</label>
                            <div class="col-sm-6">
                            <input value="{{$shipment->vat_percentage}}" readonly name="vat_percentage" id="vat_percentage" type="hidden">
                              <input value="{{$shipment->vat_amount}}" readonly class="form-control" name="vat_amount" id="vat_amount" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Postal Charge <span id="postal_charge_percentage_label">{{$shipment->postal_charge_percentage}}</span>%</label>
                            <div class="col-sm-6">
                            <input value="{{$shipment->postal_charge_percentage}}" readonly name="postal_charge_percentage" id="postal_charge_percentage" type="hidden">
                              <input value="{{$shipment->postal_charge}}" readonly class="form-control" name="postal_charge" id="postal_charge" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Total </label>
                            <div class="col-sm-6">
                              <input value="{{$shipment->total}}" readonly class="form-control" name="total" id="total" type="text">
                            </div>
                          </div>

                      </div>
                    </div>

                  </div>
                </div>
              </div>


              <div class="col-sm-12">
                <div class="card">
                <div class="card-header">
                    <h5>Shipment Logs</h5>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">

                   <br>
                        @foreach($system_logs as $row)
                        <div class="col-sm-12 show_from_address">
                            <div class="media-body">
                              <h6 class="mt-0 mega-title-badge">
                                <span class="badge badge-primary pull-right digits">
                                  {{$row->created_at}}
                                </span>
                              </h6>
                              <p>{{$row->remark}}</p>
                            </div>
                        </div>
                        @endforeach

                  </div>
                </div>
              </div>

              <div class="col-sm-12">
                <div class="card">
                <div class="card-header">
                    <h5>Shipment Notes</h5>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">

                    <div class="form-group">
                      <label class="col-form-label">Notes </label>
                      <textarea class="form-control" name="notes" id="notes"></textarea>
                    </div>
                    <br>
                        @foreach($shipment_notes as $row)
                        <div class="col-sm-12 show_from_address">
                            <div class="media-body">
                              <h6 class="mt-0 mega-title-badge">
                                <span class="badge badge-primary pull-right digits">
                                  {{$row->created_at}}
                                </span>
                              </h6>
                              <p>{{$row->notes}}</p>
                            </div>
                        </div>
                        @endforeach

                  </div>
                </div>
              </div>
              
                
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-footer text-right">
                    <button onclick="SaveShipment()" class="btn btn-primary m-r-15" type="button">Save Notes</button>
                    <a href="/admin/shipment">
                    <button class="btn btn-light" type="button">Cancel</button>
                    </a>
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
$('.view-shipment').addClass('active');


function SaveShipment(){
  var formData = new FormData($('#shipping_form')[0]);
  $.ajax({
      url : '/admin/save-shipment-notes',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {                
          $("#shipping_form")[0].reset();
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