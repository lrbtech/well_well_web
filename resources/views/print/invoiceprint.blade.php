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
                <div style="height:180px; overflow: hidden;">
                  <div style="padding-top:40px; padding-left: 40px; float: left; width: 30%">
                    <h2 style="font-weight:bold; font-size: 32px; color: #2d87ba; max-width: 85%; line-height: 1.1; margin: 10px 0 0; padding: 0; float: left">Invoice</h2>
                  </div>
                  <div style="color:black; text-align: right; padding-top:40px; padding-right: 40px; float: right;">
                      <img style="width:100px;height:80px;" src="assets/images/logo.png">
                  </div>
                </div>
                
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-bottom: 20px">
                  <tbody>
                    <tr>
                      <td valign="top" width="60%" style="color:#000; padding: 20px 10px 20px 40px; background: #EDEDED; border-right: 2px solid white;">
                        <h3 style="font-size: 13px;"><label id="tmp_billing_address_label">Bill To</label>:</h3>
                        <p style="font-size: 14px">
                          <b>{{$invoice->name}}</b><br>
                          <span id="tmp_billing_address" style="white-space: pre-wrap;">{{$invoice->mobile}}<br>{{$invoice->email}}
                          </span>
                          <span id="tmp_billing_address" style="white-space: pre-wrap;">{{$invoice->address1}} 
                          @if($invoice->address2 != '')
                          , {{$invoice->address2}} 
                          @endif
                          @if($invoice->address3 != '')
                          , {{$invoice->address3}} 
                          @endif
                          </span>
                          <span id="tmp_billing_address" style="white-space: pre-wrap;">
                          {{$invoice->area}} , {{$invoice->city}}
                          </span>
                        </p>
                      </td>
                      <td width="10%" valign="top" style="color:#fff; padding: 20px 40px 20px 0; background: #2d87ba;text-align: right;">
                        <!-- <p style="font-size: 14px">Due date:</p>
                        <h3 style="font-size: 18px"><span id="tmp_due_date">DueDate</span></h3> -->
                        
                      </td>
                      <td width="30%" valign="top" style="color:#000; padding: 20px 10px; background: #dde9ef; border-right: 2px solid white;">
                        <p style="font-size: 14px">Invoice Date:</p>
                        <h3 style="font-size: 14px">{{$invoice->date}}</h3>
                        <p style="font-size: 14px">Invoice Number:</p>
                        <h3 style="font-size: 13px;word-wrap:break-word;max-width: 170px"><span id="tmp_entity_number"><b> #{{$invoice->invoice_id}}</b></span></h3>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-family: Verdana, Arial, Helvetica, sans-serif;color:#000; font-size: 12px;">
                  <thead style="text-transform: uppercase;color:#fff; padding: 10px 10px 10px 10px; background: #2d87ba; border-right: 2px solid white;">
                    <tr>
                      <td style="font-weight:bold;border-bottom:2px solid #EDEDED;  padding: 10px 10px 10px 10px;" width="10%">#</td>
                      <td style="font-weight:bold;border-bottom:2px solid #EDEDED;  padding: 10px 10px 10px 10px;" width="45%">Description</td>
                      <td style="font-weight:bold;border-bottom:1px solid #EDEDED;  padding: 10px 10px 10px 10px;" width="15%">Qty</td>
                      <td style="font-weight:bold;border-bottom:1px solid #2d87ba; padding: 10px 10px 10px 10px; text-align: right;" width="30%">Total</td>
                    </tr>
                  </thead>
                  <tbody id="lineItem">
                    @foreach($invoice_item as $key => $row)
                    <tr>
                        <td style="border-bottom:1px solid #EDEDED; padding: 7px 5px 7px 40px; font-size: 12px;">
                        {{$key+1}}
                        </td>
                        <td style="border-bottom:1px solid #EDEDED; padding: 7px 5px 7px 40px; font-size: 12px;">
                        Tracking ID : {{$row['tracking_id']}} Delivery Charge
                        </td>
                        <td style="border-bottom:1px solid #EDEDED; padding: 7px 5px 7px 0px; font-size: 12px;">
                        <span id="tmp_item_name" style="word-wrap: break-word;">
                        {{$row['no_of_packages']}}
                        </span>
                        </td>
                        <td valign="top" style="border-bottom:1px solid #2d87ba; padding: 7px 40px 7px 0; font-size: 12px; text-align: right;">{{round($row['total'],2)}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tbody>
                    <tr>
                      <td colspan="3" style="padding: 7px 5px 7px;margin-left:250px !important;"><b>Total</b> </td>
                      <td style="padding: 7px 40px 7px 5px; text-align: right;" id="tmp_total"><b>AED {{round($invoice->total,2)}}</b></td>
                    </tr>

                    <tr>
                      <td colspan="3" style="padding: 7px 5px 7px;margin-left:250px !important;"><b>Paid</b> </td>
                      <td style="padding: 7px 40px 7px 5px; text-align: right;" id="tmp_total"><b>AED {{round($invoice->paid,2)}}</b></td>
                    </tr>

                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #EDEDED; border-bottom:1px solid #dde9ef;border-top:1px solid #dde9ef;padding: 10px 5px; color:#2d87ba; font-size: 13px;margin-left:250px !important;"><b>Balance</b></td>
                      <td style="border-bottom:1px solid #2d87ba;border-top:1px solid #2d87ba;padding: 10px 40px 10px 0; text-align: right; color:#2d87ba; font-size: 13px"  id="tmp_balance_due"><b>AED {{round($invoice->total - $invoice->paid,2)}}</b></td>
                    </tr>
                  </tbody>
                </table>


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