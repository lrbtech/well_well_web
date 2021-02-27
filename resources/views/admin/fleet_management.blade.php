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
                  <h2>Fleet Management </span></h2>
                  <h6 class="mb-0">Vehicle Management</h6>
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
                    <i class="bx bx-plus">Create Vehicle</i>
                    <span></span>
                    </button>
                
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>CAR ID</th>
                            <th>Model</th>
                            <th>Courier</th>
                            <th>VIN</th>
                            <th>Engine</th>
                            <th>Type of vehicle </th>
                            <th>Plate No</th>
                            <th>Status</th>
                            <th>Action</th>
                        
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($fleet_management as $key => $row)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->id}}</td>
                            <td>{{$row->model}}</td>
                            <td>{{$row->agent_id}}</td>
                            <td>{{$row->vin}}</td>
                            <td>{{$row->engine}}</td>
                            <td>{{$row->type_vehicle}}</td>
                            <td>{{$row->plate_no}}</td>
                            <td>
                            @if($row->status == 0)
                            Active
                            @else 
                            DeActive
                            @endif
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">

                                    <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#">{{$language[225][Auth::guard('admin')->user()->lang]}}</a>
                               
                            
                                      <a onclick="Delete({{$row->id}},1)" class="dropdown-item" href="#">{{$language[226][Auth::guard('admin')->user()->lang]}}</a>
                               
                                      <a onclick="Delete({{$row->id}},0)" class="dropdown-item" href="#">{{$language[227][Auth::guard('admin')->user()->lang]}}</a>
                             
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
        <h5 class="modal-title">New Vehicle</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
        <form id="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">

        <div class="row">
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle make</label>
              <input autocomplete="off" type="text" id="make" name="make" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle model</label>
              <input autocomplete="off" type="text" id="model" name="model" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle Model Year</label>
              <input autocomplete="off" type="text" id="model_year" name="model_year" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle color</label>
              <input autocomplete="off" type="text" id="color" name="color" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle Vin No</label>
              <input autocomplete="off" type="text" id="vin" name="vin" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle engine</label>
              <input autocomplete="off" type="text" id="engine" name="engine" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle Type</label>
              <select id="type_vehicle" name="type_vehicle" class="form-control">
              <option value="">SELECT</option>
              @foreach($vehicle_type as $row)
              <option value="{{$row->id}}">{{$row->vehicle_type}}</option>
              @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle Group</label>
              <select id="group" name="group" class="form-control">
              <option value="">SELECT</option>
              @foreach($vehicle_group as $row)
              <option value="{{$row->id}}">{{$row->vehicle_group}}</option>
              @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Department</label>
              <input autocomplete="off" type="text" id="department" name="department" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Plate No</label>
              <input autocomplete="off" type="text" id="plate_no" name="plate_no" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Vehicle Category</label>
              <select id="type" name="type" class="form-control">
              <option value="">SELECT</option>
              <option>Two Wheeler</option>
              <option>Four Wheeler</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Expirataion</label>
              <input autocomplete="off" type="text" id="expirataion" name="expirataion" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Odometer</label>
              <input autocomplete="off" type="text" id="odometer" name="odometer" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Odometer Date</label>
              <input autocomplete="off" type="date" id="odometer_date" name="odometer_date" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Insurance No</label>
              <input autocomplete="off" type="text" id="insurance_no" name="insurance_no" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Insurance Expire</label>
              <input autocomplete="off" type="date" id="insurance_expire" name="insurance_expire" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Oil Change Date</label>
              <input autocomplete="off" type="date" id="oil_change_date" name="oil_change_date" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Service Date</label>
              <input autocomplete="off" type="date" id="service_date" name="service_date" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label class="col-form-label">Choose Agent</label>
              <select id="agent_id" name="agent_id" class="form-control">
              <option value="">SELECT</option>
              @foreach($agent as $row)
              <option value="{{$row->id}}">{{$row->name}}</option>
              @endforeach
              </select>
            </div>
        </div>

        </form>
        </div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
$('.package-category').addClass('active');

var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Package Category');
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/create-fleet',
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
      url : '/admin/update-fleet',
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
    url : '/admin/edit-fleet/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Fleet');
      $('#save').text('Save Change');
      $('input[name=make]').val(data.make);
      $('input[name=model]').val(data.model);
      $('input[name=model_year]').val(data.model_year);
      $('input[name=color]').val(data.color);
      $('input[name=vin]').val(data.vin);
      $('input[name=engine]').val(data.engine);
      $('select[name=type_vehicle]').val(data.type_vehicle);
      $('input[name=department]').val(data.department);
      $('select[name=group]').val(data.group);
      $('input[name=plate_no]').val(data.plate_no);
      $('select[name=type]').val(data.type);
      $('input[name=expirataion]').val(data.expirataion);
      $('input[name=odometer]').val(data.odometer);
      $('input[name=odometer_date]').val(data.odometer_date);
      $('input[name=insurance_no]').val(data.insurance_no);
      $('input[name=insurance_expire]').val(data.insurance_expire);
      $('input[name=oil_change_date]').val(data.oil_change_date);
      $('input[name=service_date]').val(data.service_date);
      $('select[name=agent_id]').val(data.agent_id);
      $('input[name=id]').val(id);
      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}

function Delete(id,status){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/delete-fleet/'+id+'/'+status,
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