
<?php $__env->startSection('content'); ?>
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Bus Search</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">Bus Search</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">

            <!-- Toolbar -->
            <!--===================================================-->
            <?php echo Form::open(); ?>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Book Bus</h3>
                    </div>
                    <div class="panel-body">
                
                        <!-- Inline Form  -->
                        <!--===================================================-->
                        <form class="form-inline">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bus-source">Source</label>
                                        <?php echo Form::select('from',$sources,null,['class'=>'form-control busSource','placeholder'=>'Select Source','id'=>'bus-source']); ?>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bus-destination">Destination</label>
                                        <?php echo Form::select('destination',[],null,['class'=>'form-control busDestination','placeholder'=>'Select Destination','id'=>'bus-destination','required']); ?>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="departure_date">Journey Date</label>
                                        <?php echo Form::text('journey_date',null,['class'=>'form-control datePicker','id'=>'departure_date','placeholder'=>'Journey Date','autocomplete'=>'off','data-format'=>'yyyy-mm-dd']); ?>

                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-top: 2%;">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Search Bus</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php echo Form::close(); ?>



             <div class="search-background"></div>
                <div class="row search-spinner hotel-spinner">
                    <div class="col-md-12 text-center">
                        <h4 class="load_text">Getting Destination List..</h4>
                        <div class="sk-wandering-cubes">
                            <div class="sk-cube sk-cube1"></div>
                            <div class="sk-cube sk-cube2"></div>
                        </div>
                    </div>
                </div>

            <hr class="new-section-xs bord-no">
            <?php
         // dd($searchResults);
            ?>
            <?php if(!empty($searchResults['availableTrips'])): ?>
                <div class="panel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped bus_details">
                                <thead>
                                    <tr>
                                        <th width="90">Departure Time</th>
                                        <th width="80">Duration</th>
                                        <th width="88">Arrival Time</th>
                                        <th width="200">Bus Details</th>
                                        <th>Seats</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <input id="ctoken" type="hidden" value="<?php echo e(csrf_token()); ?>">
                                    <?php $__currentLoopData = $searchResults['availableTrips']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    $departureTime = $bus['departureTime'];
                                                    $hours = floor($departureTime/60)%24;
                                                    $minutes = $departureTime%60;
                                                    echo \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $timeElaps = $bus['arrivalTime'] - $bus['departureTime'];
                                                    $hours = floor($timeElaps/60)%24;
                                                    $minutes = $timeElaps%60;
                                                ?>
                                                <?php echo e($hours); ?>h, <?php echo e($minutes); ?>m
                                            </td>
                                            <td>
                                                <?php
                                                    $arrivalTime = $bus['arrivalTime'];
                                                    $hours = floor($arrivalTime/60)%24;
                                                    $minutes = $arrivalTime%60;
                                                    echo \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                                                ?>
                                            </td>
                                            <td>
                                                <h5><?php echo e($bus['travels']); ?></h5>
                                                <?php echo e($bus['busType']); ?>

                                            </td>
                                            <td>
                                                <span style="color: <?php echo e(($bus['availableSeats'] == 0)?'red':'#000'); ?>">Seats <b><?php echo e($bus['availableSeats']); ?></b> Left</span>
                                                <br/>
                                                <small>Available Windows Seat <?php echo e($bus['avlWindowSeats']); ?></small>
                                            </td>
                                            <td>
                                                <?php if(is_array($bus['fares'])): ?>
                                                    <h4> &#8377; <?php echo e(round(max($bus['fares']))); ?></h4>
                                                <?php else: ?>
                                                    <h4> &#8377; <?php echo e(round($bus['fares'])); ?></h4>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                 

                                                <button class="btn btn-primary seat_details" data-id="<?php echo e($bus['id']); ?>" <?php echo e(($bus['availableSeats'] == 0)?'disabled':''); ?> data-boarding-points="<?php echo e(json_encode($bus['boardingTimes'])); ?>" data-droping-points="<?php echo e(json_encode($bus['droppingTimes'])); ?>" data-source="<?php echo e(request()->from); ?>" data-destination="<?php echo e(request()->destination); ?>">Book Now</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!--===================================================-->
        <!--End page content-->
    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
    
    
    <div class="modal_content">
        
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    ##parent-placeholder-2f84417a9e73cead4d5c99e05daff2a534b30132##
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset(env('FPATH').'css/bus_booking.css?ref='.rand(111,999))); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" src="<?php echo e(asset(env('FPATH').'js/bus_booking.js?ref='.rand(11111,99999))); ?>"></script>
     <script type="text/javascript">
     $(document).ready(function(){
            $('select[name=from]').select2();
            $('select[name=destination]').select2();
        });
     </script>
    <script type="text/javascript">
        $(function(){
            window.selectedSeats = {};
            window.price = 0;
            $('body').on('click','.seat',function(){
                if(!$(this).hasClass('disabled')){
                    if($(this).hasClass('selected')){
                        $(this).removeClass('selected');
                        if($(this).hasClass('sleeper')){
                            $(this).find('img').attr('src','<?php echo e(asset('public/images/sleapper_seat.png')); ?>');
                        }else if($(this).hasClass('sitting')){
                            $(this).find('img').attr('src','<?php echo e(asset('public/images/bus_seat.png')); ?>');
                        }
                        delete selectedSeats[$(this).data('name')];
                        var tempArray = [];
                        $.each(selectedSeats, function(key,value){
                            tempArray.push(value);
                        });
                        price = price - parseFloat($(this).data('fare'));
                        $('.total_price').html(price);
                        $('input[name=total_price]').val(price);
                        $('.seats_selected').html(tempArray.join(','));
                        $('input[name=seats_selected]').val(tempArray.join(','));
                    }else{
                        if($('.maximum_seats').val() == Object.keys(selectedSeats).length){
                            $.niftyNoty({
                                type: 'danger',
                                container : 'floating',
                                title : 'Error',
                                message : 'You have selected maximum seats!',
                                closeBtn : true,
                                timer : 10000,
                            });
                            return false;
                        }
                        $(this).addClass('selected');
                        if($(this).hasClass('sleeper')){
                            $(this).find('img').attr('src','<?php echo e(asset('public/images/sleapper_seat_selected.png')); ?>');
                        }else if($(this).hasClass('sitting')){
                            $(this).find('img').attr('src','<?php echo e(asset('public/images/bus_seat_selected.png')); ?>');
                        }
                        var tempArray = [];
                        selectedSeats[$(this).data('name')] = $(this).data('name');
                        $.each(selectedSeats, function(key,value){
                            tempArray.push(value);
                        });
                        price = price + parseFloat($(this).data('fare'));
                        $('.total_price').html(price);
                        $('input[name=total_price]').val(price);
                        $('.seats_selected').html(tempArray.join(','));
                        $('input[name=seats_selected]').val(tempArray.join(','));
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>