<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Css -->
    <title>Print</title>
    <style>
    @font-face {
    font-family: "cairo";
    src: url("./assets/Cairo/Cairo-Regular.ttf");
}

@page {
    size: A4;
    margin: 20px 40px;
}

.page {
  page-break-after: always;
}

/* @page {
  margin: 20mm
} */

body {
    font-family: 'open-sans', sans-serif;
    font-size: 16px;
    color: #000;
    margin: 20px 40px;
}

.d-flex {
    display: flex;
}

.justify-between {
    justify-content: space-between;
}

.align-items-center {
    align-items: center;
}

.align-item-end {
    align-items: flex-end;
}

.m-0 {
    margin: 0;
}

.mb-0 {
    margin-bottom: 0;
}

.px-2 {
    padding: 0 15px;
}

.pt-2 {
    padding-top: 15px;
}

.pb-2 {
    padding-bottom: 15px;
}

.ml-2 {
    margin-left: 15px;
}

.mr-2 {
    margin-right: 15px;
}

.mb-2 {
    margin-bottom: 15px;
}

.text-center {
    text-align: center;
}

.title {
    text-align: center;
}

.logo {
    width: 100px;
    margin-bottom: 20px;
}

.title_line {
    border-top: 1px solid #dee2e6;
    border-bottom: 1px solid #dee2e6;
    padding: 10px 0;
}


/* Table style */

.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}

table {
    border-collapse: collapse;
}

.table thead th {
    vertical-align: bottom;
    /* border-bottom: 2px solid #dee2e6; */
}

.table td,
.table th {
    padding: .65rem;
    vertical-align: top;
    /* border-top: 1px solid #dee2e6; */
}

th {
    text-align: inherit;
}


/* .table-striped tbody tr:nth-of-type(2n+1) {
    background-color: rgba(0, 0, 0, .05);
} */
    </style>
</head>

