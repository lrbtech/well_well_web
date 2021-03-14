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
                  <h2>Edit <span>Role </span></h2>
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
          <form id="form" action="#" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="id" id="id" value="{{$role->id}}" >
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Role Name</label>
                        <input value="{{$role->role_name}}" autocomplete="off" type="text" id="role_name" name="role_name" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table style="width:100% !important;" class="display">
                        <thead>
                          <tr>
                            <th>Option</th>
                            <th style="text-align:center;">Read</th>
                            <th style="text-align:center;">Create</th>
                            <th style="text-align:center;">Edit</th>
                            <th style="text-align:center;">Delete</th>
                          </tr>
                        </thead>
                        <tbody>

 <tr>
  <td>Dashboard</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->dashboard == 'on' ? ' checked' : '') }} id="dashboard" name="dashboard" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>All Customer</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->all_customer == 'on' ? ' checked' : '') }} id="all_customer" name="all_customer" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->all_customer_edit == 'on' ? ' checked' : '') }} id="all_customer_edit" name="all_customer_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->all_customer_delete == 'on' ? ' checked' : '') }} id="all_customer_delete" name="all_customer_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>New Customer</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->new_customer == 'on' ? ' checked' : '') }} id="new_customer" name="new_customer" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->new_customer_edit == 'on' ? ' checked' : '') }} id="new_customer_edit" name="new_customer_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->new_customer_delete == 'on' ? ' checked' : '') }} id="new_customer_delete" name="new_customer_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Sales Team</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->sales_team == 'on' ? ' checked' : '') }} id="sales_team" name="sales_team" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->sales_team_edit == 'on' ? ' checked' : '') }} id="sales_team_edit" name="sales_team_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->sales_team_delete == 'on' ? ' checked' : '') }} id="sales_team_delete" name="sales_team_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Accounts Team</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->accounts_team == 'on' ? ' checked' : '') }} id="accounts_team" name="accounts_team" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->accounts_team_edit == 'on' ? ' checked' : '') }} id="accounts_team_edit" name="accounts_team_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->accounts_team_delete == 'on' ? ' checked' : '') }} id="accounts_team_delete" name="accounts_team_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Create Shipment</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->create_shipment == 'on' ? ' checked' : '') }} id="create_shipment" name="create_shipment" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Create Special Shipment</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->create_special_shipment == 'on' ? ' checked' : '') }} id="create_special_shipment" name="create_special_shipment" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>All Shipment</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->all_shipment == 'on' ? ' checked' : '') }} id="all_shipment" name="all_shipment" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Revenue Exception</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->revenue_exception == 'on' ? ' checked' : '') }} id="revenue_exception" name="revenue_exception" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Cancel Shipment</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->cancel_shipment == 'on' ? ' checked' : '') }} id="cancel_shipment" name="cancel_shipment" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Shipment Hold</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->shipment_hold == 'on' ? ' checked' : '') }} id="shipment_hold" name="shipment_hold" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>New Pickup Request</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->new_pickup_request == 'on' ? ' checked' : '') }} id="new_pickup_request" name="new_pickup_request" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->new_pickup_request_edit == 'on' ? ' checked' : '') }} id="new_pickup_request_edit" name="new_pickup_request_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Guest Pickup Request</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->guest_pickup_request == 'on' ? ' checked' : '') }} id="guest_pickup_request" name="guest_pickup_request" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->guest_pickup_request_edit == 'on' ? ' checked' : '') }} id="guest_pickup_request_edit" name="guest_pickup_request_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Today Bulk Pickup Request</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->today_bulk_pickup_request == 'on' ? ' checked' : '') }} id="today_bulk_pickup_request" name="today_bulk_pickup_request" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->today_bulk_pickup_request_edit == 'on' ? ' checked' : '') }} id="today_bulk_pickup_request_edit" name="today_bulk_pickup_request_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Future Bulk Pickup Request</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->future_bulk_pickup_request == 'on' ? ' checked' : '') }} id="future_bulk_pickup_request" name="future_bulk_pickup_request" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->future_bulk_pickup_request_edit == 'on' ? ' checked' : '') }} id="future_bulk_pickup_request_edit" name="future_bulk_pickup_request_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Pickup Asigned</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->pickup_assigned == 'on' ? ' checked' : '') }} id="pickup_assigned" name="pickup_assigned" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Pickup Exception</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->pickup_exception == 'on' ? ' checked' : '') }} id="pickup_exception" name="pickup_exception" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->pickup_exception_edit == 'on' ? ' checked' : '') }} id="pickup_exception_edit" name="pickup_exception_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Package Collected</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->package_collected == 'on' ? ' checked' : '') }} id="package_collected" name="package_collected" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Transit In</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->transit_in == 'on' ? ' checked' : '') }} id="transit_in" name="transit_in" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Transit Out</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->transit_out == 'on' ? ' checked' : '') }} id="transit_out" name="transit_out" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Package At Station</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->package_at_station == 'on' ? ' checked' : '') }} id="package_at_station" name="package_at_station" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Van for Delivery</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->van_for_delivery == 'on' ? ' checked' : '') }} id="van_for_delivery" name="van_for_delivery" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Delivery Exception</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->delivery_exception == 'on' ? ' checked' : '') }} id="delivery_exception" name="delivery_exception" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Shipment Delivered</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->shipment_delivered == 'on' ? ' checked' : '') }} id="shipment_delivered" name="shipment_delivered" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Today Delivery</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->today_delivery == 'on' ? ' checked' : '') }} id="today_delivery" name="today_delivery" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Future Delivery</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->future_delivery == 'on' ? ' checked' : '') }} id="future_delivery" name="future_delivery" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Couriers</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->couriers == 'on' ? ' checked' : '') }} id="couriers" name="couriers" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->couriers_create == 'on' ? ' checked' : '') }} id="couriers_create" name="couriers_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->couriers_edit == 'on' ? ' checked' : '') }} id="couriers_edit" name="couriers_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->couriers_delete == 'on' ? ' checked' : '') }} id="couriers_delete" name="couriers_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Employess</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->employees == 'on' ? ' checked' : '') }} id="employees" name="employees" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->employees_create == 'on' ? ' checked' : '') }} id="employees_create" name="employees_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->employees_edit == 'on' ? ' checked' : '') }} id="employees_edit" name="employees_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->employees_delete == 'on' ? ' checked' : '') }} id="employees_delete" name="employees_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>


