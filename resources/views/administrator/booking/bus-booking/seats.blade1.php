<div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">

            <!--Modal header-->
           <div class="row modal-header">
<h6 class="modal-title">Seat Layout</h6>
</div>
 @if($from == 'admin')
                {!! Form::open(['route'=>'bus.passengers.details','id'=>'confirm_booking','method'=>'get']) !!}
            @else
                {!! Form::open(['route'=>'bus.booking.passengers','id'=>'confirm_booking','method'=>'get']) !!}
            @endif
<div class="modal-content">
 <h6>1) Select Your Seat</h6>
    <div class="row">
        <div class="col l7">
            <input type="hidden" value="{{ $maxSeats }}" class="maximum_seats" />
            <input type="hidden" value="{{ $bus_id }}" name="bus_id" />
            <input type="hidden" value="{{ $request['source'] }}" name="source" />
            <input type="hidden" value="{{ $request['destination'] }}" name="destination" /> 
            @foreach($seatData as $zIndex => $layer)
                @php
                    $layer = $layer->sortBy(function($object, $key){
                        return $key;
                    });
                @endphp
                 @if($zIndex == 1)
                                    <div class="row bus_row">
                                        <div class="col-md-12">
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
                                                    @endphp
                                                    @foreach($layer as $k => $row)
                                                        @php
                                                            if($marginIndex == 0){
                                                                $margin = floor((100/count($row))-6);
                                                            }
                                                        @endphp
                                                        @foreach($row as $column => $seat)
                                                            
                                                            @if(($seat['length'] == 2 && $seat['width'] == 1 )||($seat['length'] == 1 && $seat['width'] == 2 ))
                                                                @php
                                                                    if($seat['available'] == 'false'){
                                                                        $availability = 'disabled';
                                                                        $sleeper_image = 'sleapper_seat_booked.png';
                                                                    }else{
                                                                        $availability = '';
                                                                        $sleeper_image = 'sleapper_seat.png';
                                                                    }
                                                                @endphp
                                                                <div class="seat add-tooltip {{ @$availability }} sleeper" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Sleeper Seat" style="margin-right: {{ $margin }}%" data-fare="{{ $seat['fare'] }}" data-name="{{ $seat['name'] }}">
                                                                    <img src="{{ asset('images/'.$sleeper_image) }}" class="responsive-img">
                                                                </div>
                                                            @else
                                                                @php
                                                                    if($seat['available'] == 'false'){
                                                                        $availability = 'disabled';
                                                                        $seat_image = 'bus_seat_booked.png';
                                                                    }else{
                                                                        $availability = '';
                                                                        $seat_image = 'bus_seat.png';
                                                                    }
                                                                @endphp
                                                                <div class="seat add-tooltip {{ @$availability }} sitting" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Sitting Seat" style="margin-right: {{ $margin }}%" data-fare="{{ $seat['fare'] }}" data-name="{{ $seat['name'] }}">
                                                                    <img src="{{ asset('images/'.$seat_image) }}" class="responsive-img">
                                                                </div>
                                                            @endif
                                                            
                                                        @endforeach
                                                        <div class="row"></div>
                                                        @php
                                                            $index++;
                                                            $marginIndex++;
                                                            if($index == 2){
                                                                echo '<br/><br/>';
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
                                        <div class="col-md-12">
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
                                                    @endphp
                                                    @foreach($layer as $k => $row)
                                                        @php
                                                            if($marginIndex == 0){
                                                                if(count($row) == 1){
                                                                    $margin = 2.6;
                                                                }else{
                                                                    $margin = floor((100/count($row))-6);
                                                                }
                                                            }
                                                        @endphp
                                                        @foreach($row as $column => $seat)
                                                            @php
                                                                if($seat['available'] == 'false'){
                                                                    $availability = 'disabled';
                                                                }else{
                                                                    $availability = '';
                                                                }
                                                            @endphp
                                                            @if(($seat['length'] == 2 && $seat['width'] == 1 )||($seat['length'] == 1 && $seat['width'] == 2 ))
                                                                @php
                                                                    if($seat['available'] == 'false'){
                                                                        $availability = 'disabled';
                                                                        $sleeper_image = 'sleapper_seat_booked.png';
                                                                    }else{
                                                                        $availability = '';
                                                                        $sleeper_image = 'sleapper_seat.png';
                                                                    }
                                                                @endphp
                                                                <div class="seat add-tooltip {{ @$availability }} sleeper" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Sleeper Seat" style="margin-right: {{ $margin }}%" data-fare="{{ $seat['fare'] }}" data-name="{{ $seat['name'] }}">
                                                                    <img src="{{ asset('images/'.$sleeper_image) }}" class="responsive-img">
                                                                </div>
                                                            @else
                                                                @php
                                                                    if($seat['available'] == 'false'){
                                                                        $availability = 'disabled';
                                                                        $seat_image = 'bus_seat_booked.png';
                                                                    }else{
                                                                        $availability = '';
                                                                        $seat_image = 'bus_seat.png';
                                                                    }
                                                                @endphp
                                                                <div class="seat add-tooltip {{ @$availability }} sitting" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Sitting Seat" style="margin-right: {{ $margin }}%" data-fare="{{ $seat['fare'] }}" data-name="{{ $seat['name'] }}">
                                                                    <img src="{{ asset('images/'.$seat_image) }}" class="responsive-img">
                                                                </div>
                                                            @endif

                                                        @endforeach
                                                        @if(count($layer) != 5)
                                                            <div class="row"></div>
                                                            @php
                                                                $index++;
                                                                $marginIndex++;
                                                                if($index == 2){
                                                                    echo '<br/><br/>';
                                                                    $index = 0;
                                                                }
                                                            @endphp
                                                        @else
                                                            <div class="row"></div>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
        <div class="col l5">
        <div class="row boarding">
            <div clas="col l12 boarding_select">
             @php
                $boardingArray = [];
                if(isset($request['boarding_points']['bpId'])){
                    $time = $request['boarding_points']['time'];
                    $hours = floor($time/60)%24;
                    $minutes = $time%60;
                    $time = \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                    $boardingArray[$request['boarding_points']['bpId'].'-'.$request['boarding_points']['bpName']] = $request['boarding_points']['bpName'].'  '.$time;
                }else{
                    foreach($request['boarding_points'] as $key => $value){
                        $time = $value['time'];
                        $hours = floor($time/60)%24;
                        $minutes = $time%60;
                        $time = \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                        $boardingArray[$value['bpId'].'-'.$value['bpName']] = $value['bpName'].' '.$time;
                    }
                }
                @endphp
                <h6>2) Select your boarding point</h6>
                {!! Form::select('boarding_point',$boardingArray,null,['class'=>'form-control']) !!}
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
                        $dropingArray[$request['droping_time']['bpId'].'-'.$request['droping_time']['bpName']] = $request['droping_time']['bpName'].' '.$time;
                    }else{
                        foreach($request['droping_time'] as $key => $value){
                            $time = $value['time'];
                            $hours = floor($time/60)%24;
                            $minutes = $time%60;
                            $time = \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                            $dropingArray[$value['bpId'].'-'.$value['bpName']] = $value['bpName'].' '.$time;
                        }
                    }
                @endphp
                <h6>3) Select your droping point</h6>
                {!! Form::select('droping_point',$dropingArray,null,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col l12">
                <span>Seat No.</span>
                <h6 class="seats_selected"></h6>
                <input type="hidden" value="" name="seats_selected" />
            </div>
        </div>
        <div class="row">
            <div class="col l12">
                <span>Total Amount</span>
                <h6>&#8377; <span class="total_price">0</span></h6>
                <input type="hidden" name="total_price" value="" />             
            </div>
        </div>
        </div>
    </div>
</div>
<div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary confirm_booking">Confirm Booking</button>
                </div>
         {!! Form::close() !!}   
</div>
</div>
