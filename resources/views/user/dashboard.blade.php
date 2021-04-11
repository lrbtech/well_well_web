@extends('user.layouts')
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
                  <h2>{{$language[141][Auth::user()->lang]}} <span>{{$language[1][Auth::user()->lang]}}  </span></h2>
               
                </div>
                <div class="col-lg-6 breadcrumb-right">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/user/dashboard"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item">{{$language[1][Auth::user()->lang]}}</li>
                    <li class="breadcrumb-item active"> </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">

            
            <form action="/user/date-dashboard" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
              <div class="row">
                <div class="form-group col-md-3">
                    <label>{{$language[117][Auth::user()->lang]}}</label>
                    <input value="{{$cfdate}}" autocomplete="off" type="date" id="from_date" name="from_date" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label>{{$language[118][Auth::user()->lang]}}</label>
                    <input value="{{$cldate}}" autocomplete="off" type="date" id="to_date" name="to_date" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <button id="search" class="btn btn-primary btn-block mr-10" type="submit">{{$language[114][Auth::user()->lang]}}
                    </button>
                </div>
              </div>
            </form>

            <div class="row">
          <div class="col-lg-12">
                <div class="row ecommerce-chart-card">

                <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-primary o-hidden">
                  <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg></div>
                      <div class="media-body"><span class="m-0 text-white"><br>{{$language[5][Auth::user()->lang]}}</span>
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
                      <div class="media-body"><span class="m-0">{{$language[6][Auth::user()->lang]}}</span>
                        {{-- <span>AED</span> --}}
                        <h5 class="mb-0">AED {{round($current_month_value,2)}}</h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag icon-bg"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
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
                      <div class="media-body"><span class="m-0">Current Month C.O.D</span>
                        {{-- <span>AED</span> --}}
                        <h5 class="mb-0">AED {{round($current_month_cod,2)}}</h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag icon-bg"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
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
                      <div class="media-body"><span class="m-0">Settlement Value</span>
                        {{-- <span>AED</span> --}}
                        <h5 class="mb-0">AED {{round($settlement_value,2)}}</h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag icon-bg"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



                </div>
              </div>
           <div class="col-xl-8 xl-100 box-col-12">
                <div class="card">
                  <div class="card-header no-border">
                    <h5>{{$language[7][Auth::user()->lang]}}</h5>
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
                            <td class="f-w-700">
                              <h6 class="mb-0">
                              <?php
                              if($row->status == 0){
                                echo '<a href="/user/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Scheduled for Pickup</a>';
                              }
                              elseif($row->status == 1){
                                echo '<a href="/user/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Pickup Assigned</a>';
                              }
                              elseif($row->status == 2){
                                echo '<a href="/user/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Package Collected</a>';
                              }
                              elseif($row->status == 3){
                                echo '<a href="/user/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Exception</a>';
                              }
                              elseif($row->status == 4){
                                echo '<a href="/user/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Transit In</a>';
                              }
                              elseif($row->status == 5){
                                echo '<a href="/user/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Assign Agent to Transit Out (Hub)</a>';
                              }
                              elseif($row->status == 6){
                                echo '<a href="/user/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Transit Out</a>';
                              }
                              elseif($row->status == 7){
                                echo '<a href="/user/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">In the Van for Delivery</a>';
                              }
                              elseif($row->status == 8){
                                echo '<a href="/user/view-shipment/'.$row->id.'" class="btn btn-shadow-primary">Shipment delivered</a>';
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