@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
@endsection
@section('section') 
<!-- Right sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>View<span>Profile</span></h2>
          <h6 class="mb-0">admin panel</h6>
        </div>
        <!-- <div class="col-lg-6 breadcrumb-right">     
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
            <li class="breadcrumb-item">Apps    </li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active"> Edit Profile</li>
          </ol>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title mb-0">My Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <form class="theme-form">
                <div class="row mb-2">
                  <div class="col-auto"><img class="img-70 rounded-circle" alt="" src="/upload_files/{{$customer->profile_image}}"></div>
                  <div class="col">
                    <h3 class="mb-1">{{$customer->first_name}} {{$customer->last_name}}</h3>
                    <!-- <p class="mb-4">DESIGNER</p> -->
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Email-Address</label>
                  <input class="form-control" type="email" value="{{$customer->email}}">
                </div>
                <div class="form-group">
                  <label class="form-label">Mobile</label>
                  <input class="form-control" type="text" value="{{$customer->mobile}}">
                </div>
                <div class="form-group">
                  <label class="form-label">Website</label>
                  <input class="form-control" type="text" value="{{$customer->website}}">
                </div>
                <!-- <div class="form-footer">
                  <button class="btn btn-primary btn-block btn-pill">Save</button>
                </div> -->
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <form class="card theme-form">
            <div class="card-header">
              <h4 class="card-title mb-0">View Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Busisness Name</label>
                    <input class="form-control" type="text" value="{{$customer->busisness_name}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">land Line</label>
                    <input class="form-control" type="text" value="{{$customer->landline}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Emirates ID</label>
                    <input class="form-control" type="text" value="{{$customer->emirates_id}}">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">Trade License Number</label>
                    <input class="form-control" type="text" value="{{$customer->trade_license}}">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label class="form-label">Vat Certficate No</label>
                    <input class="form-control" type="text" value="{{$customer->vat_certificate_no}}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">About Me</label>
                    <textarea class="form-control" rows="5" placeholder="Enter About your description">{{$customer->description}}</textarea>
                  </div>
                </div>
                <!-- <div class="col-md-12 text-right">
                  <button class="btn btn-primary btn-pill" type="submit">Update Profile</button>
                </div> -->
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">Add projects And Upload</h5>
              <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                          <label class="form-label">Emirates ID File</label>
                          <a target="_blank" href="/upload_files/{{$customer->emirates_id_file}}"><img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""></a>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                          <label class="form-label">Vat Certificate File</label>
                          <a target="_blank" href="/upload_files/{{$customer->vat_certificate_file}}"><img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""></a>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                          <label class="form-label">Trade License File</label>
                          <a target="_blank" href="/upload_files/{{$customer->trade_license_file}}"><img src="/assets/images/folder.png" class="picture-src" id="wizardPicturePreview" style="padding: 20px" title=""></a>
                          </div>
                        </div>
                      </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              @if(!empty($rate))
              <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr>
                      <th>Insurance Percentage</th>
                      <th>Cash on Delivery</th>
                      <th>Vat Percentage</th>
                      <th>Postal Charge Percentage</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(!empty($rate))
                    <tr>
                      <td>
                      @if($rate->insurance_enable == '1')
                        {{$rate->insurance_percentage}} %
                      @endif
                      </td>
                      <td>
                      @if($rate->cod_enable == '1')
                        {{$rate->cod_price}} AED
                      @endif
                    </td>
                      <td>
                      @if($rate->vat_enable == '1')
                        {{$rate->vat_percentage}} %
                      @endif
                      </td>
                      <td>
                      @if($rate->postal_charge_enable == '1')
                        {{$rate->postal_charge_percentage}} %
                      @endif
                      </td>
                    </tr>
                  @endif
                  </tbody>
                </table>
                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th colspan="3">
                          <label>Service Area Price Section</label>
                      </th>
                    </tr>
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>20 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_20_to_1000_kg_price}} AED
                      </th>
                    </tr>
                    <tr>
                      <th>Weight From</th>
                      <th>Weight To</th>
                      <th>Service Area Price</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                  @if(!empty($rate_item))
                  @foreach($rate_item as $row)
                  @if($row->status == 1)
                    <tr>
                      <td>{{$row->weight_from}}</td>
                      <td>{{$row->weight_to}}</td>
                      <td>{{$row->price}} AED</td>
                    </tr>
                  @endif
                  @endforeach
                  @endif
                  </tbody>
                </table>
                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th colspan="3">
                          <label>Same Day Delivery Area Price Section</label>
                      </th>
                    </tr>
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>20 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_20_to_1000_kg_price}} AED
                      </th>
                    </tr>
                    <tr>
                      <th>Weight From</th>
                      <th>Weight To</th>
                      <th>Same Day Delivery Price</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(!empty($rate_item))
                  @foreach($rate_item as $row)
                  @if($row->status == 2)
                    <tr>
                      <td>{{$row->weight_from}}</td>
                      <td>{{$row->weight_to}}</td>
                      <td>{{$row->price}} AED</td>
                    </tr>
                  @endif
                  @endforeach
                  @endif
                  </tbody>
                </table>
                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th colspan="4">
                          <label>Non Service Area Price Section</label>
                      </th>
                    </tr>
                    <tr style="text-align: center;">
                      <th colspan="2">
                          <label>0 to 5 kg Price = </label>
                          {{$rate->before_5_kg_price}} AED
                      </th>
                      <th colspan="2">
                          <label>Above 5 kg Price (Per kg) = </label>
                          {{$rate->above_5_kg_price}} AED
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

@endsection
@section('extra-js')
<script src="/assets/app-assets/js/chat-menu.js"></script>
@endsection
