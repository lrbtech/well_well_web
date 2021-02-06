<!doctype html>
<html lang="en">
 
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" href="//assets/login/assets/favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="//assets/login/assets/favicon/favicon-32x32.png" type="image/x-icon">

    <title>WellWell Express Ship Now</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="apple-touch-icon" sizes="76x76" href="/assets/login/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="/assets/login/assets/img/favicon.png" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="/assets/login/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/login/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/assets/login/assets/css/demo.css" rel="stylesheet" />
    
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
    </style>
</head>

<body>
    <div class="image-container set-full-height" style="background-image: url('assets/images/register.jpg')">

        <!-- <a href="">
	         <div class="logo-container">
	            <div class="logo">
	                <img src="/
                    
	            </div>
	            <div class="brand">
	               /assets Login
	            </div>
	        </div>
	    </a> -->

        <!--  Made With Material Kit  -->
        <a href="/login" class="made-with-mk">
            <div class="brand">Go</div>
            <div class="made-with"> to/assets Login </div>
        </a>

<!--   Big container   -->
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-sm-offset-0">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="green" id="wizardProfile">
                <form action="#" method="POST" id="form">
                {{ csrf_field() }}  


<div class="wizard-header">
    <h3 class="wizard-title">
        Ship Now
    </h3>
    <h5>This information will let us know more about you.</h5>
</div>
<div class="wizard-navigation">
    <ul>
        <li><a href="#shipfrom" data-toggle="tab">Ship From</a></li>
        <li><a href="#shipto" data-toggle="tab">Ship To</a></li>
        <li><a href="#shipdetail" data-toggle="tab">Shipment Detail</a></li>
        <li><a href="#billing" data-toggle="tab">Billings</a></li>

    </ul>
</div>

