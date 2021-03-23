@extends('frontend.layout.materialize')
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/style.css') }}">
@section('content')
@php
use App\Helpers\Hotel;
//dump(json_encode(Session::get('hotel_req')));
@endphp
@if($no_of_hotels!=0) 
<div class="home1">
  <div class="home_slider_container1">
    <div class="owl-carousel owl-theme home_slider1">
      <div class="owl-item home_slider_item1">
        <div class="home_slider_background1" style="background-image:url(../images/bg.jpg)"></div>
        <div class="home_slider_content1 text-center">
          <div class="home_slider_content_inner1" data-animation-in="flipInX" data-animation-out="animate-out fadeOut">
            <h1>{{ $no_of_hotels }}  Hotel Found</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="section" id="content">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h4 class="search-results-title text-black"><i class="soap-icon-search"></i><b>{{ $no_of_hotels }} </b> results found.</h4>
          <div class="toggle-container filters-container">
            <div class="panel style1 arrow-right">
              <h4 class="panel-title">
              <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
              </h4>
              <div id="price-filter" class="panel-collapse collapse">
                <div class="panel-content">
                  <div id="price-range"></div>
                  <br />
                  <span class="min-price-label pull-left"></span>
                  <span class="max-price-label pull-right"></span>
                  <div class="clearer"></div>
                  </div>
                </div>
              </div>
              
              <div class="panel style1 arrow-right">
                <h4 class="panel-title">
                <a data-toggle="collapse" href="#rating-filter" class="collapsed">Rating</a>
                </h4>
                <div id="rating-filter" class="panel-collapse collapse">
                  <div class="panel-content">
                 <form  action="{{ route('hotels.results') }}" method="post" >
                {{ csrf_field() }}   
                @foreach(Session::get('orginal_request') as $okey => $oval)
                @if($okey =='_token')
                  @continue
                @endif

                @if(is_array($oval))
                  @foreach($oval as $rok => $roV)
                      @if(is_array($roV))
                        @continue
                      @endif
                        <input type="hidden" name="{{$okey}}[{{ $rok }}]" value="{{$roV}}">
                  @endforeach
                @else
                  <input type="hidden" name="{{ $okey }}" value="{{$oval  }}">
                @endif
                @endforeach
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck5" name="stars" class="stars" value="5" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck5"><img src="{{ url('images/star/star_rating_5.png')}}" alt="1 Star"> 5 Star</label>
                 </div>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck4" name="stars" class="stars" value="4" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck4"><img src="{{ url('images/star/star_rating_4.png')}}" alt="1 Star"> 4 Star</label>
                 </div>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck3" name="stars" class="stars" value="3" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck3"><img src="{{ url('images/star/star_rating_3.png')}}" alt="1 Star"> 3 Star</label>
                 </div>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck2" name="stars" class="stars" value="2" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck2"><img src="{{ url('images/star/star_rating_2.png')}}" alt="1 Star"> 2 Star</label>
                 </div>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="stars" class="stars" value="1" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck1"><img src="{{ url('images/star/star_rating_1.png')}}" alt="1 Star"> 1 Star</label>
                 </div>
                </form>
                  </div>
                </div>
              </div>
              
              
              <div class="panel style1 arrow-right">
                <h4 class="panel-title">
                <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                </h4>
                <div id="modify-search-panel" class="panel-collapse collapse">
                  <div class="panel-content">
                    <form method="post">
                      <div class="form-group">
                        <label>destination</label>
                        <input type="text" class="input-text full-width" placeholder="" value="" />
                      </div>
                      <div class="form-group">
                        <label>check in</label>
                        <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                      </div>
                      <div class="form-group">
                        <label>check out</label>
                          <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                      </div>
                      <button class="button search_button mt-0">search<span></span><span></span><span></span></button>
                      
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9 ">
          <div class="sort-by-section clearfix">
            <h4 class="sort-by-title block-sm text-black">Sort results by:</h4>
            <ul class="sort-bar clearfix block-sm ">
              <li class="sort-by-name"><a class="sort-by-container text-black" href="javascript:void(0)"><span>name</span></a></li>
              <li class="sort-by-price"><a class="sort-by-container text-black" href="javascript:void(0)"><span>price</span></a></li>
              <li class="clearer visible-sms"></li>
              <li class="sort-by-rating active"><a class="sort-by-container text-black" href="javascript:void(0)"><span>rating</span></a></li>
            </ul>
          </div>
          <div class="hotel-list">
  {{-- <div class="row image-box listing-style2 "> --}}
   @foreach($results as $h_key => $h_val)
