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
                
                <div class="panel">
                    <div class="panel-body">
                        <h3>Create Your Markup</h3>
                        <p>Create your busses markups according to your route or all routes.</p>
                        <form action="<?php echo e(route('save.bus-markups')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Source</label>
                                                <?php echo Form::select('source',$sources,null,['class'=>'form-control busSource','placeholder'=>'Select Source']); ?>

                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Destination</label>
                                                <?php echo Form::select('destination',[],null,['class'=>'form-control busDestination','placeholder'=>'Select Destination']); ?>

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Amount By</label>
                                                <select name="amount_by" class="form-control">
                                                    <option value="percent">Percent</option>
                                                    <option value="rupee">Rupee</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Amount Or Percent</label>
                                                <input type="text" name="amount_or_percent" value=""
                                                        placeholder="Amount Or Percent" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit" style="margin-top: 8.5%;">Save Markup</button>
                                    </div>
                                </div>
                            </div>
                        </form>

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


                        <?php if(@$results['Response']['ResponseStatus'] == 3): ?>
                            <span style="color: red"><?php echo e($results['Response']['Error']['ErrorMessage']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                        

                  <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Your Current Busses Markups</h3>
                        </div>
                        <div class="panel-body">
                            <table id="bus-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Source</th>
                                        <th class="min-tablet">Destination</th>
                                        <th class="min-tablet">Amount By</th>
                                        <th class="min-desktop">Amount Or Percent</th>
                                        <th class="min-desktop">Created At</th>
                                        <th class="min-desktop">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($result)): ?>
                                    <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($sources[$val->source]); ?> </td>
                                        <td> <?php if(!empty($val->des)): ?>
                                             <?php echo e($val->des->city_name); ?>


                                             <?php else: ?>
                                                 <?php echo e($val->destination); ?>

                                             <?php endif; ?>
                                         </td>
                                        <td><?php echo e($val->amount_by); ?></td>
                                        <td><?php echo e($val->amount_or_percent); ?></td>
                                      
                                        <td> <?php echo e($val->created_at); ?> </td>
                                        <td><div class="btn-group">
                                        <a class="add-tooltip" href="<?php echo e(route('delete.bus_markup',['id'=>$val->id])); ?>" data-original-title="Delete" data-container="body"><i class="fa fa-trash red"></i></a>
                                        </div></td>
                                    </tr>                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                   </tbody>
                                </table>
                            </div>
                        </div>


                   
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
     $(document).ready(function(){
            $('select[name=source]').select2();
            $('select[name=destination]').select2();
            $('#bus-list').DataTable();
        });
     </script>
     <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>