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
          <form action="/admin/date-dashboard" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
              <div class="row">
                <div class="form-group col-md-3">
                    <label>{{$language[117][Auth::guard('admin')->user()->lang]}}</label>
                    <input value="{{$cfdate}}" autocomplete="off" type="date" id="from_date" name="from_date" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label>{{$language[118][Auth::guard('admin')->user()->lang]}}</label>
                    <input value="{{$cldate}}" autocomplete="off" type="date" id="to_date" name="to_date" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <button id="search" class="btn btn-primary btn-block mr-10" type="submit">{{$language[114][Auth::guard('admin')->user()->lang]}}
                    </button>
                </div>
              </div>
            </form>
            <div class="row">
          
            @if($role_get->dashboard != 'on')
            @else 
              <div class="col-lg-12">
                <div class="row ecommerce-chart-card">
                  
                               

              <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-info o-hidden">
                  <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus text-white i"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                      </div>
                      <div class="media-body"><span class="m-0 text-white">{{$language[2][Auth::guard('admin')->user()->lang]}}</span>
                        <h4 class="mb-0 counter text-white">{{$total_individual}}</h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus icon-bg"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-info o-hidden">
                  <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus text-white i"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                      </div>
                      <div class="media-body"><span class="m-0 text-white">{{$language[4][Auth::guard('admin')->user()->lang]}}</span>
                        <h4 class="mb-0 counter text-white">{{$total_business}}</h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus icon-bg"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
{{-- 
              <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-info o-hidden">
                  <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg></div>
                      <div class="media-body"><span class="m-0">Products</span>
                        <h4 class="mb-0 counter">9856</h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag icon-bg"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div> --}}

{{-- 
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
                  </div> --}}

                    <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-primary o-hidden">
                  <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg></div>
                      <div class="media-body"><span class="m-0 text-white"><br>{{$language[5][Auth::guard('admin')->user()->lang]}}</span>
                        <h4 class="mb-0 counter">{{$total_shipment}}</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database icon-bg"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-secondary o-hidden">
                  <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg></div>
                      <div class="media-body"><span class="m-0">{{$language[6][Auth::guard('admin')->user()->lang]}}</span>
                        {{-- <span>AED</span> --}}
                        <h5 class="mb-0">AED {{round($current_month_value,2)}}</h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag icon-bg"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                  {{-- <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card gradient-primary o-hidden">
                      <div class="card-body tag-card">
                        <div class="ecommerce-chart">
                          <div class="media ecommerce-small-chart">
                            <div class="small-bar">
                              <div class="small-chart1 flot-chart-container"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="120" height="80" class="ct-chart-bar" style="width: 120px; height: 80px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="17.420989990234375" x2="17.420989990234375" y1="71.03460693359375" y2="59.827685546875" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="71.03460693359375" y2="45.819033813476565" class="ct-bar" ct:value="900" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="71.03460693359375" y2="48.62076416015625" class="ct-bar" ct:value="800" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="71.03460693359375" y2="51.42249450683594" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line></g><g class="ct-series ct-series-b"><line x1="17.420989990234375" x2="17.420989990234375" y1="59.827685546875" y2="31.810382080078128" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="45.819033813476565" y2="31.810382080078128" class="ct-bar" ct:value="500" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="48.62076416015625" y2="31.81038208007812" class="ct-bar" ct:value="600" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="51.42249450683594" y2="31.810382080078128" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line></g></g><g class="ct-labels"></g></svg></div>
                            </div>
                            <div class="sale-chart">   
                              <div class="media-body m-l-40">
                                <h6 class="f-w-100 m-l-10"><?php echo round($total_shipment,2); ?></h6>
                                <h4 class="mb-0 f-w-700 m-l-10">{{$language[5][Auth::guard('admin')->user()->lang]}}</h4>
                              </div>
                            </div>
                          </div>
                        </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">       </span></span></span>
                      </div>
                    </div>
                  </div> --}}

                  {{-- <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card gradient-primary o-hidden">
                      <div class="card-body tag-card">
                        <div class="ecommerce-chart">
                          <div class="media ecommerce-small-chart">
                            <div class="small-bar">
                              <div class="small-chart1 flot-chart-container"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="120" height="80" class="ct-chart-bar" style="width: 120px; height: 80px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><line x1="17.420989990234375" x2="17.420989990234375" y1="71.03460693359375" y2="59.827685546875" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="71.03460693359375" y2="45.819033813476565" class="ct-bar" ct:value="900" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="71.03460693359375" y2="48.62076416015625" class="ct-bar" ct:value="800" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="71.03460693359375" y2="51.42249450683594" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="71.03460693359375" y2="43.017303466796875" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line></g><g class="ct-series ct-series-b"><line x1="17.420989990234375" x2="17.420989990234375" y1="59.827685546875" y2="31.810382080078128" class="ct-bar" ct:value="1000" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="30.142687116350444" x2="30.142687116350444" y1="45.819033813476565" y2="31.810382080078128" class="ct-bar" ct:value="500" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="42.864384242466514" x2="42.864384242466514" y1="48.62076416015625" y2="31.81038208007812" class="ct-bar" ct:value="600" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="55.58608136858259" x2="55.58608136858259" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="68.30777849469865" x2="68.30777849469865" y1="51.42249450683594" y2="31.810382080078128" class="ct-bar" ct:value="700" style="stroke-width: 5px ; stroke-linecap: round"></line><line x1="81.02947562081474" x2="81.02947562081474" y1="43.017303466796875" y2="31.810382080078128" class="ct-bar" ct:value="400" style="stroke-width: 5px ; stroke-linecap: round"></line></g></g><g class="ct-labels"></g></svg></div>
                            </div>
                            <div class="sale-chart">   
                              <div class="media-body m-l-40">
                                <h6 class="f-w-100 m-l-10">AED <?php echo round($current_month_value,2); ?></h6>
                                <h4 class="mb-0 f-w-700 m-l-10">{{$language[6][Auth::guard('admin')->user()->lang]}}</h4>
                              </div>
                            </div>
                          </div>
                        </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">       </span></span></span>
                      </div>
                    </div>
                  </div> --}}
                  
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
                              <h5 class="default-text mb-0 f-w-700 f-18">
                              @foreach($shipment_package as $key => $packages)
                                @if($row->id == $packages->shipment_id)
                                #{{$packages->sku_value}}
                                <?php break; ?>
                                @endif
                              @endforeach
                              </h5>
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
                            <td class="f-w-700">AED {{round($row->total,2)}}</td>
                            <td>
                              <h6 class="mb-0">
                              <?php
                              if($row->status == 0){
                                echo '<a href="/admin/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Pending</button></a>';
                              }
                              elseif($row->status == 1){
                                  echo '<a href="/admin/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Approved</button></a>';
                              }
                              elseif($row->status == 2){
                                  echo '<a href="/admin/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Package Collected</button></a>';
                              }
                              elseif($row->status == 3){
                                  echo '<a href="/admin/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Exception</button></a>';
                              }
                              elseif($row->status == 4){
                                  echo '<a href="/admin/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Received Station Hub</button></a>';
                              }
                              elseif($row->status == 5){
                                  echo '<a href="/admin/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Assign Agent to Transit Out (Hub)</button></a>';
                              }
                              elseif($row->status == 6){
                                  echo '<a href="/admin/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Other Transit in Received (Hub)</button></a>';
                              }
                              elseif($row->status == 7){
                                  echo '<a href="/admin/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Assign Agent to Delivery</button></a>';
                              }
                              elseif($row->status == 8){
                                  echo '<a href="/admin/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Shipment delivered</button></a>';
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