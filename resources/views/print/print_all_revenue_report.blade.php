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
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="text-align:center;" colspan="3">
            @if($fdate !="1970-01-01" && $tdate !="1970-01-01" )
            {{date('d-m-Y',strtotime($fdate))}} to {{date('d-m-Y',strtotime($tdate))}}
            @endif
          </th>
        </tr>
      </thead>
    </table>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
    <table class="table table-bordered">
      <thead>
        <tr>
            <th>#</th>
            <th>Account ID</th>
            <th>No of Shipments</th>
            <th>No of Packages</th>
            <th>Total</th>
            <th>Special C.O.D</th>
            <th>Special C.O.P</th>
        </tr>
        
      </thead>
      <tbody>
            @foreach($shipment as $key => $row)
                <tr>
                    <td>
                      {{$key + 1}}
                    </td>
                  <td>
            {{ \App\Http\Controllers\Admin\ReportController::printAllRevenueReportUserDetails($row->sender_id) }}
                  </td>
                  <td>
                      {{$row->no_of_shipments}}
                  </td>
                  <td>
                      {{$row->no_of_packages}}
                  </td>
                  <td>
                      AED {{$row->total}}
                  </td>
                  <td>
                      AED {{$row->special_cod}}
                  </td>
                  <td>
                      AED {{$row->special_cop}}
                  </td>
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