<div class="tab-content">

    <div class="tab-pane" id="shipfrom">
        <div class="row">
            <!-- <h4 class="info-text"> Let's start with the basic information </h4> -->
            <div class="col-sm-4">
                <label class="control-label">Country</label>
                <div class="form-group is-empty">
                    <select name="from_country_id" id="from_country_id" class="form-control">
                        <option disabled="" selected="">Choose Country</option>
                        @foreach($country as $row)
                        <option value="{{$row->id}}"> {{$row->country_name_english}} </option>
                        @endforeach
                    </select>
                    <span class="material-input"></span>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="control-label">City</label>
                <div class="form-group is-empty">
                    <select name="from_city_id" id="from_city_id" class="form-control" aria-required="true">
                        <option disabled="" selected="">Choose City</option>
                        @foreach($city as $row)
                        <option value="{{$row->id}}"> {{$row->city}} </option>
                        @endforeach
                    </select>
                    <span class="material-input"></span>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="control-label">Area</label>
                <div class="form-group is-empty">
                    <select name="from_area_id" id="from_area_id" class="form-control" aria-required="true">
                        <option disabled="" selected="">Choose City</option>
                        @foreach($area as $row)
                        <option value="{{$row->id}}"> {{$row->city}} </option>
                        @endforeach
                    </select>
                    <span class="material-input"></span>
                </div>
            </div>

            <div class="col-sm-3">
                <!-- <label class="control-label">Address Type</label> -->
                <select name="from_address_type" id="from_address_type" class="form-control">
                    <option disabled="" selected="">Choose Address Type</option>
                    <option value="1">Home</option>
                    <option value="2">Office</option>
                    <option value="3">Other</option>
                </select>
            </div>

            <div class="col-sm-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Name
                            <small>(required)</small></label>
                        <input name="from_name" id="from_name" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <!-- <div class="col-sm-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Email
                            <small>(required)</small></label>
                        <input id="from_email" name="from_email" type="email" class="form-control">
                    </div>
                </div>
            </div> -->

            <div class="col-sm-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
                    </span>
                    <div class="form-group label-floating">
                        <label style="margin-left: 60px;" class="control-label">Mobile
                            <small>(required)</small></label>
                        <!-- <input name="mobile" id="mobile" type="text" class="form-control"> -->
                        <div class="input-group">
                            <span class="input-group-addon">+971</span>
                            <input name="from_mobile" id="from_mobile" class="form-control" type="text">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Landline
                            <small>(optional)</small></label>
                        <input name="from_landline" id="from_landline" type="text" class="form-control">
                    </div>
                </div>
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

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Address</label>
                    <input id="from_address" name="from_address" class="form-control"></input>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Latitude</label>
                    <input readonly type="text" id="from_latitude" name="from_latitude" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Longitude</label>
                    <input readonly type="text" id="from_longitude" name="from_longitude" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="shipto">
        <div class="row">
            <!-- <h4 class="info-text"> Contact Information</h4> -->
            <div class="col-sm-4">
                <label class="control-label">Country</label>
                <select name="to_country_id" id="to_country_id" class="form-control">
                    <option disabled="" selected="">Choose Country</option>
                    @foreach($country as $row)
                    <option value="{{$row->id}}"> {{$row->country_name_english}} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label class="control-label">City</label>
                <select name="to_city_id" id="to_city_id" class="form-control">
                    <option disabled="" selected="">Choose City</option>
                    @foreach($city as $row)
                    <option value="{{$row->id}}"> {{$row->city}} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label class="control-label">Area</label>
                <select name="to_area_id" id="to_area_id" class="form-control">
                    <option disabled="" selected="">Choose City</option>
                    @foreach($area as $row)
                    <option value="{{$row->id}}"> {{$row->city}} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-3">
                <!-- <label class="control-label">Address Type</label> -->
                <select name="to_address_type" id="to_address_type" class="form-control">
                    <option disabled="" selected="">Choose Address Type</option>
                    <option value="1">Home</option>
                    <option value="2">Office</option>
                    <option value="3">Other</option>
                </select>
            </div>

            <div class="col-sm-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Contact Name
                            <small>(required)</small></label>
                        <input name="to_name" id="to_name" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Contact Mobile
                            <small>(required)</small></label>
                        <input name="to_mobile" id="to_mobile" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Contact Landline
                            <small>(optional)</small></label>
                        <input name="to_landline" id="to_landline" type="text" class="form-control">
                    </div>
                </div>
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

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Address</label>
                    <input id="to_address" name="to_address" class="form-control"></input>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Latitude</label>
                    <input readonly type="text" id="to_latitude" name="to_latitude" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Longitude</label>
                    <input readonly type="text" id="to_longitude" name="to_longitude" class="form-control">
                </div>
            </div>

        </div>
    </div>

    <div class="tab-pane" id="shipdetail">
        <!-- <div class="parent">
            <h4><strong>Shipment Mode</strong></h4>
            <div class="row">
                <div class="col-sm-6">
                    <label class="radio">
                        <input type="radio" name="r" value="1">
                        <span>
                            <h5 class="mb-0"><strong>Standard</strong></h5>
                            <p> Estimated 3 Day Shipping ( Duties end taxes may be due
                                upon delivery )</p>

                        </span>
                    </label>
                </div>
                <div class="col-sm-6">
                    <label class="radio">
                        <input type="radio" name="r" value="2">
                        <span>
                            <h5 class="mb-0"><strong>express</strong></h5>
                            <p>Estimated 1 Day Shipping ( Duties end taxes may be due
                                upon delivery )</p>
                        </span>
                    </label>
                </div>
            </div>
        </div> -->
        <div class="parent">
            <h4><strong>Package and Shipment Detail</strong></h4>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Number of Packages</label>
                    <input class="form-control" id="no_of_packages" name="no_of_packages" type="number" min="1">
                </div>

                <div class="form-group col-md-6">
                    <label class="col-form-label">Declared Value</label>
                    <input class="form-control" id="declared_value" name="declared_value" type="number">
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
                    <input type="text" class="form-control" id="description1" name="description[]">
                </div>
                <div class="form-group col-md-2">
                    <label class="col-form-label">Actual Weight</label>
                    <input class="form-control" id="weight1" name="weight[]" type="number">
                </div>

                <div class="form-group col-md-8">
                    <div class="col-md-12">
                        <label class="col-form-label">Dimensions&nbsp;&nbsp;[Length&nbsp;x&nbsp;Width&nbsp;x&nbsp;Height] (cm):</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="length[]" id="length1" style="max-width: 100px;">
                            </span>
                            <span class="input-group-text">x</span>
                            <span class="input-group-text">
                                <input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="width[]" id="width1" style="max-width: 100px;">
                            </span>
                            <span class="input-group-text">x</span>
                            <span class="input-group-text">
                                <input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="height[]" id="height1" style="max-width: 100px;">
                            </span>
                            <span class="input-group-text">
                                <input style="max-width: 100px;" onclick="getPrice(1)" type="button" class="btn btn-fill btn-success btn-wd" value="Get Dim Weight" />
                            </span>
                            <span class="input-group-text">=</span>
                            <span class="input-group-text">
                                <input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="dim_weight[]" id="dim_weight1" style="max-width: 100px;">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label class="col-form-label">Chargeable Weight</label>
                    <input readonly="" class="form-control" id="chargeable_weight1" name="chargeable_weight[]" type="text">
                </div>
            </div>
            <div class="numberpackcreate"></div>
        </div>
    </div>

    <div class="tab-pane" id="billing">
        <!-- <div class="parent">
            <h4><strong>Return Package Cost</strong></h4>
            <div class="row">
                <div class="col-sm-6">
                    <label class="radio">
                        <input type="radio" name="w" value="1">
                        <span>
                            <h5 class="mb-0"><strong>Yes</strong></h5>


                        </span>
                    </label>
                </div>
                <div class="col-sm-6">
                    <label class="radio">
                        <input type="radio" name="w" value="2">
                        <span>
                            <h5 class="mb-0"><strong>No</strong></h5>

                        </span>
                    </label>
                </div>
            </div>
        </div> -->
        <div class="parent">
            <h4><strong>Shipment Type</strong></h4>
            <div class="row">
                <div class="col-md-4">
                    <label>Pickup Date</label>
                    <input min="<?php echo date('Y-m-d', strtotime("+0 days")); ?>" max="<?php echo date('Y-m-d', strtotime("+60 days")); ?>" class="form-control" id="shipment_date" name="shipment_date" type="date">
                </div>

                <div class="col-md-4">
                    <label>Pickup Time</label>
                    <input class="form-control" id="shipment_from_time" name="shipment_from_time" type="time">
                </div>

                <div class="col-md-4">
                    <label>Pickup Time</label>
                    <input readonly="" class="form-control" id="shipment_to_time" name="shipment_to_time" type="time">
                </div>
            </div>
        </div>
        <div class="parent">
            <h4><strong>Billing Details</strong></h4>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Shipment Price (Total Weight = <span id="total_weight_label">0</span> Kg)</label>
                        <input type="hidden" name="total_weight" id="total_weight">
                        <input readonly class="form-control" name="shipment_price" id="shipment_price" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Postal Charge <span id="postal_charge_percentage_label">{{$settings->postal_charge_percentage}}</span>%</label>
                        <input value="{{$settings->postal_charge_percentage}}" readonly name="postal_charge_percentage" id="postal_charge_percentage" type="hidden">
                        <input readonly class="form-control" name="postal_charge" id="postal_charge" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Sub Total</label>
                        <input readonly id="sub_total" name="sub_total" class="form-control"></input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>VAT <span id="vat_percentage_label">{{$settings->vat_percentage}}</span>%</label>
                        <input value="{{$settings->vat_percentage}}" readonly name="vat_percentage" id="vat_percentage" type="hidden">
                        <input readonly class="form-control" name="vat_amount" id="vat_amount" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Insurance <span id="insurance_percentage_label">{{$settings->insurance_percentage}}</span>%</label>
                        <input value="{{$settings->insurance_percentage}}" readonly name="insurance_percentage" id="insurance_percentage" type="hidden">
                        <input readonly class="form-control" name="insurance_amount" id="insurance_amount" type="text">
                    </div>
                </div>
                <!-- <div class="col-sm-6">
                    <div class="form-group">
                        <label>Cash on Delivery</label>
                        <input readonly id="cod_amount" name="cod_amount" class="form-control"></input>
                    </div>
                </div> -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Total</label>
                        <input readonly id="total" name="total" class="form-control"></input>
                    </div>
                </div>
            </div>
        </div>

    </div>

