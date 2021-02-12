@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
@endsection
@section('section')        
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>{{$language[3][Auth::guard('admin')->user()->lang]}}
                    <span>{{$language[93][Auth::guard('admin')->user()->lang]}}  </span></h2>
                  <h6 class="mb-0">{{$language[9][Auth::guard('admin')->user()->lang]}}</h6>
                </div>
                <!-- <div class="col-lg-6 breadcrumb-right">     
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item">Data Tables</li>
                    <li class="breadcrumb-item active">Basic Init</li>
                  </ol>
                </div> -->
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <!-- <h5>Zero Configuration</h5><span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span><span>Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</span> -->
                    <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
                    <i class="bx bx-plus"></i>
                    <span>{{$language[94][Auth::guard('admin')->user()->lang]}}</span>
                    </button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{$language[12][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[13][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[14][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($agent as $key => $row)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->mobile}}</td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#">Edit</a>
                                    @if(Auth::guard('admin')->user()->role_id == '0')
                                    <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#">Delete</a>
                                    @endif
                                </div>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->


            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>


<div class="modal fade" id="popup_modal"  tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Add New</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
        <form id="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">

        <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">Agent ID</label>
              <input autocomplete="off" type="text" id="agent_id" name="agent_id" class="form-control">
          </div>

          <div class="form-group col-md-6">
              <label class="col-form-label">Name</label>
              <input autocomplete="off" type="text" id="name" name="name" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">Email ID</label>
              <input autocomplete="off" type="email" id="email" name="email" class="form-control">
          </div>

          <div class="form-group col-md-6">
              <label class="col-form-label">Mobile Number</label>
              <input autocomplete="off" type="text" id="mobile" name="mobile" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">Date of Birth</label>
              <input autocomplete="off" type="date" id="dob" name="dob" class="form-control">
          </div>

          <div class="form-group col-md-6">
              <label class="col-form-label">Gender</label>
              <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                  <div class="radio radio-primary">
                  <input value="male" id="gender1" type="radio" name="gender" >
                  <label class="mb-0" for="gender1">Male</label>
                  </div>
                  <div class="radio radio-primary">
                  <input value="female" id="gender2" type="radio" name="gender">
                  <label class="mb-0" for="gender2">Female</label>
                  </div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control">
          </div>

          <div class="form-group col-md-6">
              <label class="col-form-label">Confirm Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
          </div>
         </div>
        
         <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">Select City</label>
              <select id="city_id" name="city_id" class="form-control">
                  <option value="">SELECT</option>
                  @foreach($city as $row)
                  <option value="{{$row->id}}">{{$row->city}}</option>
                  @endforeach
              </select>
          </div>

          <!-- <div class="form-group col-md-6">
              <label class="col-form-label">Select Area</label>
              <select id="area_ids" name="area_ids" class="form-control">
                  <option value="">SELECT</option>
                  @foreach($area as $row)
                  <option value="{{$row->id}}">{{$row->city}}</option>
                  @endforeach
              </select>
          </div> -->
         </div>

         <div class="row">
            <div class="form-group col-md-6">
              <label class="col-form-label">Driving License Number</label>
              <input type="text" id="driving_license" name="driving_license" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <label class="col-form-label">Driving License File</label>
              <input type="file" id="driving_license_file" name="driving_license_file" class="form-control">
            </div>
         </div>

         <div class="row">
            <div class="form-group col-md-6">
              <label class="col-form-label">Emirates ID Number</label>
              <input type="text" id="emirates_id" name="emirates_id" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <label class="col-form-label">Emirates ID File</label>
              <input type="file" id="emirates_id_file" name="emirates_id_file" class="form-control">
            </div>
         </div>

         <div class="row">
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle Number</label>
              <input type="text" id="vehicle_number" name="vehicle_number" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle Details</label>
              <textarea class="form-control" name="vehicle_details" id="vehicle_details"></textarea>
            </div>
         </div>

        <div class="row">

          <div class="form-group col-md-4">
            <div class="checkbox checkbox-primary">
              <input value="1" id="pickup" name="pickup" type="checkbox">
              <label for="pickup">Pickup</label>
            </div>
          </div>

          <div class="form-group col-md-4">
            <div class="checkbox checkbox-primary">
              <input value="1" id="delivery" name="delivery" type="checkbox">
              <label for="delivery">Delivery</label>
            </div>
          </div>

          <div class="form-group col-md-4">
            <div class="checkbox checkbox-primary">
              <input value="1" id="revenue_exception" name="revenue_exception" type="checkbox">
              <label for="revenue_exception">Revenue Exception</label>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="form-group col-md-4">
            <div class="checkbox checkbox-primary">
              <input value="1" id="cash_report" name="cash_report" type="checkbox">
              <label for="cash_report">Cash Report</label>
            </div>
          </div>

          <div class="form-group col-md-4">
            <div class="checkbox checkbox-primary">
              <input value="1" id="hub" name="hub" type="checkbox">
              <label for="hub">Hub</label>
            </div>
          </div>

          <div class="form-group col-md-4">
            <div class="checkbox checkbox-primary">
              <input value="1" id="van_scan" name="van_scan" type="checkbox">
              <label for="van_scan">Van Scan</label>
            </div>
          </div>

        </div>

        

        </form>
        </div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <button onclick="Save()" class="btn btn-primary" type="button">Save</button>
        </div>
    </div>
    </div>
</div>


@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

<script type="text/javascript">
$('.agent').addClass('active');

var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Agent');
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-agent',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#popup_modal').modal('hide');
            location.reload();
            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
  }else{
    $.ajax({
      url : '/admin/update-agent',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {
        console.log(data);
          $("#form")[0].reset();
           $('#popup_modal').modal('hide');
           location.reload();
           toastr.success(data, 'Successfully Update');
      },error: function (data) {
        var errorData = data.responseJSON.errors;
        $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
        });
      }
    });
  }
}

function Edit(id){
  $.ajax({
    url : '/admin/edit-agent/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Agent');
      $('#save').text('Save Change');
      $('input[name=agent_id]').val(data.agent_id);
      $('input[name=name]').val(data.name);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('input[name=driving_license]').val(data.driving_license);
      $('input[name=emirates_id]').val(data.emirates_id);
      $('input[name=vehicle_number]').val(data.vehicle_number);
      $('textarea[name=vehicle_details]').val(data.vehicle_details);
      $('select[name=city_id]').val(data.city_id);
      //$('select[name=area_ids]').val(data.area_ids);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#gender1').prop("checked", true);
      }
      else{
        $('#gender2').prop("checked", true);
      }

      if(data.pickup == 1){
        $('#pickup').prop("checked", true);
      }
      else{
        $('#pickup').prop("checked", false);
      }

      if(data.delivery == 1){
        $('#delivery').prop("checked", true);
      }
      else{
        $('#delivery').prop("checked", false);
      }

      if(data.van_scan == 1){
        $('#van_scan').prop("checked", true);
      }
      else{
        $('#van_scan').prop("checked", false);
      }

      if(data.cash_report == 1){
        $('#cash_report').prop("checked", true);
      }
      else{
        $('#cash_report').prop("checked", false);
      }

      if(data.hub == 1){
        $('#hub').prop("checked", true);
      }
      else{
        $('#hub').prop("checked", false);
      }

      if(data.revenue_exception == 1){
        $('#revenue_exception').prop("checked", true);
      }
      else{
        $('#revenue_exception').prop("checked", false);
      }


      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}

function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/delete-agent/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Delete');
          location.reload();
        }
      });
    } 
}

</script>
@endsection