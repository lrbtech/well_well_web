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
                  <h2>View <span>Customer  </span></h2>
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
                  <!-- <div class="card-header">
                    <h5>Zero Configuration</h5><span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span><span>Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</span>
                  </div> -->
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                          <th>ID</th>
                            <th>Business Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($customer as $key => $row)
                        @if($row->status >= 3)
                          <tr>
                          <td>{{$row->customer_id}}</td>
                            <td>
                              @if($row->user_type == 0)
                              Individual Business
                              @else
                              Commercial Business
                              @endif
                            </td>
                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                            <td>
                            @if($row->status == 0)
                                <p class="alert alert-danger dark" >{{$row->email}}</p>
                            @else
                                <p class="alert alert-success dark">{{$row->email}}</p>
                            @endif
                            </td>
                            <td>{{$row->mobile}}</td>
                            <td>
                            @if($row->status == 0)
                            Pending
                            @elseif($row->status == 1)
                            Not Verify
                            @elseif($row->status == 2)
                            Verified
                            @elseif($row->status == 3)
                            Sales team Verified
                            @elseif($row->status == 4)
                            Accounts Team Verified
                            @endif
                            </td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                @if($row->status == 3)
                                  <a onclick="updateAccountStatus({{$row->id}},4)" class="dropdown-item" href="#">Account Verfication Confirm</a>
                                @elseif($row->status == 4)
                                  <a onclick="updateSalesStatus({{$row->id}},3)" class="dropdown-item" href="#">Block User</a>
                                @endif
                                    
                                    <a class="dropdown-item" href="/admin/view-profile/{{$row->id}}">View Profile</a>
                                </div>
                            </td>
                          </tr>
                        @endif
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

@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

<script type="text/javascript">
$('.view-customer').addClass('active');
function updateAccountStatus(id,status){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/update-account-status/'+id+'/'+status,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Update');
          location.reload();
        }
      });
    } 
}


</script>
@endsection