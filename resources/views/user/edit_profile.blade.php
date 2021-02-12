@extends('user.layouts')
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
          <h2>{{$language[146][Auth::user()->lang]}}<span>{{$language[147][Auth::user()->lang]}}</span></h2>
          <h6 class="mb-0">{{$language[9][Auth::user()->lang]}}</h6>
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
  <form id="form" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="hidden" name="id" name="id" value="{{$customer->id}}">
  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title mb-0">{{$language[148][Auth::user()->lang]}}</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <form class="theme-form">
                <div class="row mb-2">
                  <div class="col-auto"><img class="img-70 rounded-circle" alt="" src="/upload_files/{{$customer->profile_image}}"></div>
                  <div class="col">
                    <h3 class="mb-1">{{$customer->first_name}} {{$customer->last_name}}</h3>
                    <!-- <p class="mb-4">DESIGNER</p> -->
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">{{$language[150][Auth::user()->lang]}}</label>
                  <input readonly class="form-control" type="email" name="email" id="email" value="{{$customer->email}}">
                </div>
                <div class="form-group">
                  <label class="form-label">{{$language[14][Auth::user()->lang]}}</label>
                  <input class="form-control" type="text" name="mobile" id="mobile" value="{{$customer->mobile}}">
                </div>
                <div class="form-group">
                  <label class="form-label">{{$language[151][Auth::user()->lang]}}</label>
                  <input class="form-control" type="text" id="website" name="website" value="{{$customer->website}}">
                </div>
                <!-- <div class="form-footer">
                  <button class="btn btn-primary btn-block btn-pill">Save</button>
                </div> -->
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <form class="card theme-form">
            <div class="card-header">
              <h4 class="card-title mb-0">{{$language[149][Auth::user()->lang]}}</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">{{$language[152][Auth::user()->lang]}}</label>
                    <input class="form-control" type="text" name="business_name" id="business_name" value="{{$customer->business_name}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">{{$language[153][Auth::user()->lang]}}</label>
                    <input class="form-control" type="text" value="{{$customer->landline}}" id="landline" name="landline">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">{{$language[154][Auth::user()->lang]}}</label>
                    <input class="form-control" type="text" value="{{$customer->emirates_id}}" id="emirates_id" name="emirates_id">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">{{$language[155][Auth::user()->lang]}}</label>
                    <input class="form-control" type="text" value="{{$customer->trade_license}}" id="trade_license" name="trade_license">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">{{$language[156][Auth::user()->lang]}}</label>
                    <input class="form-control" type="text" value="{{$customer->vat_certificate_no}}" name="vat_certificate_no" id="vat_certificate_no">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">{{$language[157][Auth::user()->lang]}}</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter About your description">{{$customer->description}}</textarea>
                  </div>
                </div>
                <!-- <div class="col-md-12 text-right">
                  <button class="btn btn-primary btn-pill" type="submit">Update Profile</button>
                </div> -->
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label class="form-label">{{$language[158][Auth::user()->lang]}}</label>
                    <input class="form-control" type="file" name="emirates_id_file" id="emirates_id_file">
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label class="form-label">{{$language[159][Auth::user()->lang]}}</label>
                    <input class="form-control" type="file" name="vat_certificate_file" id="vat_certificate_file">
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label class="form-label">{{$language[160][Auth::user()->lang]}}</label>
                    <input class="form-control" type="file" name="trade_license_file" id="trade_license_file">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">{{$language[161][Auth::user()->lang]}}</h5>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                          <label class="form-label">{{$language[158][Auth::user()->lang]}}</label>
                          <a target="_blank" href="/upload_files/{{$customer->emirates_id_file}}"><img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""></a>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                          <label class="form-label">{{$language[159][Auth::user()->lang]}}</label>
                          <a target="_blank" href="/upload_files/{{$customer->vat_certificate_file}}"><img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""></a>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                          <label class="form-label">{{$language[160][Auth::user()->lang]}}</label>
                          <a target="_blank" href="/upload_files/{{$customer->trade_license_file}}"><img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""></a>
                          </div>
                        </div>
                      </div>
            </div>
          </div>
        </div>
        
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-footer text-right">
                    <button onclick="Save()" class="btn btn-primary m-r-15" type="button">{{$language[162][Auth::user()->lang]}}</button>
                    <button class="btn btn-light" type="button">{{$language[72][Auth::user()->lang]}}</button>
                  </div>
                </div>
            </div>
      </div>
    </div>
  </div>

  <!-- Container-fluid Ends-->
</div>
</form>

@endsection
@section('extra-js')
<script src="/assets/app-assets/js/chat-menu.js"></script>

<script>
function Save(){
  var formData = new FormData($('#form')[0]);
  $.ajax({
      url : '/user/update-profile',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {                
          $("#form")[0].reset();
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
