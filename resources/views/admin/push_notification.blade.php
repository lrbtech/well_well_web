@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/select2.css">

@endsection
@section('section')        
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>View <span>Push Notification  </span></h2>
                  <h6 class="mb-0">admin panel</h6>
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
                    @if($role_get->push_notification_create == 'on')
                    <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
                    <i class="bx bx-plus"></i>
                    <span>New Push Notification</span>
                    </button>
                    @endif
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Send To</th>
                            <th>Date and Time</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($push_notification as $key => $row)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->description}}</td>
                            <td>
                                @if($row->send_to == 1)
                                All Agent
                                @elseif($row->send_to == 2)
                                All Customer
                                @elseif($row->send_to == 3)
                                Selected Agent
                                @elseif($row->send_to == 4)
                                Selected Customer
                                @endif
                            </td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->expiry_date}}</td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    @if($row->expiry_date != '')
                                    @if($row->expiry_date >= date('Y-m-d'))
                                    @if($role_get->push_notification_edit == 'on')
                                    <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                                    <a onclick="SendNotification({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-chat mr-1"></i> Send</a>
                                    @endif
                                    @if($role_get->push_notification_delete == 'on')
                                    <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                                    @endif
                                    
                                    @else
                                    <a class="dropdown-item" href="#">Expired</a>
                                    @endif
                                    @else
                                    @if($role_get->push_notification_edit == 'on')
                                    <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                                    <a onclick="SendNotification({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-chat mr-1"></i> Send</a>
                                    @endif
                                    @if($role_get->push_notification == 'on')
                                    <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
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


<style>
    .select2-container {
    z-index: 99999;
    }
</style>
<div class="modal fade" id="popup_modal" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
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
            <label>Title</label>
            <input autocomplete="off" type="text" id="title" name="title" class="form-control">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Send To</label>
            <select onchange="usertype()" id="send_to" name="send_to" class="form-control">
                <option value="">SELECT</option>
                <option value="1">All Agent</option>
                <option value="2">All Customer</option>
                <option value="3">Selected Agent</option>
                <option value="4">Selected Customer</option>
            </select>
        </div>

        <div class="form-group" id="agentshow">
            <label>Select the Agent</label>
            <select style="width:100% !imporatnt;" id="agent_id" name="agent_id[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                @foreach ($agent as $agent1)
                <option value="{{$agent1->id}}">{{$agent1->name}}</option>
                @endforeach
            </select>
        </div>



        <div class="form-group" id="usershow">
            <label>Select the Customer</label>
            <select style="width:100% !imporatnt;" id="customer_id" name="customer_id[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                @foreach ($user as $user1)
                <option value="{{$user1->id}}">{{$user1->first_name}} {{$user1->last_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Expiry Date</label>
            <input autocomplete="off" type="date" id="expiry_date" name="expiry_date" class="form-control">
        </div>
                    

        </form>
        </div>
        <div class="modal-footer">
            <button onclick="Save()" id="saveButton" class="btn btn-secondary" type="button">Save</button>
            <button onclick="Send()" id="sendButton" class="btn btn-secondary" type="button">Save & Send</button>
        </div>
    </div>
    </div>
</div>


@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

  <script src="/assets/app-assets/js/select2/select2.full.min.js"></script>
  <script src="/assets/app-assets/js/select2/select2-custom.js"></script>

  <script type="text/javascript">
$('.push-notification').addClass('active');
$("#agentshow").hide();
$("#usershow").hide();
$('#agent_id').select2();
$('#customer_id').select2();

// $(".select2").select2({
//     dropdownAutoWidth: true,
//     width: '100%',
//     //color:'#fff';
// });

$('#agent_id').select2({
    dropdownParent: $('#popup_modal')
});

function usertype(){
  var send_to = $("#send_to").val();
  if(send_to == '1'){
    $("#agentshow").hide();
    $("#usershow").hide();
  }
  else if(send_to == '2'){
    $("#agentshow").hide();
    $("#usershow").hide();
  }
  else if(send_to == '3'){
    $("#agentshow").show();
    $("#usershow").hide();
  }
  else if(send_to == '4'){
    $("#usershow").show();
    $("#agentshow").hide();
  }
}

var action_type;

$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Push Notification');
    $('#agent_id').select2();
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-notification',
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
      url : '/admin/update-notification',
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

function Send(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-send-notification',
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
      url : '/admin/update-send-notification',
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
    url : '/admin/notification/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Notification');
      $('#save').text('Save Change');
      $('input[name=title]').val(data.title);
      $('input[name=expiry_date]').val(data.expiry_date);
      $('textarea[name=description]').val(data.description);
      $('select[name=send_to]').val(data.send_to);
      $('input[name=id]').val(id);
      $('#agent_id').select2();

      if(data.send_to == '1'){
        $("#agentshow").hide();
        $("#usershow").hide();
      }
      else if(data.send_to == '2'){
        $("#agentshow").hide();
        $("#usershow").hide();
      }
      else if(data.send_to == '3'){
        $("#agentshow").show();
        $("#usershow").hide();
        get_notification_agent(data.id);
      }
      else if(data.send_to == '4'){
        $("#usershow").show();
        $("#agentshow").hide();
        get_notification_user(data.id);
      }

      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}

function get_notification_agent(id)
{
    $.ajax({        
        url : '/admin/get-notification-agent/'+id,
        type: "GET",
        success: function(data)
        {
           $('#agent_id').html(data);
        }
   });
}

function get_notification_user(id)
{
    $.ajax({        
        url : '/admin/get-notification-user/'+id,
        type: "GET",
        success: function(data)
        {
           $('#customer_id').html(data);
        }
   });
}

function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/notification-delete/'+id,
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

function SendNotification(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/notification-send/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Send');
          location.reload();
        }
      });
    } 
}

</script>
@endsection