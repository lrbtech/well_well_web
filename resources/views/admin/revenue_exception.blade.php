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
                  <h2>{{$language[205][Auth::guard('admin')->user()->lang]}}  <span>{{$language[206][Auth::guard('admin')->user()->lang]}} </span></h2>
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
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{$language[207][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[208][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[209][Auth::guard('admin')->user()->lang]}} * {{$language[210][Auth::guard('admin')->user()->lang]}} * {{$language[211][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[212][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[213][Auth::guard('admin')->user()->lang]}} * {{$language[210][Auth::guard('admin')->user()->lang]}} * {{$language[211][Auth::guard('admin')->user()->lang]}}</th>
                            <th>{{$language[16][Auth::guard('admin')->user()->lang]}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($revenue_exception as $key => $row)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->shipment_id}}</td>
                            <td>{{$row->old_weight}} Kg</td>
                            <td>{{$row->old_length}} * {{$row->old_width}} * {{$row->old_height}} CM</td>
                            <td>{{$row->weight}} Kg</td>
                            <td>{{$row->length}} * {{$row->width}} * {{$row->height}} CM</td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="/admin/view-shipment/{{$row->shipment_id}}">View Shipment</a>
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


@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

  <script type="text/javascript">
$('.revenue-exception').addClass('active');

</script>
@endsection