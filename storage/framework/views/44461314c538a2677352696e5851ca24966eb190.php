
<?php $__env->startSection('content'); ?>
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Flight Search</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">Booking Details</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <!-- Toolbar -->
            <!--===================================================-->
            <?php
                if($request->has('journey_type') && $request->journey_type != 2){
                    $flightDetails = json_decode($request->flight_details,true);
                    $segments = $flightDetails['Segments'][0][0];
                }else{
                    $flight_details_1 = json_decode($request->flight_details_1, true);
                    $flight_details_2 = json_decode($request->flight_details_2, true);
                    $segment_1 = $flight_details_1['Segments'][0][0];
                    $segment_2 = $flight_details_2['Segments'][0][0];
                }
            ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Flight Details</h3>
                </div>
                <div class="panel-body">
            
                    <!-- Inline Form  -->
                    <!--===================================================-->
                    <?php if($request->journey_type == 1): ?>
                        <div class="row">
                            <div class="col-md-3" style="border: 1px solid #CCC;">
                                <img src="<?php echo e(asset('images/'.$segments['Airline']['AirlineName'])); ?>.jpg" style="width: 100%;" />
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" style="height: 189px;">
                                    <tbody>
                                        <tr>
                                            <td width="120"><b>Source</b></td>
                                            <td width="300"><?php echo e($segments['Origin']['Airport']['AirportName']); ?></td>

                                            <td width="120"><b>Destination</b></td>
                                            <td><?php echo e($segments['Destination']['Airport']['AirportName']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Baggage</b></td>
                                            <td width="300"><?php echo e($segments['Baggage']); ?></td>

                                            <td width="120"><b>Departure Time</b></td>
                                            <td><?php echo e($segments['Origin']['DepTime']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Arrival Time</b></td>
                                            <td width="300"><?php echo e($segments['Destination']['ArrTime']); ?></td>

                                            <td width="120"><b>Airline</b></td>
                                            <td><?php echo e($segments['Airline']['AirlineName']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Published Fare</b></td>
                                            <td width="300"><b>&#8377; <?php echo e($flightDetails['Fare']['PublishedFare']); ?></b></td>

                                            <td width="120"><b>Duration</b></td>
                                            <td><?php echo e($segments['Duration']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Airline Code</b></td>
                                            <td width="300"><?php echo e($segments['Airline']['AirlineCode']); ?></td>

                                            <td width="120"><b>Flight Number</b></td>
                                            <td><?php echo e($segments['Airline']['FlightNumber']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 pull-right">
                                        Want insurance <input id="demo-sw-clr1" type="checkbox" class="want_insurance pull-right">  
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-md-3" style="border: 1px solid #CCC;">
                                <img src="<?php echo e(asset('images/'.$segment_1['Airline']['AirlineName'])); ?>.jpg" style="width: 100%;" />
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" style="height: 189px;">
                                    <tbody>
                                        <tr>
                                            <td width="120"><b>Source</b></td>
                                            <td width="300"><?php echo e($segment_1['Origin']['Airport']['AirportName']); ?></td>

                                            <td width="120"><b>Destination</b></td>
                                            <td><?php echo e($segment_1['Destination']['Airport']['AirportName']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Baggage</b></td>
                                            <td width="300"><?php echo e($segment_1['Baggage']); ?></td>

                                            <td width="120"><b>Departure Time</b></td>
                                            <td><?php echo e($segment_1['Origin']['DepTime']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Arrival Time</b></td>
                                            <td width="300"><?php echo e($segment_1['Destination']['ArrTime']); ?></td>

                                            <td width="120"><b>Airline</b></td>
                                            <td><?php echo e($segment_1['Airline']['AirlineName']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Published Fare</b></td>
                                            <td width="300"><b>&#8377; <?php echo e($flight_details_1['Fare']['PublishedFare']); ?></b></td>

                                            <td width="120"><b>Duration</b></td>
                                            <td><?php echo e($segment_1['Duration']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Airline Code</b></td>
                                            <td width="300"><?php echo e($segment_1['Airline']['AirlineCode']); ?></td>

                                            <td width="120"><b>Flight Number</b></td>
                                            <td><?php echo e($segment_1['Airline']['FlightNumber']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" style="border: 1px solid #CCC;">
                                <img src="<?php echo e(asset('images/'.$segment_2['Airline']['AirlineName'])); ?>.jpg" style="width: 100%;" />
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" style="height: 189px;">
                                    <tbody>
                                        <tr>
                                            <td width="120"><b>Source</b></td>
                                            <td width="300"><?php echo e($segment_2['Origin']['Airport']['AirportName']); ?></td>

                                            <td width="120"><b>Destination</b></td>
                                            <td><?php echo e($segment_2['Destination']['Airport']['AirportName']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Baggage</b></td>
                                            <td width="300"><?php echo e($segment_2['Baggage']); ?></td>

                                            <td width="120"><b>Departure Time</b></td>
                                            <td><?php echo e($segment_2['Origin']['DepTime']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Arrival Time</b></td>
                                            <td width="300"><?php echo e($segment_2['Destination']['ArrTime']); ?></td>

                                            <td width="120"><b>Airline</b></td>
                                            <td><?php echo e($segment_2['Airline']['AirlineName']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Published Fare</b></td>
                                            <td width="300"><b>&#8377; <?php echo e($flight_details_2['Fare']['PublishedFare']); ?></b></td>

                                            <td width="120"><b>Duration</b></td>
                                            <td><?php echo e($segment_2['Duration']); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Airline Code</b></td>
                                            <td width="300"><?php echo e($segment_2['Airline']['AirlineCode']); ?></td>

                                            <td width="120"><b>Flight Number</b></td>
                                            <td><?php echo e($segment_2['Airline']['FlightNumber']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 pull-right">
                                        Want insurance <input id="demo-sw-clr1" type="checkbox" class="want_insurance pull-right">  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $totalAmount = $flight_details_1['Fare']['PublishedFare'];
                            $totalAmount = $totalAmount+$flight_details_2['Fare']['PublishedFare'];
                        ?>
                    <?php endif; ?>

                    <div class="row" style="margin-bottom: 2%;">
                        <div class="col-md-12">
                            <button class="btn btn-primary pull-right add_passenger">+ Add Passenger</button>
                            <button class="btn btn-default pull-left reload_list"><i class="fa fa-refresh"></i> Reload List</button>
                        </div>
                    </div>
                    <?php echo Form::open(['route'=>'book.flight.now']); ?>

                        <?php if($request->journey_type == 1): ?>
                            <?php echo Form::hidden('trace_id',$request->traceid); ?>

                            <?php echo Form::hidden('single_amount',$request->total_amount); ?>

                            <?php echo Form::hidden('journey_type',$request->journey_type); ?>

                            <?php echo Form::hidden('flight_details',$request->flight_details); ?>

                        <?php else: ?>
                            <?php echo Form::hidden('trace_id',$request->traceid_2); ?>

                            <?php echo Form::hidden('single_amount',$totalAmount); ?>

                            <?php echo Form::hidden('journey_type',$request->journey_type); ?>

                            <?php echo Form::hidden('flight_details_1',$request->flight_details_1); ?>

                            <?php echo Form::hidden('flight_details_2',$request->flight_details_2); ?>

                        <?php endif; ?>
                        <?php
                            $requestData = json_decode($request->search_request);                            
                            $passengersCount = $requestData->adult_count;
                            $passengersCount = $passengersCount + $requestData->child_count;
                            $passengersCount = $passengersCount + $requestData->infant;
                        ?>
                        <?php echo Form::hidden('total_passengers',$passengersCount); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Contact</th>
                                                <th>City</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="customers_list">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <b>Total Amount: </b>
                                <?php if($request->journey_type == 2): ?>
                                    <span class="total_amount">&#8377; <?php echo e($totalAmount); ?></span>
                                <?php else: ?>
                                    <span class="total_amount">&#8377; <?php echo e($request->total_amount); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success pull-right">Book Now</button>
                            </div>
                        </div>

                    <?php echo Form::close(); ?>

                </div>
            </div>
            <hr class="new-section-xs bord-no">

            <div class="search-background"></div>
            <div class="row search-spinner">
                <div class="col-md-12 text-center">
                    <h4>Searching Your Flights..</h4>
                    <div class="sk-wandering-cubes">
                        <div class="sk-cube sk-cube1"></div>
                        <div class="sk-cube sk-cube2"></div>
                    </div>
                </div>
            </div>
            <div class="search-results">

            </div>
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>