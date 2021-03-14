@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
@endsection
@section('section') 
<!-- Right sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Social<span> Media Links</span></h2>
          <h6 class="mb-0">{{$language[9][Auth::guard('admin')->user()->lang]}}</h6>
        </div>
        <!-- <div class="col-lg-6 breadcrumb-right">     
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
            <li class="breadcrumb-item">Apps    </li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active"> Edit Profile</li>
          </ol>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-lg-12">
          <form id="form" method="POST" class="card theme-form">
          {{ csrf_field() }}
          <input type="hidden" name="id" id="id" value="{{$settings->id}}">
            <!-- <div class="card-header">
              <h4 class="card-title mb-0">View Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div> -->
            <div class="card-body">
              <div class="row">

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label class="form-label">Facebook Url</label>
                    <input class="form-control" type="text" id="facebook_url" name="facebook_url" value="{{$settings->facebook_url}}">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label class="form-label">Twitter Url</label>
                    <input class="form-control" type="text" id="twitter_url" name="twitter_url" value="{{$settings->twitter_url}}">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label class="form-label">Linkedin Url</label>
                    <input class="form-control" type="text" id="linkedin_url" name="linkedin_url" value="{{$settings->linkedin_url}}">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label class="form-label">Instagram Url</label>
                    <input class="form-control" type="text" id="instagram_url" name="instagram_url" value="{{$settings->instagram_url}}">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label class="form-label">Youtube Url</label>
                    <input class="form-control" type="text" id="youtube_url" name="youtube_url" value="{{$settings->youtube_url}}">
                  </div>
                </div>


                <div class="col-md-12 text-right">
                  <button onclick="Update()" class="btn btn-primary btn-pill" type="button">{{$language[135][Auth::guard('admin')->user()->lang]}}</button>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

@endsection
@section('extra-js')
<script src="/assets/app-assets/js/chat-menu.js"></script>

<script>
$('.social-media-link').addClass('active');
function Update(){
  var formData = new FormData($('#form')[0]);
  $.ajax({
      url : '/admin/update-social-media-link',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {                
        $("#form")[0].reset();
        location.reload();
        toastr.success(data, 'Successfully Save');
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