<div class="wizard-footer">
    <div class="pull-right">
        <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' />
        <input id="save" onclick="Send()" type='button' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Finish' />
    </div>

    <div class="pull-left">
        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
    </div>
    <div class="clearfix"></div>
</div>
               
                </form>
                </div>
            </div>
            <!-- wizard container -->
        </div>
    </div>
    <!-- end row -->
</div>
<!--  big container -->

            <!-- <div class="footer">
	        <div class="container text-center">
	             Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/bootstrap-wizard">here.</a>
	        </div>
        </div> -->

        </div>

</body>
<!--   Core JS Files   -->
<script src="/assets/login/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="/assets/login/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/login/assets/js/jquery.bootstrap.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<!-- <script src="/assets/login/assets/js/material-bootstrap-wizard.js"></script>  -->

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="/assets/login/assets/js/jquery.validate.min.js"></script>

<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">

<script src="{{ asset('assets/toastr/toastr.min.js')}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/toastr/toastr.css')}}">

<script>
    /* script */
    function initialize() {
        var latlng = new google.maps.LatLng(24.453884, 54.3773438);
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
        var latlng = new google.maps.LatLng(24.453884, 54.3773438);
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
    //wizard function

    var searchVisible = 0;
    var transparent = true;
    var mobile_device = false;
    $(document).ready(function() {
        $.material.init();
        /*  Activate the tooltips      */
        $('[rel="tooltip"]').tooltip();
        // Code for the Validator
        var checkSame;
        var beforeSame;
        var tosterActivate = 0;
        var $validator = $('.wizard-card form').validate({
            rules: {
                from_name: {
                    required: true,
                    minlength: 3
                },
                from_mobile: {
                    required: true,
                    minlength: 9,
                },
                from_country_id: {
                    required: true,
                },
                from_city_id: {
                    required: true,
                },
                from_area_id: {
                    required: true,
                },
                to_name: {
                    required: true,
                    minlength: 3
                },
                to_mobile: {
                    required: true,
                    minlength: 9,
                },
                to_country_id: {
                    required: true,
                },
                to_city_id: {
                    required: true,
                },
                to_area_id: {
                    required: true,
                },
                no_of_packages: {
                    required: true,
                },
                "weight[]": {
                    required: true,
                },
                "chargeable_weight[]": {
                    required: true,
                },
                searchInput: {
                    required: true,
                },
                searchInput1: {
                    required: true,
                },
                shipment_date: {
                    required: true,
                },
                shipment_from_time: {
                    required: true,
                },

            },

            errorPlacement: function(error, element) {
                var errorName;
                if (element.attr("name") == "from_name") {
                    errorName = "Name";
                } 
                else if (element.attr("name") == "from_mobile") {
                    errorName = "Mobile";
                } 
                else if (element.attr("name") == "from_city_id") {
                    errorName = "City";
                } 
                else if (element.attr("name") == "from_area_id") {
                    errorName = "Area";
                } 
                else if (element.attr("name") == "from_country_id") {
                    errorName = "Country";
                } 
                else if (element.attr("name") == "to_name") {
                    errorName = "Name";
                } 
                else if (element.attr("name") == "to_mobile") {
                    errorName = "Mobile";
                } 
                else if (element.attr("name") == "to_city_id") {
                    errorName = "City";
                } 
                else if (element.attr("name") == "to_area_id") {
                    errorName = "Area";
                } 
                else if (element.attr("name") == "to_country_id") {
                    errorName = "Country";
                } 
                else if (element.attr("name") == "searchInput") {
                    errorName = "Pick From Address";
                } 
                else if (element.attr("name") == "searchInput1") {
                    errorName = "Pick To Address";
                } 
                else if (element.attr("name") == "shipment_date") {
                    errorName = "Pickup Date";
                } 
                else if (element.attr("name") == "shipment_from_time") {
                    errorName = "Pickup Time";
                } 
                else {
                    errorName = element.attr("name");
                }
                if (tosterActivate == 0) {
                    toastr.error(errorName + ' fields is required');
                    $(element).parent('div').addClass('has-error');
                }
                // tosterActivate = 1;
                // $(element).parent('div').addClass('has-error');
            }
        });

        // Wizard Initialization
        $('.wizard-card').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function(tab, navigation, index) {
                tosterActivate = 0;
                var $valid = $('.wizard-card form').valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            },

            onInit: function(tab, navigation, index) {

                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('.wizard-card');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                $('.wizard-card .wizard-navigation').append($moving_div);

                refreshAnimation($wizard, index);

                $('.moving-tab').css('transition', 'transform 0s');
            },

            onTabClick: function(tab, navigation, index) {

                var $valid = $('.wizard-card form').valid();

                if (!$valid) {
                    return false;
                } else {
                    return false;
                    //return true;
                }
            },

            //onTabShow: function (tab, navigation, index) {


            onNext: function(tab, navigation, index) {
                tosterActivate = 0;
                var $valid = $('.wizard-card form').valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            },

            onInit: function(tab, navigation, index) {

                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('.wizard-card');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                $('.wizard-card .wizard-navigation').append($moving_div);

                refreshAnimation($wizard, index);

                $('.moving-tab').css('transition', 'transform 0s');
            },

            onTabClick: function(tab, navigation, index) {

                var $valid = $('.wizard-card form').valid();

                if (!$valid) {
                    return false;
                } else {
                    return false;
                    //return true;
                }
            },

            onTabShow: function(tab, navigation, index) {

                var $total = navigation.find('li').length;
                var $current = index + 1;
                console.log($current);
                var $wizard = navigation.closest('.wizard-card');

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $($wizard).find('.btn-next').hide();
                    $($wizard).find('.btn-finish').show();
                } else {
                    $($wizard).find('.btn-next').show();
                    $($wizard).find('.btn-finish').hide();
                }

                button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                setTimeout(function() {
                    $('.moving-tab').text(button_text);
                }, 150);

                var checkbox = $('.footer-checkbox');

                if (!index == 0) {
                    $(checkbox).css({
                        'opacity': '0',
                        'visibility': 'hidden',
                        'position': 'absolute'
                    });
                } else {
                    $(checkbox).css({
                        'opacity': '1',
                        'visibility': 'visible'
                    });
                }

                refreshAnimation($wizard, index);
            }
        });



        $('[data-toggle="wizard-radio"]').click(function() {
            wizard = $(this).closest('.wizard-card');
            wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
            $(this).addClass('active');
            $(wizard).find('[type="radio"]').removeAttr('checked');
            $(this).find('[type="radio"]').attr('checked', 'true');
        });

        $('[data-toggle="wizard-checkbox"]').click(function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).find('[type="checkbox"]').removeAttr('checked');
            } else {
                $(this).addClass('active');
                $(this).find('[type="checkbox"]').attr('checked', 'true');
            }
        });

        $('.set-full-height').css('height', 'auto');

    });



    //Function to show image before upload

    $(window).resize(function() {
        $('.wizard-card').each(function() {
            $wizard = $(this);

            index = $wizard.bootstrapWizard('currentIndex');
            refreshAnimation($wizard, index);

            $('.moving-tab').css({
                'transition': 'transform 0s'
            });
        });
    });

    function refreshAnimation($wizard, index) {
        $total = $wizard.find('.nav li').length;
        $li_width = 100 / $total;

        total_steps = $wizard.find('.nav li').length;
        move_distance = $wizard.width() / total_steps;
        index_temp = index;
        vertical_level = 0;

        mobile_device = $(document).width() < 600 && $total > 3;

        if (mobile_device) {
            move_distance = $wizard.width() / 2;
            index_temp = index % 2;
            $li_width = 50;
        }

        $wizard.find('.nav li').css('width', $li_width + '%');

        step_width = move_distance;
        move_distance = move_distance * index_temp;

        $current = index + 1;

        if ($current == 1 || (mobile_device == true && (index % 2 == 0))) {
            move_distance -= 8;
        } else if ($current == total_steps || (mobile_device == true && (index % 2 == 1))) {
            move_distance += 8;
        }

        if (mobile_device) {
            vertical_level = parseInt(index / 2);
            vertical_level = vertical_level * 38;
        }

        $wizard.find('.moving-tab').css('width', step_width);
        $('.moving-tab').css({
            'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
            'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

        });
    }

    materialDesign = {

        checkScrollForTransparentNavbar: debounce(function() {
            if ($(document).scrollTop() > 260) {
                if (transparent) {
                    transparent = false;
                    $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                }
            } else {
                if (!transparent) {
                    transparent = true;
                    $('.navbar-color-on-scroll').addClass('navbar-transparent');
                }
            }
        }, 17)

    }

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            }, wait);
            if (immediate && !timeout) func.apply(context, args);
        };
    };




