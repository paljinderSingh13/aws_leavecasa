<h4 class="search-results-title"><i class="soap-icon-search"></i><b><?php echo e(count($results['Response']['Results'][0])); ?></b> results found.</h4>
         <div class="toggle-container filters-container" style="padding-bottom: 20px;">
         <form method="post" action="<?php echo e(route('advance.search.results')); ?>">
            <input type="hidden" value="<?php echo e($tripType); ?>" name="trip_type" />
            <?php echo e(csrf_field()); ?>

            <div class="panel style1 arrow-right">
               <h4 class="panel-title">
               <a data-toggle="collapse" href="#flight-stops-filter" class="collapsed">Flight Stops</a>
               </h4>
               <div id="flight-stops-filter" class="panel-collapse collapse">
                  <div class="panel-content">
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheckD" name="DirectFlight" value="true">
                        <label class="custom-control-label" for="customCheckD">Non Stop</label>
                     </div>
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheckO" name="OneStopFlight" value="true">
                        <label class="custom-control-label" for="customCheckO">1 Stop</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel style1 arrow-right">
               <h4 class="panel-title">
               <a data-toggle="collapse" href="#flight-type-filter" class="collapsed">Flight Type</a>
               </h4>
               <div id="flight-type-filter" class="panel-collapse collapse">
                  <div class="panel-content">
                     <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customCheck1" name="preferClass" value="1">
                        <label class="custom-control-label" for="customCheck1">All</label>
                     </div>
                     <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customCheck2" name="preferClass" value="2">
                        <label class="custom-control-label" for="customCheck2">Economy</label>
                     </div>
                     <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customCheck3" name="preferClass" value="3">
                        <label class="custom-control-label" for="customCheck3">Premium Economy</label>
                     </div>
                     <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customCheck4" name="preferClass" value="4">
                        <label class="custom-control-label" for="customCheck4">Business</label>
                     </div>
                     <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customCheck5" name="preferClass" value="5">
                        <label class="custom-control-label " for="customCheck5">Premium Business</label>
                     </div>
                     <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customCheck6" name="preferClass" value="6">
                        <label class="custom-control-label" for="customCheck6">First</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel style1 arrow-right">
               <h4 class="panel-title">
               <a data-toggle="collapse" href="#airlines-filter" class="collapsed">Airlines</a>
               </h4>
               <div id="airlines-filter" class="panel-collapse collapse">
                  <div class="panel-content">
                    <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="PreferredAirlines<?php echo e($loop->index); ?>" name="PreferredAirlines" value="<?php echo e($airline->IATA); ?>">
                        <label class="custom-control-label" for="PreferredAirlines<?php echo e($loop->index); ?>"><?php echo e($airline->Airline); ?></label>
                     </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
               </div>
            </div>
             <div class="panel style1 arrow-right">
               <h4 class="panel-title">
               <a data-toggle="collapse" href="#time-filter" class="collapsed">Flight Times</a>
               </h4>
               <div id="time-filter" class="panel-collapse collapse">
                  <div class="panel-content">
                   <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="mor" name="preferDepartureTime" value="mor">
                        <label class="custom-control-label" for="mor">Morning</label>
                     </div>
                     <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="aft" name="preferDepartureTime" value="aft">
                        <label class="custom-control-label" for="aft">After-noon</label>
                     </div>
                     <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="eve" name="preferDepartureTime" value="eve">
                        <label class="custom-control-label" for="eve">Evening</label>
                     </div> 
                  </div>
               </div>
            </div>
            <div class="panel-content text-center">            
           <button class="btn btn-primary btn-rounded btn-block ">Search<span></span><span></span><span></span></button> 
         </div>
         </form>
         </div>