<tr>
  <td>Vehicle Managesment</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle == 'on' ? ' checked' : '') }} id="vehicle" name="vehicle" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_create == 'on' ? ' checked' : '') }} id="vehicle_create" name="vehicle_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_edit == 'on' ? ' checked' : '') }} id="vehicle_edit" name="vehicle_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_delete == 'on' ? ' checked' : '') }} id="vehicle_delete" name="vehicle_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Vehicle Group</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_group == 'on' ? ' checked' : '') }} id="vehicle_group" name="vehicle_group" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_group_create == 'on' ? ' checked' : '') }} id="vehicle_group_create" name="vehicle_group_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_group_edit == 'on' ? ' checked' : '') }} id="vehicle_group_edit" name="vehicle_group_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_group_delete == 'on' ? ' checked' : '') }} id="vehicle_group_delete" name="vehicle_group_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Vehicle Type</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_type == 'on' ? ' checked' : '') }} id="vehicle_type" name="vehicle_type" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_type_create == 'on' ? ' checked' : '') }} id="vehicle_type_create" name="vehicle_type_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_type_edit == 'on' ? ' checked' : '') }} id="vehicle_type_edit" name="vehicle_type_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->vehicle_type_delete == 'on' ? ' checked' : '') }} id="vehicle_type_delete" name="vehicle_type_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Shipment Report</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->shipment_report == 'on' ? ' checked' : '') }} id="shipment_report" name="shipment_report" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Revenue Report</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->revenue_report == 'on' ? ' checked' : '') }} id="revenue_report" name="revenue_report" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Agent Report</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->agent_report == 'on' ? ' checked' : '') }} id="agent_report" name="agent_report" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Generate Invoice</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->generate_invoice == 'on' ? ' checked' : '') }} id="generate_invoice" name="generate_invoice" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Guest Generate Invoice</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->guest_generate_invoice == 'on' ? ' checked' : '') }} id="guest_generate_invoice" name="guest_generate_invoice" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Invoice History</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->invoice_history == 'on' ? ' checked' : '') }} id="invoice_history" name="invoice_history" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Courier Team COD Settlement Report</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->courier_team_cod_settlement_report == 'on' ? ' checked' : '') }} id="courier_team_cod_settlement_report" name="courier_team_cod_settlement_report" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Courier Team Guest Settlement Report</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->courier_team_guest_settlement_report == 'on' ? ' checked' : '') }} id="courier_team_guest_settlement_report" name="courier_team_guest_settlement_report" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Accounts Team Settlement Report</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->accounts_team_settlement_report == 'on' ? ' checked' : '') }} id="accounts_team_settlement_report" name="accounts_team_settlement_report" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Payments Out Report</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->payments_out_report == 'on' ? ' checked' : '') }} id="payments_out_report" name="payments_out_report" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Country</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->country == 'on' ? ' checked' : '') }} id="country" name="country" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->country_create == 'on' ? ' checked' : '') }} id="country_create" name="country_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->country_edit == 'on' ? ' checked' : '') }} id="country_edit" name="country_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->country_delete == 'on' ? ' checked' : '') }} id="country_delete" name="country_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Package Category</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->package_category == 'on' ? ' checked' : '') }} id="package_category" name="package_category" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->package_category_create == 'on' ? ' checked' : '') }} id="package_category_create" name="package_category_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->package_category_edit == 'on' ? ' checked' : '') }} id="package_category_edit" name="package_category_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->package_category_delete == 'on' ? ' checked' : '') }} id="package_category_delete" name="package_category_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Exception Category</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->exception_category == 'on' ? ' checked' : '') }} id="exception_category" name="exception_category" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->exception_category_create == 'on' ? ' checked' : '') }} id="exception_category_create" name="exception_category_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->exception_category_edit == 'on' ? ' checked' : '') }} id="exception_category_edit" name="exception_category_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->exception_category_delete == 'on' ? ' checked' : '') }} id="exception_category_delete" name="exception_category_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>


