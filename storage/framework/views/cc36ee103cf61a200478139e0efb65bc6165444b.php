<?php $__env->startSection('content'); ?>
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">Add Packages</h1>
            </div>

            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">Add Package</li>
            </ol>

        </div>

        <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <!-- Toolbar -->
            <input type="hidden" id="cuntryList" value="<?php echo e($country); ?>">
            <input type="hidden" id="DurationList" value="<?php echo e($duration); ?>">
            <!--===================================================-->
            <?php echo Form::open(['route'=>'package.store']); ?>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Package</h3>
                    </div>
                    <div class="panel-body">
                <input type="hidden" value="<?php echo e(route("country.city")); ?>" id="city_route">
                        <!-- Inline Form  -->
                        <!--===================================================-->
                        <form class="form-inline">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Title of Package</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Total Duration</label>
                                         <?php echo Form::select('duration[]',$duration,null,['placeholder'=>'Duration ', 'class'=>'form-control duration']); ?>                                       
                                    </div>
                                </div>
                            </div>

                    <div class="country-group"> 
                        <div  style="border:1px solid #7a878e61; padding: 12px;">  
                            <div  class="row" >                               
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                       <?php echo Form::select('countries_id[]',$country,null,['placeholder'=>'Choose Country', 'class'=>'form-control country' ,'onchange'=>'countryroute(this.value)']); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Country Duration</label>
                                         <?php echo Form::select('duration[]',$duration,null,['placeholder'=>'Duration ', 'class'=>'form-control duration']); ?>

                                    </div>
                                </div>

                            </div>

                        <div class="city_group">
                             <div class="row city_data" >                               
                               <div class="col-md-6">
                                    <div class="form-group city_div">
                                        <label class="control-label">City</label>
                                        <?php echo Form::select('cities[]',[],null,['placeholder'=>'', 'class'=>'form-control cities']); ?>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> City Duration </label>
                                         <?php echo Form::select('duration[]',$duration,null,['placeholder'=>'Duration ', 'class'=>'form-control duration']); ?>

                                    </div>
                                </div>
                            </div>                           
                            </div>
                            <a href="javascript:void(0)" class="add_city"> Add More City</a>
                        </div>
                    </div>
                         <div class="row">
                                <div class="col-md-3">
                                    <a id="add_more_country" href="javascript:void(0)"> + ADD More Country</a>
                                </div>
                        </div>

                            <div class="row">
                                
                                <div class="col-md-3" style="padding-top: 2%;">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Add Packages</button>
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
            
        </div>
        <!--===================================================-->
        <!--End page content-->
    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
    
  <?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript">
       
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>