<style type="text/css" media="all">
#lineItem tr:nth-child(even) {
  background-color: #fafaf8;
}
#lineItem td{
  vertical-align: middle;
}
</style>

<html style="border: 0; margin: 0; padding: 0;">
<head>
  <title>Invoice</title>
</head>
<body style="border: 0; margin: 0; padding: 0;">
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="padding:0; margin: 0 auto;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px;border-top: 8px solid #2D87BA; background: white;">
  <tbody>
    <tr>
      <td valign="top">
        <table border="0" cellspacing="0" cellpadding="0" width="100%" style="">
          <tbody>
            <tr>
              <td valign="top">
                
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-bottom: 20px">
                  <tbody>
                    <tr>
                      <td valign="top" width="50%" style="color:#000; padding: 20px 10px 20px 40px; background: #EDEDED; border-right: 2px solid white;">
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Agent ID : {{$agent->agent_id}} </label><br>
                            <label id="tmp_billing_address_label">
                            Name : {{$agent->name}}
                            </label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Today Total Shipment </label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['total_shipment']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Collected C.O.D Value </label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['collected_value']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Collected C.O.D Bank Transfer Value </label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['collected_bank_value']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">On Pickup</label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['on_pickup']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Pickup</label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['pickup']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Exception</label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['exception']}}</label>
                        </h3>
                      </td>
                      <td width="50%" valign="top" style="color:#000; padding: 20px 10px; background: #dde9ef; border-right: 2px solid white;">
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Today Date</label><br>
                            <label id="tmp_billing_address_label">{{date('d-m-Y')}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Collected Guest Value</label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['collected_guest']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Collected C.O.D Cash Value</label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['collected_cash_value']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Collected C.O.D Credit Card Value</label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['collected_credit_value']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">On Delievry</label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['delivery']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Hub</label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['hub']}}</label>
                        </h3>
                        <h3 style="font-size: 13px;">
                            <label id="tmp_billing_address_label">Shipment Completed</label><br>
                            <label id="tmp_billing_address_label">{{$shipment_data['completed']}}</label>
                        </h3>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
                <!-- <table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-family: Verdana, Arial, Helvetica, sans-serif;color:#000; font-size: 12px;">
                  <thead style="text-transform: uppercase;color:#fff; padding: 10px 10px 10px 10px; background: #2d87ba; border-right: 2px solid white;">
                    <tr>
                      <td style="font-weight:bold;border-bottom:2px solid #EDEDED;  padding: 10px 10px 10px 10px;" width="10%">No</td>
                      <td style="font-weight:bold;border-bottom:1px solid #EDEDED;  padding: 10px 10px 10px 10px;" width="20%">Shipment ID</td>
                      <td style="font-weight:bold;border-bottom:1px solid #EDEDED;  padding: 10px 10px 10px 10px;" width="25%">From</td>
                      <td style="font-weight:bold;border-bottom:1px solid #EDEDED;  padding: 10px 10px 10px 10px;" width="25%">To</td>
                      <td style="font-weight:bold;border-bottom:1px solid #EDEDED;  padding: 10px 10px 10px 10px;" width="20%">Status</td>
                    </tr>
                  </thead>
                  <tbody id="lineItem">
                    @foreach($datas as $key => $row)
                    <tr>
                        <td style="border-bottom:1px solid #EDEDED; padding: 7px 5px 7px 40px; font-size: 12px;">{{$key + 1}}</td>
                        <td style="border-bottom:1px solid #EDEDED; padding: 7px 5px 7px 0px; font-size: 12px;">
                        <span id="tmp_item_name" style="word-wrap: break-word;">
                        {{$row['order_id']}}
                        </span>
                        </td>
                        <td style="border-bottom:1px solid #EDEDED; padding: 7px 5px 7px 0px; font-size: 12px;">
                        <span id="tmp_item_name" style="word-wrap: break-word;">
                        {{$row['from_station']}}
                        </span>
                        </td>
                        <td style="border-bottom:1px solid #EDEDED; padding: 7px 5px 7px 0px; font-size: 12px;">
                        <span id="tmp_item_name" style="word-wrap: break-word;">
                        {{$row['to_station']}}
                        </span>
                        </td>
                        <td style="border-bottom:1px solid #EDEDED; padding: 7px 5px 7px 0px; font-size: 12px;">
                        <span id="tmp_item_name" style="word-wrap: break-word;">
                        {{$row['status']}}
                        </span>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table> -->


<style media="print">
    #invoice-footer {
        width: 100%;
        display: block;
        position: fixed;
        bottom: 0;
    }
</style>
<style media="screen">
    #invoice-footer { 
        position: fixed;
        margin-top: -5em; /* negative value of footer height */
        height: 5em;
        clear: both;
        margin-left: 30px;
        margin-right: 20px;
    }
</style>
                <!-- <div id="invoice-footer" style="margin-top: 60px; padding: 0 0 0 20px; overflow: hidden;border-top:1px solid #dadada; page-break-inside: avoid;">
                  <div style="color:gray;padding: 0px 0px 0 0px; float: left; width: 60%;">
                    <h3 style="margin: 0 0 0px; font-size: 13px; color: #2d87ba;"><label id="tmp_terms_label">Terms and Conditions</label></h3>
                    <pre style="color:#000; padding: 0px 20px 0 0; display: block; font-size: 12px; font-family: Verdana, Helvetica, Arial, sans-serif;" wrap="soft">1.Goods once Sold wil not be taken back</pre>
                    <pre style="color:#000; padding: 0px 20px 0 0; display: block; font-size: 12px; font-family: Verdana, Helvetica, Arial, sans-serif;" wrap="soft">2.Manufacturer warranty only.</pre>
                  </div>
                </div> -->
                
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>