function getPrice(count){
  var weight = $("#weight"+count).val();
  var length = $("#length"+count).val();
  var width = $("#width"+count).val();
  var height = $("#height"+count).val();
    
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

    if(total_weight >= 30){
      postal_charge = 0;
      $("#postal_charge").val('0');
    }
    else{
      postal_charge = (postal_charge_percentage/100) * total_price;
      postal_charge =  Number(postal_charge.toFixed(2));
      $("#postal_charge").val(postal_charge);
    }

    sub_total = Number(postal_charge + total_price);
    sub_total =  Number(sub_total.toFixed(2));

    $("#sub_total").val(sub_total);

    vat_amount = Number((vat_percentage/100) * sub_total);
    vat_amount =  Number(vat_amount.toFixed(2));
    $("#vat_amount").val(vat_amount);

    insurance_amount = Number((insurance_percentage/100) * sub_total);
    insurance_amount =  Number(insurance_amount.toFixed(2));
    $("#insurance_amount").val(insurance_amount);

    before_total = Number(sub_total + vat_amount + insurance_amount);

    total = Number(before_total);
    total =  Number(total.toFixed(2));

    $("#total").val(total);
}



$('#from_city_id').change(function(){
  var id = $('#from_city_id').val();
  $.ajax({
    url : '/get-area/'+id,
    type: "GET",
    success: function(data)
    {
        $('#from_area_id').html(data);
    }
  });
});

