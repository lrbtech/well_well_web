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
                  <h2>{{$language[298][Auth::guard('admin')->user()->lang]}} </span></h2>
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
                    <!-- <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
                    <i class="bx bx-plus"></i>
                    <span>{{$language[121][Auth::guard('admin')->user()->lang]}}</span>
                    </button> -->
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{$language[215][Auth::guard('admin')->user()->lang]}} / {{$language[216][Auth::guard('admin')->user()->lang]}} / {{$language[217][Auth::guard('admin')->user()->lang]}}</th>
                                <th>{{$language[218][Auth::guard('admin')->user()->lang]}}</th>
                         
                                <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th>
                                <th>{{$language[219][Auth::guard('admin')->user()->lang]}}</th>
                                <th>{{$language[220][Auth::guard('admin')->user()->lang]}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($systemLogs as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                            @if($row->category == 'shipment')
                              @foreach($shipment as $ship)
                                @if($row->_id == $ship->id)
                                {{$ship->order_id}}
                                @endif
                              @endforeach
                            @else 
                            {{$row->_id}}
                            @endif
                            </td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->to_id}}</td>
                            <td>{{$row->category}}</td>
                            <td>{{$row->remark}}</td>
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
$('.country').addClass('active');



</script>
@endsection