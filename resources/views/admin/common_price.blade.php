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
                  <h2>{{$language[3][Auth::guard('admin')->user()->lang]}} <span>{{$language[136][Auth::guard('admin')->user()->lang]}}  </span></h2>
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
                  <!-- <div class="card-header">
                    <h5>Zero Configuration</h5><span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span><span>Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</span>
                  </div> -->
                  <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <table id="productTable" class="display" id="basic-1">
                            <thead class="thead-primary">
                                <tr style="text-align: center;">
                                    <th>{{$language[137][Auth::guard('admin')->user()->lang]}}</th>
                                    <th>{{$language[138][Auth::guard('admin')->user()->lang]}}</th>
                                    <th>{{$language[139][Auth::guard('admin')->user()->lang]}}</th>
                                    <th style="width: 3%;padding: .0rem !important;">
                                        <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="productTabletbody">
                                <?php
                                $x=0;
                                foreach ($common_price as $value) {
                                $x++;
                                ?>
                                <tr value="{{$x}}" id="row{{$x}}">
                                    <td><input value="{{$value->weight_from}}" style="text-align:right;" type="text" name="weight_from[]" id="weight_from{{$x}}" autocomplete="off" class="form-control" /></td>
                                    <td><input value="{{$value->weight_to}}" style="text-align:right;" type="text" name="weight_to[]" id="weight_to{{$x}}" autocomplete="off" class="form-control" /></td>
                                    <td><input value="{{$value->price}}" style="text-align:right;" type="text" name="price[]" id="price{{$x}}" autocomplete="off" class="form-control" /></td>
                                    <td align="center"><button id="removeProductRowBtnn{{$x}}" class="btn btn-default removeProductRowBtnn" type="button" onclick="removeProductRow({{$x}})"><i class="fa fa-minus" aria-hidden="true"></i></button></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        </form>
                    </div>
                  </div>

                  <div class="card-footer text-right">
                    <button onclick="SavePrice()" class="btn btn-primary m-r-15" type="button">{{$language[140][Auth::guard('admin')->user()->lang]}}</button>
                    <button class="btn btn-light" type="button">Cancel</button>
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
$('.common-price').addClass('active');

function SavePrice(){
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : '/admin/save-common-price',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            location.reload();
            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
                toastr.error(obj[0]);
            });
        }
    });
}


addRow();
function addRow() {
	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		count = 1;
		arrayNumber = 0;
	}


var tr = '<tr value="'+count+'" id="row'+count+'">'+
	'<td>'+
		'<input style="text-align:right;" type="text" name="weight_from[]" id="weight_from'+count+'" autocomplete="off" class="form-control" />  '+
	'</td> '+
	'<td>'+
		' <input style="text-align:right;" type="text" name="weight_to[]" id="weight_to'+count+'" autocomplete="off" class="form-control" />'+
	'</td>'+
	
	'<td> '+
		'<input style="text-align: right;" type="text" name="price[]" id="price'+count+'" autocomplete="off" class="form-control" />'+
	'</td>'+
	'<td align="center">'+
		'<button id="removeProductRowBtn'+count+'" class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="fa fa-minus" aria-hidden="true"></i>'+
'</button>'+
	'</td>'+
'</tr>';


if(tableLength > 0) {							
	$("#productTable tbody tr:last").after(tr);
} else {				
	$("#productTable tbody").append(tr);
}		

} // /add row



function removeProductRow(row = null)
{
	if(confirm('Are you sure delete this row?'))
	{
	   	var tableProductLength = $("#productTable tbody tr").length;

		if(tableProductLength > '1') {
			$("#row"+row).remove();
		}
	}
}

</script>
@endsection