$('#to_city_id').change(function(){
  var id = $('#to_city_id').val();
  $.ajax({
    url : '/get-area/'+id,
    type: "GET",
    success: function(data)
    {
        $('#to_area_id').html(data);
    }
  });
});

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
                '<label class="col-form-label">Dimensions&nbsp;&nbsp;[Length&nbsp;x&nbsp;Width&nbsp;x&nbsp;Height] (cm):</label>'+
                '<div class="input-group">'+
                    '<span class="input-group-text">'+
                        '<input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="length[]" id="length'+count+'" style="max-width: 100px;">'+
                    '</span>'+
                    '<span class="input-group-text">x</span>'+
                    '<span class="input-group-text">'+
                        '<input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="width[]" id="width'+count+'" style="max-width: 100px;">'+
                    '</span>'+
                    '<span class="input-group-text">x</span>'+
                    '<span class="input-group-text">'+
                        '<input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="height[]" id="height'+count+'" style="max-width: 100px;">'+
                    '</span>'+
                    '<span class="input-group-text">'+
                        '<input style="max-width: 100px;" onclick="getPrice('+count+')" type="button" class="btn btn-fill btn-success btn-wd" value="Get Dim Weight" />'+
                    '</span>'+
                    '<span class="input-group-text">=</span>'+
                    '<span class="input-group-text">'+
                        '<input type="text" class="form-control form-control-sm bootstrap-touchspin-vertical-btn" name="dim_weight[]" id="dim_weight'+count+'" style="max-width: 100px;">'+
                    '</span>'+
                '</div>'+
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


