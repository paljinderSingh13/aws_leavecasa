<?php $__env->startSection('content'); ?>
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            <div class="pad-all text-center">
                <h3>Welcome back to the Dashboard.</h3>
                <p1>
                Scroll down to see quick links and overviews of your Server, To do list, Order status or get some Help using Nifty.</p>
            </div>
        </div>
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-warning panel-colorful media middle pad-all">
                        <div class="media-left">
                            <div class="pad-hor">
                                <i class="demo-pli-file-word icon-3x"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-semibold">0</p>
                            <p class="mar-no">Flights Booked</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-info panel-colorful media middle pad-all">
                        <div class="media-left">
                            <div class="pad-hor">
                                <i class="demo-pli-file-zip icon-3x"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-semibold">0</p>
                            <p class="mar-no">Buses Booked</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-mint panel-colorful media middle pad-all">
                        <div class="media-left">
                            <div class="pad-hor">
                                <i class="demo-pli-camera-2 icon-3x"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-semibold">0</p>
                            <p class="mar-no">Hotels Booked</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-danger panel-colorful media middle pad-all">
                        <div class="media-left">
                            <div class="pad-hor">
                                <i class="demo-pli-video icon-3x"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-semibold">0</p>
                            <p class="mar-no">White Lists</p>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        <!--===================================================-->
        <!--End page content-->
    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>