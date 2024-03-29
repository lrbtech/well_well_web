<!doctype html>
<html lang="en" dir="rtl">
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
                            {{ csrf_field() }}   
		                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        	   بناء ملف التعريف الخاص بك

		                        	</h3>
									<h5>ستتيح لنا هذه المعلومات معرفة المزيد عنك
.</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#account" data-toggle="tab">اختر حساب
</a></li>
                                        <li><a href="#profile" data-toggle="tab">لمحة أساسية
</a></li>
                                        <li><a href="#contact" data-toggle="tab">معلومات الاتصال
</a></li>
                                        <li><a href="#notes" data-toggle="tab">ملاحظات
</a></li>
			                            <li><a href="#terms" data-toggle="tab">الأحكام والشروط
</a></li>
			                            <li><a href="#signature" data-toggle="tab">التوقيع
</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
                                <div class="tab-pane" id="account">
		                                <h4 class="info-text"> يرجى تحديد نوع العمل الخاص بك
 </h4>
		                                <div class="row">
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="col-sm-6">
		                                            <div class="choice" data-toggle="wizard-radio" onclick="user_type_fun(0)">
		                                                <input id="user_type1" type="radio" name="user_type" value="0" required>
		                                                <div class="icon">
		                                                    <i class="fa fa-user-o"></i>
		                                                </div>
		                                                <h6>الأعمال الفردية
</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-6">
		                                            <div class="choice" data-toggle="wizard-radio" onclick="user_type_fun(1)">
		                                                <input id="user_type2" type="radio" name="user_type" value="1" required>
		                                                <div class="icon">
		                                                   <i class="fa fa-briefcase" aria-hidden="true"></i>
		                                                </div>
		                                                <h6>الأعمال التجارية
</h6>
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
		                                	<h4 class="info-text"> لنبدأ بالمعلومات الأساسية
 </h4>
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
		                                        	<h6>اختر صورة الملف الشخصي
 <small>(jpg, jpeg, png)</small></h6>
		                                    	</div>
		                                	</div>
		                                	<div class="col-sm-4">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>

													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">الاسم الاول (مطلوب)
</small></label>
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
													  <label class="control-label">نشاط اسم مطلوب)
</label>
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
													  <label class="control-label">اسم العمل (مطلوب)</small></label>
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
													  <label class="control-label">البريد الإلكتروني (مطلوب)
</label>
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
													  <label class="control-label">كلمة المرور مطلوبة)
</label>
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
													  <label class="control-label">تأكيد كلمة المرور (مطلوب)
</label>
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
			                                          <label style="margin-left: 60px;" class="control-label">المحمول (مطلوب)
</label>
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
			                                          <label class="control-label">الخط الأرضي (اختياري)</label>
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
			                                          <label class="control-label">صفحة انترنت (اختياري)</label>
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
			                                          <label class="control-label">الهوية الإماراتية (مطلوب)
</label>
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
			                                          <label class="control-label">الرخصة التجارية (اختياري)</label>
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
		                                        	<h6>اختر ملف هوية الإمارات
 <small>(jpg, jpeg, png)</small></h6>
		                                    	</div>
                                            </div>
                                            
                                            <div class="col-sm-4 user_type_class">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview1" style="padding: 20px" title=""/>
		                                            	<input type="file" id="wizard-picture1" name="trade_license_file">
		                                        	</div>
		                                        	<h6>اختر ملف الرخصة التجارية <small>(jpg, jpeg, png)</small></h6>
		                                    	</div>
                                            </div>
                                            
                                            <div class="col-sm-4 user_type_class">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview2" style="padding: 20px" title=""/>
		                                            	<input type="file" id="wizard-picture2" name="vat_certificate_file">
		                                        	</div>
		                                        	<h6>اختر ملف تصديق ضريبة القيمة المضافة <small>(jpg, jpeg, png)</small></h6>
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
		                                	<h4 class="info-text"> معلومات الاتصال
</h4>
		                                	<div class="col-sm-4">
                                                <label class="control-label">دولة
</label>
                                                <select name="country_id" id="country_id" class="form-control">
                                                    <option disabled="" selected="">اختر الدولة

