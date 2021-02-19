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
          <h2>Working <span>Hours</span></h2>
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
            <!-- <div class="card-header">
              <h4 class="card-title mb-0">View Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div> -->
            <div class="card-body">
              

            <div class="table-responsive">
                <table class="display" id="datatable">
                <thead>
                    <tr>
                    <th>Days</th>
                    <th>Opening Time</th>
                    <th>Closing Time</th>
                    <th>Open / Close</th>
                    </tr>
                </thead>
                <tbody>
<?php
$time = array('12:00 AM','12:30 AM','01:00 AM','01:30 AM','02:00 AM','02:30 AM','03:00 AM','03:30 AM','04:00 AM','04:30 AM','05:00 AM','05:30 AM','06:00 AM','06:30 AM','07:00 AM','07:30 AM','08:00 AM','08:30 AM','09:00 AM','09:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM','12:00 PM','12:30 PM','01:00 PM','01:30 PM','02:00 PM','02:30 PM','03:00 PM','03:30 PM','04:00 PM','04:30 PM','05:00 PM','05:30 PM','06:00 PM','06:30 PM','07:00 PM','07:30 PM','08:00 PM','08:30 PM','09:00 PM','09:30 PM','10:00 PM','10:30 PM','11:00 PM','11:30 PM');
?>
                @foreach($weeks as $row)
                    <tr>
                        <td>
                            {{$row->days}}
                            <input value="{{$row->id}}" type="hidden" name="timing_id[]">
                        </td>
                        <td>
                            <select name="status[]" class="form-control">
                                <option value="">SELECT</option>
                                <option {{$row->status == 1 ?'selected':''}} value="1">Open</option>
                                <option {{$row->status == 2 ?'selected':''}} value="2">Close</option>
                            </select>
                        </td>

                        <td>
                            <select name="open_time[]" class="form-control">
                                <option value="">SELECT</option>
                                @for ($i = 0; $i < 48; $i++) {
                                <option {{$row->open_time == $time[$i] ?'selected':''}} value="{{$time[$i]}}">{{$time[$i]}}</option>
                                @endfor
                            </select>
                        </td>
                        <td>
                            <select name="close_time[]" class="form-control">
                                <option value="">SELECT</option>
                                @for ($i = 0; $i < 48; $i++) {
                                <option {{$row->close_time == $time[$i] ?'selected':''}} value="{{$time[$i]}}">{{$time[$i]}}</option>
                                @endfor
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div
                    >
            <div class="row">
                <div class="col-md-12 text-right">
                  <button onclick="Update()" class="btn btn-primary btn-pill" type="button">Update</button>
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
$('.weeks').addClass('active');
function Update(){
  var formData = new FormData($('#form')[0]);
  $.ajax({
      url : '/admin/update-weeks',
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
