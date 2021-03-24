<div style="display: none;" class="_token"><?php echo e(csrf_token()); ?></div>
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
<?php if($journey_type == 1): ?>
    <div class="panel">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter flight-search">
                    <thead>
                    <tr>
                        <th>Airlines</th>
                        <th>Departure</th>
                        <th>Stops</th>
                        <th>Arrival</th>
                        <th>Price</th>
                        <th>Commision</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $results['Response']['Results'][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $airline = $value['Segments'][0][0]['Airline'];
                                $segment = $value['Segments'][0][0];
                                $markupModel = App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName'], true);
                            ?>
                            <tr>
                                
                                <td>
                                    <textarea style="display: none;" class="flight_details_array"><?php echo e(json_encode($value)); ?></textarea>
                                    <a href="javascript:void(0)" class="click_for_flight_details">
                                        <?php echo e($airline['AirlineName']); ?>.
                                        <span style="font-size: 10px;" class="help-block"><?php echo e($airline['AirlineCode']); ?>-<?php echo e($airline['FlightNumber']); ?></span>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                         $departure = explode('T',$segment['Origin']['DepTime']);
                                    ?>
                                    <span><b><?php echo e($departure[1]); ?></b></span>
                                    <span style="font-size: 10px;" class="help-block"><?php echo e($segment['Origin']['Airport']['CityName']); ?></span>
                                </td>
                                <td>
                                    <?php if(count($value['Segments'][0]) > 1): ?>
                                        <?php
                                            $totalHours = 0;
                                            $totalMinutes = 0;
                                            $index = 0;
                                            $totalSegments = count($value['Segments'][0])-1;
                                            $cities = [];
                                            foreach($value['Segments'][0] as $k => $seg){
                                                if($index <= $totalSegments){
                                                    $stopArrival = \Carbon\Carbon::parse(explode('T',$seg['StopPointArrivalTime'])[1]);
                                                    $stopdepart = \Carbon\Carbon::parse(explode('T',$seg['StopPointDepartureTime'])[1]);
                                                    $totalHours = $totalHours + $stopArrival->diff($stopdepart)->format('%H');
                                                    $totalMinutes = $totalMinutes + $stopArrival->diff($stopdepart)->format('%I');
                                                }
                                                if($index == 0){
                                                    $cities[] = $seg['Destination']['Airport']['CityName'];
                                                }
                                                $index++;
                                            }
                                        ?>
                                        <b><?php echo e($totalHours); ?>h <?php echo e($totalMinutes); ?>m</b>
                                        <p><?php echo e(implode(' ---- ',$cities)); ?></p>
                                    <?php else: ?>
                                        No Stops
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                        $lastSegment = $value['Segments'][0][count($value['Segments'][0])-1];
                                        $arival = explode('T',$lastSegment['Destination']['ArrTime']);
                                    ?>
                                    <span><b><?php echo e($arival[1]); ?></b></span>
                                    <span style="font-size: 10px;" class="help-block"><?php echo e($lastSegment['Destination']['Airport']['CityName']); ?></span>
                                </td>
                                <td>
                                    <span style="color: red; font-size: 18px">₹</span>
                                    <?php
                                        $amount = $value['Fare']['PublishedFare'];
                                        if($markup_include == 1){
                                            if($markupModel != null){
                                                if($markupModel['amount_by'] == 'percent'){
                                                    $amount = $value['Fare']['PublishedFare'];
                                                    $percent = ($amount*$markupModel['plus_percent'])/100;
                                                    $amount = $amount+$percent;
                                                }elseif($markupModel['amount_by'] == 'rupee'){
                                                    $amount = $value['Fare']['PublishedFare'] + $markupModel['plus_amount'];
                                                }else{
                                                    $amount = $value['Fare']['PublishedFare'];
                                                }
                                            }
                                        }
                                    ?>
                                    <span style="color: red; font-size: 18px"><?php echo e($amount); ?></span>
                                </td>
                                <td>
                                    <span style="color: green; font-size: 18px">₹</span>
                                    <span style="color: green; font-size: 18px"><?php echo e($value['Fare']['CommissionEarned']); ?></span>
                                </td>
                                <td class="min-width">
                                    <?php echo Form::open(['route'=>'booking.flight']); ?>

                                        <div class="btn-groups">
                                            <?php echo Form::hidden('journey_type',1); ?>

                                            <input type="hidden" name="traceid" value="<?php echo e($results['Response']['TraceId']); ?>" />
                                            <input type="hidden" name="flight_details" value="<?php echo e(json_encode($value)); ?>" />
                                            <input type="hidden" name="total_amount" value="<?php echo e($amount); ?>" />
                                            <input type="hidden" name="search_request" value="<?php echo e(json_encode($request->all())); ?>">
                                            <button class="btn btn-primary">Book Now</button>
                                        </div>
                                    <?php echo Form::close(); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($journey_type == 2): ?>
    <?php echo Form::open(['route'=>'booking.flight']); ?>

        <div class="row" style="margin-bottom: 2%;">
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Book Now</button>
            </div>
        </div>
        <?php echo Form::hidden('journey_type',2); ?>

        <div class="row second_journey_type">
            
            <div class="col-md-6 booking_tables">
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
                                </tr>
                                </thead>
                                <tbody>

                                    <?php $__currentLoopData = $results['Response']['Results'][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $airline = $value['Segments'][0][0]['Airline'];
                                            $segment = $value['Segments'][0][0];
                                            $markupModel = App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName'], true);
                                        ?>
                                        <?php
                                            $amount = $value['Fare']['PublishedFare'];
                                            if($markup_include == 1){
                                                if($markupModel != null){
                                                    if($markupModel['amount_by'] == 'percent'){
                                                        $amount = $value['Fare']['PublishedFare'];
                                                        $percent = ($amount*$markupModel['plus_percent'])/100;
                                                        $amount = $amount+$percent;
                                                    }elseif($markupModel['amount_by'] == 'rupee'){
                                                        $amount = $value['Fare']['PublishedFare'] + $markupModel['plus_amount'];
                                                    }else{
                                                        $amount = $value['Fare']['PublishedFare'];
                                                    }
                                                }
                                            }
                                        ?>
                                        <tr data-trace="<?php echo e($results['Response']['TraceId']); ?>" data-flight_data="<?php echo e(json_encode($value)); ?>" data-amount="<?php echo e($amount); ?>">
                                            
                                            <td>
                                                <?php echo e($airline['AirlineName']); ?>.
                                                <span style="font-size: 10px;" class="help-block"><?php echo e($airline['AirlineCode']); ?>-<?php echo e($airline['FlightNumber']); ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                    // $departure = explode('T',$segment['StopPointDepartureTime']);
                                                ?>
                                              
                                                <span style="font-size: 10px;" class="help-block"><?php echo e($segment['Origin']['Airport']['CityName']); ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                    // $arival = explode('T',$segment['StopPointArrivalTime']);
                                                ?>
                                               
                                                <span style="font-size: 10px;" class="help-block"><?php echo e($segment['Destination']['Airport']['CityName']); ?></span>
                                            </td>
                                            <td>
                                                <span style="color: red; font-size: 18px">₹</span>
                                                <span style="color: red; font-size: 18px"><?php echo e($amount); ?></span>
                                            </td>
                                            <td>
                                                <span style="color: green; font-size: 18px">₹</span>
                                                <span style="color: green; font-size: 18px"><?php echo e($value['Fare']['CommissionEarned']); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <input type="hidden" name="traceid_1" class="traceid" value="" />
                            <input type="hidden" name="flight_details_1" class="flight_details" value="" />
                            <input type="hidden" name="total_amount_1" class="total_amount" value="" />
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6 booking_tables">
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
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $results['Response']['Results'][1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $airline = $value['Segments'][0][0]['Airline'];
                                            $segment = $value['Segments'][0][0];
                                            $markupModel = App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName'], true);
                                        ?>
                                        <tr data-trace="<?php echo e($results['Response']['TraceId']); ?>" data-flight_data="<?php echo e(json_encode($value)); ?>" data-amount="<?php echo e($amount); ?>">
                                            
                                            <td>
                                                <?php echo e($airline['AirlineName']); ?>.
                                                <span style="font-size: 10px;" class="help-block"><?php echo e($airline['AirlineCode']); ?>-<?php echo e($airline['FlightNumber']); ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                    // $departure = explode('T',$segment['StopPointDepartureTime']);
                                                ?>
                                               
                                                <span style="font-size: 10px;" class="help-block"><?php echo e($segment['Origin']['Airport']['CityName']); ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                    // $arival = explode('T',$segment['StopPointArrivalTime']);
                                                ?>
                                               
                                                <span style="font-size: 10px;" class="help-block"><?php echo e($segment['Destination']['Airport']['CityName']); ?></span>
                                            </td>
                                            <td>
                                                <span style="color: red; font-size: 18px">₹</span>
                                                <?php
                                                    $amount = $value['Fare']['PublishedFare'];
                                                    if($markup_include == 1){
                                                        if($markupModel != null){
                                                            if($markupModel['amount_by'] == 'percent'){
                                                                $amount = $value['Fare']['PublishedFare'];
                                                                $percent = ($amount*$markupModel['plus_percent'])/100;
                                                                $amount = $amount+$percent;
                                                            }elseif($markupModel['amount_by'] == 'rupee'){
                                                                $amount = $value['Fare']['PublishedFare'] + $markupModel['plus_amount'];
                                                            }else{
                                                                $amount = $value['Fare']['PublishedFare'];
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <span style="color: red; font-size: 18px"><?php echo e($amount); ?></span>
                                            </td>
                                            <td>
                                                <span style="color: green; font-size: 18px">₹</span>
                                                <span style="color: green; font-size: 18px"><?php echo e($value['Fare']['CommissionEarned']); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <input type="hidden" name="traceid_2" class="traceid" value="" />
                            <input type="hidden" name="flight_details_2" class="flight_details" value="" />
                            <input type="hidden" name="total_amount_2" class="total_amount" value="" />
                            <input type="hidden" name="search_request" value="<?php echo e(json_encode($request->all())); ?>">
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    <?php echo Form::close(); ?>

<?php endif; ?>

