<?php $__env->startSection('content'); ?>
<?php 

use App\Helpers\Hotel;
 //dump(json_encode(Session::get('hotel_req')));
?>
       <div class="row mdb p1"> 
        <div class="col offset-l1 l5 s12">
            <p class="f28w100 white-text mt0 mb0"> <?php echo e($no_of_hotels); ?> Hotels found</p>
        </div>
        <div class="col l5 p0 hide-on-med-and-down">
            <ul class="stepper horizontal">
                <li class="step active blue-text">
                    <div class="step-title waves-effect">Selection</div>
                </li>
                <li class="step grey-text">
                    <div class="step-title waves-effect">Review</div>
                </li>
                <li class="step grey-text">
                    <div class="step-title waves-effect">Payment</div>
                </li>
            </ul>
        </div> 
    </div>
    
            <div class="container">
                <div id="main">
                  <?php if($no_of_hotels!=0): ?> 
                    <div class="row" id="ecommerce-products">
                     
                        
                        <div class="col offset-s1 s10 m2 l2 pr-0 sticky1">
                            
                               <div class="card  animate fadeLeft border-radius-8 z-depth-4">
                                <div class="card-content">


                                
                                <span class="card-title icon_prefix" ><i class="material-icons mr-2 search-icon orange-text" style="vertical-align: top;">search</i><b><?php echo e($no_of_hotels); ?></b> results.</span>
                                        <span class="card-title mt-10">Advance Search</span>
                                        <hr class="p-0 mb-10">
                                             <span class="card-title mt-10">Category</span>
                                                     <hr class="p-0 mb-10">
                                                     <p class="display-grid black-text">
                                           <form  action="<?php echo e(route('hotels.results')); ?>" method="post" >
                                                    <?php echo e(csrf_field()); ?>


                                                     <?php
                                                    	//dump(Session::get('orginal_request'));
                                                    ?>
                                                     

                                                    <?php $__currentLoopData = Session::get('orginal_request'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $okey => $oval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($okey =='_token'): ?>
                                                      <?php continue; ?>
                                                    <?php endif; ?>
                                                      <?php if(is_array($oval)): ?>
                                                       <?php

                                                    	//dd($okey, $oval);
                                                    ?>
                                                          <?php $__currentLoopData = $oval; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rok => $roV): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <?php if(is_array($roV)): ?>
                                                            	 <?php continue; ?>
                                                            <?php endif; ?>

                                                           <input type="hidden" name="<?php echo e($okey); ?>[<?php echo e($rok); ?>]" value="<?php echo e($roV); ?>">

                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      
                                                      <?php else: ?>
                                                        <input type="hidden" name="<?php echo e($okey); ?>" value="<?php echo e($oval); ?>">
                                                      <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                    <label> <input type="checkbox" class="with-gap" name="stars" class="stars" value="5" onclick="getCheckedBoxes()"> <span>5 Star </span></label>
                                                    <label><input type="checkbox" class="with-gap" name="stars" class="stars" value="4" onclick="getCheckedBoxes()"><span>4 Star</span></label>
                                                    <label><input type="checkbox" class="with-gap" name="stars" class="stars" value="3" onclick="getCheckedBoxes()"><span>3 Star</span></label>
                                                    <label><input type="checkbox" class="with-gap" name="stars" class="stars" value="2" onclick="getCheckedBoxes()"><span>2 Star</span></label>
                                                    <label><input type="checkbox" class="with-gap" name="stars" class="stars" value="1" onclick="getCheckedBoxes()"><span>1 Star</span></label>

                                                   
                                                
                                                 
                                                 <button class="btn mdb waves-effect waves-light mt3" type="submit">search again
                                                 </button>
                                      </form>
                                </div>
                            </div>
                        </div>
  
 <div class="col l10">                       
<?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h_key => $h_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php

$datah = collect($h_val['hotels']);

$resulth = $datah->groupBy([
            function ($item) {
            	if(empty($item['category'])){
            		return 0;
            	}

                return (int)$item['category'];
            },
            ], $preserveKeys = true);
    $cat_wise_hotel = $resulth->toArray();
?>
<?php $__currentLoopData = $cat_wise_hotel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat => $catVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="cat_<?php echo e($cat); ?> show_cat"> 

	<?php
	?>
