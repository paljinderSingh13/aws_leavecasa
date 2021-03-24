<div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="">
        <div class="row modal-header p1">
            <div class="col l4">
                <h6 class="modal-title">Seat Layout</h6>
            </div>
            {{-- <div class="col l8">
                
            </div> --}}
        </div>
        @if(!empty($from) && $from == 'admin')
        {!! Form::open(['route'=>'bus.passengers.details','id'=>'confirm_booking','method'=>'post']) !!}
        @else
        {!! Form::open(['route'=>'bus.booking.passengers','id'=>'confirm_booking','method'=>'post']) !!}
        @endif
        <div class="modal-content p1">


            
            <div class="row">
                <div class="col l7 s12">

                    <div id="seats">
                        

                    </div>
                    
                    <input type="hidden" value="{{ $maxSeats }}" class="maximum_seats" />
                    <input type="hidden" value="{{ $bus_id }}" name="bus_id" />
                    @php
                    $markup_amount =0;
                    function cal_markup($fare, $cent){
                    return number_format($fare/100*$cent, 0);
                    }
                    // dump($request);
                    if(!empty($request['markup_type']) && $request['markup_type'] == "amount"){
                    $markup_amount = $request['markup'];
                    }
                    $nu =0;
                    @endphp
                    
                    @foreach($seatData as $zIndex => $layer)
                    @php
                    // dump($seatData->toArray());
                    // $layer = $layer->sortBy('row');
                    $layer = $layer->sortBy(function($object, $key){
                    return $key;
                    });
                    @endphp
                    @if($zIndex == 1)
                    <div class="row bus_row">
                        <div class="col l12">
                            
                            <div class="bus_layout">
                                <div class="driver">
                                    <div class="steering_wheel upper">
                                        <p>UPPER</p>
                                    </div>
                                </div>
                                <div class="seats_layout">
                                    @php
                                    $marginIndex = 0;
                                    $index = 0;
                                    if(!empty($layer[0])){
                                    
                                    $usize = count($layer[0]);
                                    }else{
                                    $usize = count($layer[1]);
                                    }
                                    // dump($usize ,  $layer->toArray());
                                    @endphp
                                    @foreach($layer as $k => $row)
                                    @php
                                    if($marginIndex == 0){
                                    $margin = floor((100/count($row))-6);
                                    }
                                    $row = $row->sortBy('column');
                                    $row = $row->keyBy('column');
                                    // dump($row);
                                    
                                    @endphp
                                    @for($u=0; $u < $usize; $u++ )
                                    @php
                                    $nu =  $u * 2;
                                    @endphp
                                    @if(empty($row[$nu]))
                                    @php
                                    
                                    $slWidth='14% !important';
                                    
                                    @endphp
                                    <div class="Seat white-text" style="float: left;width: {{ $slWidth }}; "> {{$nu}} </div>
                                    @continue
                                    @endif
                                    @php
                                    if( !empty($request['markup_type']) && $request['markup_type']=='percent'){
                                    $markup_amount =  cal_markup($row[$nu]['fare'], $request['markup']);
                                    }
                                    @endphp
                                    @if( ($row[$nu]['length'] == 2 && $row[$nu]['width'] == 1 )||($row[$nu]['length'] == 1 && $row[$nu]['width'] == 2 ))
                                    @php
                                     if($row[$nu]['ladiesSeat']=='false'){
                                        $ladies_seat ='';
                                        $lady_seat='';
                                    }else{
                                     $lady_seat='ladySleep';   
                                    $ladies_seat =' | Ladies Seat';
                                    }
                                    if($row[$nu]['available'] == 'false'){
                                    $availability = 'disabled';
                                    $sleeper_image = 'sleapper_seat_booked.png';
                                      if($row[$nu]['ladiesSeat'] == 'true'){
                                                $sleeper_image ="sleapper_seat_booked_ladies.png";
                                            }
                                    }else{
                                    $availability = '';
                                    $sleeper_image = 'sleapper_seat.png';
                                    if($row[$nu]['ladiesSeat'] == 'true'){
                                                $sleeper_image ="lady_sleapper_seat.png";
                                            }
                                    }



                                    @endphp
                                    <div class="seat tooltipped {{ @$availability }} sleeper sw {{ @$lady_seat }}" data-lady="{{ $row[$nu]['ladiesSeat']}},SL" data-toggle="tooltip"  data-position="right" data-original-title="Sleeper Seat" style="margin-right: {{ 2 }}%" data-fare="{{ $row[$nu]['fare'] }}" data-markup-fare="{{ $row[$nu]['fare'] + $markup_amount }}" data-name="{{ $row[$nu]['name'] }}" data-tooltip="Seat No : {{ $row[$nu]['name'] }}{{ $ladies_seat }}">
                                       
                                        <img src="{{ asset('public/images/'.$sleeper_image) }}">

                                    </div>
                                    @else
                                    @php
                                     if($row[$nu]['ladiesSeat']=='false'){
                                            $lady_seat='';
                                             $ladies_seat ='';
                                    }else{
                                            $lady_seat='ladySeat';   
                                    $ladies_seat =' | Ladies Seat';
                                    }
                                    if($row[$nu]['available'] == 'false'){
                                    $availability = 'disabled';
                                    $seat_image = 'bus_seat_booked.png';
                                     if($row[$i]['ladiesSeat'] == 'true'){
                                                $seat_image ="ladySeatBook.png";
                                            }
                                    }else{
                                    $availability = '';
                                    $seat_image = 'bus_seat.png';
                                     if($row[$i]['ladiesSeat'] == 'true'){
                                                $seat_image ="ladySeat.png";
                                            }
                                    }
                                    @endphp
                                    <div class="seat tooltipped {{ @$availability }} sitting sw {{ @$lady_seat }}" data-lady="{{ $row[$nu]['ladiesSeat']}}"  data-toggle="tooltip"  data-position="right" data-original-title="Sitting Seat" style="margin-right: {{ 2 }}%" data-markup-fare="{{ $row[$nu]['fare'] + $markup_amount }}"  data-fare="{{ $row[$nu]['fare'] }}" data-name="{{ $row[$nu]['name'] }}" data-tooltip="Seat No : {{ $row[$nu]['name'] }} {{ $ladies_seat }}">
                                        <img src="{{ asset('public/images/'.$seat_image) }}">
                                    </div>
                                    @endif
                                    
                                    @endfor
                                    <div class="row"></div>
                                    @php
                                    $index++;
                                    $marginIndex++;
                                    if($index == 2){
                                    echo '<br/>';
                                    $index = 0;
                                    }
                                    @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($zIndex == 0)
                    <div class="row bus_row">
                        <div class="col l12">
                            
                            <div class="bus_layout">
                                <div class="driver">
                                    <div class="steering_wheel upper">
                                        <img src="{{ asset('images/steering-wheel.png') }}" class="steering_wheel_image responsive-img">
                                        <p>LOWER</p>
                                    </div>
                                </div>
                                <div class="seats_layout">
                                    @php
                                    $marginIndex = 0;
                                    $index = 0;
                                    $nsize = count($layer[0]);
                                    
                                    @endphp
                                    @foreach($layer as $k => $row)
                                    @php
                                    $max_column = $row->max('column');
                                    if($nsize < $max_column){
                                        $nsize = $max_column;
                                    }
                                    // dump($row->max('column'));
                                    
                                    // dump($row);
                                    if($marginIndex == 0){
                                    if(count($row) == 1){
                                    $margin = 2.6;
                                    }else{
                                    $margin = floor((100/count($row))-6);
                                    }
                                    }
                                    $row = $row->sortBy('column');
                                    // dump($row->toArray());
                                    $row = $row->keyBy('column');
                                    // dump($row);
                                    $sleep = 0;
                                    @endphp
                                    @for ($i=0; $i <= $nsize; $i++)

                                     
                                    @if($sleep == 1)
                                    @php
                                    $sleep = 0;
                                    @endphp
                                    @continue
                                    @endif
                                    @if(empty($row[$i]))
                                    <div class="seat white-text">{{$i}}</div>
                                    @continue
                                    @endif
                                    @php                                  

                                    

                                     
                                    if( !empty($request['markup_type']) && $request['markup_type']=='percent'){
                                    $markup_amount =  cal_markup($row[$i]['fare'], $request['markup']);
                                    }
                                    @endphp
                                    
                                    @if($row[$i]['length'] ==2)
                                        @php
                                        $sleep = 1;
                                        @endphp
                                        @if(empty($row[$i]))
                                            <div class="seat white-text">{{$i}}</div>
                                            @continue
                                        @endif
                                    @endif
                                    
                                    @php
                                    if($row[$i]['ladiesSeat']=='false'){
                                         $lady_seat='';
                                             $ladies_seat ='';
                                    }else{
                                         $lady_seat='ladySleep';   
                                    $ladies_seat =' | Ladies Seat';
                                    }

                                    if($row[$i]['available'] == 'false'){
                                    $availability = 'disabled';

                                    }else{
                                    $availability = '';
                                    }

                                    @endphp
                                    @if(($row[$i]['length'] == 2 && $row[$i]['width'] == 1 )|| ($row[$i]['length'] == 1 && $row[$i]['width'] == 2 ))
                                    @php
                                        if($row[$i]['available'] == 'false'){
                                                $availability = 'disabled';
                                            $sleeper_image = 'sleapper_seat_booked.png';

                                            if($row[$i]['ladiesSeat'] == 'true'){

                                                $sleeper_image ="sleapper_seat_booked_ladies.png";
                                            }

                                        }else{
                                            $availability = '';
                                            $sleeper_image = 'sleapper_seat.png';
                                            if($row[$i]['ladiesSeat'] == 'true'){

                                                $sleeper_image ="lady_sleapper_seat.png";
                                            }
                                        }
                                    @endphp
                                    @if(count($row) ==1)
                                    
                                    
                                    <div class="seat  {{ @$availability }} sleeper tooltipped sw {{ @$lady_seat }}" data-lady="{{ $row[$i]['ladiesSeat']}}, SL" data-toggle="tooltip"  data-position="right" data-original-title="Sleeper Seat" data-markup-fare="{{ $row[$i]['fare'] + $markup_amount }}"  data-fare="{{ $row[$i]['fare'] }}" data-name="{{ $row[$i]['name'] }}" data-tooltip="Seat No : {{ $row[$i]['name'] }} {{ $ladies_seat }}">
                                        
                                        <img src="{{ asset('public/images/'.$sleeper_image) }}" >
                                    </div>
                                    @else
                                    
                                    <div class="seat  {{ @$availability }} sleeper tooltipped sw {{ @$lady_seat }}" data-lady="{{ $row[$i]['ladiesSeat']}},SL" data-toggle="tooltip" data-markup-fare="{{ $row[$i]['fare'] + $markup_amount }}"   data-position="right" data-original-title="Sleeper Seat"  data-fare="{{ $row[$i]['fare'] }}" data-name="{{ $row[$i]['name'] }}" data-tooltip="Seat No : {{ $row[$i]['name'] }} {{ $ladies_seat }}">
                                        
                                        <img src="{{ asset('public/images/'.$sleeper_image) }}" >
                                    </div>
                                    @endif
                                @else
                                    @php
                                    if($row[$i]['ladiesSeat']=='false'){
                                        $lady_seat='';
                                             $ladies_seat ='';
                                    }else{
                                        $lady_seat='ladySeat';   
                                    $ladies_seat =' | Ladies Seat';
                                    }
                                    if($row[$i]['available'] == 'false'){
                                    $availability = 'disabled';
                                    $seat_image = 'bus_seat_booked.png';
                                         if($row[$i]['ladiesSeat'] == 'true'){

                                                $seat_image ="ladySeatBook.png";
                                            }
                                    }else{
                                    $availability = '';
                                    $seat_image = 'bus_seat.png';

                                         if($row[$i]['ladiesSeat'] == 'true'){

                                                $seat_image ="ladySeat.png";
                                            }
                                    }
                                    
                                    
                                    @endphp
                                    @if(count($row) ==1)
                                    <div class="seat tooltipped {{ @$availability }} sitting {{ @$lady_seat }}" data-toggle="tooltip" data-lady="{{ $row[$i]['ladiesSeat']}}" data-position="right" data-original-title="Sitting Seat"  data-markup-fare="{{ $row[$i]['fare'] + $markup_amount }}" data-fare="{{ $row[$i]['fare'] }}" data-name="{{ $row[$i]['name'] }}" data-tooltip="Seat No : {{ $row[$i]['name'] }} {{ $ladies_seat }}">
                                        
                                        <img src="{{ asset('public/images/'.$seat_image) }}" >
                                        
                                    </div>
                                    @else
                                    <div class="seat tooltipped {{ @$availability }} sitting {{ @$lady_seat }}" data-lady="{{ $row[$i]['ladiesSeat']}}" data-toggle="tooltip" data-markup-fare="{{ $row[$i]['fare'] + $markup_amount }}" data-position="right" data-original-title="Sitting Seat" style="margin-right: {{ 2 }}%; " data-fare="{{ $row[$i]['fare'] }}" data-name="{{ $row[$i]['name'] }}" data-tooltip="Seat No : {{ $row[$i]['name'] }}{{ $ladies_seat }}">
                                        {{-- background-color: {{ $ladies_seat }} --}}
                                        
                                        <img src="{{ asset('public/images/'.$seat_image) }}" >
                                        
                                    </div>
                                    @endif
                                    @endif
                                    @endfor
                                    @if(count($layer) != 5 && count($seatData)!='1')
                                    <div class="row"></div>
                                    @php
                                    //    echo count($layer);
                                    $index++;
                                    $marginIndex++;
                                    if($index == 2){
                                    echo '<br/>';
                                    $index = 0;
                                    }
                                    @endphp
                                    @else
                                    <div class="row"></div>
                                    @php
                                    // echo count($layer);
                                    @endphp
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="col l5 s12">
                    <div class="row boarding">
                        <div clas="col l12 boarding_select">
                            @php
                            $boardingArray = [];
                            if(isset($request['boarding_points']['bpId'])){
                            $time = $request['boarding_points']['time'];
                            $hours = floor($time/60)%24;
                            $minutes = $time%60;
                            $time = \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                            $boardingArray[$request['boarding_points']['bpId']] = $request['boarding_points']['bpName'].'  '.$time;
                            }else{
                            foreach($request['boarding_points'] as $key => $value){
                            $time = $value['time'];
                            $hours = floor($time/60)%24;
                            $minutes = $time%60;
                            $time = \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                            $boardingArray[$value['bpId']] = $value['bpName'].' '.$time;
                            }
                            //.'-'.$value['bpName']
                            
                            }
                            @endphp
                            <h6>2) Select your boarding point</h6>
                            {!! Form::select('boarding_point',$boardingArray,null,['class'=>'form-control dropdown', ]) !!}
                        </div>
                    </div>
                    <div class="row boarding">
                        <div clas="col l12 boarding_select">
                            @php
                            $dropingArray = [];
                            if(isset($request['droping_time']['bpId'])){
                            $time = $request['droping_time']['time'];
                            $hours = floor($time/60)%24;
                            $minutes = $time%60;
                            $time = \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                            $dropingArray[$request['droping_time']['bpId']] = $request['droping_time']['bpName'].' '.$time;
                            }else{
                            foreach($request['droping_time'] as $key => $value){
                            $time = $value['time'];
                            $hours = floor($time/60)%24;
                            $minutes = $time%60;
                            $time = \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                            $dropingArray[$value['bpId']] = $value['bpName'].' '.$time;
                            }
                            }
                            //.'-'.$value['bpName']
                            @endphp
                            <h6>3) Select your droping point</h6>
                            {!! Form::select('droping_point',$dropingArray,null,['class'=>'form-control dropdown']) !!}
                            
                        </div>
                    </div>
                    <div class="row boarding" style="border-bottom: 1px solid #9e9e9e;">
                        <div class="col l4 pl0">
                        <h6>Seat No.</h6></div>
                        <div class="col l8 p0"><h6 class="seats_selected"></h6></div>
                        <input type="hidden" value="" name="seats_selected" class="validate" required="true"/>
                    </div>
                    <div class="row boarding" style="border-bottom: 1px solid #9e9e9e;">
                        <div class="col l4 p0">
                        <h6>Amount</h6></div>
                        <div class="col l8 p0"> <h6>&#8377; <span class="total_price">0</span></h6></div>
                        <input type="hidden" name="total_price" value="" class="validate" required="true"/>
                        <input type="hidden" name="markup_price" value="" class="validate" required="true"/>
                        <input type="hidden" name="source" value="{{$request['source']}}" />
                        
                    </div>
                    <div class="row">
                        <button class="btn li-red confirm_booking">Confirm Booking</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        
    </div>
</div>
<script>
$('.tooltipped').tooltip();
</script>