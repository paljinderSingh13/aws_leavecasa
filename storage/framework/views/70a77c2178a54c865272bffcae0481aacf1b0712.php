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
                <?php $__currentLoopData = $results['Response']['Results'][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $airline = $value['Segments'][0][0]['Airline'];
                        $segment = $value['Segments'][0][0];
                    ?>
                    <tr>
                        
                        <td>
                            <?php echo e($airline['AirlineName']); ?>.
                            <span style="font-size: 10px;" class="help-block"><?php echo e($airline['AirlineCode']); ?>-<?php echo e($airline['FlightNumber']); ?></span>
                        </td>
                        <td>
                            <?php
                                $departure = explode('T',$segment['Origin']['DepTime']);
                            ?>
                            <span><b><?php echo e($departure[1]); ?></b></span>
                            <span style="font-size: 10px;" class="help-block"><?php echo e($segment['Origin']['Airport']['CityName']); ?></span>
                        </td>
                        <td>
                            <?php
                                $arival = explode('T',$segment['Destination']['ArrTime']);
                            ?>
                            <span><b><?php echo e($arival[1]); ?></b></span>
                            <span style="font-size: 10px;" class="help-block"><?php echo e($segment['Destination']['Airport']['CityName']); ?></span>
                        </td>
                        <td>
                            <span style="color: red; font-size: 18px">₹</span>
                            <span style="color: red; font-size: 18px"><?php echo e($value['Fare']['PublishedFare']); ?></span>
                        </td>
                        <td>
                            <span style="color: green; font-size: 18px">₹</span>
                            <span style="color: green; font-size: 18px"><?php echo e($value['Fare']['CommissionEarned']); ?></span>
                        </td>
                        <td>
                            <a href="#" class="demo-editable-username" data-airline="<?php echo e($airline['AirlineName']); ?>" data-flightnumber="<?php echo e($airline['FlightNumber']); ?>" data-airlinecode="<?php echo e($airline['AirlineCode']); ?>" data-from="<?php echo e($segment['Origin']['Airport']['CityName']); ?>" data-to="<?php echo e($segment['Destination']['Airport']['CityName']); ?>">
                                <?php
                                    $visibilityAndAmount = \App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName']);
                                    echo $visibilityAndAmount['amount'];
                                    if($visibilityAndAmount['status'] == 1 || $visibilityAndAmount['status'] == 'null'){
                                        $class = 'fa-eye green';
                                        $status = 'true';
                                    }else{
                                        $class = 'fa-eye-slash red';
                                        $status = 'false';
                                    }
                                ?>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="percentage" data-airline="<?php echo e($airline['AirlineName']); ?>" data-flightnumber="<?php echo e($airline['FlightNumber']); ?>" data-airlinecode="<?php echo e($airline['AirlineCode']); ?>" data-from="<?php echo e($segment['Origin']['Airport']['CityName']); ?>" data-to="<?php echo e($segment['Destination']['Airport']['CityName']); ?>">
                                <?php
                                    $visibilityAndAmount = \App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName']);
                                    echo $visibilityAndAmount['percent'];
                                    $amountOption = $visibilityAndAmount['amount_by'];
                                    if($visibilityAndAmount['amount_by'] == 'percent'){
                                        $percentClass = 'fa fa-percent';
                                    }else{
                                        $percentClass = 'fa fa-rupee';
                                    }
                                ?>
                            </a>
                        </td>
                        <td class="min-width">
                            <div class="btn-groups">
                                <a href="javascript:;" class="btn btn-icon fa <?php echo e($class); ?> icon-lg add-tooltip setVisibility" data-visible="<?php echo e($status); ?>" data-original-title="Show/Hide Flight" data-container="body" data-airline="<?php echo e($airline['AirlineName']); ?>" data-flightnumber="<?php echo e($airline['FlightNumber']); ?>" data-airlinecode="<?php echo e($airline['AirlineCode']); ?>" data-from="<?php echo e($segment['Origin']['Airport']['CityName']); ?>" data-to="<?php echo e($segment['Destination']['Airport']['CityName']); ?>"></a>
                                <a href="javascript:;" class="btn btn-icon fa <?php echo e($percentClass); ?> icon-lg add-tooltip setAmountBy" data-original-title="Percentage/Rupee" data-container="body" data-by="<?php echo e($amountOption); ?>" data-original-title="Percent/Rupee" data-container="body" data-airline="<?php echo e($airline['AirlineName']); ?>" data-flightnumber="<?php echo e($airline['FlightNumber']); ?>" data-airlinecode="<?php echo e($airline['AirlineCode']); ?>" data-from="<?php echo e($segment['Origin']['Airport']['CityName']); ?>" data-to="<?php echo e($segment['Destination']['Airport']['CityName']); ?>"></a>
                                
                                
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>