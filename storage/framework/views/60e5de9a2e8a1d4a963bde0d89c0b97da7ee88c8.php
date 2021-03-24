<?php $__env->startSection('content'); ?>

	<style type="text/css">
		.h-90{
			height:90px;
		}

		.changeimg{
			cursor: pointer;
		}

	</style>

<?php 
use App\Helpers\Hotel;
$mark_price = 0;

dump(@$hotel_imgs, @$hotel);
?>

<?php if(!empty($error[0]['messages'][0])): ?>
	<div class="col s12  l10 center-align white">
      <img src="<?php echo e(url('images/error-2.png')); ?>" class="bg-image-404" alt="">
      <h4 class="error-code m-0">Sorry ! <?php echo e($error[0]['messages'][0]); ?></h4>
      <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="<?php echo e(route('index')); ?>">Back
        TO Home</a>
    </div>

<?php else: ?>

<div class="home1 h-50" style="">
  <div class="home_slider_container1">
    <div class="owl-carousel owl-theme home_slider1">
      <div class="owl-item home_slider_item1">
        <div class="home_slider_background1" style="background-image:url(/../images/bg.jpg)"></div>
        <div class="home_slider_content1 text-center">
          <div class="home_slider_content_inner1" data-animation-in="flipInX" data-animation-out="animate-out fadeOut">
          </div>
        </div>
      </div>
    </div>
  </div>   
