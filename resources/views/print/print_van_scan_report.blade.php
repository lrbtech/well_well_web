<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid">

  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
    <table style="font-size:12px;" class="table table-bordered">
      <thead>
        <tr>
            <th>Date</th>
            <th>Sender Details</th>
            <th>Driver Name</th>
            <th>AWB No</th>
            <th>Reference No</th>
            <th>Ship To</th>
            <th>To Details</th>
            <th>Special C.O.P</th>
            <th>Special C.O.D</th>
            <th>Delivery Fees</th>
        </tr>
        
      </thead>
      <tbody>
        @foreach($shipment as $row)
        <tr>
            <td>{{$row->van_scan_date}}</td>
            <td>{{ \App\Http\Controllers\Admin\ReportController::getsenderdetails($row->sender_id) }}</td>
            <td>{{ \App\Http\Controllers\Admin\ReportController::getagentname($row->van_scan_id) }}</td>
            <td>{{ \App\Http\Controllers\Admin\ReportController::getawbno($row->id) }}</td>
            <td>{{$row->reference_no}}</td>
            <td>{{ \App\Http\Controllers\Admin\ReportController::getshipto($row->to_station_id) }}</td>
            <td>{{ \App\Http\Controllers\Admin\ReportController::gettodetails($row->to_address) }}</td>
            <td>{{$row->special_cop}}</td>
            <td>{{$row->special_cod}}</td>
            <td>{{$row->total}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>

</div>


</div>

</body>
</html>
