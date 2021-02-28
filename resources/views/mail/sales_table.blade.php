<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> We're thrilled to have you here! Get ready to dive into your new account. </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#0064a6" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php
                    $url = asset('');
                    ?>
        <tr>
            <td bgcolor="#0064a6" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> <img src="{{$url}}assets/images/logo.png" width="125" height="120" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
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
                        {{$settings->insurance_percentage}} %
                      @endif
                      </td>
                      <td>
                      @if($rate->cod_enable == '1')
                        {{$rate->cod_price}} AED
                      @endif
                    </td>
                      <td>
                      @if($rate->vat_enable == '1')
                        {{$settings->vat_percentage}} %
                      @endif
                      </td>
                      <td>
                      @if($rate->postal_charge_enable == '1')
                        {{$settings->postal_charge_percentage}} %
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
                          <label>0 to 5 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_0_to_5_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>5.1 to 10 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_5_to_10_kg_price}} AED
                      </th>
                    </tr>
                    
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>10.1 to 15 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_10_to_15_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>15.1 to 20 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_15_to_20_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>20.1 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          {{$rate->service_area_20_to_1000_kg_price}} AED
                      </th>
                    </tr>
                  </thead>
                </table>

                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th colspan="3">
                          <label>Same Day Delivery Price Section</label>
                      </th>
                    </tr>
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>0 to 5 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_0_to_5_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>5.1 to 10 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_5_to_10_kg_price}} AED
                      </th>
                    </tr>
                    
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>10.1 to 15 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_10_to_15_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>15.1 to 20 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_15_to_20_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>20.1 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          {{$rate->same_day_delivery_20_to_1000_kg_price}} AED
                      </th>
                    </tr>
                  </thead>
                </table>

                <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th colspan="3">
                          <label>Special Service Area Price Section</label>
                      </th>
                    </tr>
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>0 to 5 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_0_to_5_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>5.1 to 10 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_5_to_10_kg_price}} AED
                      </th>
                    </tr>
                    
                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>10.1 to 15 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_10_to_15_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>15.1 to 20 kg Price</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_15_to_20_kg_price}} AED
                      </th>
                    </tr>

                    <tr style="text-align: center;">
                      <th colspan="1">
                          <label>20.1 to 1000 kg Price (Per kg)</label>
                      </th>
                      <th colspan="2">
                          {{$rate->special_service_20_to_1000_kg_price}} AED
                      </th>
                    </tr>
                  </thead>
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
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
                            <p style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">
                            For Any Changes on Price Please Contact our Customer Support : 024442254
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                            <p style="margin: 0;">If these emails get annoying, please feel free to <a href="#" target="_blank" style="color: #111111; font-weight: 700;">unsubscribe</a>.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>