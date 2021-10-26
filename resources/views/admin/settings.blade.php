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
          <h2>{{$language[3][Auth::guard('admin')->user()->lang]}}<span>{{$language[132][Auth::guard('admin')->user()->lang]}}</span></h2>
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

                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">{{$language[133][Auth::guard('admin')->user()->lang]}} (%)</label>
                    <input class="form-control" type="number" id="insurance_percentage" name="insurance_percentage" value="{{$settings->insurance_percentage}}">
                  </div>
                </div>

                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">{{$language[134][Auth::guard('admin')->user()->lang]}} (%)</label>
                    <input class="form-control" type="number" id="vat_percentage" name="vat_percentage" value="{{$settings->vat_percentage}}">
                  </div>
                </div>

                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">0 to 30 Kgs {{$language[66][Auth::guard('admin')->user()->lang]}} (%)</label>
                    <input class="form-control" type="number" id="postal_charge_percentage" name="postal_charge_percentage" value="{{$settings->postal_charge_percentage}}">
                  </div>
                </div>

                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">Gust User COD Price</label>
                    <input class="form-control" type="number" id="cod_amount" name="cod_amount" value="{{$settings->cod_amount}}">
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
$('.settings').addClass('active');
function Update(){
  var formData = new FormData($('#form')[0]);
  $.ajax({
      url : '/admin/update-settings',
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