$('#shipment_from_time').blur(function(){
    $("#shipment_to_time").val('');
  var shipment_from_time = $("#shipment_from_time").val();
  //alert(shipment_from_time);
  <?php //echo date('H:m a',strtotime($_POST['shipment_from_time']."+2 hour")); ?>

  var to_time = moment.utc(shipment_from_time,'hh:mm').add(2,'hour').format('hh:mm');
  $("#shipment_to_time").val(to_time);
});

function Send(){
    var formData = new FormData($('#form')[0]);
    $("#save").attr("disabled", true);
    $.ajax({
        url : '/save-mobile-verify',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            // console.log(data);
            // //$("#form")[0].reset();
            // // toastr.success(data, 'Successfully Save');
            // alert('Save Successfully');
            // //window.location.href = '/home';
            // $("#save").attr("disabled", false);
var mobile = $('#from_mobile').val();
Swal.fire({
  title: 'Verify Your Otp',
  input: 'text',
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: true,
  confirmButtonText: 'Verify',
  showLoaderOnConfirm: true,
  preConfirm: (login) => {
    return fetch('verify-otp/'+mobile+'/'+login)
      .then(response => {
        if (!response.ok) {
          throw new Error(response.statusText)
        }
        return response.json()
      })
      .catch(error => {
        Swal.showValidationMessage(
          `Request failed: ${error}`
        )
      })
  },
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
  if (result.isConfirmed) {
    Save();
  }
  else {
    $("#save").attr("disabled", false);
  }
})
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
                toastr.error(obj[0]);
                $("#save").attr("disabled", false);
            });
        }
    });
}

function Save(){
    var formData = new FormData($('#form')[0]);
    $("#save").attr("disabled", true);
    $.ajax({
        url : '/save-new-shipment',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            Swal.fire({
                text: "Your Shipment is Saved Successfully",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/home';
            }
            })
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
            $("#save").attr("disabled", false);
    });
    }
    });
}
</script>

</html>