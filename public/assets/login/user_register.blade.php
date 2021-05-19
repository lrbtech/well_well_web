<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="icon" href="/assets/favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/favicon/favicon-32x32.png" type="image/x-icon">

	<title>WellWell Register Page</title>

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
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/toastr/toastr.css')}}">
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
                            
		                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        	   Build Your Profile
		                        	</h3>
									<h5>This information will let us know more about you.</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
                                        <li><a href="#profile" data-toggle="tab">Basic Profile</a></li>
                                        <li><a href="#contact" data-toggle="tab">Contact Information</a></li>
                                        <li><a href="#notes" data-toggle="tab">Notes</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
                                
		                            <div class="tab-pane" id="profile">
		                              <div class="row">
		                                	<h4 class="info-text"> Let's start with the basic information </h4>
                                             
		                                	<div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>

													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">First Name <small>(required)</small></label>
			                                          <input name="first_name" id="first_name" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>
                                            <div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Last Name <small>(required)</small></label>
													  <input name="last_name" id="last_name" type="text" class="form-control">
													</div>
												</div>
                                            </div>

                                            <div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Email <small>(required)</small></label>
													  <input id="email" name="email" type="email" class="form-control">
													</div>
												</div>
                                            </div>


                                           


                                            <div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label style="margin-left: 60px;" class="control-label">Mobile <small>(required)</small></label>
                                                      <!-- <input name="mobile" id="mobile" type="text" class="form-control"> -->
                                                      <div class="input-group">
                                                        <span class="input-group-addon">+971</span>
                                                        <input name="mobile" id="mobile" class="form-control" type="text">
                                                        </div>
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-4 user_type_class">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-phone fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Landline <small>(optional)</small></label>
			                                          <input name="landline" id="landline" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>
                                            
		                            	</div>
                                    </div>
                                    
                                    <div class="tab-pane" id="contact">
		                              <div class="row">
		                                	<h4 class="info-text"> Contact Information</h4>
		                                	<div class="col-sm-4">
                                                <label class="control-label">Country</label>
                                                <select name="country_id" id="country_id" class="form-control">
                                                    <option disabled="" selected="">Choose Country</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="control-label">City</label>
                                                <select name="city_id" id="city_id" class="form-control">
                                                    <option disabled="" selected="">Choose City</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="control-label">Area</label>
                                                <select name="area_id" id="area_id" class="form-control">
                                                    <option disabled="" selected="">Choose City</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <!-- <label class="control-label">Address Type</label> -->
                                                <select name="address_type" id="address_type" class="form-control">
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
			                                          <label class="control-label">Contact Name <small>(optional)</small></label>
			                                          <input name="contact_name" id="contact_name" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Contact Mobile <small>(optional)</small></label>
			                                          <input name="contact_mobile" id="contact_mobile" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-phone fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Contact Landline <small>(optional)</small></label>
			                                          <input name="contact_landline" id="contact_landline" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Enter a location</label>
                                                    <input id="searchInput" class="input-controls form-control" type="text" placeholder="Enter a location">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input id="address" name="address" class="form-control"></input>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Latitude</label>
                                                    <input readonly type="text" id="latitude" name="latitude" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Longitude</label>
                                                    <input readonly type="text" id="longitude" name="longitude" class="form-control">
                                                </div>
                                            </div>
                                            
		                            	</div>
                                    </div>
                                    
                                    <div class="tab-pane" id="notes">
		                                <div class="row">
		                                    <!-- <h4 class="info-text"> No.</h4> -->
		                                    <div class="col-sm-6 col-sm-offset-1">
	                                    		<div class="form-group">
		                                            <label>Notes</label>
		                                            <textarea name="description" id="description" class="form-control" placeholder="" rows="6"></textarea>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-4">
		                                    	<div class="form-group">
		                                            <label class="control-label">Example</label>
		                                            <p class="description">"We would like to know your business nature to support you at the best, drop some details regarding your process in logistics will make a note of it, & make sure the best serves you."</p>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            


		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' />
		                                <input id="save" onclick="Save()" type='button' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Finish' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	        </div><!-- end row -->
	    </div> <!--  big container -->

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
     <script src="{{ asset('assets/toastr/toastr.min.js')}}" type="text/javascript"></script>
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
   document.getElementById('address').value = address;
   document.getElementById('latitude').value = lat;
   document.getElementById('longitude').value = lng;
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>



