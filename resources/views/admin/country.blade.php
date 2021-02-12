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
                  <h2>{{$language[3][Auth::guard('admin')->user()->lang]}} <span>{{$language[120][Auth::guard('admin')->user()->lang]}}  </span></h2>
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
                    <span>{{$language[121][Auth::guard('admin')->user()->lang]}}</span>
                    </button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{$language[122][Auth::guard('admin')->user()->lang]}}</th>
                                <th>{{$language[123][Auth::guard('admin')->user()->lang]}}</th>
                                <!-- <th>Country Name Arabic</th> -->
                                <th>{{$language[124][Auth::guard('admin')->user()->lang]}}</th>
                                <th>{{$language[15][Auth::guard('admin')->user()->lang]}}</th>
                                <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($country as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$row->country_code}}</td>
                            <td>
                            <a href="/admin/city/{{$row->id}}">{{$row->country_name_english}}</a>
                            </td>
                            <!-- <td>{{$row->country_name_arabic}}</td> -->
                            <td>
                                <img style="width: 100px;height: 100px;" src="/upload_files/{{$row->image}}">
                            </td>
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
                                    <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#">Edit</a>
                                    @if(Auth::guard('admin')->user()->role_id == '0')
                                    @if($row->status == 0)
                                      <a onclick="Delete({{$row->id}},1)" class="dropdown-item" href="#">DeActive</a>
                                    @else 
                                      <a onclick="Delete({{$row->id}},0)" class="dropdown-item" href="#">Active</a>
                                    @endif
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
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Add New</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
        <form id="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id">

        <div class="form-group">
            <label class="col-form-label">Country Code</label>
            <input autocomplete="off" type="text" id="country_code" name="country_code" class="form-control">
        </div>

        <div class="form-group">
            <label class="col-form-label">Country Name English</label>
            <input autocomplete="off" type="text" id="country_name_english" name="country_name_english" class="form-control">
        </div>

        <!-- <div class="form-group">
            <label class="col-form-label">Country Name Arabic</label>
            <input autocomplete="off" type="text" id="country_name_arabic" name="country_name_arabic" class="form-control">
        </div>

        
        <div class="form-group">
            <label class="col-form-label">Phone Count</label>
            <input autocomplete="off" type="text" id="phone_count" name="phone_count" class="form-control">
        </div> -->

        <div class="form-group">
            <label class="col-form-label">Image</label>
            <input type="file" id="image" name="image" class="form-control">
            <input type="hidden" id="image1" name="image1">
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
$('.country').addClass('active');
var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Country');
});
function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-country',
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
      url : '/admin/update-country',
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
    url : '/admin/country/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Country');
      $('#save').text('Save Change');
      $('input[name=country_name_arabic]').val(data.country_name_arabic);
      $('input[name=country_name_english]').val(data.country_name_english);
      $('input[name=phone_count]').val(data.phone_count);
      $('input[name=image1]').val(data.image);
      $('input[name=country_code]').val(data.country_code);
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
        url : '/admin/country-delete/'+id+'/'+status,
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