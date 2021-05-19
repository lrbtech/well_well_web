@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/timepicker.css">
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
                  <h2>Received <span>Shipment  </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item">Received Shipment</li>
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
                            
                            <div class="form-group col-md-4">
                                <label class="col-form-label">Mobile</label><br>
                                <label class="col-form-label">{{$user->mobile}}</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="col-form-label">Email</label><br>
                                <label class="col-form-label">{{$user->email}}</label>
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
                                <th>Category</th>
                                <th>Info</th>
                                <th>Price</th>
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
                              <td>{{$row->price}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="col">

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Receiver ID Copy</label>
                            <div class="col-sm-6">
                              <input class="form-control" name="receiver_id_copy" id="receiver_id_copy" type="file">
                            </div>
                          </div>


                          <div class="form-group row">
                              <div class="col-12">
                                  <h6 class="py-50">Receiver Signature</h6>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <center>
                                          <canvas id="canvas">Canvas is not supported</canvas>
                                      </center>
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <center><input class="btn btn-primary glow" id="btnClearSign" type="button" value="Clear" onclick="init_Sign_Canvas()" /></center>
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
                    <button onclick="SaveShipment()" class="btn btn-primary m-r-15" type="button">Confirm Delivery</button>
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

@endsection
@section('extra-js')
<script src="/assets/app-assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="/assets/app-assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="/assets/app-assets/js/sweet-alert/sweetalert.min.js"></script>
<script src="/assets/app-assets/js/sweet-alert/app.js"></script>
<script src="/assets/app-assets/js/time-picker/jquery-clockpicker.min.js"></script>
<script src="/assets/app-assets/js/time-picker/highlight.min.js"></script>
<script src="/assets/app-assets/js/time-picker/clockpicker.js"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">



<script type="text/javascript">
$('.view-shipment').addClass('active');


function SaveShipment(){

swal.fire({
    buttonsStyling: false,
    html: "<strong>Are you sure?</strong><br />This action will make the responsible for the delivery is you for administration review",
    //html: "<strong>Are you sure?",
    type: "warning",

    confirmButtonText: "Yes, confirm!",
    confirmButtonClass: "btn btn-sm btn-bold btn-success",

    showCancelButton: true,
    cancelButtonText: 'No',
    cancelButtonClass: "btn btn-sm btn-bold btn-danger"
}).then(function (result) {
    if (result.value) {
        
    if (isSign) {
        var canvas = $("#canvas").get(0);
        var imgData = canvas.toDataURL();
        jQuery('#page').find('p').remove();
        jQuery('#page').find('img').remove();
        
        var formData = new FormData($('#shipping_form')[0]);
        formData.append("signature_data", imgData);
        $("#save").attr("disabled", true);
        $.ajax({
            url : '/admin/update-shipment-delivery',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {                
                $("#shipping_form")[0].reset();
                toastr.success(data, 'Successfully Save');
                window.location.href="/admin/shipment";
            },error: function (data) {
                var errorData = data.responseJSON.errors;
                $.each(errorData, function(i, obj) {
                    toastr.error(obj[0]);
                });
            }
        });
    } else {
        toastr.error('Please Sign Signature');
    }


    } else {
        swal.fire({
            title: 'Cancelled',
            text: 'Nothing updated! :)',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'OK',
            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
        });
    }
});

}


var isSign = false;
var leftMButtonDown = false;

jQuery(function () {
    //Initialize sign pad
    init_Sign_Canvas();
});

function fun_submit() {
    if (isSign) {
        var canvas = $("#canvas").get(0);
        var imgData = canvas.toDataURL();
        jQuery('#page').find('p').remove();
        jQuery('#page').find('img').remove();
        // jQuery('#page').append(jQuery('<p>Your Sign:</p>'));
        // jQuery('#page').append($('<img/>').attr('src', imgData));
       // Save(imgData);
       jQuery('#signature_data').val(imgData);
    } else {
        alert('Please sign');
    }
}

function init_Sign_Canvas() {
    isSign = false;
    leftMButtonDown = false;

    //Set Canvas width
    var sizedWindowWidth = $(window).width();
    if (sizedWindowWidth > 700)
        sizedWindowWidth = $(window).width() / 2;
    else if (sizedWindowWidth > 400)
        sizedWindowWidth = sizedWindowWidth - 100;
    else
        sizedWindowWidth = sizedWindowWidth - 50;

    $("#canvas").width(sizedWindowWidth);
    $("#canvas").height(200);
    $("#canvas").css("border", "1px solid #000");

    var canvas = $("#canvas").get(0);

    canvasContext = canvas.getContext('2d');

    if (canvasContext) {
        canvasContext.canvas.width = sizedWindowWidth;
        canvasContext.canvas.height = 200;

        canvasContext.fillStyle = "#fff";
        canvasContext.fillRect(0, 0, sizedWindowWidth, 200);

        canvasContext.moveTo(50, 150);
        canvasContext.lineTo(sizedWindowWidth - 50, 150);
        canvasContext.stroke();

        canvasContext.fillStyle = "#000";
        canvasContext.font = "20px Arial";
        canvasContext.fillText("x", 40, 155);
    }
    // Bind Mouse events
    $(canvas).on('mousedown', function (e) {
        if (e.which === 1) {
            leftMButtonDown = true;
            canvasContext.fillStyle = "#000";
            var x = e.pageX - $(e.target).offset().left;
            var y = e.pageY - $(e.target).offset().top;
            canvasContext.moveTo(x, y);
        }
        e.preventDefault();
        return false;
    });

    $(canvas).on('mouseup', function (e) {
        if (leftMButtonDown && e.which === 1) {
            leftMButtonDown = false;
            isSign = true;
        }
        e.preventDefault();
        return false;
    });

    // draw a line from the last point to this one
    $(canvas).on('mousemove', function (e) {
        if (leftMButtonDown == true) {
            canvasContext.fillStyle = "#000";
            var x = e.pageX - $(e.target).offset().left;
            var y = e.pageY - $(e.target).offset().top;
            canvasContext.lineTo(x, y);
            canvasContext.stroke();
        }
        e.preventDefault();
        return false;
    });

    //bind touch events
    $(canvas).on('touchstart', function (e) {
        leftMButtonDown = true;
        canvasContext.fillStyle = "#000";
        var t = e.originalEvent.touches[0];
        var x = t.pageX - $(e.target).offset().left;
        var y = t.pageY - $(e.target).offset().top;
        canvasContext.moveTo(x, y);

        e.preventDefault();
        return false;
    });

    $(canvas).on('touchmove', function (e) {
        canvasContext.fillStyle = "#000";
        var t = e.originalEvent.touches[0];
        var x = t.pageX - $(e.target).offset().left;
        var y = t.pageY - $(e.target).offset().top;
        canvasContext.lineTo(x, y);
        canvasContext.stroke();

        e.preventDefault();
        return false;
    });

    $(canvas).on('touchend', function (e) {
        if (leftMButtonDown) {
            leftMButtonDown = false;
            isSign = true;
        }

    });
}


</script>
@endsection