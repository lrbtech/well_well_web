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
                  <h2>{{$language[3][Auth::guard('admin')->user()->lang]}} <span>{{$language[8][Auth::guard('admin')->user()->lang]}}  </span></h2>
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
                    <span>{{$language[95][Auth::guard('admin')->user()->lang]}}</span>
                    </button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{$language[10][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[12][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[13][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[14][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $key => $row)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->employee_id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->mobile}}</td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$language[16][Auth::guard('admin')->user()->lang]}}</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#">{{$language[178][Auth::guard('admin')->user()->lang]}}</a>
                                    @if(Auth::guard('admin')->user()->role_id == '0')
                                    <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#">{{$language[193][Auth::guard('admin')->user()->lang]}}</a>
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
        <h5 class="modal-title">{{$language[172][Auth::guard('admin')->user()->lang]}}</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
        <form id="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">

        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-form-label">{{$language[194][Auth::guard('admin')->user()->lang]}}</label>
            <input autocomplete="off" type="text" id="employee_id" name="employee_id" class="form-control">
          </div>

          <div class="form-group col-md-6">
            <label class="col-form-label">{{$language[12][Auth::guard('admin')->user()->lang]}}</label>
            <input autocomplete="off" type="text" id="name" name="name" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">{{$language[209][Auth::guard('admin')->user()->lang]}}</label>
              <input autocomplete="off" type="email" id="email" name="email" class="form-control">
          </div>

          <div class="form-group col-md-6">
              <label class="col-form-label">{{$language[195][Auth::guard('admin')->user()->lang]}}</label>
              <input autocomplete="off" type="text" id="mobile" name="mobile" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">{{$language[196][Auth::guard('admin')->user()->lang]}}</label>
              <input autocomplete="off" type="date" id="dob" name="dob" class="form-control">
          </div>

          <div class="form-group col-md-6">
              <label class="col-form-label">{{$language[197][Auth::guard('admin')->user()->lang]}}</label>
              <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                  <div class="radio radio-primary">
                  <input value="male" id="radioinline1" type="radio" name="gender" >
                  <label class="mb-0" for="radioinline1">{{$language[210][Auth::guard('admin')->user()->lang]}}</label>
                  </div>
                  <div class="radio radio-primary">
                  <input value="female" id="radioinline2" type="radio" name="gender">
                  <label class="mb-0" for="radioinline2">{{$language[211][Auth::guard('admin')->user()->lang]}}</label>
                  </div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">{{$language[198][Auth::guard('admin')->user()->lang]}}</label>
              <input type="password" id="password" name="password" class="form-control">
          </div>

          <div class="form-group col-md-6">
              <label class="col-form-label">{{$language[199][Auth::guard('admin')->user()->lang]}}</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
          </div>
         </div>

         <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">{{$language[200][Auth::guard('admin')->user()->lang]}}</label>
              <select id="role_id" name="role_id" class="form-control">
                  <option value="">{{$language[201][Auth::guard('admin')->user()->lang]}}</option>
                  <option value="0">{{$language[202][Auth::guard('admin')->user()->lang]}}</option>
                  <option value="1">{{$language[203][Auth::guard('admin')->user()->lang]}}</option>
                  <option value="2">{{$language[204][Auth::guard('admin')->user()->lang]}}</option>
                  <option value="3">{{$language[205][Auth::guard('admin')->user()->lang]}}</option>
                  <option value="4">{{$language[206][Auth::guard('admin')->user()->lang]}}</option>
                  <option value="5">{{$language[207][Auth::guard('admin')->user()->lang]}}</option>
                  <option value="6">{{$language[208][Auth::guard('admin')->user()->lang]}}</option>
              </select>
          </div>

          <div class="form-group col-md-6">
              <label class="col-form-label">{{$language[212][Auth::guard('admin')->user()->lang]}}</label>
              <select id="station_id" name="station_id" class="form-control">
                  <option value="0">{{$language[213][Auth::guard('admin')->user()->lang]}}</option>
                  @foreach($station as $row)
                  <option value="{{$row->id}}">{{$row->station}}</option>
                  @endforeach
              </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
              <label class="col-form-label">{{$language[214][Auth::guard('admin')->user()->lang]}}</label>
              <input type="file" id="profile_image" name="profile_image" class="form-control">
          </div>
         </div>

         <div class="row">
          <div class="col-sm-12">
            <h5>{{$language[215][Auth::guard('admin')->user()->lang]}}</h5>
          </div>

          <div class="col">
            <div class="form-group m-t-15 m-checkbox-inline mb-0">

              <!-- <div class="checkbox checkbox-dark">
                <input id="dashboard" name="dashboard" type="checkbox">
                <label for="dashboard"><span class="digits"> Dashboard</span></label>
              </div> -->

              <div class="checkbox checkbox-dark">
                <input id="view_customer" name="view_customer" type="checkbox">
                <label for="view_customer"><span class="digits">{{$language[216][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="new_shipment" name="new_shipment" type="checkbox">
                <label for="new_shipment"><span class="digits"> {{$language[217][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="new_shipment_request" name="new_shipment_request" type="checkbox">
                <label for="new_shipment_request"><span class="digits"> {{$language[218][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="schedule_for_pickup" name="schedule_for_pickup" type="checkbox">
                <label for="schedule_for_pickup"><span class="digits"> {{$language[219][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="pickup_exception" name="pickup_exception" type="checkbox">
                <label for="pickup_exception"><span class="digits"> {{$language[220][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="package_collected" name="package_collected" type="checkbox">
                <label for="package_collected"><span class="digits"> {{$language[221][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="transit_in" name="transit_in" type="checkbox">
                <label for="transit_in"><span class="digits"> {{$language[222][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="transit_out" name="transit_out" type="checkbox">
                <label for="transit_out"><span class="digits"> {{$language[223][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="ready_for_delivery" name="ready_for_delivery" type="checkbox">
                <label for="ready_for_delivery"><span class="digits"> {{$language[224][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="delivery_exception" name="delivery_exception" type="checkbox">
                <label for="delivery_exception"><span class="digits"> {{$language[225][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="shipment_delivered" name="shipment_delivered" type="checkbox">
                <label for="shipment_delivered"><span class="digits"> {{$language[226][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="cancel_request" name="cancel_request" type="checkbox">
                <label for="cancel_request"><span class="digits"> {{$language[227][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="all_shipment" name="all_shipment" type="checkbox">
                <label for="all_shipment"><span class="digits"> {{$language[228][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="agent" name="agent" type="checkbox">
                <label for="agent"><span class="digits"> {{$language[229][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="employee" name="employee" type="checkbox">
                <label for="employee"><span class="digits"> {{$language[230][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="shipment_report" name="shipment_report" type="checkbox">
                <label for="shipment_report"><span class="digits"> {{$language[231][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="revenue_report" name="revenue_report" type="checkbox">
                <label for="revenue_report"><span class="digits"> {{$language[232][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="agent_report" name="agent_report" type="checkbox">
                <label for="agent_report"><span class="digits"> {{$language[233][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="user_report" name="user_report" type="checkbox">
                <label for="user_report"><span class="digits"> {{$language[234][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="country" name="country" type="checkbox">
                <label for="country"><span class="digits"> {{$language[235][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="package_category" name="package_category" type="checkbox">
                <label for="package_category"><span class="digits"> {{$language[236][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="exception_category" name="exception_category" type="checkbox">
                <label for="exception_category"><span class="digits"> {{$language[237][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="station" name="station" type="checkbox">
                <label for="station"><span class="digits"> {{$language[238][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="financial_settings" name="financial_settings" type="checkbox">
                <label for="financial_settings"><span class="digits"> {{$language[239][Auth::guard('admin')->user()->lang]}}</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="common_price" name="common_price" type="checkbox">
                <label for="common_price"><span class="digits"> Common Price</span></label>
              </div>

              <div class="checkbox checkbox-dark">
                <input id="language" name="language" type="checkbox">
                <label for="language"><span class="digits"> Languages</span></label>
              </div>



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
$('.user').addClass('active');
var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add User');

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});


});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-user',
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
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


    }
    });
  }else{
    $.ajax({
      url : '/admin/update-user',
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
    url : '/admin/edit-user/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});

      $('#modal-title').text('Update User');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=employee_id]').val(data.employee_id);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=email]').val(data.email);
      $('input[name=dob]').val(data.dob);
      $('select[name=role_id]').val(data.role_id);
      $('select[name=station_id]').val(data.station_id);
      $('input[name=id]').val(id);

      if(data.gender == 'male'){
        $('#radioinline1').prop("checked", true);
      }
      else{
        $('#radioinline2').prop("checked", true);
      }

$.each([ 'language','common_price','financial_settings','station','exception_category','package_category','country','user_report','agent_report','revenue_report','shipment_report','employee','agent','all_shipment','cancel_request','shipment_delivered','delivery_exception','ready_for_delivery','transit_out','transit_in','package_collected','pickup_exception','schedule_for_pickup','new_shipment_request','new_shipment','view_customer' ], function( index, value ) {

  if (data[value] == 'on'){ 
    if ($('#'+value)[0].checked){ 
      // nothing
    }else{
      $('#'+value).trigger('click').attr("checked", "checked"); 
    }
  }
  else{ 
    if ($('#'+value).checked){ 
      $('#'+value).trigger('click').removeAttr("checked"); 
    }else{ 
      // nothing, already off
    }
  }

//alert( index + ": " + value );
});


      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}

function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/delete-user/'+id,
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