<tr>
  <td>Complaint Request</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->complaint_request == 'on' ? ' checked' : '') }} id="complaint_request" name="complaint_request" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->complaint_request_create == 'on' ? ' checked' : '') }} id="complaint_request_create" name="complaint_request_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->complaint_request_edit == 'on' ? ' checked' : '') }} id="complaint_request_edit" name="complaint_request_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->complaint_request_delete == 'on' ? ' checked' : '') }} id="complaint_request_delete" name="complaint_request_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>


<tr>
  <td>Push Notification</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->push_notification == 'on' ? ' checked' : '') }} id="push_notification" name="push_notification" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->push_notification_create == 'on' ? ' checked' : '') }} id="push_notification_create" name="push_notification_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->push_notification_edit == 'on' ? ' checked' : '') }} id="push_notification_edit" name="push_notification_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->push_notification_delete == 'on' ? ' checked' : '') }} id="push_notification_delete" name="push_notification_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>


<tr>
  <td>Station</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->station == 'on' ? ' checked' : '') }} id="station" name="station" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->station_create == 'on' ? ' checked' : '') }} id="station_create" name="station_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->station_edit == 'on' ? ' checked' : '') }} id="station_edit" name="station_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->station_delete == 'on' ? ' checked' : '') }} id="station_delete" name="station_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>

<tr>
  <td>Financial Settings</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->financial_settings == 'on' ? ' checked' : '') }} id="financial_settings" name="financial_settings" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Common Price</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->common_price == 'on' ? ' checked' : '') }} id="common_price" name="common_price" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Terms and Conditions</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->terms_and_conditions == 'on' ? ' checked' : '') }} id="terms_and_conditions" name="terms_and_conditions" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Social Media Links</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->social_media_links == 'on' ? ' checked' : '') }} id="social_media_links" name="social_media_links" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Working Hours</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->working_hours == 'on' ? ' checked' : '') }} id="working_hours" name="working_hours" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Languages</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->languages == 'on' ? ' checked' : '') }} id="languages" name="languages" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Shipment Logs</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->shipment_logs == 'on' ? ' checked' : '') }} id="shipment_logs" name="shipment_logs" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>System Logs</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->system_logs == 'on' ? ' checked' : '') }} id="system_logs" name="system_logs" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>

<tr>
  <td>Roles</td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->roles == 'on' ? ' checked' : '') }} id="roles" name="roles" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->roles_create == 'on' ? ' checked' : '') }} id="roles_create" name="roles_create" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->roles_edit == 'on' ? ' checked' : '') }} id="roles_edit" name="roles_edit" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
  <td>
    <div class="media-body text-center icon-state switch-outline">
      <label class="switch">
        <input {{ ($role->roles_delete == 'on' ? ' checked' : '') }} id="roles_delete" name="roles_delete" type="checkbox"><span class="switch-state bg-primary"></span>
      </label>
    </div>
  </td>
</tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->

              <div class="col-sm-12">
                <div class="card">
                  <div class="card-footer text-right">
                    <button onclick="Save()" class="btn btn-primary m-r-15" type="button">Save</button>
                  </div>
                </div>
              </div>


            </div>
          </div>
          </form>
          <!-- Container-fluid Ends-->
        </div>


@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/chat-menu.js"></script>

<script type="text/javascript">
$('.role').addClass('active');

function Save(){
  var formData = new FormData($('#form')[0]);
    $.ajax({
        url : '/admin/update-role',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            window.location.href="/admin/role"
            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
            });
        }
    });
}

</script>
@endsection