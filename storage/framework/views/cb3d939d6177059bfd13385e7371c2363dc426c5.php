<?php $__env->startSection('content'); ?>
<section id="content">
 <?php

//dump(json_encode(Session::get('searchBus')));
 use App\Helpers\BusApi;
        if(!empty($results['markup'])){


            $markup = $results['markup'];

          
            if($markup['amount_by'] == "rupee"){

                $markup_amount = $markup['amount_or_percent'];
             ?>
                <input id="markup_type"  type="hidden" value="amount">
                <input id="markup_parm"  type="hidden" value="<?php echo e($markup_amount); ?>">
             <?php
            }
             if($markup['amount_by'] == "percent"){

                $markup_percent = $markup['amount_or_percent'];
                 ?>
                <input id="markup_type"  type="hidden" value="percent">
                <input id="markup_parm"  type="hidden" value="<?php echo e($markup_percent); ?>">
                 <?php
            }
       }else{ 

       ?>
            <input id="markup_parm" type="hidden" value="<?php echo e($results['markup']); ?>" >
        <?php

        }

    ?>
  
 <div class="row mdb p1 "> 
    <div class="col  l5 s12">
     <p class="f22w200 white-text mt0 mb0"><i class="fas fa-bus  prefix white-text"></i> <?php echo e(App\Model\BusBookingSource::city_code_to_name($request->bus_from)); ?> to <?php echo e(App\Model\BusBookingSource::city_code_to_name($request->bus_to)); ?><span> On <?php echo e($request->journey_date); ?></span></p>
 </div> 
 <div class="col l5 p0 hide-on-med-and-down">
    <ul class="stepper horizontal">
        <li class="step active blue-text">
            <div class="step-title waves-effect">Bus Select</div>
        </li>
        <li class="step grey-text">
            <div class="step-title waves-effect">Review</div>
        </li>
        <li class="step grey-text">
            <div class="step-title waves-effect">Make Payment</div>
        </li>
    </ul>
