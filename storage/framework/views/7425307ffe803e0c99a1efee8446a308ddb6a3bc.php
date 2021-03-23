<?php $__env->startSection('content'); ?>

    <!--CONTENT CONTAINER-->

    <!--===================================================-->
<div id="content-container">
  <div id="page-head">
  </div>
    <div id="page-content">





                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Agency Markup</h3>
                        </div>
                        <div class="panel-body">

                        <div style="display: none;" class="edit">       
                            <?php echo Form::open(['route'=>'admin.agency.markstore' , 'enctype'=>'multipart/form-data']); ?>


                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label"> Hotel Markup</label>

                                        <input type="text" class="form-control" name="markup_hotel" value="<?php echo e($data->markup_hotel); ?>">

                                    </div>

                                </div>



                                 <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Flight Markup</label>

                                        <input type="text" class="form-control" name="markup_flight" value="<?php echo e($data->markup_flight); ?>">

                                    </div>

                                </div>



                               

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Bus Markup</label>

                                        <input type="text" class="form-control" name="markup_bus" value="<?php echo e($data->markup_bus); ?>">

                                    </div>

                                </div>

                               

                               

                                <div class="col-md-3" style="padding-top: 2%;">

                                    <div class="form-group">

                                        <button class="btn btn-primary" type="submit">Edit Markup</button>

                                    </div>

                                </div>

                               

                            </div>

                        </form>
                    </div>



                            <table id="agency-markup" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th class="min-tablet">Hotel Markup</th>
                                        <th class="min-tablet">Flight Markup</th>
                                        <th class="min-desktop">Bus Markup</th>
                                        
                                        <th class="min-desktop">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td><?php echo e($data->id); ?></td>
                                        <td><?php echo e($data->markup_hotel); ?></td>
                                        <td><?php echo e($data->markup_flight); ?></td>
                                        <td><?php echo e($data->markup_bus); ?></td>
                                        
                                        <td><div class="btn-group">
                                        <a class="add-tooltip" onclick="$('.edit').toggle(); return false;" data-original-title="Edit" data-container="body"><i class="fa fa-pencil  green"></i></a>

                                        
                                        
                                        
                                        </div></td>
                                    </tr>                                    
                                  
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     
                    
</div>

           
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript">
        $(document).ready(function(){
           $('#agency-markup').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>