<script type="text/javascript">

//wizard function

var searchVisible = 0;
var transparent = true;
var mobile_device = false;
$(document).ready(function () {
    $.material.init();
    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();
    // Code for the Validator
    var checkSame;
    var beforeSame;
    var tosterActivate=0;
    var $validator = $('.wizard-card form').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                minlength: 3,
            },
            
            mobile: {
                required: true,
                minlength: 9,
            },
            country_id: {
                required: true,
            },
            city_id: {
                required: true,
            },
            area_id: {
                required: true,
            },
            
        },
        messages: {
            mobile: {
                required: "mobile Field is Required",
                minlength: "mobile Field Minimum Lenth is 15 Digits"
            }
            //AcceptTerms_check: "<br/>Please read and accept the program terms to submit your application"
        },

        errorPlacement: function (error, element) {
            
            //var errorData = element.responseJSON.errors;
            // console.log(element.attr("name"))
            // $.each(error, function(i, obj) {

            var errorName;
            if(element.attr("name") == "user_type"){
                errorName = "Business Type";
            }
            else if(element.attr("name") == "first_name"){
                    errorName = "First Name";
            }
            else if(element.attr("name") == "last_name"){
                    errorName = "Last Name";
            }
            else if(element.attr("name") == "city_id"){
                    errorName = "City";
            }
            else if(element.attr("name") == "area_id"){
                    errorName = "Area";
            }
            else if(element.attr("name") == "country_id"){
                    errorName = "Country";
            }
            else{
                errorName =element.attr("name");
            }
            if(tosterActivate ==0){
                if(element.attr("name") == "agree"){
                    toastr.error("Please Agree The Term & Conditions");
                }else{
                    toastr.error(errorName+' fields is required');
                }
            }
            tosterActivate=1;
            $(element).parent('div').addClass('has-error');
        }
    });

    // Wizard Initialization
    $('.wizard-card').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function (tab, navigation, index) {
         tosterActivate =0;
            var $valid = $('.wizard-card form').valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }
        },

        onInit: function (tab, navigation, index) {
         
            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            var $wizard = navigation.closest('.wizard-card');

            $first_li = navigation.find('li:first-child a').html();
            $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
            $('.wizard-card .wizard-navigation').append($moving_div);

            refreshAnimation($wizard, index);

            $('.moving-tab').css('transition', 'transform 0s');
        },

        onTabClick: function (tab, navigation, index) {
    
            var $valid = $('.wizard-card form').valid();

            if (!$valid) {
                return false;
            } else {
                return false;
                //return true;
            }
        },

        //onTabShow: function (tab, navigation, index) {
           

        onNext: function (tab, navigation, index) {
         tosterActivate =0;
            var $valid = $('.wizard-card form').valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }
        },

        onInit: function (tab, navigation, index) {
         
            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            var $wizard = navigation.closest('.wizard-card');

            $first_li = navigation.find('li:first-child a').html();
            $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
            $('.wizard-card .wizard-navigation').append($moving_div);

            refreshAnimation($wizard, index);

            $('.moving-tab').css('transition', 'transform 0s');
        },

        onTabClick: function (tab, navigation, index) {
    
            var $valid = $('.wizard-card form').valid();

            if (!$valid) {
                return false;
            } else {
                return false;
                //return true;
            }
        },

        onTabShow: function (tab, navigation, index) {
           
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

            setTimeout(function () {
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


    // Prepare the preview for profile picture
    $("#wizard-picture").change(function () {
        readURL(this);
    });

    $("#wizard-picture1").change(function () {
        readURL1(this);
    });

    $("#wizard-picture2").change(function () {
        readURL2(this);
    });

    $("#wizard-picture3").change(function () {
        readURL3(this);
    });

    $('[data-toggle="wizard-radio"]').click(function () {
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked', 'true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function () {
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

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview1').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview2').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview3').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(window).resize(function () {
    $('.wizard-card').each(function () {
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

    checkScrollForTransparentNavbar: debounce(function () {
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
    return function () {
        var context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
};



</script>

</html>
