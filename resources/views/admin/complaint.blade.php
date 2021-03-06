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
                  <h2>Complaint <span>Request  </span></h2>
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
                    @if($role_get->complaint_request_create == 'on')
                    <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
                    <i class="bx bx-plus"></i>
                    <span>New Complaint Request</span>
                    </button>
                    @endif
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Tracking Id</th>
                                <th>{{$language[15][Auth::guard('admin')->user()->lang]}}</th>
                                <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($complaint as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->mobile}}</td>
                            <td>
                            <a href="/admin/complaint-shipment/{{$row->track_id}}">{{$row->track_id}}</a>
                            </td>
                            <td>
                            @if($row->status == 0)
                            {{$language[227][Auth::guard('admin')->user()->lang]}}
                            @else 
                            {{$language[226][Auth::guard('admin')->user()->lang]}}
                            @endif
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$language[16][Auth::guard('admin')->user()->lang]}}</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    @if($role_get->complaint_request_edit == 'on')
                                    <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#">{{$language[225][Auth::guard('admin')->user()->lang]}}</a>
                                    @endif
                                    <!-- @if($row->status == 0)
                                      <a onclick="Delete({{$row->id}},1)" class="dropdown-item" href="#">{{$language[226][Auth::guard('admin')->user()->lang]}}</a>
                                    @else 
                                      <a onclick="Delete({{$row->id}},0)" class="dropdown-item" href="#">{{$language[227][Auth::guard('admin')->user()->lang]}}</a>
                                    @endif -->
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
        <h5 class="modal-title">{{$language[221][Auth::guard('admin')->user()->lang]}}</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
        <form id="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">

        <div class="form-group">
            <label class="col-form-label">Name</label>
            <input autocomplete="off" type="text" id="name" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label class="col-form-label">Mobile</label>
            <input autocomplete="off" type="text" id="mobile" name="mobile" class="form-control">
        </div>

        <div class="form-group">
            <label class="col-form-label">Email Id</label>
            <input autocomplete="off" type="email" id="email" name="email" class="form-control">
        </div>

        
        <div class="form-group">
            <label class="col-form-label">Tracking id</label>
            <input autocomplete="off" type="number" id="track_id" name="track_id" class="form-control">
        </div>

        <div class="form-group">
            <label class="col-form-label">Damage Category</label>
            <select id="damage_category" name="damage_category" class="form-control">
            <option value="">SELECT</option>
            <option value="1">Outer Package Damage</option>
            <option value="2">Inner Package Damage</option>
            <option value="3">Inside Package Damage</option>
            </select>
        </div>

        <div class="form-group">
            <label class="col-form-label">Complaint Category</label>
            <select id="complaint_category" name="complaint_category" class="form-control">
            <option value="">SELECT</option>
            <option value="1">Rude Behaviour</option>
            <option value="2">Billing Charge</option>
            <option value="3">Wrong Shipment</option>
            <option value="4">Loss of Packages</option>
            <option value="5">C.O.D Issues</option>
            </select>
        </div>

        <div class="form-group">
            <label class="col-form-label">Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>


        </form>
        </div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">{{$language[233][Auth::guard('admin')->user()->lang]}}</button>
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
$('.complaint').addClass('active');
var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Complaint');
});
function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-complaint',
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
      url : '/admin/update-complaint',
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
    url : '/admin/edit-complaint/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Complint');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=email]').val(data.email);
      $('input[name=mobile]').val(data.mobile);
      $('input[name=track_id]').val(data.track_id);
      $('select[name=damage_category]').val(data.damage_category);
      $('select[name=complaint_category]').val(data.complaint_category);
      $('textarea[name=description]').val(data.description);
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
        url : '/admin/complaint-delete/'+id+'/'+status,
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