<?php $__currentLoopData = $catVal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    $mark_price =0;
    // dump($hotel['category']);

    if(!empty($hotel['category']))
    {
    	$hotel_cat = explode('.', $hotel['category']);
      $mark_data =  $mark_up->where('star_ratting',$hotel_cat[0])->toArray();
        if(!empty($mark_data)){

      foreach ($mark_data   as $key => $value) {
          # code...
           if($value['amount_by'] =="rupee"){
              $mark_price =  $value['amount'];
           }elseif($value['amount_by'] =="percent"){

             $mark_price = Hotel::cal_markup_percent_val($hotel['min_rate']['price'], $value['amount']);
             
           }
        }
       }
      $dull = 5 - $hotel['category'];
    }
   $hotel_total_price =  $hotel['min_rate']['price'] + $mark_price;
  ?>
  <?php if($loop->iteration%3==0): ?>
        <div>
        
      <?php endif; ?>
    <div class="col s12 m4" id="h_detail">
      <div class="card hotel-list listing-style3 hotel z-depth-4 border-radius-8">
       
        <div class="card-image waves-effect waves-block waves-light">
          <?php if(!empty($hotel['images']['url'])): ?>
          <img class="activator responsive-img" src="<?php echo e($hotel['images']['url']); ?>" style="height:200px">
          <?php else: ?>
          <img class="activator responsive-img" src="<?php echo e(asset('images/demo_hotel.jpg')); ?>" style="height:200px">
          <?php endif; ?>
        </div>
        <div class="card-content">

          <?php if(!empty($hotel['category'])): ?>
        <span>
      <?php
        $rating = floor($hotel['category']);
        $decimalstart = $hotel['category'] - $rating;
      $pointrating = $decimalstart * 10;
      $rating2 = ceil($hotel['category']);
      $unfieldstar = 5-$rating2;
      ?>
      <?php for($i=0;$i<$rating;$i++): ?>
      <img src="<?php echo e(url('/images/star/star.png')); ?>"  width="16" height="16">
      <?php endfor; ?> 
      <?php if(strpos($decimalstart,'.') !== false): ?>
      <img src="<?php echo e(url('/images/star/star'.$pointrating.'.png')); ?>" width="16" height="16">
      <?php endif; ?>
      <?php for($j=0;$j<$unfieldstar;$j++): ?>
      <img src="<?php echo e(url('/images/star/unfield-star.png')); ?>" width="16" height="16">
      <?php endfor; ?> 
        </span>


          <?php if(!empty($hotel['min_rate']['non_refundable']) &&($hotel['min_rate']['non_refundable']==true)): ?>
          <span class=" red-text valign right mr-5 fs20">
              Non Refundable
          </span>
      <?php endif; ?>
      <?php endif; ?>
          <p class="activator mdb-text text-darken-4">
            <i class="material-icons left mt-1 red-text">location_on</i>
            <h6>
          <?php echo e(Illuminate\Support\Str::limit($hotel['name'], 25, '...')); ?></h6>  
      
      </p>
      <p class="activator mdb-text text-darken-4">
            <i class="material-icons left mt-1 green-text">account_balance_wallet</i>
            
            <h6>
          ₹ <?php echo e($hotel_total_price); ?></h6>  
       
      </p>
          <p class="grey-text text-darken-4">
            <i class="material-icons left">more</i>
            <a href="javascript:modal_open(<?php echo e($loop->index); ?>)" >
          Facilities</a>          
         </p>
     
           <div class="modal" id="modal<?php echo e($loop->index); ?>"  tabindex="-1">
    <div class="modal-content" id="<?php echo e($loop->index); ?>">
      <h5 class="mt0 collection-item">Facilities at <?php echo e($hotel['name']); ?></h5>

      <?php if(!empty($hotel['facilities'])): ?>
        <div class="row">

         <?php $__currentLoopData = explode(';', $hotel['facilities']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($loop->iteration%4==0): ?>
          <div>
           <?php endif; ?>
           <div class="col m4 s10 lc">
            <i class="fas fa-check mdb-text mr1 "></i><?php echo e($info); ?></div>
         <?php if($loop->iteration%4==0): ?>
           </div>        
       <?php endif; ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    

    <?php endif; ?>

    
  </div></div>
        </div>
          
             
        <div class="card-action">
          <a href="<?php echo e(route('hotel.detail',['sid'=>$h_val['search_id'], 'code'=>$hotel['hotel_code']])); ?>" class="btn mdb">More Info</a>
        </div>        
      </div>
    </div>
   
  <?php if($loop->iteration%3==0): ?>
        </div>
        
      <?php endif; ?>
      
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </div>
                     
                    </div>

                     <?php else: ?>
                        <div class="col s12  l10 center-align white">
      <img src="<?php echo e(asset('images/not_found.gif')); ?>" class="bg-gif-404" alt="">
      <h1 class="error-code m-0">Sorry ! No Result Found</h1>
      <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="<?php echo e(route('index')); ?>">Back
        TO Home</a>
    </div>
                      <?php endif; ?>
                </div>
            </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.materialize', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>