@php
  $datah = collect($h_val['hotels']);
  $resulth = $datah->groupBy([
     function ($item) {
      if(empty($item['category'])){
         return 0;
      }
      return (int)$item['category'];
      },
  ], $preserveKeys = true);
  $cat_wise_hotel = $resulth->toArray();
@endphp

@foreach($cat_wise_hotel as $cat => $catVal)
  <div class="cat_{{ $cat }} show_cat row">
  @foreach($catVal as $key => $hotel)
    @php
    $mark_price =0;
    if(!empty($hotel['category']))
    {
      $hotel_cat = explode('.', $hotel['category']);
      $mark_data =  $mark_up->where('star_ratting',$hotel_cat[0])->toArray();
      if(!empty($mark_data)){
        foreach ($mark_data   as $key => $value) 
        {
          if($value['amount_by'] =="rupee"){
              $mark_price =  $value['amount'];
           }
           elseif($value['amount_by'] =="percent"){
              $mark_price = Hotel::cal_markup_percent_val($hotel['min_rate']['price'], $value['amount']);  
           }
        }
      }
     $dull = 5 - $hotel['category'];
    }
  $hotel_total_price =  $hotel['min_rate']['price'] + $mark_price;
@endphp 

    <div class="col-sm-6 col-md-4 mb-3">
      <div class="card">
             @if(!empty($hotel['images']['url']))
          <img class="card-img-top" src="{{ $hotel['images']['url'] }}" style="height:200px">
          @else
          <img class="card-img-top" src="{{ asset('images/demo_hotel.jpg') }}" style="height:200px">
          @endif
          <div class="card-body p-1" >
            
        @if(!empty($hotel['category']))
        <span>
      @php
        $rating = floor($hotel['category']);
        $decimalstart = $hotel['category'] - $rating;
      $pointrating = $decimalstart * 10;
      $rating2 = ceil($hotel['category']);
      $unfieldstar = 5-$rating2;
      @endphp
      @for($i=0;$i<$rating;$i++)
      <img src="{{ url('/images/star/star.png') }}"  width="16" height="16">
      @endfor 
      @if(strpos($decimalstart,'.') !== false)
      <img src="{{ url('/images/star/star'.$pointrating.'.png') }}" width="16" height="16">
      @endif
      @for($j=0;$j<$unfieldstar;$j++)
      <img src="{{ url('/images/star/unfield-star.png') }}" width="16" height="16">
      @endfor</span>
      @if(!empty($hotel['min_rate']['non_refundable']) &&($hotel['min_rate']['non_refundable']==true))
          <span class=" text-danger float-right text-right mr-2 fs20">
              Non Refundable
          </span>
      @endif
      @endif
      <p>
     <h4 class=""><i class="fa fa-map-marker" aria-hidden="true"></i>
          {{ Illuminate\Support\Str::limit($hotel['name'], 22, '...') }}</h4>
       </p> 
        <p>
     <h4 class=""><i class="fas fa-wallet"></i>
          {{ Illuminate\Support\Str::limit($hotel['name'], 22, '...') }}</h4>
       </p>   
          <div class="action">
            <a class="button btn-small" href="hotel-detailed.html">SELECT</a>
          </div>
        </div>
    </div></div>
  @endforeach
</div>
@endforeach
@endforeach

{{-- </div> --}}




        </div>
      </div>
    </div>
  </div>
  </section>
  @else
  @include('frontend.component.sliderother')
  @endif
  @endsection
  @section('script')
  <script type="text/javascript">
        $(document).ready(function() {
            $("#price-range").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [ 100, 800 ],
                slide: function( event, ui ) {
                    $(".min-price-label").html( "$" + ui.values[ 0 ]);
                    $(".max-price-label").html( "$" + ui.values[ 1 ]);
                }
            });
            $(".min-price-label").html( "$" + $("#price-range").slider( "values", 0 ));
            $(".max-price-label").html( "$" + $("#price-range").slider( "values", 1 ));
            
            $("#rating").slider({
                range: "min",
                value: 40,
                min: 0,
                max: 50,
                slide: function( event, ui ) {
                    
                }
            });
        });
    </script>
    @endsection