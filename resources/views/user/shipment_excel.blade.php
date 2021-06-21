@extends('user.layouts')
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
                  <h2>Upload <span>Excel </span></h2> 
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
                <form action="/user/upload-shipment-excel" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="card-header">

@if(count($errors) > 0)
<div class="alert alert-danger">
    Upload Validation Error<br><br>
    <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif

@if($message = Session::get('success'))
<div class="alert alert-success alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif
                    <div class="row">
                        <h2>
                        Sample Excel File Download <a href="/excel/customer_excel_structure.xlsx">Here</a>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-9">
                            <label>Excel</label>
                            <input autocomplete="off" type="file" id="excel_file" name="excel_file" class="form-control">
                        </div>                        

                        <div class="form-group col-md-2">
                            <button id="exceldownload" class="btn btn-primary btn-block mr-10" type="submit">Upload Excel
                            </button>
                        </div>
                    </div>
                    
                  </div>
                  </form>
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
$('.shipment-excel').addClass('active');

</script>
@endsection