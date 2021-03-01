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
                  <h2>{{$language[3][Auth::guard('admin')->user()->lang]}} <span>{{$language[96][Auth::guard('admin')->user()->lang]}}  </span></h2>
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
                   
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>option</th>
                            <th>Read</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Create</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                         
                            <tr>
                            <td>Dashboard</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                      
                            </td>
                            <td>
                             
                            </td>
                            <td>
                       
                            </td>
                            
                            </td>
                          </tr>
                          
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>

                            <tr>
                            <td>New Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                            <tr>
                            <td>All Customer</td>
                            <td>
                         <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                       <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            <td>
                                <div class="media-body text-center icon-state switch-outline">
                          <label class="switch">
                            <input type="checkbox"><span class="switch-state bg-primary"></span>
                          </label>
                        </div>
                            </td>
                            
                            </td>
                          </tr>
                    
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

        <div class="form-group">
            <label class="col-form-label">{{$language[98][Auth::guard('admin')->user()->lang]}}</label>
            <input autocomplete="off" type="text" id="role_name" name="role_name" class="form-control">
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
$('.role').addClass('active');
var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Department');
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-role',
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
      url : '/admin/update-role',
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
    url : '/admin/edit-role/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Department');
      $('#save').text('Save Change');
      $('input[name=role_name]').val(data.role_name);
      $('input[name=id]').val(id);
      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}

function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/delete-role/'+id,
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