<?php $__env->startSection('content'); ?>

    <!--CONTENT CONTAINER-->

    <!--===================================================-->

    <div id="content-container">

        <div id="page-head">

            

            <!--Page Title-->

            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

            <div id="page-title">

                <h1 class="page-header text-overflow">Add Agency</h1>

            </div>

            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

            <!--End page title-->





            <!--Breadcrumb-->

            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

            <ol class="breadcrumb">

            <li><a href="#"><i class="demo-pli-home"></i></a></li>

            <li><a href="#">Home</a></li>

            <li class="active">Add Agency</li>

            </ol>

            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

            <!--End breadcrumb-->



        </div>



        

        <!--Page content-->

        <!--===================================================-->

        <div id="page-content">

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>


            <!-- Toolbar -->

            <!--===================================================-->

            <?php echo Form::open(['route'=>'admin.agency.registration' , 'enctype'=>'multipart/form-data']); ?>


                <div class="panel">

                    <div class="panel-heading">

                        <h3 class="panel-title">Add Agency</h3>

                    </div>

                    <div class="panel-body">

                

                        <!-- Inline Form  -->

                        <!--===================================================-->

                        <form class="form-inline">

                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Name</label>

                                        <input type="text" class="form-control" name="name">

                                    </div>

                                </div>



                                 <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Image</label>

                                        <input type="file" class="form-control" name="image">

                                    </div>

                                </div>



                               

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Address</label>

                                        <input type="text" class="form-control" name="address">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">State</label>

                                        <input type="text" class="form-control" name="state">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">City</label>

                                        <input type="text" class="form-control" name="city">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Contact</label>

                                        <input type="text" class="form-control" name="contact_no">

                                    </div>

                                </div>

                                 <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Sub Domain</label>

                                        <input type="text" class="form-control" name="sub_domain">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Email</label>

                                        <input type="text" class="form-control" name="email">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Password</label>

                                        <input type="text" class="form-control" name="password">

                                    </div>

                                </div>

                                <div class="col-md-3" style="padding-top: 2%;">

                                    <div class="form-group">

                                        <button class="btn btn-primary" type="submit">Add Agency</button>

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

    

    

    <div class="modal_content">

        

    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>