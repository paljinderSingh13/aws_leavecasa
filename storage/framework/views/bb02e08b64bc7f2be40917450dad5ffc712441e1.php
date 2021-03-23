<?php $__env->startSection('content'); ?>

    <!--CONTENT CONTAINER-->

    <!--===================================================-->
<div id="content-container">
  <div id="page-head">
  </div>
    <div id="page-content">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Agency List</h3>
                        </div>
                        <div class="panel-body">
                            <table id="demo-agency" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th class="min-tablet">Name</th>
                                        <th class="min-tablet">Subdomain</th>
                                        <th class="min-desktop">Email</th>
                                        <th class="min-desktop">Status</th>
                                        <th class="min-desktop">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <?php echo e($loop->iteration); ?> </td>
                                        <td><?php echo e(ucfirst($val->name)); ?></td>
                                        <td><?php echo e(ucfirst($val->sub_domain)); ?></td>
                                        <td><?php echo e($val->email); ?></td>
                                        <td> <?php echo e(($val->status==1?'Activate':'Deactivate')); ?> </td>
                                        <td><div class="btn-group">
                                        <a class="add-tooltip" href="<?php echo e(route('admin.agency.edit',['id'=>$val->id])); ?>" data-original-title="Edit" data-container="body"><i class="fa fa-pencil  green"></i></a>
                                        <a class="add-tooltip" href="<?php echo e(route('admin.agency.delete',['id'=>$val->id])); ?>" data-original-title="Delete" data-container="body"><i class="fa fa-trash red"></i></a>
                                        <a class=" add-tooltip" href="<?php echo e(route('admin.agency.status',['id'=>$val->id, 'status'=>$val->status])); ?>" data-original-title="Click to <?php echo e(($val->status==1?'Ban Agency':'Activate Agency')); ?>" data-container="body"><i class="fa fa-lock <?php echo e(($val->status==1?'green':'red')); ?> "></i></a>
                                        </div></td>
                                    </tr>                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
           $('#demo-agency').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>