<body>
<?php $x=1; ?>
<?php $y=0; ?>
@foreach($all_shipments as $key => $row)
    <div class="sticker_label page">
        <div class="d-flex" style="border-bottom: 1px solid #cdcdcd;">
            <div style="width: 50% !important;" class="px-2" style="border-right: 1px solid #cdcdcd;">
                <div class="d-flex">
                    <!-- <p class="m-0 mr-2">
                    <strong>Order ID :</strong> </p><span>{{$row->order_id}}</span> -->
                </div>
                <p class="m-0">
                @if(!empty($user))    
                    @if($user->business_name != '')
                    {{$user->business_name}}<br>
                    @else 
                    {{$row->from_name}}<br>
                    @endif
                @else 
                {{$row->from_name}}<br>
                @endif
                {{$row->from_mobile}}<br>
                @foreach($area as $area1)
                @if($area1->id == $row->from_area)
                {{$area1->city}}
                @endif
                @endforeach
                <br>
                @foreach($city as $city1)
                @if($city1->id == $row->from_city)
                {{$city1->city}}
                @endif
                @endforeach
                </p>
            </div>
            <div style="width: 50% !important;" class="px-2">
                <p class="m-0"><strong>SHIP DATE:</strong> {{date('d-m-Y',strtotime($row->shipment_date))}}</p>
                
                @if($row->shipment_mode == 1)
                <p class="m-0"><strong>Commitment DATE:</strong> {{date('d-m-Y', strtotime($row->shipment_date.'+3 days'))}}</p>
                @else 
                <p class="m-0"><strong>Commitment DATE:</strong> {{date('d-m-Y', strtotime($row->shipment_date.'+1 day'))}}</p>
                @endif

                <p class="m-0"><strong>Weight:</strong> {{$row->total_weight}} KG</p>
                <!-- <p class="m-0"><strong>CAD:</strong> 1234567ASD12</p> -->
                <p class="m-0"><strong>DIMS:</strong> {{$row->length}}x{{$row->width}}x{{$row->height}} CM</p>
            </div>
        </div>

        <div class="d-flex" style="border-bottom: 1px solid #cdcdcd;">
            <div style="width: 100% !important;" class="px-2" style="border-right: 1px solid #cdcdcd;">
                <div class="d-flex">
                    <!-- <p class="m-0 mr-2">
                    <strong>Order ID :</strong> </p><span>{{$row->order_id}}</span> -->
                </div>
                <p class="m-0 pt-2"><strong>TO:</strong></p>
                <div>{{$row->contact_name}}</div>
                <div>{{$row->contact_mobile}}</div>
                <div>{{$row->contact_landline}}</div>
                <div>{{$row->address1}} {{$row->address2}} {{$row->address3}}
                @foreach($city as $city1)
                @if($city1->id == $row->city_id)
                {{$city1->city}}
                @endif
                @endforeach</div>
                @if($row->special_cop_enable == '1')
                <center><p style="font-size:18px;" class="m-0 pt-2"><strong>C.O.P Amount : {{$row->special_cop}}</strong></p></center>
                @endif
                @if($row->special_cod_enable == '1')
                <center><p style="font-size:18px;" class="m-0 pt-2"><strong>C.O.D Amount : {{$row->special_cod}}</strong></p></center>
                @endif
            </div>
        </div>

        <div class="d-flex justify-between pt-2 pb-2" style="border-bottom: 1px solid #cdcdcd;">
            <div class="text-center"> 
            <!-- <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($row->order_id, 'C39',1,60)}}" alt="barcode"   /> -->

            <p class="m-0 pt-2">
            <strong>REF ID : {{$row->reference_no}}</strong><br>
            <strong>
            @foreach($package_category as $cat)
            @if($cat->id == $row->category)
            {{$cat->category}}
            @endif
            @endforeach
            </strong>
            <br>
            <strong>{{$row->description}}</strong>
            </p>
    
            </div>
            <div class="">
                <div><img src="http://wellwell.ae/assets/images/logo.png" alt="" height="50" width="70"></div>
                <div class="pt-2 text-center">
                    <!-- <strong style="
                    font-size: 27px;
                    border: 3px solid #000;
                    border-radius: 3px;
                    padding: 6px 13px;
                ">E</strong> -->
                </div>
            </div>
        </div>
        <div class="d-flex justify-between pt-2 ">
            @if($x <= $row->no_of_packages)
            <!-- <div style="font-size: 16px;">{{$x}} of {{$row->no_of_packages}}</div> -->
            @else
            <?php $x=1; ?>
            <?php 
            $y = $row->no_of_packages + $y; ?>
            @endif
            <div style="font-size: 16px;">{{$x}} of {{$row->no_of_packages}}</div>
            <!-- <div style="font-size: 16px;">{{$key + 1}} of {{$shipment_count}}</div> -->
            <!-- <div style="font-size: 16px;"><strong>H2</strong></div> -->
            


        </div>
        <div class="d-flex justify-between pt-2 ">
            <div>
                <!-- @if(($x) != '1')
                <div class="d-flex">
                    <div class="mr-2">
                        <div><strong style="font-size: 14px;">Master TRK#</strong></div>
                    </div>
                    <div style="font-size: 20px;"><strong>{{$shipment_package[$y]->sku_value}}</strong></div>
                </div>
                @endif -->
                <div style="font-size: 18px;"><strong>Your Tracking ID</strong></div>
                <div style="font-size: 25px;"><strong>{{$row->sku_value}}</strong></div>
            </div>
            <?php $x++; ?>
            <div>

                <div style="font-size: 24px;"><strong>{{$row->station}}</strong></div>
                <!-- <div style="font-size: 18px;text-align: right;"><strong>SY20 9HI</strong></div>
                <div style="font-size: 18px;text-align: right;"><strong>SNI</strong></div> -->
            </div>
        </div>
        <div class="pt-2 text-center"> 
        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($row->sku_value, 'C39',1,50)}}" alt="barcode"   />
        </div>
    </div>   
@endforeach
</body>
<style>
    body {
        font-family: 'open-sans', sans-serif;
        font-size: 12px;
        color: #000;
        margin: 20px 40px;
    }
    
    .sticker_label {
        width: 384px;
        margin: 0 auto;
        padding: 10px;
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5)
    }
</style>

</html>