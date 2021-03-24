<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset(env('FPATH').'bootstrap/styles/style.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset(env('FPATH').'v2.9/css/nifty.min.css')); ?>">
<?php
use Illuminate\Support\Str;
$sess=Session::get('search_request');
?>
<?php if(!Auth::guard('customer')->check()): ?>
 <?php echo $__env->make('frontend.pages.register-login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.materialize', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>