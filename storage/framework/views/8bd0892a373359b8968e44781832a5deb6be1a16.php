<!DOCTYPE html>
<html lang="en">
    <!-- Mirrored from www.themeon.net/nifty/v2.9/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Mar 2018 16:38:40 GMT -->
    <?php echo $__env->make('layouts.components.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--TIPS-->
    <!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
    <body>
        <div id="container" class="effect aside-float aside-bright mainnav-lg">
            <?php echo $__env->make('layouts.components.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="boxed">
                
                <?php echo $__env->yieldContent('content'); ?>

                <?php echo $__env->make('layouts.components.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('layouts.components.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            

            <?php echo $__env->make('layouts.components.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- SCROLL PAGE BUTTON -->
            <!--===================================================-->
            <button class="scroll-top btn">
                <i class="pci-chevron chevron-up"></i>
            </button>
            <!--===================================================-->
        </div>
        <?php echo $__env->make('layouts.components.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
    <!-- Mirrored from www.themeon.net/nifty/v2.9/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Mar 2018 16:39:48 GMT -->
</html>