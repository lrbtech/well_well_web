@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
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
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>View <span>Drop Point  </span></h2>
                  <h6 class="mb-0">admin panel</h6>
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
                    <!-- <h5>Zero Configuration</h5><span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span><span>Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</span> -->
                    <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
                    <i class="bx bx-plus"></i>
                    <span>New Drop Point</span>
                    </button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Drop Point Name</th>
                            <th>Area</th>
                            <th>City</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($drop_point as $key => $row)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->drop_point_name}}</td>
                            <td>
                                @foreach($area as $area1)
                                @if($area1->id == $row->area_id)
                                {{$area1->city}}
                                @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($city as $city1)
                                @if($city1->id == $row->city_id)
                                {{$city1->city}}
                                @endif
                                @endforeach
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#">Edit</a>
                                    @if(Auth::guard('admin')->user()->role_id == '0')
                                    <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#">Delete</a>
                                    @endif
                                </div>
                            </td>
                          </tr>
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


<div class="modal fade" id="popup_modal"  tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Add New</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
        <form id="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">

        <div class="row">
            <div class="form-group col-md-6">
              <label class="col-form-label">Drop Point Name</label>
              <input autocomplete="off" type="text" id="drop_point_name" name="drop_point_name" class="form-control">
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
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">Latitude</label>
                <input readonly type="text" id="latitude" name="latitude" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label">Longitude</label>
                <input readonly type="text" id="longitude" name="longitude" class="form-control">
            </div>
        </div> 

        </form>
        </div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <button onclick="Save()" class="btn btn-primary" type="button">Save</button>
        </div>
    </div>
    </div>
</div>


@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

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
$('.drop-point').addClass('active');

var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Drop Point');
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-drop-point',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#popup_modal').modal('hide');
            location.reload();
            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
  }else{
    $.ajax({
      url : '/admin/update-drop-point',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {
        console.log(data);
          $("#form")[0].reset();
           $('#popup_modal').modal('hide');
           location.reload();
           toastr.success(data, 'Successfully Update');
      },error: function (data) {
        var errorData = data.responseJSON.errors;
        $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
        });
      }
    });
  }
}

function Edit(id){
  $.ajax({
    url : '/admin/edit-drop-point/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Drop Point');
      $('#save').text('Save Change');
      $('input[name=drop_point_name]').val(data.drop_point_name);
      $('input[name=address1]').val(data.address1);
      $('input[name=address2]').val(data.address2);
      $('select[name=city_id]').val(data.city_id);
      $('select[name=area_id]').val(data.area_id);
      $('select[name=country_id]').val(data.country_id);
      $('input[name=latitude]').val(data.latitude);
      $('input[name=longitude]').val(data.longitude);
      $('input[name=id]').val(id);

      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}

function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/drop-point-delete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Delete');
          location.reload();
        }
      });
    } 
}

</script>
@endsection