</option>
                                                    @foreach($country as $row)
                                                    <option value="{{$row->id}}"> {{$row->country_name_english}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="control-label">مدينة
</label>
                                                <select onChange="applyMyLocation(this);" name="city_id" id="city_id" class="form-control">
                                                    <option disabled="" selected="">اختر المدينة
</option>
                                                    @foreach($city as $row)
                                                    <option value="{{$row->id}}"> {{$row->city}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="control-label">Area</label>
                                                <select onChange="applyMyLocationCity(this);" name="area_id" id="area_id" class="form-control">
                                                    <option disabled="" selected="">اختر المدينة
</option>
                                                    @foreach($area as $row)
                                                    <option value="{{$row->id}}"> {{$row->city}} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <!-- <label class="control-label">Address Type</label> -->
                                                <select name="address_type" id="address_type" class="form-control">
                                                    <option disabled="" selected="">اختر نوع العنوان
</option>
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
			                                          <label class="control-label">اسم جهة الاتصال (مطلوب)
</label>
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
			                                          <label class="control-label">الاتصال بالهاتف المحمول (مطلوب)
</label>
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
			                                          <label class="control-label">الاتصال بالهاتف الأرضي (اختياري)
</label>
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
			                                          <label class="control-label">عنوان URL على Facebook (اختياري)
</label>
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
			                                          <label class="control-label">Twitter URL (اختياري)
</label>
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
			                                          <label class="control-label">عنوان URL لـ Instagram (اختياري)
</label>
			                                          <input name="instagram_url" id="instagram_url" type="text" class="form-control">
			                                        </div>
												</div>
                                            </div> 
                                        </div>                                        
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>أدخل موقعًا
</label>
                                                    <input id="searchInput" name="searchInput" class="input-controls form-control" type="text" placeholder="Enter a location">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>تبوك
</label>
                                                    <input id="address" name="address" class="form-control"></input>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>خط العرض
</label>
                                                    <input readonly type="text" id="latitude" name="latitude" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>خط الطول
</label>
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
		                                            <label>ملاحظات
</label>
		                                            <textarea name="description" id="description" class="form-control" placeholder="" rows="6"></textarea>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-4">
		                                    	<div class="form-group">
		                                            <label class="control-label">مثال</label>
		                                            <p class="description">"نود أن نعرف طبيعة عملك لدعمك في أحسن الأحوال ، وإسقاط بعض التفاصيل المتعلقة بعمليتك في مجال الخدمات اللوجستية ، وسوف نقوم بتدوين ذلك ، والتأكد من أن الأفضل يخدمك."</p>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            
		                        <div class="tab-pane" id="terms">
		                                <div class="row">
										<h4 class="info-text"> الأحكام والشروط
</h4>
										<div class="col-sm-1"></div>
		                                <div style="display: block;height: 300px;overflow-y: scroll;" class="col-sm-10">
                                        
                                        <?php echo $settings->terms_and_conditions; ?>
                                            
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
                                        <h4 class="info-text"> التوقيع
</h4>
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
                                                        <center><input class="btn btn-primary glow" id="btnClearSign" type="button" value="واضح"وonclick="init_Sign_Canvas()" /></center>
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
    
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">

     <script src="{{ asset('assets/toastr/toastr.min.js')}}" type="text/javascript"></script>
    <script>
/* script */

function applyMyLocation(sel){
    select_location='';
    var id = $('#city_id').val();
    $('#searchInput').val($( "#city_id option:selected" ).text()); 
    $('#searchInput').focus(); 
    select_location = $( "#city_id option:selected" ).text();
}
function applyMyLocationCity(sel){
if(select_location !=''){
    $('#searchInput').val( select_location+' '+$( "#area_id option:selected" ).text()); 
    $('#searchInput').focus(); 
}
select_location = $( "#city_id option:selected" ).text();
}

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
                minlength:9,
                maxlength:9,
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
                minlength:15,
                maxlength:15,
            },
            emirates_id_file:{
                required: true,
                extension: "pdf|jpg|jpeg|png",
                //filesize: 1000000   //max size 1 mb
            },
            vat_certificate_file:{
                //required: true,
                extension: "pdf|jpg|jpeg|png",
                //filesize: 1000000   //max size 1 mb
            },
            trade_license_file:{
                //required: true,
                extension: "pdf|jpg|jpeg|png",
               // filesize: 1000000   //max size 1 mb
            },
            address: {
                required: true,
            },
            contact_name: {
                required: true,
            },
            contact_mobile: {
                required: true,
                minlength:9,
                maxlength:9,
            },
            latitude: {
                required: true,
            },
            longitude: {
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
            else if (element.attr("name") == "address") {
                    errorName = "Pick Address";
            } 
            else if (element.attr("name") == "latitude") {
                errorName = "Pick To Address";
            } 
            else if (element.attr("name") == "longitude") {
                errorName = "Pick To Address";
            } 
            else if (element.attr("name") == "contact_name") {
                    errorName = "Contact Name";
            } 
            else if (element.attr("name") == "contact_mobile") {
                errorName = "Contact Mobile";
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
                Swal.fire({
                text: "Thanks for the Registration please Verify your Email",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok!'
                }).then((result) => {
                if (result.isConfirmed) {
                    console.log(data);
                    $("#form")[0].reset();
                    // toastr.success(data, 'Successfully Save');
                   // alert('Save Successfully');
                    window.location.href = '/login';
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

$('#email').blur(function(){
  var email = $('#email').val();
  $.ajax({
    url : '/email-validate/'+email,
    type: "GET",
    success: function(data)
    {
        if(data.status == 0){
            toastr.error('This Email Address Has been Already Registered');
            $('#email').focus();
            $('#email').val('');
        }
    }
  });
});

$('#mobile').blur(function(){
  var mobile = $('#mobile').val();
  $.ajax({
    url : '/mobile-validate/'+mobile,
    type: "GET",
    success: function(data)
    {
        if(data.status == 0){
            toastr.error('This Mobile Has been Already Registered');
            $('#mobile').focus();
            $('#mobile').val('');
        }
    }
  });
});


</script>

</html>