</div> 
</div>
<div class="container">
    <div id="main">
      <?php if(!empty($results['availableTrips'])): ?>
        <div class="row">                        
         <div class="col offset-s1 s10 m2 l2 pr-0 sticky1">
             <div class="card animate fadeLeft border-radius-8 z-depth-4">
                <div class="card-content">
                    <span class="card-title icon_prefix" ><i class="material-icons mr-2 search-icon orange-text" style="vertical-align: top;">search</i><b><?php echo e((!empty($results['availableTrips']))?count($results['availableTrips']):0); ?> results.</b></span>
                        <span class="card-title mt-10">Bus Type</span>
                        <hr class="p-0 mb-10">
                        <p class="display-grid">
                            <label> <input type="checkbox" class="with-gap" name="preferClass" value="1"> <span>AC  </span></label>
                            <label> <input type="checkbox" class="with-gap" name="preferClass" value="2"> <span>Non AC  </span></label>
                            <label><input type="checkbox" class="with-gap" name="preferClass" value="3"><span> Seater</span></label>
                            <label><input type="checkbox" class="with-gap" name="preferClass" value="4"><span> Sleeper</span></label>
                            <label><input type="checkbox" class="with-gap" name="preferClass" value="5"><span> Semi Sleeper</span></label>
                        </p>

                        <span class="card-title mt-10">Departure Time</span>
                        <hr class="p-0 mb-10">
                        <p class="display-grid">
                            <label><input type="checkbox" class="with-gap" name="preferDepartureTime" value="mor"><span> Morning</span></label>
                            <label><input type="checkbox" class="with-gap" name="preferDepartureTime" value="aft"><span> After-noon</span></label>
                            <label><input type="checkbox" class="with-gap" name="preferDepartureTime" value="eve"><span> Evening</span></label>
                            <label><input type="checkbox" class="with-gap" name="preferDepartureTime" value="ngt"><span> Night</span></label>
                        </p>
                        <button class="btn mdb waves-effect waves-light mt3" type="submit">search again
                        </button>
                    </div>
                </div>
            </div>
            <div class="col s12 m9 l10">
                <?php if($results != null &&  !empty($results['availableTrips'])): ?>
                <div class="bus-list listing-style3 bus">
                    <div class="sort-by-section row hide-on-med-and-down">

                        <div class="col l1"><h6 class="center-align">Sort:</h6></div>
                        <div class="col l2"><h6 class="">Departure</h6></div>
                        <div class="col l2"><h6 class="">Duration</h6></div>
                        <div class="col l2"><h6 class="">Arrival</h6></div>
                        <div class="col l1"><h6 class="">Seats</h6></div>
                        <div class="col l2"><h6 class="">Price</h6></div>
                        <div class="col l2"><h6 class="">Book</h6></div>
                    </div>

                    <input id="ctoken" type="hidden" value="<?php echo e(csrf_token()); ?>">
                    <?php $__currentLoopData = $results['availableTrips']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php

                    // dump($record);

                     ?> 

                   
                    <?php if($record['bookable'] == "true" || $record['bookable'] == true): ?>

                    <div class="card  border-radius-8 z-depth-4 <?php echo e($record['AC']? 'ac': ''); ?>   <?php echo e($record['sleeper']=='true' ? 'sl': 'nsl'); ?>">
                        <small class="uc ml2 fs15"><?php echo e($record['travels']); ?></small> <span class="valign right mr5">
                        <?php if($record['AC'] == "true"): ?>
                        <small class="fs15"><a class="stop">AC <b class="green-text">Yes</b></a></small>
                        <?php else: ?>
                        <small class="fs15"><a class="stop">AC <b class="red-text">No</b></a></small>
                        <?php endif; ?>
                        
                        | 
                        <?php if($record['sleeper'] == "true"): ?>
                        <small class="fs15"><a class="stop">SLEEPER <b class="green-text">Yes</b></a></small>
                        <?php else: ?>
                        <small class="fs15"><a class="stop">SLEEPER <b class="red-text">No</b></a></small>
                        <?php endif; ?>
                        </span>
                        <div class="row  card-content mb0 padding-1">

                           <div class="col l1 ">
                             <img alt="" src="<?php echo e(asset('images/bus.png')); ?>" class="responsive-img" style="height:50px; width:50px">                
                         </div>
                         <div class="col l2">
                             <?php
                                $departureTime = $record['departureTime'];
                                $hours = floor($departureTime/60)%24;
                                $minutes = $departureTime%60;
                                ?>
                            <span class="skin-color uc fs22"><?php echo e(\Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a')); ?></span>
                         </div>
                         <div class="col l2">
                         <?php
                                $arrivalTime = $record['arrivalTime'];
                                $timeElaps = $arrivalTime - $departureTime;
                                $hours = floor($timeElaps/60)%24;
                                $minutes = $timeElaps%60;
                         ?>
                            <span class="skin-color fs22"><?php echo e($hours); ?>hr, <?php echo e($minutes); ?>m</span>
                        </div>
                         <div class="col l2">
                             <?php
                                $arrivalTime = $record['arrivalTime'];
                                $hours = floor($arrivalTime/60)%24;
                                $minutes = $arrivalTime%60;
                                ?>
                            <span class="skin-color uc fs22"><?php echo e(\Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a')); ?></span>
                         </div>
                         <div class="col l1">
                            <span class="skin-color uc fs22"><?php echo e($record['availableSeats']); ?></span>
                         </div>
                         <div class="col l2">
                            <span class="teal-text uc fs22">
                               
                                <?php 



                                    if((is_array($record['fares']))){

                                        $ifares_amount = $fares_amount = round($record['fares'][0]);
                                    }else{

                                       $ifares_amount = $fares_amount = round($record['fares']);

                                    }

                                    if(!empty($markup_amount)){

                                    $fares_amount = ($fares_amount + $markup_amount);
                                }

                                    if(!empty($markup_percent)){

                                      $markup_amount =   BusApi::percentage_markup($markup_percent,  $fares_amount);

                                      $fares_amount = ($fares_amount + $markup_amount);
                                    }


                                ?>
                             
                             ₹ <?php echo e($fares_amount); ?></span>
                         </div>
                          <div class="col l2 action">
                            <input id="source_<?php echo e($key); ?>" type="hidden"  value="<?php echo e($record['source']); ?>">
                            <input id="bt_<?php echo e($key); ?>" type="hidden"  value="<?php echo e(json_encode($record['boardingTimes'])); ?>">
                            <input id="dt_<?php echo e($key); ?>" type="hidden"  value="<?php echo e(json_encode($record['droppingTimes'])); ?>">
                            <a id="<?php echo e($key); ?>" href="javascript:void(0)" class="button btn border-round mdb seat_details" data-id="<?php echo e($record['id']); ?>" <?php echo e(($record['availableSeats'] == 0)?'disabled':''); ?> >SELECT</a>
                          </div>

                          <!-- data-id="<?php echo e($record['id']); ?>" <?php echo e(($record['availableSeats'] == 0)?'disabled':''); ?> data-boarding-points="<?php echo e(json_encode($record['boardingTimes'])); ?>" data-droping-points="<?php echo e((!empty($record['droppingTimes']))?json_encode($record['droppingTimes']):null); ?>" data-source="<?php echo e(request()->bus_from); ?>" data-destination="<?php echo e(request()->bus_to); ?>" data-record="<?php echo e(json_encode($record)); ?>" -->

                     </div>
                 </div>
                 <?php endif; ?>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
             <?php endif; ?>
            
         </div>
     </div>
       <?php else: ?>
   <div class="row">
  <div class="center-align white">
      <img src="<?php echo e(asset('images/not_found.gif')); ?>" class="bg-gif-404" alt="">
      <h2 class="error-code m-0">Sorry ! No Result Found</h2>
      <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="<?php echo e(route('index')); ?>">Back
        TO Home</a>
    </div> 
</div>
 
<?php endif; ?>
 </div>
</div>
</section>



<div class="modal_content">
    
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">

    var $ = jQuery;
    $(function(){
        window.selectedSeats = {};
        window.price = 0;
        window.markup_fare = 0;
        $('body').on('click','.seat',function(){             
            if(!$(this).hasClass('disabled')){
                if($(this).hasClass('selected')){
                    $(this).removeClass('selected');
                    if($(this).hasClass('sleeper')){
                        $(this).find('img').attr('src','<?php echo e(asset('public/images/sleapper_seat.png')); ?>');
                      if($(this).hasClass('ladySeat')){
                        $(this).find('img').attr('src','<?php echo e(asset('public/images/lady_sleapper_seat.png')); ?>');  
                    }}else if($(this).hasClass('sitting')){
                        $(this).find('img').attr('src','<?php echo e(asset('public/images/bus_seat.png')); ?>');
                        if($(this).hasClass('ladySeat')){
                        $(this).find('img').attr('src','<?php echo e(asset('public/images/ladySeat.png')); ?>');}
                    }
                    delete selectedSeats[$(this).data('name')];
                    var tempArray = [];
                    $.each(selectedSeats, function(key,value){
                        tempArray.push(value);
                    });
                      seat_name = $(this).data('name');
                      $("#"+seat_name).remove();
                    markup_fare = parseInt(markup_fare) - parseInt($(this).data('markup-fare'));
                     markup_fare = parseInt(markup_fare).toFixed(2);
                    console.log('-', markup_fare);

                    price = price - parseFloat($(this).data('fare'));
                    $('.total_price').html(markup_fare);
                    $('input[name=total_price]').val(price);
                    $('.seats_selected').html(tempArray.join(','));
                    $('input[name=seats_selected]').val(tempArray.join(','));
                  }else{
                    if($('.maximum_seats').val() == Object.keys(selectedSeats).length){
                        M.toast({html: 'You have selected maximum seats!'},2200);
                        return false;
                    }
                    $(this).addClass('selected');
                    if($(this).hasClass('sleeper')){
                        $(this).find('img').attr('src','<?php echo e(asset('public/images/sleapper_seat_selected.png')); ?>');
                        if($(this).hasClass('ladySeat')){
                        $(this).find('img').attr('src','<?php echo e(asset('public/images/sleapper_seat_selectedLady.png')); ?>');}

                    }else if($(this).hasClass('sitting')){
                        $(this).find('img').attr('src','<?php echo e(asset('public/images/bus_seat_selected.png')); ?>');
                        if($(this).hasClass('ladySeat')){
                        $(this).find('img').attr('src','<?php echo e(asset('public/images/bus_seat_selectedLady.png')); ?>');}
                    }
                    var tempArray = [];
                    selectedSeats[$(this).data('name')] = $(this).data('name');
                    $.each(selectedSeats, function(key,value){
                        tempArray.push(value);
                    });
                    markup_fare = parseInt(markup_fare) + parseInt($(this).data('markup-fare'));
                    markup_fare = parseInt(markup_fare).toFixed(2);
                   // console.log('++', markup_fare);

                    price = price + parseFloat($(this).data('fare'));

                    seat_name = $(this).data('name');
                    lady = $(this).data('lady');

                    fare = [$(this).data('fare'), lady];

                    inputs = "<input id='"+seat_name+"' type='hidden' name='seat["+seat_name+"]' value='"+fare+"'' >";
                    $("#seats").append(inputs);
                    $('.total_price').html(markup_fare);
                    $('input[name=markup_price]').val(markup_fare);
                    $('input[name=total_price]').val(price);
                    $('.seats_selected').html(tempArray.join(','));
                    $('input[name=seats_selected]').val(tempArray.join(','));
                }
            }
        });
        

    });
    
    
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.materialize', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>