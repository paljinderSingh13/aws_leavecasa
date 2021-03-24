@extends('frontend.layout.materialize')
@section('content')

<?php 

//dd($results);
?>

{{--  @foreach($results['Response']['Results'][0] as $key => $record) 
 --}}
<section id="content ">

  <div class="row mdb p1 sticky"> 
        <div class="col offset-l1 l5 s12">
            <p class="f28w100 white-text mt0 mb0">Flight Search Results</p>
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

    <div class="container">

                <div id="main">
                    @if($errorStatus == false)
                    
                        <div class="row">
                            <div class="col offset-s1 s10 m2 l2 pr-0 sticky1">
                            
                               <div class="card  animate fadeLeft border-radius-8 z-depth-4">
                                <div class="card-content">
                                
                                <span class="card-title icon_prefix" ><i class="material-icons mr-2 search-icon orange-text" style="vertical-align: top;">search</i><b>{{ count($results['Response']['Results'][0]) }}</b> results.</span>
                                

                                        <!-- <h5 class="card-title">
                                            <a data-toggle="collapse" href="#airlines-filter" class="collapsed">Advance Search</a>
                                        </h5> -->
                                        <span class="card-title mt-10">Advance Search</span>
                                        <hr class="p-0 mb-10">
                                        <div class="loader"></div>
                                            <form method="post" action="{{ route('advance.search.results') }}"> 
                                                <input type="hidden" value="{{ $tripType }}" name="trip_type" />
                                                {{ csrf_field() }}
                                                    @foreach($airlines as $key => $airline)
                                                    <p class="display-grid">
                                                            <label>
                                                            <input type="checkbox" value="{{  $airline->IATA }}" name="PreferredAirlines[]">
                                                            <span>{{ $airline->Airline }} </span></label>
                                                      </p>  
                                                    @endforeach

                                                    <span class="card-title mt-10">Departure Time</span>
                                                     <hr class="p-0 mb-10">
                                                     <p class="display-grid">
                                                        <label>
                                                            <input type="checkbox" value="true" name="DirectFlight"><span>Direct </span>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" value="true" name="OneStopFlight"><span>One Stop </span>
                                                        </label>
                                                     </p>

                                                   <span class="card-title mt-10">Seat Class</span>
                                                     <hr class="p-0 mb-10">
                                                     <p class="display-grid">
                                                    <label> <input type="radio" class="with-gap" name="preferClass" value="1"> <span>All  </span></label>
                                                    <label><input type="radio" class="with-gap" name="preferClass" value="2"><span> Economy</span></label>
                                                    <label><input type="radio" class="with-gap" name="preferClass" value="3"><span> Premium Economy</span></label>
                                                    <label><input type="radio" class="with-gap" name="preferClass" value="4"><span> Business</span></label>
                                                    <label><input type="radio" class="with-gap" name="preferClass" value="5"><span> Premium Business</span></label>
                                                    <label><input type="radio" class="with-gap" name="preferClass" value="6"><span> First</span></label></p>

                                                    <span class="card-title mt-10">Departure Time</span>
                                                     <hr class="p-0 mb-10">
                                                     <p class="display-grid">
                                                    <label><input type="radio" class="with-gap" name="preferDepartureTime" value="mor"><span> Morning</span></label>
                                                    <label><input type="radio" class="with-gap" name="preferDepartureTime" value="aft"><span> After-noon</span></label>
                                                    <label><input type="radio" class="with-gap" name="preferDepartureTime" value="eve"><span> Evening</span></label></p>
                                                
                                                 
                                                 <button class="btn mdb waves-effect waves-light mt3" type="submit">search again
                                                 </button>
                                        </form>
                                    
                                </div>
                            </div>
                        </div> {{-- end div side bar s2 --}}

                       {{--  result area start here --}}
                        <div class="col s12 m10 l10">
                          <div class="sort-by-section row hide-on-med-and-down">
                            <div class="col l2"><h6 class="center-align">Sort By:</h6></div>
                            <div class="col l2"><h6 class="center-align">Departure</h6></div>
                            <div class="col l2"><h6 class="center-align">Duration</h6></div>
                            <div class="col l2"><h6 class="">Arrival</h6></div>
                            <div class="col l2"><h6 class="">Price</h6></div>
                            <div class="col l2"><h6 class="">Book</h6></div>
                          </div>
                           @if($results['Response']['Error']['ErrorCode'] == 0)
                               @foreach($results['Response']['Results'][0] as $key => $record) 
                                  <?php
                                    dump($key);

                                   ?>
                               @endforeach  {{-- end foreach $results['Response']['Results'][0]  --}}

                           @endif {{-- $results['Response']['Error']['ErrorCode'] errors endif  --}}
                         
                        </div>  
                        {{--  end result area start here --}}
          @endif {{-- errors if  --}}
  </div> {{-- row end div --}}
</div>{{-- main end div --}}
</div> {{-- container end div --}}

</section>
?>