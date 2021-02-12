@extends('admin.layouts')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/jsgrid.css">
{{-- <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/datatables.css"> --}}
<link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
@endsection
@section('section')        
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>Language <span>Management  </span></h2>
                  <h6 class="mb-0">Admin Panel</h6>
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
                    <form id="languagesTable">
                       {{ csrf_field() }}
                               
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>





@endsection
@section('extra-js')
  <script src="/assets/app-assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/app-assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="/assets/app-assets/js/jsgrid/jsgrid.min.js"></script>
  {{-- <script src="/assets/app-assets/js/jsgrid/griddata.js"></script> --}}
  <script src="/assets/app-assets/js/chat-menu.js"></script>
  {{-- <script src="/assets/app-assets/js/jsgrid/jsgrid.js"></script> --}}

<script type="text/javascript">
    $("#languagesTable").jsGrid({
        width: "100%",
        filtering: true,
        editing: true,
        inserting: true,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,
        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete the data?",

        controller:{
            loadData:function(filter){
         
                return  $.ajax({
                    type:"GET",
                    url:"/admin/fetch_language",
                    data:filter
                });
              
            },
             insertItem: function(item){
       return $.ajax({
        type: "POST",
        url: "/admin/insert_language",
        data:{english:item.english,arabic:item.arabic,_token: "{{csrf_token()}}"}
       });
      },
       updateItem: function(item){
       return $.ajax({
        type: "POST",
        url: "/admin/update_language",
        data: {english:item.english,arabic:item.arabic,_token: "{{csrf_token()}}",id:item.id}
       });
      },
       deleteItem: function(item){
       return $.ajax({
        type: "POST",
        url: "/admin/delete_language",
        data: {_token: "{{csrf_token()}}",id:item.id}
       });
      },
        },
        fields: [
            {
                name:"id",
                type:"hidden",
                css:"hide"
            },
        { name: "index",  type: "readonly",width:10},
        { name: "english",title:"English Content", type: "text",validate:"required"},
        { name: "arabic",title:"Arabic Content", type: "text",validate:"required"},
        { type: "control" }
        ]
    });
// $('.country').addClass('active');
// var action_type;
// $('#add_new').click(function(){
//     $('#popup_modal').modal('show');
//     $("#form")[0].reset();
//     action_type = 1;
//     $('#saveButton').text('Save');
//     $('#modal-title').text('Add Country');
// });
// function Save(){
//   var formData = new FormData($('#form')[0]);
//   if(action_type == 1){
//     $.ajax({
//         url : '/admin/save-country',
//         type: "POST",
//         data: formData,
//         contentType: false,
//         processData: false,
//         dataType: "JSON",
//         success: function(data)
//         {                
//             $("#form")[0].reset();
//             $('#popup_modal').modal('hide');
//             location.reload();
//             toastr.success(data, 'Successfully Save');
//         },error: function (data) {
//             var errorData = data.responseJSON.errors;
//             $.each(errorData, function(i, obj) {
//             toastr.error(obj[0]);
//       });
//     }
//     });
//   }else{
//     $.ajax({
//       url : '/admin/update-country',
//       type: "POST",
//       data: formData,
//       contentType: false,
//       processData: false,
//       dataType: "JSON",

//       success: function(data)
//       {
//         console.log(data);
//           $("#form")[0].reset();
//            $('#popup_modal').modal('hide');
//            location.reload();
//            toastr.success(data, 'Successfully Update');
//       },error: function (data) {
//         var errorData = data.responseJSON.errors;
//         $.each(errorData, function(i, obj) {
//           toastr.error(obj[0]);
//         });
//       }
//     });
//   }
// }
// function Edit(id){
//   $.ajax({
//     url : '/admin/country/'+id,
//     type: "GET",
//     dataType: "JSON",
//     success: function(data)
//     {
//       $('#modal-title').text('Update Country');
//       $('#save').text('Save Change');
//       $('input[name=country_name_arabic]').val(data.country_name_arabic);
//       $('input[name=country_name_english]').val(data.country_name_english);
//       $('input[name=phone_count]').val(data.phone_count);
//       $('input[name=image1]').val(data.image);
//       $('input[name=country_code]').val(data.country_code);
//       $('input[name=id]').val(id);
//       $('#popup_modal').modal('show');
//       action_type = 2;
//     }
//   });
// }
// function Delete(id){
//     var r = confirm("Are you sure");
//     if (r == true) {
//       $.ajax({
//         url : '/admin/country-delete/'+id,
//         type: "GET",
//         dataType: "JSON",
//         success: function(data)
//         {
//           toastr.success(data, 'Successfully Delete');
//           location.reload();
//         }
//       });
//     } 
// }
</script>
@endsection