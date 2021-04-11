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
          <th style="text-align:center;">
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
    <table style="width:100%;" class="table table-bordered">
      <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>No of Shipments</th>
            <th>Amount</th>
            <th>Receiver</th>
        </tr>
        
      </thead>
      <tbody>
            @foreach($shipment as $key => $row)
                <tr>
                    <td>
                      {{$key + 1}}
                    </td>
                  <td>
                      {{date('d-m-Y',strtotime($row->date))}}
                  </td>
                  <td>
                      {{$row->no_of_shipments}}
                  </td>
                  <td>
                      AED {{$row->amount}}
                  </td>
                  <td>
                  @foreach($admin as $admin1)
                    @if($row->admin_id == $admin1->id)
                      {{$admin1->name}}
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

</body>
</html>
