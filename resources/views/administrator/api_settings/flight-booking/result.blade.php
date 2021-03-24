<div style="display: none;" class="_token">{{csrf_token()}}</div>
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Filters</h3>
    </div>
    <div class="panel-body">
        <p class="text-main text-bold mar-no">Price Filter</p>
        <p>Select Maximum and Minimum Price Filter</p>
        <div class="row">
            <div class="col-md-6">
                <input type="text" value="" name="min" id="min" class="form-control" placeholder="Minimum Price" />
            </div>
            <div class="col-md-6">
                <input type="text" value="" name="min" id="max" class="form-control" placeholder="Maximum Price" />
            </div>
        </div>

        <hr class="new-section-sm bord-no">
        <p class="text-main text-bold mar-no">Airline Filter</p>
        <p>Select airline filter</p>
        <select name="airlines" class="form-control">
            <option value="">All</option>
            <option value="Air India">Air India</option>
            <option value="Air Vistara">Air Vistara</option>
            <option value="Indigo">Indigo</option>
        </select>
        <br/>
        <div class="row">
            <div class="col-md-1">
                <input type="button" class="btn btn-primary" name="clear_filter" value="Clear Filter" />
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-vcenter flight-search">
                <thead>
                <tr>
                    <th>Airlines</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Price</th>
                    <th>Commision</th>
                    <th>Extra Commission ₹</th>
                    <th>Extra Commission %</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results['Response']['Results'][0] as $key => $value)
                    @php
                        $airline = $value['Segments'][0][0]['Airline'];
                        $segment = $value['Segments'][0][0];
                    @endphp
                    <tr>
                        {{--<td><img class="img-responsive img-sm" src="{{ asset('images/flight.png') }}" alt="thumbs"></td>--}}
                        <td>
                            {{ $airline['AirlineName'] }}.
                            <span style="font-size: 10px;" class="help-block">{{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</span>
                        </td>
                        <td>
                            @php
                                $departure = explode('T',$segment['Origin']['DepTime']);
                            @endphp
                            <span><b>{{ $departure[1] }}</b></span>
                            <span style="font-size: 10px;" class="help-block">{{ $segment['Origin']['Airport']['CityName'] }}</span>
                        </td>
                        <td>
                            @php
                                $arival = explode('T',$segment['Destination']['ArrTime']);
                            @endphp
                            <span><b>{{ $arival[1] }}</b></span>
                            <span style="font-size: 10px;" class="help-block">{{ $segment['Destination']['Airport']['CityName'] }}</span>
                        </td>
                        <td>
                            <span style="color: red; font-size: 18px">₹</span>
                            <span style="color: red; font-size: 18px">{{ $value['Fare']['PublishedFare'] }}</span>
                        </td>
                        <td>
                            <span style="color: green; font-size: 18px">₹</span>
                            <span style="color: green; font-size: 18px">{{ $value['Fare']['CommissionEarned'] }}</span>
                        </td>
                        <td>
                            <a href="#" class="demo-editable-username" data-airline="{{$airline['AirlineName']}}" data-flightnumber="{{ $airline['FlightNumber'] }}" data-airlinecode="{{ $airline['AirlineCode'] }}" data-from="{{ $segment['Origin']['Airport']['CityName'] }}" data-to="{{ $segment['Destination']['Airport']['CityName'] }}">
                                @php
                                    $visibilityAndAmount = \App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName']);
                                    echo $visibilityAndAmount['amount'];
                                    if($visibilityAndAmount['status'] == 1 || $visibilityAndAmount['status'] == 'null'){
                                        $class = 'fa-eye green';
                                        $status = 'true';
                                    }else{
                                        $class = 'fa-eye-slash red';
                                        $status = 'false';
                                    }
                                @endphp
                            </a>
                        </td>
                        <td>
                            <a href="#" class="percentage" data-airline="{{$airline['AirlineName']}}" data-flightnumber="{{ $airline['FlightNumber'] }}" data-airlinecode="{{ $airline['AirlineCode'] }}" data-from="{{ $segment['Origin']['Airport']['CityName'] }}" data-to="{{ $segment['Destination']['Airport']['CityName'] }}">
                                @php
                                    $visibilityAndAmount = \App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName']);
                                    echo $visibilityAndAmount['percent'];
                                    $amountOption = $visibilityAndAmount['amount_by'];
                                    if($visibilityAndAmount['amount_by'] == 'percent'){
                                        $percentClass = 'fa fa-percent';
                                    }else{
                                        $percentClass = 'fa fa-rupee';
                                    }
                                @endphp
                            </a>
                        </td>
                        <td class="min-width">
                            <div class="btn-groups">
                                <a href="javascript:;" class="btn btn-icon fa {{$class}} icon-lg add-tooltip setVisibility" data-visible="{{$status}}" data-original-title="Show/Hide Flight" data-container="body" data-airline="{{$airline['AirlineName']}}" data-flightnumber="{{ $airline['FlightNumber'] }}" data-airlinecode="{{ $airline['AirlineCode'] }}" data-from="{{ $segment['Origin']['Airport']['CityName'] }}" data-to="{{ $segment['Destination']['Airport']['CityName'] }}"></a>
                                <a href="javascript:;" class="btn btn-icon fa {{$percentClass}} icon-lg add-tooltip setAmountBy" data-original-title="Percentage/Rupee" data-container="body" data-by="{{ $amountOption }}" data-original-title="Percent/Rupee" data-container="body" data-airline="{{$airline['AirlineName']}}" data-flightnumber="{{ $airline['FlightNumber'] }}" data-airlinecode="{{ $airline['AirlineCode'] }}" data-from="{{ $segment['Origin']['Airport']['CityName'] }}" data-to="{{ $segment['Destination']['Airport']['CityName'] }}"></a>
                                {{--<a href="#" class="btn btn-icon demo-pli-pen-5 icon-lg add-tooltip" data-original-title="Edit Post" data-container="body"></a>--}}
                                {{--<a href="#" class="btn btn-icon demo-pli-trash icon-lg add-tooltip" data-original-title="Remove" data-container="body"></a>--}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>