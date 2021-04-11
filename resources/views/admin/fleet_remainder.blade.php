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
                  <h2>Fleet Management Remainder </span></h2>
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
                            <th>#</th>
                            <th>CAR ID</th>
                            <th>Model</th>
                            <th>Courier</th>
                            <th>VIN</th>
                            <th>Engine</th>
                            <th>Type of vehicle </th>
                            <th>Vehicle Group</th>
                            <th>Plate No</th>
                            <th>Status</th>                        
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($fleet_management as $key => $row)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->id}}</td>
                            <td>{{$row->model}}</td>
                            <td>
                            @foreach($agent as $agent1)
                            @if($agent1->id == $row->agent_id)
                            {{$agent1->name}}
                            @endif
                            @endforeach
                            </td>
                            <td>{{$row->vin}}</td>
                            <td>{{$row->engine}}</td>
                            <td>
                            @foreach($vehicle_type as $vehicle_type1)
                            @if($vehicle_type1->id == $row->type_vehicle)
                            {{$vehicle_type1->vehicle_type}}
                            @endif
                            @endforeach
                            </td>
                            <td>
                            @foreach($vehicle_group as $vehicle_group1)
                            @if($vehicle_group1->id == $row->group)
                            {{$vehicle_group1->vehicle_group}}
                            @endif
                            @endforeach
                            </td>
                            <td>{{$row->plate_no}}</td>
                            <td>
                            @if($row->status == 0)
                            Active
                            @else 
                            DeActive
                            @endif
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
$('.get-remainder').addClass('active');

</script>
@endsection