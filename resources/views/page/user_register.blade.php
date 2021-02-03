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
		                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        	   Build Your Profile
		                        	</h3>
									<h5>This information will let us know more about you.</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#account" data-toggle="tab">Choose Account</a></li>
                                        <li><a href="#profile" data-toggle="tab">Basic Profile</a></li>
                                        <li><a href="#contact" data-toggle="tab">Contact Information</a></li>
                                        <li><a href="#notes" data-toggle="tab">Notes</a></li>
			                            <li><a href="#terms" data-toggle="tab">Terms and Conditions</a></li>
			                            <li><a href="#signature" data-toggle="tab">Signature</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
                                <div class="tab-pane" id="account">
		                                <h4 class="info-text"> Please Select your Busisness Type </h4>
		                                <div class="row">
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="col-sm-6">
		                                            <div class="choice" data-toggle="wizard-radio" onclick="user_type_fun(0)">
		                                                <input id="user_type1" type="radio" name="user_type" value="0" required>
		                                                <div class="icon">
		                                                    <i class="fa fa-user-o"></i>
		                                                </div>
		                                                <h6>Individual Business</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-6">
		                                            <div class="choice" data-toggle="wizard-radio" onclick="user_type_fun(1)">
		                                                <input id="user_type2" type="radio" name="user_type" value="1" required>
		                                                <div class="icon">
		                                                   <i class="fa fa-briefcase" aria-hidden="true"></i>
		                                                </div>
		                                                <h6>Comercial Business</h6>
		                                            </div>
		                                        </div>
		                                        <!-- <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="jobb" value="Develop">
		                                                <div class="icon">
		                                                    <i class="fa fa-laptop"></i>
		                                                </div>
		                                                <h6>Develop</h6>
		                                            </div>
		                                        </div> -->
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="tab-pane" id="profile">
		                              <div class="row">
		                                	<h4 class="info-text"> Let's start with the basic information </h4>
		                                	<!-- <div class="col-sm-4 col-sm-offset-1">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="/assets/login/assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
		                                            	<input type="file" id="wizard-picture">
		                                        	</div>
		                                        	<h6>Choose Picture</h6>
		                                    	</div>
                                            </div> -->
                                             <div class="col-sm-12">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="/assets/login/assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview3" title=""/>
		                                            	<input type="file" id="wizard-picture3" name="profile_image">
		                                        	</div>
		                                        	<h6>Choose Profile Image <small>(jpg, jpeg, png)</small></h6>
		                                    	</div>
		                                	</div>
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
                                            <div class="col-sm-4 user_type_class">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-address-card-o fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Business Name <small>(required)</small></label>
													  <input name="business_name" id="business_name" type="text" class="form-control">
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
														<i class="material-icons">password</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Password <small>(required)</small></label>
													  <input id="password" name="password" type="password" class="form-control">
													</div>
												</div>
                                            </div>

                                            <div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">password</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Confirm Password <small>(required)</small></label>
													  <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
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

                                            <div class="col-sm-4 user_type_class">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-globe fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Website <small>(optional)</small></label>
			                                          <input name="website" id="website" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-id-card-o fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Emirates ID <small>(required)</small></label>
			                                          <input name="emirates_id" id="emirates_id" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-4 user_type_class">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-id-card-o fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Trade License <small>(optional)</small></label>
			                                          <input name="trade_license" id="trade_license" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-4 user_type_class">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-id-card-o fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">VAT certificate Number <small>(optional)</small></label>
			                                          <input name="vat_certificate_no" id="vat_certificate_no" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-4">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""/>
		                                            	<input type="file" id="wizard-picture" name="emirates_id_file">
		                                        	</div>
		                                        	<h6>Choose Emirates ID File <small>(jpg, jpeg, png)</small></h6>
		                                    	</div>
                                            </div>
                                            
                                            <div class="col-sm-4 user_type_class">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview1" style="padding: 20px" title=""/>
		                                            	<input type="file" id="wizard-picture1" name="trade_license_file">
		                                        	</div>
		                                        	<h6>Choose Trade License File <small>(jpg, jpeg, png)</small></h6>
		                                    	</div>
                                            </div>
                                            
                                            <div class="col-sm-4 user_type_class">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview2" style="padding: 20px" title=""/>
		                                            	<input type="file" id="wizard-picture2" name="vat_certificate_file">
		                                        	</div>
		                                        	<h6>Choose Vat Certification File <small>(jpg, jpeg, png)</small></h6>
		                                    	</div>
                                            </div>
                                            
                                           
                                            
		                                	<!-- <div class="col-sm-10 col-sm-offset-1">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
			                                            <label class="control-label">Email <small>(required)</small></label>
			                                            <input name="email" type="email" class="form-control">
			                                        </div>
												</div>
                                            </div> -->
                                            
		                            	</div>
                                    </div>
                                    
                                    <div class="tab-pane" id="contact">
		                              <div class="row">
		                                	<h4 class="info-text"> Contact Information</h4>
		                                	<div class="col-sm-4">
                                                <label class="control-label">Country</label>
                                                <select name="country_id" id="country_id" class="form-control">
                                                    <option disabled="" selected="">Choose Country</option>
                                                    @foreach($country as $row)
                                                    <option value="{{$row->id}}"> {{$row->country_name_english}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="control-label">City</label>
                                                <select name="city_id" id="city_id" class="form-control">
                                                    <option disabled="" selected="">Choose City</option>
                                                    @foreach($city as $row)
                                                    <option value="{{$row->id}}"> {{$row->city}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="control-label">Area</label>
                                                <select name="area_id" id="area_id" class="form-control">
                                                    <option disabled="" selected="">Choose City</option>
                                                    @foreach($area as $row)
                                                    <option value="{{$row->id}}"> {{$row->city}} </option>
                                                    @endforeach
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
                                            <div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Facebook URL <small>(optional)</small></label>
			                                          <input name="facebook_url" id="facebook_url" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-twitter fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Twitter URL <small>(optional)</small></label>
			                                          <input name="twitter_url" id="twitter_url" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div>

                                            <div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Instagram URL <small>(optional)</small></label>
			                                          <input name="instagram_url" id="instagram_url" type="text" class="form-control">
			                                        </div>
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


                                            
                                            
		                                	<!-- <div class="col-sm-10 col-sm-offset-1">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
			                                            <label class="control-label">Email <small>(required)</small></label>
			                                            <input name="email" type="email" class="form-control">
			                                        </div>
												</div>
                                            </div> -->
                                            
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
		                            
		                        <div class="tab-pane" id="terms">
		                                <div class="row">
										<h4 class="info-text"> Terms and Condition</h4>
										<div class="col-sm-1"></div>
		                                <div style="display: block;height: 300px;overflow-y: scroll;" class="col-sm-10">
<p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>THE FOLLOWING TERMS AND CONDITIONS GOVERN YOUR USE OF WELLWELL.ae. YOUR VIEWING OR USE OF THIS SITE WILL CONSTITUTE YOUR AGREEMENT, ON BEHALF OF YOURSELF AND THE ENTITY YOU REPRESENT (HEREINAFTER COLLECTIVELY &quot;YOU&quot; OR &quot;YOUR&quot;), TO ALL OF THE TERMS AND CONDITIONS PROVIDED BELOW.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL Express Cargo MAY MAKE FUTURE CHANGES OR MODIFICATIONS TO SUCH TERMS AND CONDITIONS AT ANY TIME WITHOUT NOTICE, AND YOUR SUBSEQUENT VIEWING OR USE OF WELLWELL.ae WILL CONSTITUTE YOUR AGREEMENT TO THE CHANGES AND MODIFICATIONS. THERE MAY BE ADDITIONAL TERMS AND CONDITIONS PROVIDED THROUGHOUT WELLWELL.ae GOVERNING YOUR USE OF PARTICULAR FUNCTIONS, FEATURES, INFORMATION AND APPLICATIONS AVAILABLE THROUGH WELLWELL.ae</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 1. Definitions</span><span style='font-size:12px;font-family:"Arial","sans-serif";color:#333333;'><br>&nbsp;</span><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>Content: information, graphics, products, features, functionality, services, and links on WELLWELL.ae, including Billing Online, Tracking Signature Proof of Delivery and Tracking Updates.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL Express :WELLWELL Corporate Services, Incorporated, its parent and its parent&apos;s subsidiary companies.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>You: Yourself and the entity that you represent</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 2. Use of WELLWELL.ae</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL.ae is provided solely for the use of current and potential WELLWELL Express customers to interact with WELLWELL and may not be used by any other person or entity, or for any other purpose. Specifically, all shipping, tracking, rating, receiving invoices and remitting payment using electronic funds transfer (&quot;EFT&quot;), drop-off location, and other information and services may only be used by current and potential WELLWELL customers for their own shipments. Use of WELLWELL.ae to provide information to or prepare shipments by or for the benefit of third-party shippers is expressly prohibited.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>The use of non-authorized scripting technologies to obtain information from WELLWELL.ae or submit information through WELLWELL.ae is strictly prohibited.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 3. WELLWELL.ae/assets Login Registration</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>You may choose to register on WELLWELL.ae to access interactive features/assets Login provides you with access to&nbsp;Tracking,Billing Online,and other online services. The availability of these services varies by country. In the future, WELLWELL Express may add other features that may be accessed through/assets Login. In such event, previously registered users will not be required to re-register.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>By registering on WELLWELL.ae, You agree to provide accurate and current information about Yourself as prompted by the WELLWELL.ae/assets Login Registration pages and maintain and promptly update Your online profile information to keep it accurate and current.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>When you register using WELLWELL.ae/assets Login Registration, you will select a user ID and password. You are responsible for maintaining the confidentiality of the password and user ID, and you are responsible for all activities that occur under Your password and user ID. You agree to (a) immediately notify WELLWELL Express of any unauthorized use of Your user ID and password, and (b) ensure that You exit from Your session at the end of each visit.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>You acknowledge and agree that it may be necessary from time to time for WELLWELL Express to confirm the validity of the credit card information you provided to open your account. When this occurs, WELLWELL Express may request a temporary authorization hold for a nominal amount on your card. This authorization hold does not result in actual charges to your card. These authorizations will automatically expire based on guidelines established by your card issuer.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 4. Changes to WELLWELL.ae</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL.ae and its Content, may be changed, deleted or updated at any time without notice.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 5. Termination of Use</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL Express may discontinue, suspend or modify WELLWELL.ae at any time without notice, and WELLWELL Express may block, terminate or suspend Your and any user&apos;s access to WELLWELL.ae at any time for any reason in its sole discretion, even if access continues to be allowed to others.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 6. Ownership</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL.ae and its Content are protected byinternational copyright, trademark and other laws.All rights reserved. Specifically, WELLWELL Express does not convey to anyone, through allowing access to WELLWELL.ae, any ownership rights in WELLWELL.ae or in any Content appearing on or made available through WELLWELL.ae. Customer may not copy, modify, translate, transmit, distribute, adapt, reproduce, decompile, reverse engineer or disassemble any part of WELLWELL.ae or its Content.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 7. Disclaimer of Warranty</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL.AE AND ITS CONTENT ARE PROVIDED &quot;AS IS&quot;. WELLWELL EXPRESS AND ITS LICENSORS DISCLAIM ANY AND ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT, REGARDING ANY SUCH CONTENT AND YOUR ABILIITY OR INABILITY TO USE WELLWELL.AE AND ITS CONTENT.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL EXPRESS DISCLAIMS AND EXCLUDES ALL WARRANTIES REGARDING WELLWELL.AE, AND THE FUNCTIONING OF THE INTERNET WHETHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. WELLWELL EXPRESS DOES NOT WARRANT THAT SHIPING SOFTWARE WILL MEET ALL OF CUSTOMER&apos;S REQUIREMENTS OR THAT ITS OPERATIONS WILL BE UNINTERRUPTED OR ERROR FREE, OR THAT ANY DEFECT WITHIN THE PORTAL WILL BE CORRECTED. FURTHERMORE, WELLWELL EXPRESS DOES NOT WARRANT NOR MAKE ANY REPRESENTATION REGARDING THE RESULTS OF CUSTOMER&apos;S USE OF SHIPING TOOLS IN TERMS OF CAPABILITY, CORRECTNESS, ACCURACY, RELIABILITY OR OTHERWISE. NO ORAL OR WRITTEN INFORMATION, REPRESENTATION OR ADVICE GIVEN BY WELLWELL EXPRESS OR AN AUTHORIZED REPRESENTATIVE OF WELLWELL EXPRESS SHALL CREATE A WARRANTY.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 8. Limitation of Liability</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>USE OF WELLWELL.AE AND ITS CONTENT IS AT YOUR SOLE RISK. WELLWELL EXPRESS WILL IN NO EVENT BE LIABLE TO YOU OR ANY PERSON OR ENTITY CLAIMING THROUGH YOU FOR ANY DIRECT, INDIRECT, CONSEQUENTIAL, INCIDENTAL OR OTHER DAMAGES UNDER ANY THEORY OF LAW FOR ANY ERRORS IN OR THE USE OF OR INABILITY TO USE WELLWELL.AE AND ITS CONTENT INCLUDING WITHOUT LIMITATION, DAMAGES FOR LOST PROFITS, BUSINESS, DATA, OR DAMAGE TO ANY COMPUTER SYSTEMS, EVEN IF YOU HAVE ADVISED WELLWELL EXPRESS OF THE POSSIBILITY OF SUCH DAMAGES.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 9. Indemnity</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>You agree to defend, indemnify and hold harmless WELLWELL Express, its parent and affiliate companies and their respective officers, directors, employees, agents and representatives from any and all claims (i) arising out of Your breach of any of these terms and conditions, and any of Your activities conducted in connection with this site.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 10. WELLWELL Express Service Guide</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>The terms and conditions for using WELLWELL Express delivery and related services are contained in the most current version of the Service Guide, which is available by request. The most current version of the Service Guide will control in the event of any conflict between any WELLWELL Express delivery or related service information online and the delivery or related service information contained in the most current version of the Service Guide.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 11. Links to other web sites</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>There are links in WELLWELL.ae site that allow You to visit sites of third parties. Neither these sites nor the companies to whom they belong are controlled by WELLWELL Express. WELLWELL Express makes no representations concerning the information provided or made available on such sites nor the quality or acceptability of the products or services offered by any persons or entities referenced in any such sites.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL Express has not tested and makes no representations regarding the correctness, performance or quality of any software found at any such sites. You should research and assess the risks which may be involved in accessing and using any software on the Internet before using it.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 12. Privacy Policy</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>The&nbsp;</span><a href="https://www.fedex.com/en-ae/privacy-policy.html"><span style='font-size:16px;font-family:"Arial","sans-serif";'>WELLWELL Express Privacy Policy</span></a><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>&nbsp;governs the use of information acquired from You through WELLWELL.ae.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 13. Export</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>You assume all responsibility for compliance with all laws and regulations of the United Arab Emirates and any other country from which You may access WELLWELL.ae regarding access, use, export, re-export and import of any Content appearing on or available through WELLWELL.ae</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 14. Controlling Law and Severability</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>This Agreement and Your use of WELLWELL.ae is governed by and construed in accordance with the laws of the United Arab Emirates If for any reason a court of competent jurisdiction finds any provision of this Agreement, or a portion thereof, to be unenforceable, that provision shall be enforced to the maximum extent permissible.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>Any cause of action with respect to WELLWELL.ae or this Agreement must be instituted within one year after the claim or cause of action has risen or be barred and must be brought in a court of competent jurisdiction within UAEThis Agreement may not be changed or modified without the written consent of WELLWELL Express.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 15. Terms of Carriage</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>(i) Customer agrees that domesticcarriage by WELLWELL Express of any shipments tendered to WELLWELL Express using WELLWELL.ae shall be in accordance with the terms, conditions and limitations of liability set out on the NONNEGOTIABLE Air Waybill, Label, Manifest, or Pick-Up Record (collectively &quot;Shipping Documentation&quot;) and as appropriate any transportation agreement between Customer and WELLWELL Express covering such shipment and in any applicable tariff, Service Guide or Standard Conditions of Carriage, copies of which are available upon request, and which are incorporated into this Agreement by reference. If there is a conflict between the Shipping Documentation and any such document then in effect or this Agreement, the transportation agreement, tariff, Service Guide, Standard Conditions of Carriage, or this Agreement will control, in that order of priority.&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>(ii) In the event Customer uses WELLWELL.ae to process shipments tendered to WELLWELL Express for delivery to locations outside the United Arab Emirates or country of shipment origin, Customer will, at Customer&apos;s sole expense, assure that the terms and conditions of international carriage supplied by WELLWELL Express from time to time (and which may be amended or modified from time to time at WELLWELL Express&rsquo;s sole discretion) are placed on the Shipping Documentation as may be instructed by WELLWELL Express, for all such international shipments. Customer will defend, indemnify and hold harmless WELLWELL Express, its officers, directors, employees and agents from and against any and all losses, damages, claims and other items of cost and expense arising out of Customer&apos;s failure to apply the international carriage terms to the Shipping Documentation for such international shipments, including without limitation claims from the recipient of any shipment, and Customer&apos;s failure to follow instructions in regard to the placement of the terms on the Shipping Documentation for such international shipments.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>(iii) Printed Signature. Customer acknowledges that if WELLWELL.ae is used to process shipments to locations outside the United Arab Emirates or country of shipment origin, Customer must enter the name of the person completing the Shipping Documentation to print in lieu of its manual signature on the Shipping Documentation, as applicable, for all shipments tendered by Customer to WELLWELL Express using WELLWELL.ae. Customer further acknowledges that such printed name shall be sufficient to constitute the Customer&apos;s signature, and Customer&apos;s acceptance of the terms and conditions of carriage contained in the applicable transportation agreement, tariff, Service Guide, Standard Conditions, or Shipping Documentation, under which the shipment is accepted by WELLWELL Express, or its independent contractor.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>(iv) Unless otherwise indicated, the shipper&apos;s address indicated on the face of any Shipping Documentation is the place of execution and the place of departure and the recipient&apos;s address listed on the face of the Shipping Documentation is the place of destination. Unless otherwise indicated on the face of the Shipping Documentation the first carrier of all shipments is WELLWELL Express.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 16. WELLWELL Express Messaging system</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL Express provides You with the opportunityto use messaging system to send a message to the recipient informing him/her of Your shipment. This feature is provided free of charge. WELLWELL Express may modify or terminate the use of this feature at any time.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>WELLWELL Express does not commit to keeping Your message private or confidential. By using WELLWELL Express messaging system, You acknowledge that WELLWELL Express is providing the technical functionality only, and that You are solely responsible for the content of Your messages. WELLWELL Express undertakes no duty to monitor any messages sent by You. However, WELLWELL Express, in its sole discretion, may elect, but is not obligated, to look at Your messages to protect itself.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>Do not use WELLWELL Express messaging system for anything other than to communicate information about Your shipment. You may not use WELLWELL Express messaging system to disseminate inflammatory, infringing, obscene, or other unlawful information, or to threaten, harass, abuse or otherwise violate the legal rights of others or perform any act contrary to law. If WELLWELL Express sees or hears about messages sent via WELLWELL Express messaging system that violate these provisions, or that may damage WELLWELL Express, it may take all actions necessary to protect itself, including disclosing any messages to the authorities.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>It is not necessary to use WELLWELL Express messaging system to ship a package via WELLWELL.ae. WELLWELL Express will not be liable for any failure or delay, for any reason, in the transmission, receipt, or acknowledgment of any messages sent by or to You.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 17. Address Book</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>Subject to the terms listed here, addresses will remain in Your Address Book as long as You use WELLWELL.ae. If You do not use WELLWELL.ae for a period of 6 months, WELLWELL Express will delete Your addresses.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>However, WELLWELL Express will not delete Your account. If You have any concerns, please email FedEx at&nbsp;</span><a href="mailto:info@wellwell.ae"><span style='font-size:18px;font-family:"Arial","sans-serif";'>info@wellwell.ae</span></a><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>&nbsp;The Address Book is a feature provided free of charge by WELLWELL Express. You should maintain a back-up copy of Your addresses as WELLWELL Express will not be responsible for the loss of addresses contained in the Address Book. WELLWELL Express may modify or terminate this feature at any time for any reason.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:15.0pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:12px;font-family:"Arial","sans-serif";color:#333333;'>&nbsp;</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:15.0pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:12px;font-family:"Arial","sans-serif";color:#333333;'>&nbsp;</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:15.0pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:12px;font-family:"Arial","sans-serif";color:#333333;'>&nbsp;</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:15.0pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:12px;font-family:"Arial","sans-serif";color:#333333;'>&nbsp;</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 18. Courtesy Rate Quote</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>The courtesy rate reflected by the Courtesy Rate Quote on WELLWELL.ae, if shown, may be different than the actual charges for Your shipment. Differences may occur based on actual weight, dimensions, and other factors. Consult the applicable WELLWELL Express Service Guide or the WELLWELL Express Rate Sheets for details on how shipping charges are calculated.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 19. WELLWELL Express Tracking Signature Proof of Delivery</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>In addition to the WELLWELL.ae Terms of Use, the following terms and conditions govern your access and use of Signature Proof of Delivery. By accessing and using Signature Proof of Delivery, you acknowledge and agree that you are the shipper, the recipient, or third-party payor, or are authorized to act on behalf of the shipper, recipient, or third party payor to retrieve the signature image for the shipment you are attempting to track. You warrant and agree, on behalf of yourself and all persons on whose behalf you are acting in accessing and using Signature Proof of Delivery, that you will not use the signature image for any purpose other than to confirm the delivery of such shipment. You further acknowledge and agree, on behalf of yourself and all persons on whose behalf you are acting in accessing and using Signature Proof of Delivery, (i) to defend (at WELLWELL Express option), indemnify, and hold harmless WELLWELL Express, its parent and its parent company&apos;s subsidiary companies (collectively &quot;WELLWELL Express&quot; for purposes of this paragraph) from and against any and all claims of whatever nature arising from your access and use of Signature Proof of Delivery, and the receipt, use and emailing of any signature retrieved; (ii) that Signature Proof of Delivery is provided &quot;AS IS&quot; and you assume all risk of accessing and using Signature Proof of Delivery; (iii) that WELLWELL EXPRESS DISCLAIMS ANY AND ALL WARRANTIES OR CONDITIONS OF WHATEVER NATURE, INCLUDING THE IMPLIED WARRANTIES OR CONDITIONS OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE IN RESPECT TO SIGNATURE PROOF OF DELIVERY; (iv) you will only email Signature Proof of Delivery to the shipper, recipient or third party payor of the shipment you are attempting to retrieve; (v) that under no circumstances shall WELLWELL Express be liable for any money or other damages resulting from the access and use of Signature Proof of Delivery and that WELLWELL Express hereby disclaims liability for any such damage; and, (vi) that your actions and shipments are further governed by, and you will comply with, the terms and conditions in the applicable Service Guide or transportation agreement.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 21. WELLWELL Express Tracking Updates</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>In addition to the WELLWELL.ae Terms of Use, the following additional terms and conditions govern the access and use of this tracking update subscription application to request tracking information updates (&quot;Tracking Updates&quot;). WELLWELL Express authorizes You to request Tracking Updates for a shipment for which You are the shipper, recipient or third-party payor and You agree to only request Tracking Updates for a shipment for which You are the shipper, recipient, or third-party payor subject to these Terms and Conditions. You acknowledge and agree that Tracking Updates are the private property of WELLWELL Express, are provided to You free of charge and that any use of Tracking Updates information is at Your sole risk. Tracking Updates are provided &quot;AS IS&quot; and WELLWELL Express disclaims all Warranties or conditions, Express or Implied.</span></p>
<p style='margin-top:15.0pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:15.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:20px;font-family:"inherit","serif";color:#333333;'>Section 22. WELLWELL Express Delivery</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>In order to facilitate delivery or release of a shipment, WELLWELL Express may, at its sole discretion, offer certain delivery options and functionality to residential Recipients through WELLWELL Express Delivery. As a condition for approval to register for and use WELLWELLExpress Delivery, Recipient agrees to these terms:</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>I. Recipient represents and warrants that Recipient: resides at the address provided for enrollment; is authorized to enroll and receive shipments at the address; will only register for himself/herself; will only register nicknames that are associated with Recipient&rsquo;s name and identity; is 13 years of age or older.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>II. For each shipment, Recipient represents and warrants that Recipient is authorized by the Shipper to use or request the WELLWELL Express Delivery options and functionality.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>III. Recipient agrees to pay any fees associated with WELLWELL Express Delivery options that are offered by WELLWELL Express for a fee.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>IV. The contract of carriage governed by the WELLWELL Express Terms and Conditions or WELLWELL Express Service Guide shall at all times remain with the Shipper, as that term is defined in the WELLWELL Express Service Guide, and nothing in these WELLWELL Express Delivery Terms shall be construed to create a contract of carriage with the Recipient. WELLWELL Express Delivery options and functionality, including those offered for a fee to the Recipient, are governed solely by the terms in this WELLWELL Express Delivery section of the WELLWELL.ae Terms of Use.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>V. In no event shall WELLWELL Express, including, without limitation, agents, contractors, employees and affiliates, be liable for any damages, including but not limited to special, incidental or consequential damages, including, without limitation, loss of profits or income, whether or not WELLWELL Express had knowledge that such damages might be incurred, from honoring, or our failure to honor, any request for delivery instructions, preferences, delivery suspension, routing instruction or other delivery request from the Recipient. Notwithstanding, a refund of the WELLWELL Express Delivery fee as outlined below is the exclusive remedy in the event of WELLWELL Express&rsquo;s failure to honor the Recipient&rsquo;s request for WELLWELL Express Delivery options.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>VII. Refund Requests: To qualify for a refund, you must notify us of a delivery option failure and request a refund of your charges in compliance with the conditions listed below. If you do not comply with these conditions, you are not entitled to receive a refund and cannot recover compensation for a delivery option failure in any lawsuit.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>1. You may request a refund of charges due to a delivery option failure by submitting your request through the billing adjustment process via costumer support team</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>2. Your notification of a delivery option failure must include the tracking number.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>3. All requests for refund or credit of charges must be received within 30 calendar days from the ship date.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>VII. If the Sign for A Package option is selected, Recipient authorizes WELLWELL Express to leave the shipment, and any other eligible shipment available for delivery, at the recipient&rsquo;s location and releases WELLWELL Express from all liability for any loss or damage that may result from leaving the shipment at Recipient&rsquo;s request.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>VIII. If Recipient provides delivery instructions, preferences, or requests to suspend deliveries for their address, Recipient releases WELLWELL Express from all liability for any loss or damage that may result from WELLWELL Express following the delivery instructions, preferences, or requests to suspend deliveries.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>IX. Recipient understands that WELLWELL Express Delivery calendar and tracking visibility will be based on information readily available to WELLWELL Express, that it may be limited, estimated or incomplete and that such information may change or be modified.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:18.0pt;font-size:15px;font-family:"Calibri","sans-serif";'><span style='font-size:18px;font-family:"Arial","sans-serif";color:#333333;'>X. Recipient agrees not to sue WELLWELL Express as a class plaintiff or class representative, join as a class member, or participate as an adverse party in any way in a class-action lawsuit against WELLWELL Express regarding any Delivery.</span></p>
</p>
                                            
										</div>
										<div class="col-sm-1"></div>

                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group">
                          <center>
                          <input type="checkbox" id="agree" name="agree">
                          <label for="agree">I read all term and conditions and i Agree</label>
                          </center>
                    </div>
                </div>
                <div class="col-sm-3"></div>


		                            </div>
                                </div>
                                

                                

                                <div class="tab-pane" id="signature">
		                                <div class="row">
                                        <h4 class="info-text"> Signature</h4>
                                            {{-- <div class="col-sm-2"></div> --}}
		                                	<div class="col-sm-12">
                                                <!-- <div class="col-12">
                                                    <h6 class="py-50">Signature</h6>
                                                </div> -->
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
                                            <div class="col-sm-2"></div>
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

	    {{-- <div class="footer">
	        <div class="container text-center">
	             Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/bootstrap-wizard">here.</a>
	        </div>
	    </div> --}}
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




// function sweetAlert(){
//     Swal.fire({
//       title: "Please Check Your Email",
//       text: "Successfully Save!",
//       type: "success",
//       confirmButtonClass: 'btn btn-primary',
//       buttonsStyling: false,
//     }).then(function() {
//     window.location.href="/assets/login";
//     });
// }

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
            password: {
                required: true,
                minlength: 6,
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                equalTo : "#password"
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
            description: {
                required: true,
                minlength: 12,
            },
            agree:{
                required: true,
            },
            emirates_id:{
                required: true,
                minlength: 15,
            },
            emirates_id_file:{
                required: true,
            },
            // user_type:{
            //     required: true,
            // }
        },
        messages: {
            emirates_id: {
                required: "Emirates ID Field is Required",
                minlength: "Emirates ID Field Minimum Lenth is 15 Digits"
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
            else if(element.attr("name") == "password_confirmation"){
                    errorName = "Confirm Password";
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
            else if(element.attr("name") == "emirates_id_file"){
                    errorName = "Choose Emirates ID";
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


//end wizard
var user_type;
function user_type_fun(data){
//      if(!$('input[name="user_type"]:checked').length) {
//   alert("You must select at least one perceived emotional state!");
//   event.preventDefault();
//   return false;
// }
$('input[name="user_type"]').prop('required', false);
    console.log(data)
    if(data == 0){
        $(".user_type_class").addClass('hide');
        $(".user_type_class").removeClass('show');
//         $(".user_type_class").each(function() {
  
// });
    }else{
        $(".user_type_class").removeClass('hide');
        $(".user_type_class").addClass('show');
    }
    user_type = data;
}


function Save(){
    if (isSign) {
        var canvas = $("#canvas").get(0);
        var imgData = canvas.toDataURL();
        jQuery('#page').find('p').remove();
        jQuery('#page').find('img').remove();

        //alert(user_type);
        var formData = new FormData($('#form')[0]);
        formData.append("user_type", user_type);
        formData.append("signature_data", imgData);
        $("#save").attr("disabled", true);
        $.ajax({
            url : '/save-user-register',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {                
                console.log(data);
                $("#form")[0].reset();
                // toastr.success(data, 'Successfully Save');
                alert('Save Successfully');
                window.location.href = '/login';
                $("#save").attr("disabled", false);

            },error: function (data) {
                var errorData = data.responseJSON.errors;
                $.each(errorData, function(i, obj) {
                toastr.error(obj[0]);
                $("#save").attr("disabled", false);
        });
        }
        });
    } else {
        alert('Please sign');
    }
}

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


</script>

</html>
