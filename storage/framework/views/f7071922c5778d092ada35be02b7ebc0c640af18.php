<link rel="stylesheet" type="text/css" href="<?php echo e(asset(env('FPATH').'bootstrap/styles/style.css')); ?>">
<?php $__env->startSection('content'); ?>
<?php
use App\Helpers\Hotel;
//dump(json_encode(Session::get('hotel_req')));
// dd($results);
?>
<style type="text/css">
  .left-header{
    display: inline;
    width: 100%;
    text-align: left;
  }

  .icon-set{
    position: relative;
    top: 3px;
    font-size: 18px;
}
  }
</style>
<?php if($no_of_hotels!=0): ?> 
<div class="home1">
  <div class="home_slider_container1">
    <div class="owl-carousel owl-theme home_slider1">
      <div class="owl-item home_slider_item1">
        <div class="home_slider_background1" style="background-image:url(../images/bg.jpg)"></div>
        <div class="home_slider_content1 text-center">
          <div class="home_slider_content_inner1" data-animation-in="flipInX" data-animation-out="animate-out fadeOut">
            <h1><?php echo e($no_of_hotels); ?>  Hotel Found</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="section" id="content">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h4 class="search-results-title text-black"><i class="soap-icon-search"></i><b><?php echo e($no_of_hotels); ?> </b> results found.</h4>
          <div class="toggle-container filters-container">
            <div class="panel style1 arrow-right">
              <h4 class="panel-title">
              <a data-toggle="collapse" href="#price-filter" class="collapsed dark-blue-color">Price</a>
              </h4>
              <div id="price-filter" class="panel-collapse collapse">
                <div class="panel-content">
                  <div id="price-range"></div>
                  <br />
                  <span class="min-price-label pull-left"></span>
                  <span class="max-price-label pull-right"></span>
                  <div class="clearer"></div>
                  </div>
                </div>
              </div>
              
              <div class="panel style1 arrow-right">
                <h4 class="panel-title">
                <a data-toggle="collapse" href="#rating-filter" class="collapsed dark-blue-color">Rating</a>
                </h4>
                <div id="rating-filter" class="panel-collapse collapse dark-blue-color">
                  <div class="panel-content">
                 <form  action="<?php echo e(route('hotels.results')); ?>" method="post" >
                <?php echo e(csrf_field()); ?>   
                <?php $__currentLoopData = Session::get('orginal_request'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $okey => $oval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($okey =='_token'): ?>
                  <?php continue; ?>
                <?php endif; ?>

                <?php if(is_array($oval)): ?>
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
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck5" name="stars" class="stars" value="5" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck5"><img src="<?php echo e(url('images/star/star_rating_5.png')); ?>" alt="1 Star"> 5 Star</label>
                 </div>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck4" name="stars" class="stars" value="4" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck4"><img src="<?php echo e(url('images/star/star_rating_4.png')); ?>" alt="1 Star"> 4 Star</label>
                 </div>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck3" name="stars" class="stars" value="3" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck3"><img src="<?php echo e(url('images/star/star_rating_3.png')); ?>" alt="1 Star"> 3 Star</label>
                 </div>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck2" name="stars" class="stars" value="2" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck2"><img src="<?php echo e(url('images/star/star_rating_2.png')); ?>" alt="1 Star"> 2 Star</label>
                 </div>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="stars" class="stars" value="1" onclick="getCheckedBoxes()">
                    <label class="custom-control-label" for="customCheck1"><img src="<?php echo e(url('images/star/star_rating_1.png')); ?>" alt="1 Star"> 1 Star</label>
                 </div>
                </form>
                  </div>
                </div>
              </div>
              
              
              <div class="panel style1 arrow-right">
                <h4 class="panel-title">
                <a data-toggle="collapse" href="#modify-search-panel" class="collapsed dark-blue-color">Modify Search</a>
                </h4>
                <div id="modify-search-panel" class="panel-collapse collapse dark-blue-color">
                  <div class="panel-content">
                    <form method="post">
                      <div class="form-group">
                        <label>destination</label>
                        <input type="text" class="input-text full-width" placeholder="" value="" />
                      </div>
                      <div class="form-group">
                        <label>check in</label>
                        <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                      </div>
                      <div class="form-group">
                        <label>check out</label>
                          <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                      </div>
                      <button class="button search_button mt-0">search<span></span><span></span><span></span></button>
                      
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9 ">
          <div class="sort-by-section clearfix">
            <h4 class="sort-by-title block-sm text-black">Sort results by:</h4>
            <ul class="sort-bar clearfix block-sm ">
              <li class="sort-by-name"><a class="sort-by-container text-black" href="javascript:void(0)"><span>name</span></a></li>
              <li class="sort-by-price"><a class="sort-by-container text-black" href="javascript:void(0)"><span>price</span></a></li>
              <li class="clearer visible-sms"></li>
              <li class="sort-by-rating active"><a class="sort-by-container text-black" href="javascript:void(0)"><span>rating</span></a></li>
            </ul>
          </div>
                <div class="hotel-list">
        <div class="row image-box listing-style2 ">
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
        
        <?php $__currentLoopData = $catVal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php

         // dump($hotel);
          $mark_price =0;
          if(!empty($hotel['category']))
          {
            $hotel_cat = explode('.', $hotel['category']);
            $mark_data =  $mark_up->where('star_ratting',$hotel_cat[0])->toArray();
            if(!empty($mark_data)){
              foreach ($mark_data   as $key => $value) 
              {
                if($value['amount_by'] =="rupee"){
                    $mark_price =  $value['amount'];
                 }
                 elseif($value['amount_by'] =="percent"){
                    $mark_price = Hotel::cal_markup_percent_val($hotel['min_rate']['price'], $value['amount']);  
                 }
              }
            }
           $dull = 5 - $hotel['category'];
          }
        $hotel_total_price =  $hotel['min_rate']['price'] + $mark_price;
      ?> 

    <div class="col-sm-6 col-md-4 mb-3">
      <div class="card">

             <?php if(!empty($hotel['images']['url'])): ?>
          <img class="card-img-top" src="<?php echo e($hotel['images']['url']); ?>" style="height:200px" onerror="this.src='<?php echo e(asset('images/demo_hotel.jpg')); ?>';">
          <?php else: ?>
          <img class="card-img-top" src="<?php echo e(asset('images/demo_hotel.jpg')); ?>" style="height:200px">
          <?php endif; ?>
          <div class="card-body p-1" >
            
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
      <?php endfor; ?></span>
      <?php if(!empty($hotel['min_rate']['non_refundable']) &&($hotel['min_rate']['non_refundable']==true)): ?>
          <span class=" text-danger float-right text-right mr-2 fs20">
              Non Refundable
          </span>
      <?php endif; ?>
      <?php endif; ?>
      <p>
     <h4 class="with-icon dark-blue-color"><i class="material-icons left mt-1 red-color">location_on</i>
          <?php echo e(Illuminate\Support\Str::limit($hotel['name'], 22, '...')); ?></h4>
        <h4 class="dark-blue-color"><i class="material-icons left mt-1 green-color">account_balance_wallet</i>
        ₹ <?php echo e($hotel_total_price); ?> 

        <a class="ml-2 text-success" type="button" style="cursor: pointer;" data-toggle="modal" data-target="#<?php echo e($hotel['hotel_code']); ?>">Facilities </a>

      </h4> 
       </p>   
          <div class="action">
           <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="<?php echo e($hotel['hotel_code']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo e($hotel['hotel_code']); ?>">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4   class="modal-title left-header" id="myModalLabel<?php echo e($hotel['hotel_code']); ?>">Facilities</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        
      </div>
      <div class="modal-body">

      <?php if(!empty($hotel['facilities'])): ?>
        <div class="row">
       <?php $__currentLoopData = explode(';', $hotel['facilities']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
           <div class="col-3 mb-2">
            <i class="material-icons left mt-1 icon-set ">verified_user</i><?php echo e($info); ?>

          </div>

        
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    

    <?php endif; ?>
        
      </div>
      
    </div>
  </div>
</div>

            <a class="button btn-small mdb " href="<?php echo e(route('hotel.detail',['sid'=>$h_val['search_id'], 'code'=>$hotel['hotel_code']])); ?>">SELECT</a>
          </div>
        </div>
    </div></div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
     </div>
      </div>
    </div>
  </div>
  </section>
  <?php else: ?>
  <?php echo $__env->make('frontend.component.sliderother', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php endif; ?>
  <?php $__env->stopSection(); ?>
  <?php $__env->startSection('script'); ?>
  <script type="text/javascript">
        $(document).ready(function() {
            $("#price-range").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [ 100, 800 ],
                slide: function( event, ui ) {
                    $(".min-price-label").html( "$" + ui.values[ 0 ]);
                    $(".max-price-label").html( "$" + ui.values[ 1 ]);
                }
            });
            $(".min-price-label").html( "$" + $("#price-range").slider( "values", 0 ));
            $(".max-price-label").html( "$" + $("#price-range").slider( "values", 1 ));
            
            $("#rating").slider({
                range: "min",
                value: 40,
                min: 0,
                max: 50,
                slide: function( event, ui ) {
                    
                }
            });
        });
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.materialize', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>