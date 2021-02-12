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
                  <h2>{{$language[73][Auth::guard('admin')->user()->lang]}} <span>{{$language[74][Auth::guard('admin')->user()->lang]}}</span></h2> 
                  <!-- <h6 class="mb-0">View Shipment</h6>-->
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
                    <div class="row">

                        <div class="col-md-3">
                          <label>{{$language[75][Auth::guard('admin')->user()->lang]}}</label>
                          <select id="agent_id" name="agent_id" class="form-control">
                            <option value="">{{$language[76][Auth::guard('admin')->user()->lang]}}</option>
                            @foreach($agent as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                            <button id="save" class="btn btn-primary btn-block mr-10" type="button">{{$language[77][Auth::guard('admin')->user()->lang]}}</button>
                        </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="datatable">
                        <thead>
                          <tr>
                            <th><input type="checkbox" name="order_master_checkbox" class="order_master_checkbox" value=""/></th>
                            <th>User ID</th>
                            <th>{{$language[59][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[78][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[32][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[24][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[28][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[15][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th>
                          </tr>
                        </thead>
                        <tbody>

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


@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>
  <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<script type="text/javascript">
$('.new-shipment-request').addClass('active');


var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/admin/get-new-shipment-request",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        { data: 'checkbox', name: 'checkbox' , orderable:false, searchable:false },
        { data: 'user_id', name: 'user_id' },
        { data: 'shipment_date', name: 'shipment_date' },
        { data: 'shipment_time', name: 'shipment_time' },
        { data: 'shipment_mode', name: 'shipment_mode' },
        { data: 'from_address', name: 'from_address' },
        { data: 'to_address', name: 'to_address' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action' },
    ]
});

$(document).on('click','.order_master_checkbox', function(){
  if($(".order_master_checkbox").prop('checked') == true){
      $(".order_checkbox").prop('checked',true);
  } else{
      $(".order_checkbox").prop('checked',false);
  }
});


$(document).on('click','#save', function(){
    var order_id=[];
    var agent_id = $('#agent_id').val();

  if(agent_id != ''){
    $(".order_checkbox:checked").each(function(){
        order_id.push($(this).val());
    });
    if(order_id.length > 0){
        $.ajax({
            url:"/admin/checkbox-assign-agent",
            method:"GET",
            data:{id:order_id,agent_id:agent_id},
            success:function(data){
              toastr.success(data);
              //window.location.href="/admin/new-shipment-request";
              var new_url = '/admin/get-new-shipment-request';
              orderPageTable.ajax.url(new_url).load();
            }
        })
    }else{
        toastr.error("Please select atleast one Checkbox");
    }
  }else{
    toastr.error("Please select Agent");
  }
});
</script>
@endsection