</div>
<section class="section" id="content">
	<div class="container">


		<?php if(!empty($hotel_imgs)): ?>
		<div class="row">
			
				<img class="col-8 main-img" src="<?php echo e($hotel['hotel']['images']['url']); ?>">
			
			<div class="col-4">

				<div class="row">
					<?php $__currentLoopData = $hotel_imgs['regular']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img_key =>$img_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
						<img class="col-4 img-responsive img-thumbnail h-90 changeimg" src="<?php echo e($img_val['url']); ?>" >
						
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
				</div>
				
			</div>
			
		</div>






		<?php endif; ?>
			<?php
			$end = $first = 1;
			$children = array_column($hotel_req['rooms'], 'children_ages');
			$other = $hotel;
			$hotel = $hotel['hotel'];
			if(!empty($hotel['category'])){
			$dull = 5 - $hotel['category'];
			}
			?>	
			<?php
			$adult=0;
			$child=0;
			foreach($hotel_req['rooms'] as $room_no => $room_val){
			if(!empty($room_val['adults'])){
			$adult+= $room_val['adults'];
			}
			if(!empty($room_val['children_ages'])){
			$child+= count($room_val['children_ages']);
			}
			}
			?>


			<div class="row card scrollspy z-depth-4 border-radius-8" id="description-tab">
	 <div class="card-content mb-0">
	 		    <h4 class="mt0 black-text"><?php echo e($hotel['name']); ?>

	 		    <?php if(!empty($hotel['category'])): ?>
	 			<span class="fs15">
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
			<?php endif; ?>
		</h4>
	 		    <h6 class="mt0"><i class="fas fa-map-marker red-text"></i> <?php echo e($hotel['address']); ?></h6>


	 		    
	 		    <h6><i class="fas fa-home green-text"></i><?php echo e(count($hotel_req['rooms'])); ?> Rooms  , <i class="fas fa-user-tie mdb-text"></i> <?php echo e($adult); ?>  Adults ,<i class="fas fa-child mdb-text"></i> <?php echo e($child); ?> Child
	</h6>
	 		</div>










		<div class="row mt-5 mb-1 justify-content-md-left">
			<div class="col"><br>
				
	 			<p class="mt0 ">
					<span class="fs15 white-text text-darken-4">
						<i class="far fa-clock orange-text"></i> Check In :
					<?php echo e(\Carbon\Carbon::parse($hotel_req['checkin'])->format('d M ,Y')); ?>

						</span>
					<span class="fs15 white-text text-darken-4">
						&nbsp;<i class="far fa-clock orange-text"></i> Check Out :
					<?php echo e(\Carbon\Carbon::parse($hotel_req['checkout'])->format('d M ,Y')); ?>

						</span>	
						
				</p>
			</div>
		</div>




		<div class="row card scrollspy z-depth-4 border-radius-8" id="description-tab">
	 		    	<div class="col-12 map">
	 			<iframe src="https://maps.google.com/maps?q=<?php echo e($hotel['geolocation']['latitude']); ?>,<?php echo e($hotel['geolocation']['longitude']); ?>&hl=en&z=14&amp;output=embed" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
	 		   </div>
	 			</div>



	 			<div class="col-12 l12 s12 ">

	 				<!-- Button trigger modal -->

	 				<ul class="collection">
	 				<li class="collection-item row">
	 					<div class="col-5 l5"><h6>Room type</h6></div>
	 					<div class="col-3 l3"><h6>Meal type</h6></div>
	 					<div class="col-2 l2"><h6>Price</h6></div>
	 					<div class="col-2 l2"><h6>Select</h6></div>
	 				</li>
	 			<?php $__currentLoopData = $hotel['rates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_key => $r_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	 			<?php
	 			// dump(json_encode($r_val));
	 			//dump(json_encode($r_val['cancellation_policy']));
	 			?>
	 			<?php if($r_val['no_of_rooms'] != count($hotel_req['rooms'])  ): ?>

	 				<?php if(!empty($first)): ?>
	 			 		<form method="post" action="<?php echo e(route('hotel.book')); ?>">
	 			 		<?php echo e(csrf_field()); ?>

	 					<?php
	 						$first =0;
	 					?>
	 				<?php endif; ?>
	 			<?php else: ?>
	 				<form method="post" action="<?php echo e(route('hotel.book')); ?>">
	 					<?php echo e(csrf_field()); ?>

	 			<?php endif; ?>
	 			

	 				

	 			<?php if($r_val['no_of_rooms'] != count($hotel_req['rooms'])): ?>

	 			<h6> Adult 

	 			<?php echo e($r_val['rooms'][0]['no_of_adults']); ?>  Children <?php echo e($r_val['rooms'][0]['no_of_children']); ?>


	 		</h6>
<?php		
	// dump($r_val);
	 				
	 			?>


	 			<?php endif; ?>
	 				
			      <li class="collection-item row">
			      	<input type="hidden"  value="<?php echo e($other['search_id']); ?>" name="search_id">
			      	<input type="hidden"  value="<?php echo e($hotel['hotel_code']); ?>" name="hotel_code">
			      	<input type="hidden"  value="<?php echo e($hotel['city_code']); ?>" name="city_code">
			      	<input type="hidden"  value="<?php echo e($r_val['group_code']); ?>" name="group_code">
			      	<input type="hidden"  value="<?php echo e($r_val['rate_key']); ?>" name="rate_key">
			      	<?php if(!empty($r_val['rooms'][0]['room_reference'])): ?>
			      		<input type="hidden"  value="<?php echo e($r_val['rooms'][0]['room_reference']); ?>" name="room_reference">

			      	<?php endif; ?>

			      <?php if(!empty($r_val['room_code'])): ?>
			      	<input type="hidden"  value="<?php echo e($r_val['room_code']); ?>" name="room_code">
			      <?php endif; ?>

                <label style="font-size: 15px;"><div class="col l5">
			    <?php if($r_val['no_of_rooms'] != count($hotel_req['rooms'])): ?>
			    	
			    	 <input type="checkbox" name="rate_index[]" value="<?php echo e($loop->index); ?>"> 
			    <?php endif; ?>
			      <span class="black-text lc">
			      	<?php echo e(count($r_val['rooms'])); ?> &#10005; <?php echo e($r_val['rooms'][0]['description']); ?> 

			      	<?php if(!empty($r_val['non_refundable'])): ?>
			      		<p>Non Refundable</p>
			      	<?php endif; ?>
			    </span></div>
                  </label>
			      	<?php if(!empty($r_val['boarding_details'])): ?>
			      		<div class="col-3 l3"><span class="orange-text"><?php echo e(implode(', ', $r_val['boarding_details'])); ?></span></div>
			      		<?php else: ?>
			      		<div class="col-3 l3"><span class="orange-text">Room Only</span></div>
			      	<?php endif; ?>

			      	<?php

			      	if(!empty($mark_up["amount_by"]) && $mark_up["amount_by"] == "percent"){
			      		$mark_price = Hotel::cal_markup_percent_val($r_val['price'], $mark_up["amount"]);
			      	}else{
			      		$mark_price=0;
			      	}

			      	
    				$total_price = $r_val['price'] + $mark_price;

			      	?>
			    	<div class="col-2 l2"><h5 class="mc0"> &#8377;
			    	
			    	<?php echo e($total_price); ?>

			    	
			    	</h5>
			    	
			    	
			    	</div>
			    	
			    <?php if($r_val['no_of_rooms'] != count($hotel_req['rooms'])  ): ?>
			    <a href="javascript:modal_detail(<?php echo e($loop->index); ?>)" >Cancellation Policy</a>
			    <?php else: ?>
			    	<div class="col-2 l2"><button type="submit" class="btn li-red">Book</button>
			    		<a href="javascript:modal_detail(<?php echo e($loop->index); ?>)" >Cancellation Policy</a>

			    		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#policy_model_<?php echo e($loop->index); ?>">
  Launch demo modal 
</button>

<!-- Modal -->
<div class="modal fade" id="policy_model_<?php echo e($loop->index); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




			    	</div>

			    <?php endif; ?>

			      </li>
			 

			 <?php if($r_val['no_of_rooms'] != count($hotel_req['rooms'])  ): ?>

	 				<?php if($loop->last): ?>
	 					 
						<button type="submit" class="btn li-red">Book</button>
	 					 </form>
	 					
	 				<?php endif; ?>
	 			<?php else: ?>
	 				</form>
	 			<?php endif; ?>

	 			<div class="modal" id="modal<?php echo e($loop->index); ?>"  tabindex="-1">
    <div class="modal-content" id="<?php echo e($loop->index); ?>">
      <h5 class="center-align"><?php echo e($hotel['name']); ?></h5>
        <div class="row">
        	<div>
        <ul class="tabs">
          <li class="tab" style="line-height: 35px; height: 33px;">
            <a id="firstTab" class="active lc" href="#rate<?php echo e($loop->index); ?>">Rate Comment</a>
          </li>
          <li class="tab" style="line-height: 35px; height: 33px;">
            <a href="#cancel<?php echo e($loop->index); ?>" class="lc">Cancellation</a>
          </li>
        
        </ul>
      </div>
      <div id="rate<?php echo e($loop->index); ?>">
      	<?php if(!empty($r_val['rate_comments'])): ?>

      	<?php $__currentLoopData = $r_val['rate_comments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raKey =>$raVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      		<?php echo str_replace("\r\n",'<br/>', $raVal ); ?>

      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      	<?php endif; ?>
      			      	
	</div>
	<div id="cancel<?php echo e($loop->index); ?>">		      	
<?php if(!empty($r_val['cancellation_policy_code'])): ?>
<?php
	$cp = Hotel::get_policy_by_code($other['search_id'], $r_val['rate_key'], $r_val['cancellation_policy_code'],123);
	//dump($cp);
?>
<?php endif; ?>

	<table id="cancel_detail">
		<?php if(!empty($r_val['non_refundable'])&&($r_val['non_refundable']==true)): ?>
		<tr><h6 class=""><span class="orange-text"> &#2547;</span>  This is Non-refundable</h6></tr>
		<?php else: ?>

		
		
		
		<?php if(!empty($r_val['cancellation_policy']["details"][0]["from"])): ?>
		<tr> <h6><span class="orange-text"> &#2547;</span> Cancellation charges starts from
			<?php echo e(\Carbon\Carbon::parse($r_val['cancellation_policy']["details"][0]["from"])->format('d M ,Y H:i:s')); ?>  </h6>
		</tr>
		<?php elseif(!empty($cp['details'][0]['from'])): ?>
		<tr> <h6><span class="orange-text"> &#2547;</span> Cancellation charges starts from
			<?php echo e(\Carbon\Carbon::parse($cp['details'][0]['from'])->format('d M ,Y H:i:s')); ?>

		  </h6></tr>		 
		 <?php endif; ?>
		 <?php if(!empty($r_val['cancellation_policy']['under_cancellation']) && ($r_val['cancellation_policy']["under_cancellation"] == true)): ?>
		<tr> <h6><span class="orange-text"> &#2547;</span> This booking  is under cancellation and you have to pay charges
			  </h6>
		</tr>
		

		<?php elseif(!empty($cp['under_cancellation']) && ($cp['under_cancellation'] == true)): ?>
		<tr> <h6><span class="orange-text"> &#2547;</span> This booking  is under cancellation and you have to pay charges
			  </h6>
		</tr>
		<?php else: ?>
		<tr> <h6><span class="orange-text"> &#2547;</span> This booking  is not under cancellation and you don't have to pay charges from till date.
			  </h6>
		</tr>
		<?php endif; ?>
		 

		 <?php if(!empty($cp['no_show_fee']['flat_fee']) && (!empty($cp['no_show_fee']['currency']))): ?>
			<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges for no show fee will be  <?php echo e($cp['no_show_fee']['currency']); ?> <?php echo e($cp['no_show_fee']['flat_fee']); ?> </h6></tr>

		<?php elseif(!empty($r_val['cancellation_policy']['no_show_fee']['flat_fee']) &&(!empty($r_val['cancellation_policy']['no_show_fee']['currency']))): ?>

		   <tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges for no show fee will be  <?php echo e($r_val['cancellation_policy']['no_show_fee']['currency']); ?>  <?php echo e($r_val['cancellation_policy']['no_show_fee']['flat_fee']); ?> .</h6></tr>			                
		 <?php elseif(!empty($r_val['cancellation_policy']['details'][0]['flat_fee']) &&(!empty($r_val['cancellation_policy']['details'][0]['currency']))): ?>

		   <tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  <?php echo e($r_val['cancellation_policy']['details'][0]['currency']); ?>  <?php echo e($r_val['cancellation_policy']['details'][0]['flat_fee']); ?> .</h6></tr>

		   <?php elseif(!empty($cp['details'][0]['flat_fee']) &&(!empty($cp['details'][0]['currency']))): ?>

		   <tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  <?php echo e($cp['details'][0]['currency']); ?>  <?php echo e($cp['details'][0]['flat_fee']); ?> .</h6></tr>				                  
	   <?php endif; ?>

		<?php if(!empty($cp['cancel_by_date'])): ?>
		<tr> <h6><span class="orange-text"> &#2547;</span> Free cancellation till 			
			<?php echo e(\Carbon\Carbon::parse($cp['cancel_by_date'])->format('d M ,Y H:i:s')); ?>

			</h6></tr>	

		<?php elseif(!empty($r_val['cancellation_policy']['cancel_by_date'])): ?>
		<tr><h6> <span class="orange-text"> &#2547;</span> Free cancellation till 						              
			<?php echo e(\Carbon\Carbon::parse($r_val['cancellation_policy']['cancel_by_date'])->format('d M ,Y H:i:s')); ?>

		</h6></tr>		 
		 <?php endif; ?>
	
	   <?php if(!empty($r_val['cancellation_policy']['no_show_fee']['percent'])): ?>
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges for no show fee will be  <?php echo e($r_val['cancellation_policy']['no_show_fee']['percent']); ?> %</h6></tr>			                
		<?php elseif(!empty($cp['no_show_fee']['percent'])): ?>
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges for no show fee will be  <?php echo e($cp['no_show_fee']['percent']); ?> %</h6></tr>	
		<?php elseif(!empty($r_val['cancellation_policy']['details'][0]['percent'])): ?>
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  <?php echo e($r_val['cancellation_policy']['details'][0]['percent']); ?> %</h6></tr>
		<?php elseif(!empty($cp['details'][0]['percent'])): ?>
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  <?php echo e($cp['details'][0]['percent']); ?> %</h6></tr>				                
		<?php endif; ?>
		<?php endif; ?>
     </table>
			      	
    </div></div>
    
  </div></div>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			    </ul>
	 			</div>
	 			
	 		

	 			</div>
	</div>
</section>
<?php endif; ?>
<script type="text/javascript">
	
	$(document).on('click','.changeimg',function(e){


		var url = $(this).attr('src');

		$(".main-img").attr('src',url);
		console.log(url);

	});
</script>
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('frontend.layout.materialize', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>