@extends('frontend.layout.materialize')
@section('content')
@php 

use App\Helpers\Hotel;
 //dump(json_encode(Session::get('hotel_req')));
@endphp
       <div class="row mdb p1"> 
        <div class="col offset-l1 l5 s12">
            <p class="f28w100 white-text mt0 mb0"> {{ $no_of_hotels }} Hotels found</p>
        </div>
        <div class="col l5 p0 hide-on-med-and-down">
            <ul class="stepper horizontal">
                <li class="step active blue-text">
                    <div class="step-title waves-effect">Selection</div>
                </li>
                <li class="step grey-text">
                    <div class="step-title waves-effect">Review</div>
                </li>
                <li class="step grey-text">
                    <div class="step-title waves-effect">Payment</div>
                </li>
            </ul>
        </div> 
    </div>
    {{--   <div class="row ">
   @include('frontend.component.hotel_search')
   </div> --}}
            <div class="container">
                <div id="main">
                  @if($no_of_hotels!=0) 
                    <div class="row" id="ecommerce-products">
                     
                        
                        <div class="col offset-s1 s10 m2 l2 pr-0 sticky1">
                            
                               <div class="card  animate fadeLeft border-radius-8 z-depth-4">
                                <div class="card-content">


                                
                                <span class="card-title icon_prefix" ><i class="material-icons mr-2 search-icon orange-text" style="vertical-align: top;">search</i><b>{{ $no_of_hotels }}</b> results.</span>
                                        <span class="card-title mt-10">Advance Search</span>
                                        <hr class="p-0 mb-10">
                                             <span class="card-title mt-10">Category</span>
                                                     <hr class="p-0 mb-10">
                                                     <p class="display-grid black-text">
                                           <form  action="{{ route('hotels.results') }}" method="post" >
                                                    {{ csrf_field() }}

                                                     @php
                                                    	//dump(Session::get('orginal_request'));
                                                    @endphp
                                                     

                                                    @foreach(Session::get('orginal_request') as $okey => $oval)
                                                    @if($okey =='_token')
                                                      @continue
                                                    @endif
                                                      @if(is_array($oval))
                                                       @php

                                                    	//dd($okey, $oval);
                                                    @endphp
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


                                                    <label> <input type="checkbox" class="with-gap" name="stars" class="stars" value="5" onclick="getCheckedBoxes()"> <span>5 Star </span></label>
                                                    <label><input type="checkbox" class="with-gap" name="stars" class="stars" value="4" onclick="getCheckedBoxes()"><span>4 Star</span></label>
                                                    <label><input type="checkbox" class="with-gap" name="stars" class="stars" value="3" onclick="getCheckedBoxes()"><span>3 Star</span></label>
                                                    <label><input type="checkbox" class="with-gap" name="stars" class="stars" value="2" onclick="getCheckedBoxes()"><span>2 Star</span></label>
                                                    <label><input type="checkbox" class="with-gap" name="stars" class="stars" value="1" onclick="getCheckedBoxes()"><span>1 Star</span></label>

                                                   {{--  <span class="card-title mt-10">Price</span>
                                                     <hr class="p-0 mb-10">
                                                     <p class="display-grid">
                                                    <label><input type="radio" class="with-gap" name="priceFilter" value="mor"><span> Low to High</span></label>
                                                    <label><input type="radio" class="with-gap" name="priceFilter" value="aft"><span> High to Low</span></label></p> --}}
                                                
                                                 
                                                 <button class="btn mdb waves-effect waves-light mt3" type="submit">search again
                                                 </button>
                                      </form>
                                </div>
                            </div>
                        </div>
  
 <div class="col l10">                       
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
<div class="cat_{{ $cat }} show_cat"> 

	@php
	@endphp
