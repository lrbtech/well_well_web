@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/date-picker.css">
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
            <button id="add_new_address" class="btn btn-primary m-r-15" type="button">Create Address</button>
          </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
            <div class="col-sm-12 col-xl-6 xl-100">
                <div class="card">
                  <div class="card-header">
                    <h5>From Address</h5><span>Shipment starting location</span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                      <div class="row show_from_address">
                      @foreach($address as $row)
                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-primary mr-3">
                                <input id="from_address{{$row->id}}" type="radio" name="from_address" value="{{$row->id}}">
                                <label for="from_address{{$row->id}}"></label>
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

              <div class="col-sm-12 col-xl-6 xl-100">
                <div class="card">
                  <div class="card-header">
                    <h5>To Address</h5><span>Shipment where to delivery location</span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                      <div class="row show_to_address">
                      @foreach($address as $row)
                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-primary mr-3">
                                <input id="to_address{{$row->id}}" type="radio" name="to_address" value="{{$row->id}}">
                                <label for="to_address{{$row->id}}"></label>
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
                      @endforeach

                      </div>
                  </div>
              
                </div>
              </div>

                {{-- Shipment details start --}}
                <div class="row">
                    <div class="col-sm-12 col-xl-6 xl-100">
                        <div class="card">
                          <div class="card-header">
                            <h5>Package & Shipment Details</h5>
                          </div>
                          <div class="card-body">
                              <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Ship Date</label>
                                <div class="col-sm-7">
                                  <input class="datepicker-here form-control digits" id="shipment_date" name="shipment_date" type="text" data-language="en">
                                </div>
                              </div>
                          
                              <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Number of Packages</label>
                                <div class="col-sm-7">
                                  <input class="form-control" id="no_of_packages" name="no_of_packages" type="number" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Weight</label>
                                <div class="col-sm-7">
                                  <input class="form-control" id="weight" name="weight" type="number" >
                                </div>
                              </div>
                             
                               <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Declared Value</label>
                                <div class="col-sm-7">
                                  <input class="form-control" id="declared_value" name="declared_value" type="text">
                                </div>
                              </div>
                          
                          </div>
                       
                        </div>
                </div>

<div class="col-sm-12 col-xl-6 xl-100">
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

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Package Cost</label>
            <div class="col-sm-9">
              <input class="form-control" id="return_package_cost" name="return_package_cost" type="text" placeholder="Package Cost">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Return Shipment Cost</label>
            <div class="col-sm-9">
              <input class="form-control" id="return_shipment_cost" name="return_shipment_cost" type="text" placeholder="Return Shipment Cost">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Return package fees responsible</label>
            <div class="col-sm-9">
              <input class="form-control" id="return_package_fees_responsible" name="return_package_fees_responsible" type="text" placeholder="Return package fees responsible">
            </div>
          </div>

      </div>

    </div>
</div>
                {{-- Shipment details end --}}

              
              {{-- Delivery type --}}
              <div class="col-sm-6">
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
                                <input id="shipment_type1" type="radio" name="shipment_type" value="1">
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

                        <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-secondary mr-3">
                                <input id="shipment_type2" type="radio" name="shipment_type" value="2">
                                <label for="shipment_type2"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Drop Off
                                  <!-- <span class="badge badge-secondary pull-right digits">0 AED</span> -->
                                </h6>
                                <p>For delivery package from office directly</p>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h5>Shipping Mode</h5>
                  </div>
                    <div class="card-body megaoptions-border-space-sm">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-secondary mr-3">
                                <input id="shipment_mode1" type="radio" name="shipment_mode" value="1">
                                <label for="shipment_mode1"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Express<span class="badge badge-secondary pull-right digits">10 AED</span></h6>
                                <p>Estimated 1 Day Shipping ( Duties end taxes may be due upon delivery )</p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="card">
                            <div class="media p-20">
                              <div class="radio radio-secondary mr-3">
                                <input id="shipment_mode2" type="radio" name="shipment_mode" value="2">
                                <label for="shipment_mode2"></label>
                              </div>
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Standard<span class="badge badge-secondary pull-right digits">0 AED</span></h6>
                                <p>Estimated 3 Day Shipping ( Duties end taxes may be due upon delivery )</p>
                              </div>
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

        <div class="row">
            <div class="form-group col-md-6">
              <label class="col-form-label">Address Title</label>
              <input autocomplete="off" type="text" id="address_name" name="address_name" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label class="col-form-label">Address Type</label>
                <select name="address_type" id="address_type" class="form-control">
                    <option disabled="" selected="">Choose Address Type</option>
                    <option value="1">Home</option>
                    <option value="2">Office</option>
                    <option value="3">Other</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
              <label class="col-form-label">Select Country</label>
              <select id="country_id" name="country_id" class="form-control">
                  <option value="">SELECT Country</option>
                  @foreach($country as $row)
                  <option value="{{$row->id}}">{{$row->country_name_english}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group col-md-6">
              <label class="col-form-label">Select City</label>
              <select id="city_id" name="city_id" class="form-control">
                  <option value="">SELECT City</option>
                  @foreach($city as $row)
                  <option value="{{$row->id}}">{{$row->city}}</option>
                  @endforeach
              </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
              <label class="col-form-label">Select Area</label>
              <select id="area_id" name="area_id" class="form-control">
                  <option value="">SELECT Area</option>
                  @foreach($area as $row)
                  <option value="{{$row->id}}">{{$row->city}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group col-md-6">
                <label class="col-form-label">Contact Name</label>
                <input type="text" id="contact_name" name="contact_name" class="form-control">
            </div>
        </div> 

        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">Contact Phone</label>
                <input type="text" id="contact_phone" name="contact_phone" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label class="col-form-label">Contact Landline</label>
                <input type="text" id="contact_landline" name="contact_landline" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">Address 1</label>
                <input type="text" id="address1" name="address1" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label class="col-form-label">Address 2</label>
                <input type="text" id="address2" name="address2" class="form-control">
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

$('#add_new_address').click(function(){
    $('#address_modal').modal('show');
    $("#address_form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Address');
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
          $('.show_from_address').load(location.href+' .show_from_address');
          $('.show_to_address').load(location.href+' .show_to_address');
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
      url : '/user/save-new-shipping',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {                
          $("#shipping_form")[0].reset();
          $('#address_modal').modal('hide');
          window.location.href="/user/view-shipment";
          toastr.success(data, 'Successfully Save');
      },error: function (data) {
          var errorData = data.responseJSON.errors;
          $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
    });
  }
  });
}


$( "#weight" ).keyup(function() {
  var to_address = $("#to_address").val();
	var weight = $("#weight").val();
	$.ajax({
    url : '/user/get-area-price/'+weight+'/'+to_address,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('input[name=declared_value]').val(data.declared_value);
    }
  });
});

</script>
@endsection