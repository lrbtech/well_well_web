@extends('user.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/timepicker.css">
@endsection
@section('section')
      <!-- Right sidebar Ends-->
      <form id="form" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input value="{{ $user->id }}" type="hidden" name="id" id="id">
      <div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>Change <span>Passowrd  </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/user/dashboard"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item">Profile</li>
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
                    <h5>Change</h5><span>Password </span>
                  </div>
                  <div class="card-body megaoptions-border-space-sm">
                  
                    <div class="row">
                      <div class="col">

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Old Password </label>
                            <div class="col-sm-6">
                              <input class="form-control" name="oldpassword" id="oldpassword" type="text">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">New Password </label>
                            <div class="col-sm-6">
                              <input class="form-control" name="password" id="password" type="password">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Password Confirmation</label>
                            <div class="col-sm-6">
                              <input class="form-control" name="password_confirmation" id="password_confirmation" type="password">
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
                    <button onclick="Save()" class="btn btn-primary m-r-15" type="button">Update</button>
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

<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">

<script type="text/javascript">
$('.change-password').addClass('active');


function Save(){
  //alert($("#service_id").val());
  var formData = new FormData($('#form')[0]);
  $.ajax({
      url : '/user/change-password',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {
        console.log(data);                
        if(data.status == 1){
        	$("#form")[0].reset();
        	toastr.success('Change Password Successfully', 'Successfully Update');
        	window.location.href="/user/dashboard/";
    	}
    	else{
    		toastr.error(data.message);
    	}
      },
      error: function (data, errorThrown) {
        var errorData = data.responseJSON.errors;
        $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
        });
      }
  });
}
</script>
@endsection