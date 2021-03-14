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
                  <h2>Agent Settlement <span>Details </span></h2> 
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
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Paid Amount</th>
                            <th>Mode</th>
                            <th>Receiver</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($agent_settlement as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{date("d-m-Y",strtotime($row->created_at))}}</td>
                            <td>{{$row->amount}} AED</td>
                            </td>
                            <td>
                                @if($row->mode == 1)
                                COD 
                                @else 
                                GUEST
                                @endif
                            </td>
                            <td>
                                @foreach($user as $user1)
                                @if($user1->id == $row->receiver_id)
                                <p>{{$user1->name}}</p>
                                <p>{{$user1->employee_id}}</p>
                                @endif
                                @endforeach
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

@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

  <script type="text/javascript">
$('.payments-in-report').addClass('active');

</script>
@endsection