@foreach($catVal as $key => $hotel)
@php
    $mark_price =0;
    // dump($hotel['category']);

    if(!empty($hotel['category']))
    {
    	$hotel_cat = explode('.', $hotel['category']);
      $mark_data =  $mark_up->where('star_ratting',$hotel_cat[0])->toArray();
        if(!empty($mark_data)){

      foreach ($mark_data   as $key => $value) {
          # code...
           if($value['amount_by'] =="rupee"){
              $mark_price =  $value['amount'];
           }elseif($value['amount_by'] =="percent"){

             $mark_price = Hotel::cal_markup_percent_val($hotel['min_rate']['price'], $value['amount']);
             
           }
        }
       }
      $dull = 5 - $hotel['category'];
    }
   $hotel_total_price =  $hotel['min_rate']['price'] + $mark_price;
  @endphp
  @if($loop->iteration%3==0)
        <div>
        
      @endif
    <div class="col s12 m4" id="h_detail">
      <div class="card hotel-list listing-style3 hotel z-depth-4 border-radius-8">
       {{--   <div class="card-badge"><a class="white-text"> <b>₹ {{ $hotel_total_price}}</b> </a></div> --}}
        <div class="card-image waves-effect waves-block waves-light">
          @if(!empty($hotel['images']['url']))
          <img class="activator responsive-img" src="{{ $hotel['images']['url'] }}" style="height:200px">
          @else
          <img class="activator responsive-img" src="{{ asset('images/demo_hotel.jpg') }}" style="height:200px">
          @endif
        </div>
        <div class="card-content">

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
      @endfor 
        </span>


          @if(!empty($hotel['min_rate']['non_refundable']) &&($hotel['min_rate']['non_refundable']==true))
          <span class=" red-text valign right mr-5 fs20">
              Non Refundable
          </span>
      @endif
      @endif
          <p class="activator mdb-text text-darken-4">
            <i class="material-icons left mt-1 red-text">location_on</i>
            <h6>
          {{ Illuminate\Support\Str::limit($hotel['name'], 25, '...') }}</h6>  
      {{--   {{ $hotel_total_price  }} = {{  $hotel['min_rate']['price']}} + {{ $mark_price  }} --}}
      </p>
      <p class="activator mdb-text text-darken-4">
            <i class="material-icons left mt-1 green-text">account_balance_wallet</i>
            
            <h6>
          ₹ {{ $hotel_total_price}}</h6>  
       {{--  {{ $hotel_total_price  }} = {{  $hotel['min_rate']['price']}} + {{ $mark_price  }} --}}
      </p>
          <p class="grey-text text-darken-4">
            <i class="material-icons left">more</i>
            <a href="javascript:modal_open({{ $loop->index }})" >
          Facilities</a>          
         </p>
     
           <div class="modal" id="modal{{ $loop->index }}"  tabindex="-1">
    <div class="modal-content" id="{{ $loop->index }}">
      <h5 class="mt0 collection-item">Facilities at {{ $hotel['name'] }}</h5>

      @if(!empty($hotel['facilities']))
        <div class="row">

         @foreach(explode(';', $hotel['facilities']) as $info)
          @if($loop->iteration%4==0)
          <div>
           @endif
           <div class="col m4 s10 lc">
            <i class="fas fa-check mdb-text mr1 "></i>{{$info}}</div>
         @if($loop->iteration%4==0)
           </div>        
       @endif
         @endforeach
    </div>
    

    @endif

    
  </div></div>
        </div>
          {{-- <span>{{ $hotel['address'] }}</span> --}}
             
        <div class="card-action">
          <a href="{{ route('hotel.detail',['sid'=>$h_val['search_id'], 'code'=>$hotel['hotel_code']]) }}" class="btn mdb">More Info</a>
        </div>        
      </div>
    </div>
   
  @if($loop->iteration%3==0)
        </div>
        
      @endif
      
@endforeach
</div>
@endforeach
@endforeach

                      </div>
                     
                    </div>

                     @else
                        <div class="col s12  l10 center-align white">
      <img src="{{ asset('images/not_found.gif') }}" class="bg-gif-404" alt="">
      <h1 class="error-code m-0">Sorry ! No Result Found</h1>
      <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="{{ route('index')}}">Back
        TO Home</a>
    </div>
                      @endif
                </div>
            </div>

@endsection
