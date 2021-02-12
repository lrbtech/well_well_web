@extends('admin.layouts')
@section('extra-css')
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/chartist.css">
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/prism.css">
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/tour.css">
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/pe7-icon.css">
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/ionic-icon.css">
    
@endsection
@section('section')
      <!-- Right sidebar Ends-->
      <div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
             
                  <h2>{{$language[0][Auth::guard('admin')->user()->lang]}} <span>{{$language[1][Auth::guard('admin')->user()->lang]}}  </span></h2>

               {{-- {{Auth::guard('admin')->user()->lang}} --}}
                </div>
                <div class="col-lg-6 breadcrumb-right">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item">{{$language[1][Auth::guard('admin')->user()->lang]}}</li>
                    <li class="breadcrumb-item active"> </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
          
            @if($role_get->id == 2 || $role_get->id == 3 || $role_get->id == 4)
            @elseif($role_get->id == 5)
            @else 
              <div class="col-lg-12">
                <div class="row ecommerce-chart-card">
                  
                  <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card gradient-primary o-hidden">
                      <div class="card-body tag-card">
                        <div class="ecommerce-chart">
                          <div class="media ecommerce-small-chart">
                            <div class="small-bar">
                              <div class="small-chart1 flot-chart-container"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="120" height="80" class="ct-chart-bar" style="width: 120px; height: 80px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="17.420989990234375" x2="17.420989990234375" y1="71.03460693359375" y2="59.827685546875" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="71.03460693359375" y2="45.819033813476565" class="ct-bar" ct:value="900" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="71.03460693359375" y2="48.62076416015625" class="ct-bar" ct:value="800" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="71.03460693359375" y2="51.42249450683594" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line></g><g class="ct-series ct-series-b"><line x1="17.420989990234375" x2="17.420989990234375" y1="59.827685546875" y2="31.810382080078128" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="45.819033813476565" y2="31.810382080078128" class="ct-bar" ct:value="500" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="48.62076416015625" y2="31.81038208007812" class="ct-bar" ct:value="600" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="51.42249450683594" y2="31.810382080078128" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line></g></g><g class="ct-labels"></g></svg></div>
                            </div>
                            <div class="sale-chart">   
                              <div class="media-body m-l-40">
                                <h6 class="f-w-100 m-l-10">{{$total_individual}}</h6>
                                <h4 class="mb-0 f-w-700 m-l-10">{{$language[2][Auth::guard('admin')->user()->lang]}}</h4>
                              </div>
                            </div>
                          </div>
                        </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">       </span></span></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card gradient-primary o-hidden">
                      <div class="card-body tag-card">
                        <div class="ecommerce-chart">
                          <div class="media ecommerce-small-chart">
                            <div class="small-bar">
                              <div class="small-chart1 flot-chart-container"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="120" height="80" class="ct-chart-bar" style="width: 120px; height: 80px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="17.420989990234375" x2="17.420989990234375" y1="71.03460693359375" y2="59.827685546875" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="71.03460693359375" y2="45.819033813476565" class="ct-bar" ct:value="900" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="71.03460693359375" y2="48.62076416015625" class="ct-bar" ct:value="800" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="71.03460693359375" y2="51.42249450683594" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line></g><g class="ct-series ct-series-b"><line x1="17.420989990234375" x2="17.420989990234375" y1="59.827685546875" y2="31.810382080078128" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="45.819033813476565" y2="31.810382080078128" class="ct-bar" ct:value="500" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="48.62076416015625" y2="31.81038208007812" class="ct-bar" ct:value="600" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="51.42249450683594" y2="31.810382080078128" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line></g></g><g class="ct-labels"></g></svg></div>
                            </div>
                            <div class="sale-chart">   
                              <div class="media-body m-l-40">
                                <h6 class="f-w-100 m-l-10">{{$total_business}}</h6>
                                <h4 class="mb-0 f-w-700 m-l-10">{{$language[4][Auth::guard('admin')->user()->lang]}}</h4>
                              </div>
                            </div>
                          </div>
                        </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">       </span></span></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card gradient-primary o-hidden">
                      <div class="card-body tag-card">
                        <div class="ecommerce-chart">
                          <div class="media ecommerce-small-chart">
                            <div class="small-bar">
                              <div class="small-chart1 flot-chart-container"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="120" height="80" class="ct-chart-bar" style="width: 120px; height: 80px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="17.420989990234375" x2="17.420989990234375" y1="71.03460693359375" y2="59.827685546875" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="71.03460693359375" y2="45.819033813476565" class="ct-bar" ct:value="900" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="71.03460693359375" y2="48.62076416015625" class="ct-bar" ct:value="800" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="71.03460693359375" y2="51.42249450683594" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line></g><g class="ct-series ct-series-b"><line x1="17.420989990234375" x2="17.420989990234375" y1="59.827685546875" y2="31.810382080078128" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="45.819033813476565" y2="31.810382080078128" class="ct-bar" ct:value="500" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="48.62076416015625" y2="31.81038208007812" class="ct-bar" ct:value="600" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="51.42249450683594" y2="31.810382080078128" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line></g></g><g class="ct-labels"></g></svg></div>
                            </div>
                            <div class="sale-chart">   
                              <div class="media-body m-l-40">
                                <h6 class="f-w-100 m-l-10">{{$total_shipment}}</h6>
                                <h4 class="mb-0 f-w-700 m-l-10">{{$language[5][Auth::guard('admin')->user()->lang]}}</h4>
                              </div>
                            </div>
                          </div>
                        </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">       </span></span></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card gradient-primary o-hidden">
                      <div class="card-body tag-card">
                        <div class="ecommerce-chart">
                          <div class="media ecommerce-small-chart">
                            <div class="small-bar">
                              <div class="small-chart1 flot-chart-container"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="120" height="80" class="ct-chart-bar" style="width: 120px; height: 80px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="17.420989990234375" x2="17.420989990234375" y1="71.03460693359375" y2="59.827685546875" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="71.03460693359375" y2="45.819033813476565" class="ct-bar" ct:value="900" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="71.03460693359375" y2="48.62076416015625" class="ct-bar" ct:value="800" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="71.03460693359375" y2="51.42249450683594" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line></g><g class="ct-series ct-series-b"><line x1="17.420989990234375" x2="17.420989990234375" y1="59.827685546875" y2="31.810382080078128" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="45.819033813476565" y2="31.810382080078128" class="ct-bar" ct:value="500" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="48.62076416015625" y2="31.81038208007812" class="ct-bar" ct:value="600" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="51.42249450683594" y2="31.810382080078128" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line></g></g><g class="ct-labels"></g></svg></div>
                            </div>
                            <div class="sale-chart">   
                              <div class="media-body m-l-40">
                                <h6 class="f-w-100 m-l-10">AED {{$current_month_value}}</h6>
                                <h4 class="mb-0 f-w-700 m-l-10">Current Month <br>Transaction</h4>
                              </div>
                            </div>
                          </div>
                        </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">       </span></span></span>
                      </div>
                    </div>
                  </div>
                  
                  <!-- <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card gradient-secondary o-hidden">
                      <div class="card-body tag-card">
                        <div class="ecommerce-chart">
                          <div class="media ecommerce-small-chart">
                            <div class="small-bar">
                              <div class="small-chart2 flot-chart-container"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="120" height="80" class="ct-chart-bar" style="width: 120px; height: 80px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="17.420989990234375" x2="17.420989990234375" y1="71.03460693359375" y2="59.827685546875" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="71.03460693359375" y2="45.819033813476565" class="ct-bar" ct:value="900" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="71.03460693359375" y2="48.62076416015625" class="ct-bar" ct:value="800" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="71.03460693359375" y2="51.42249450683594" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line></g><g class="ct-series ct-series-b"><line x1="17.420989990234375" x2="17.420989990234375" y1="59.827685546875" y2="31.810382080078128" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="45.819033813476565" y2="31.810382080078128" class="ct-bar" ct:value="500" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="48.62076416015625" y2="31.81038208007812" class="ct-bar" ct:value="600" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="51.42249450683594" y2="31.810382080078128" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line></g></g><g class="ct-labels"></g></svg></div>
                            </div>
                            <div class="sale-chart">   
                              <div class="media-body m-l-40">
                                <h6 class="f-w-100 m-l-10">AED 1000.00</h6>
                                <h4 class="mb-0 f-w-700 m-l-10">Credit Limit</h4>
                              </div>
                            </div>
                          </div>
                        </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">             </span></span></span>
                      </div>
                    </div>
                  </div> -->

                  <!-- <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card gradient-warning o-hidden">
                      <div class="card-body tag-card">
                        <div class="ecommerce-chart">
                          <div class="media ecommerce-small-chart">
                            <div class="small-bar">
                              <div class="small-chart3 flot-chart-container"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="120" height="80" class="ct-chart-bar" style="width: 120px; height: 80px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="17.420989990234375" x2="17.420989990234375" y1="71.03460693359375" y2="59.827685546875" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="71.03460693359375" y2="45.819033813476565" class="ct-bar" ct:value="900" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="71.03460693359375" y2="48.62076416015625" class="ct-bar" ct:value="800" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="71.03460693359375" y2="51.42249450683594" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line></g><g class="ct-series ct-series-b"><line x1="17.420989990234375" x2="17.420989990234375" y1="59.827685546875" y2="31.810382080078128" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="45.819033813476565" y2="31.810382080078128" class="ct-bar" ct:value="500" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="48.62076416015625" y2="31.81038208007812" class="ct-bar" ct:value="600" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="51.42249450683594" y2="31.810382080078128" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line></g></g><g class="ct-labels"></g></svg></div>
                            </div>
                            <div class="sale-chart">   
                              <div class="media-body m-l-40">
                                <h6 class="f-w-100 m-l-10">AED 500.00</h6>
                                <h4 class="mb-0 f-w-700 m-l-10">Credit Balance</h4>
                              </div>
                            </div>
                          </div>
                        </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">                    </span></span></span>
                      </div>
                    </div>
                  </div> -->

                  <!-- <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card gradient-info o-hidden">
                      <div class="card-body tag-card">
                        <div class="ecommerce-chart">
                          <div class="media ecommerce-small-chart">
                            <div class="small-bar">
                              <div class="small-chart4 flot-chart-container"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="120" height="80" class="ct-chart-bar" style="width: 120px; height: 80px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="17.420989990234375" x2="17.420989990234375" y1="71.03460693359375" y2="59.827685546875" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="71.03460693359375" y2="45.819033813476565" class="ct-bar" ct:value="900" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="71.03460693359375" y2="48.62076416015625" class="ct-bar" ct:value="800" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="71.03460693359375" y2="51.42249450683594" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line></g><g class="ct-series ct-series-b"><line x1="17.420989990234375" x2="17.420989990234375" y1="59.827685546875" y2="31.810382080078128" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="45.819033813476565" y2="31.810382080078128" class="ct-bar" ct:value="500" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="48.62076416015625" y2="31.81038208007812" class="ct-bar" ct:value="600" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="51.42249450683594" y2="31.810382080078128" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line></g></g><g class="ct-labels"></g></svg></div>
                            </div>
                            <div class="sale-chart">   
                              <div class="media-body m-l-40">
                                <h6 class="f-w-100 m-l-10">AED {{$current_month_value}}</h6>
                                <h4 class="mb-0 f-w-700 m-l-10">{{$language[6][Auth::guard('admin')->user()->lang]}}</h4>
                              </div>
                            </div>
                          </div>
                        </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">                    </span></span></span>
                      </div>
                    </div>
                  </div> -->

                </div>
              </div>
              <div class="col-xl-8 xl-100 box-col-12">
                <div class="card">
                  <div class="card-header no-border">
                    <h5>{{$language[7][Auth::guard('admin')->user()->lang]}}</h5>
                    <ul class="creative-dots">
                      <li class="bg-primary big-dot"></li>
                      <li class="bg-secondary semi-big-dot"></li>
                      <li class="bg-warning medium-dot"></li>
                      <li class="bg-info semi-medium-dot"></li>
                      <li class="bg-secondary semi-small-dot"></li>
                      <li class="bg-primary small-dot"></li>
                    </ul>
                    <!-- <div class="card-header-right">
                      <ul class="list-unstyled card-option">
                        <li><i class="icofont icofont-gear fa fa-spin font-primary"></i></li>
                        <li><i class="view-html fa fa-code font-primary"></i></li>
                        <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                        <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                        <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                        <li><i class="icofont icofont-error close-card font-primary"></i></li>
                      </ul>
                    </div> -->
                  </div>
                  <div class="card-body pt-0">
                    <div class="activity-table table-responsive recent-table selling-product">
                      <table class="table table-bordernone">
                        <tbody>
                          @foreach($shipment as $row)
                          <tr>
                            <td>
                              <h5 class="default-text mb-0 f-w-700 f-18">#{{$row->order_id}}</h5>
                            </td>
                            <td>
                              <h5 class="default-text mb-0 f-w-700 f-18">
                                @if($row->shipment_mode == '1')
                                Standard
                                @else
                                Express
                                @endif
                              </h5>
                            </td>
                            <td class="f-w-700">AED {{$row->total}}</td>
                            <td>
                              <h6 class="mb-0">
                              <?php
                              if($row->status == 0){
                                echo 'Pending';
                              }
                              elseif($row->status == 1){
                                  echo 'Approved';
                              }
                              elseif($row->status == 2){
                                  echo 'Package Collected';
                              }
                              elseif($row->status == 3){
                                  echo 'Exception';
                              }
                              elseif($row->status == 4){
                                  echo 'Received Station Hub';
                              }
                              elseif($row->status == 5){
                                  echo 'Assign Agent to Transit Out (Hub)';
                              }
                              elseif($row->status == 6){
                                  echo 'Other Transit in Received (Hub)';
                              }
                              elseif($row->status == 7){
                                  echo 'Assign Agent to Delivery';
                              }
                              elseif($row->status == 8){
                                  echo 'Shipment delivered';
                              }
                              ?>
                              </h6>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
@endsection
@section('extra-js')
    <script src="/assets/app-assets/js/chart/chartist/chartist.js"></script>
    <script src="/assets/app-assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="/assets/app-assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="/assets/app-assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="/assets/app-assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="/assets/app-assets/js/prism/prism.min.js"></script>
    <script src="/assets/app-assets/js/clipboard/clipboard.min.js"></script>
    <script src="/assets/app-assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="/assets/app-assets/js/counter/jquery.counterup.min.js"></script>
    <script src="/assets/app-assets/js/counter/counter-custom.js"></script>
    <script src="/assets/app-assets/js/custom-card/custom-card.js"></script>
    <script src="/assets/app-assets/js/dashboard/crypto-custom.js"></script>
    <script src="/assets/app-assets/js/tour/intro.js"></script>
    <script src="/assets/app-assets/js/tour/intro-init.js"></script>
    <script src="/assets/app-assets/js/chat-menu.js"></script>
    <script src="/assets/app-assets/js/height-equal.js"></script>
    

@endsection