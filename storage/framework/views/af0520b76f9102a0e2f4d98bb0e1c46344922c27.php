<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <title>LeaveCasa - The Best Spot to Make Your Holiday Plans</title>
    <link rel = "icon" type = "image/png" href = "<?php echo e(url('/images/90.png')); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link href="<?php echo e(asset('bootstrap/plugins/font-awesome-4.7.0/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/styles/bootstrap4/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/styles/bootstrap4/bootstrap-grid.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/styles/bootstrap4/bootstrap-datepicker.css')); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/plugins/OwlCarousel2-2.2.1/owl.carousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/plugins/OwlCarousel2-2.2.1/animate.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/styles/main_styles.css')); ?>">
    
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/styles/responsive.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/styles/offers_responsive.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap/styles/jquery-ui.css')); ?>">    
    <script src="<?php echo e(asset('bootstrap/js/jquery-3.2.1.min.js')); ?>"></script>

    <script type="text/javascript">
    var APP_URL = <?php echo json_encode(url('/')); ?>;
    var CURRENT_ROUTE = <?php echo json_encode(request()->route()->getName()); ?>;
    var CSRF_TOKEN = '<?php echo e(csrf_token()); ?>';
    </script>
    
    <script type="text/javascript">
    $(document).ready(function(){
    $('#dropdowner').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false,
        hover: true,
        gutter: 0,
        belowOrigin: true,
        stopPropagation: false
     });    
    });
    </script>
  </head> 

  <body>
    <div class="super_container">
      <?php if(request()->route()->getName() =='index'): ?>
      <?php echo $__env->make('frontend.component.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php else: ?>
      <?php echo $__env->make('frontend.component.headerAfter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endif; ?>
      <?php echo $__env->yieldContent('content'); ?>
      <?php if(!empty($tripType) && ($tripType == 'round')): ?>
      <?php else: ?>
      <?php echo $__env->make('frontend.component.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endif; ?>
    </div>
    <?php echo $__env->make('frontend.component.login_signup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <script src="<?php echo e(asset('bootstrap/js/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/styles/bootstrap4/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/styles/bootstrap4/bootstrap.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" ></script>
    <script src="<?php echo e(asset('bootstrap/styles/bootstrap4/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/plugins/OwlCarousel2-2.2.1/owl.carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/plugins/easing/easing.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/customs.js')); ?>"></script>
    
    <?php echo $__env->yieldContent('script'); ?>
    <?php if(!empty($address)): ?>
    <script src="<?php echo e(asset('materialize/js/country_state_city.js')); ?>"></script>
    <?php endif; ?>
    <?php if(!empty($search)): ?>
    <script src="<?php echo e(asset('materialize/js/search.js')); ?>"></script>
    <?php endif; ?>
    <script src="<?php echo e(asset('materialize/js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('materialize/js/notify.js')); ?>"></script>

    <script type="text/javascript">
      $('form').each(function() {
      this.reset();
      });
    </script>
  </body>
</html>