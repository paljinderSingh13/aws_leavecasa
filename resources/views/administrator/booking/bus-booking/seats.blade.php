<div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
				<h4 class="modal-title">Seat Layout</h4>
			</div>
			<!--Modal body-->
			@if($from == 'admin')
			{!! Form::open(['route'=>'bus.passengers.details','id'=>'confirm_booking','method'=>'get']) !!}
			@else
			{!! Form::open(['route'=>'bus.booking.passengers','id'=>'confirm_booking','method'=>'get']) !!}
			@endif
			<div class="modal-body">
				<h4>1) Select Your Seat</h4>
				<div class="row">
					<div class="col-md-7">
						<input type="hidden" value="{{ $maxSeats }}" class="maximum_seats" />
						<input type="hidden" value="{{ $bus_id }}" name="bus_id" />
						<input type="hidden" value="{{ $request['source'] }}" name="source" />
						<input type="hidden" value="{{ $request['destination'] }}" name="destination" />
						@php
						$nu =0;
						@endphp
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
										if(!empty($layer[0])){
										
										$usize = count($layer[0]);
										}else{
										$usize = count($layer[1]);
										}
										@endphp
										@foreach($layer as $k => $row)
										@php
										if($marginIndex == 0){
										$margin = floor((100/count($row))-6);
										}
										$row = $row->sortBy('column');
										$row = $row->keyBy('column');
										@endphp
										@for($u=0; $u < $usize; $u++ )
										@php
										$nu =  $u * 2;
										@endphp
										@if(empty($row[$nu]))
										@php
										
										$slWidth='14% !important';
										
										@endphp
										<div class="Seat" style="float: left;color:white; width: {{ $slWidth }}; "> {{$nu}} </div>
										@continue
										@endif
										@if( ($row[$nu]['length'] == 2 && $row[$nu]['width'] == 1 )||($row[$nu]['length'] == 1 && $row[$nu]['width'] == 2 ))
										@php
										if($row[$nu]['available'] == 'false'){
										$availability = 'disabled';
										$sleeper_image = 'sleapper_seat_booked.png';
										}else{
										$availability = '';
										$sleeper_image = 'sleapper_seat.png';
										}
										@endphp
										<div class="seat add-tooltip {{ @$availability }} sleeper sw" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Sleeper Seat" style="margin-right: {{ 2 }}%" data-fare="{{ $row[$nu]['fare'] }}" data-name="{{ $row[$nu]['name'] }}">
											<img src="{{ asset('public/images/'.$sleeper_image) }}">
										</div>
										@else
										@php
										if($row[$nu]['available'] == 'false'){
										$availability = 'disabled';
										$seat_image = 'bus_seat_booked.png';
										}else{
										$availability = '';
										$seat_image = 'bus_seat.png';
										}
										@endphp
										
										<div class="seat add-tooltip {{ @$availability }} sitting" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Sitting Seat" style="margin-right: {{ 2 }}%" data-fare="{{ $row[$nu]['fare'] }}" data-name="{{ $row[$nu]['name'] }}">
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
							<div class="col-md-12">
								<div class="bus_layout">
									<div class="driver">
										<div class="steering_wheel upper">
											<img src="{{ asset('images/steering-wheel.png') }}" class="steering_wheel_image">
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
										if($marginIndex == 0){
										if(count($row) == 1){
										$margin = 2.6;
										}else{
										$margin = floor((100/count($row))-6);
										}
										}
										$row = $row->sortBy('column');
										
										$row = $row->keyBy('column');
										
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
										<div class="seat" style="color:white;">{{$i}}</div>
										@continue
										@endif
										@if($row[$i]['length'] ==2)
										@php
										$sleep = 1;
										@endphp
										@if(empty($row[$i]))
										<div class="seat" style="color:white;">{{$i}}</div>
										@continue
										@endif
										@endif
										
										@php
										if($row[$i]['available'] == 'false'){
										$availability = 'disabled';
										}else{
										$availability = '';
										}
										@endphp
										@if(($row[$i]['length'] == 2 && $row[$i]['width'] == 1 )||($row[$i]['length'] == 1 && $row[$i]['width'] == 2 ))
										@php
										if($row[$i]['available'] == 'false'){
										$availability = 'disabled';
										$sleeper_image = 'sleapper_seat_booked.png';
										}else{
										$availability = '';
										$sleeper_image = 'sleapper_seat.png';
										}
										@endphp
										@if(count($row) ==1)
										<div class="seat add-tooltip {{ @$availability }} sleeper" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Sleeper Seat" style="margin-right: {{ 2 }}%" data-fare="{{ $row[$i]['fare'] }}" data-name="{{ $row[$i]['name'] }}">
											<img src="{{ asset('public/images/'.$sleeper_image) }}">
										</div>
										@else
										
										<div class="seat add-tooltip {{ @$availability }} sleeper sw" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Sleeper Seat" style="margin-right: {{ 2 }}%" data-fare="{{ $row[$i]['fare'] }}" data-name="{{ $row[$i]['name'] }}">
											<img src="{{ asset('public/images/'.$sleeper_image) }}">
										</div>
										@endif
										@else
										@php
										if($row[$i]['ladiesSeat']=='false'){
										$ladies_seat ='';
										// $row[$i]_image='ladies_seat.png'
										}else{
										$ladies_seat =' | Ladies Seat';
										// $row[$i]_image='ladies_seat.png';
										}
										if($row[$i]['available'] == 'false'){
										$availability = 'disabled';
										$seat_image = 'bus_seat_booked.png';
										}else{
										$availability = '';
										$seat_image = 'bus_seat.png';
										}
										
										
										@endphp
										@if(count($row) ==1)
										<div class="seat add-tooltip {{ @$availability }} sitting" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Sitting Seat" style="margin-right: {{ 2 }}%" data-fare="{{ $row[$i]['fare'] }}" data-name="{{ $row[$i]['name'] }}">
											
											<img src="{{ asset('public/images/'.$seat_image) }}" >
											
										</div>
										@else
										<div class="seat add-tooltip {{ @$availability }} sitting" data-toggle="tooltip"  data-position="right" data-original-title="Sitting Seat" style="margin-right: {{ 2 }}%; " data-fare="{{ $row[$i]['fare'] }}" data-name="{{ $row[$i]['name'] }}" >
											{{-- background-color: {{ $ladies_seat }} --}}
											@if($row[$i]['ladiesSeat']=='false')
											<img src="{{ asset('public/images/'.$seat_image) }}" >
											@else
											<img src="{{ asset('public/images/ladySeat.png') }}" >
											@endif
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
					<div class="col-md-5">
						<div class="row boarding">
							<div class="col-md-12 boarding_select">
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
								<h4>2) Select your boarding point</h4>
								{!! Form::select('boarding_point',$boardingArray,null,['class'=>'form-control']) !!}
							</div>
						</div>
						<div class="row boarding">
							<div class="col-md-12 boarding_select">
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
								<h4>3) Select your droping point</h4>
								{!! Form::select('droping_point',$dropingArray,null,['class'=>'form-control']) !!}
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-md-12">
								<span>Seat No.</span>
								<h4 class="seats_selected"></h4>
								<input type="hidden" value="" name="seats_selected" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<span>Total Amount</span>
								<h4>&#8377; <span class="total_price">0</span></h4>
								<input type="hidden" name="total_price" value="" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--Modal footer-->
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				<button class="btn btn-primary confirm_booking">Confirm Booking</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>