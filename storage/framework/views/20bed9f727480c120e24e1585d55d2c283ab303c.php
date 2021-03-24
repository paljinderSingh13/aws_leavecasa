<!--===================================================-->
<!-- END OF CONTAINER -->
<!--JAVASCRIPT-->
<!--=================================================-->
<!--jQuery [ REQUIRED ]-->
<script src="<?php echo e(asset(env('FPATH').'/v2.9/js/jquery.min.js')); ?>"></script>
<!--BootstrapJS [ RECOMMENDED ]-->
<script src="<?php echo e(asset(env('FPATH').'/v2.9/js/bootstrap.min.js')); ?>"></script>
<!--NiftyJS [ RECOMMENDED ]-->
<script src="<?php echo e(asset(env('FPATH').'/v2.9/js/nifty.min.js')); ?>"></script>
<!--=================================================-->
<!--Demo script [ DEMONSTRATION ]-->
<!--Flot Chart [ OPTIONAL ]-->
<script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/flot-charts/jquery.flot.min.js')); ?>"></script>
<script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/flot-charts/jquery.flot.resize.min.js')); ?>"></script>
<script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/flot-charts/jquery.flot.tooltip.min.js')); ?>"></script>
<!--Sparkline [ OPTIONAL ]-->
<script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>

<!--DataTables [ OPTIONAL ]-->
<script type="text/javascript" src="<?php echo e(asset(env('FPATH').'js/datatable/datatables.all.min.js')); ?>"></script>



<!--Specify page [ SAMPLE ]-->



<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/switchery/switchery.min.js')); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/chosen/chosen.jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'vendor/datatables/buttons.server-side.js')); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/x-editable/inputs-ext/mockjax/jquery.mockjax.js' )); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/momentjs/moment.min.js' )); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/x-editable/js/bootstrap-editable.min.js' )); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js' )); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/x-editable/inputs-ext/typeaheadjs/typeaheadjs.js' )); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/x-editable/inputs-ext/address/address.js' )); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/js/demo/x-editable-data.js')); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/bootbox/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset(env('FPATH').'/v2.9/plugins/select2/js/select2.min.js')); ?>"></script>
<?php echo $__env->yieldSection(); ?>
<div class="success" style="display: none;"><?php echo e(Session::get('success')); ?></div>
<div class="danger" style="display: none;"><?php echo e(Session::get('error')); ?></div>
<div class="info" style="display: none;"><?php echo e(Session::get('info')); ?></div>
<script src="<?php echo e(asset(env('FPATH').'js/custom.js?ref='.rand(10,100000))); ?>"></script>
<script type="text/javascript">
    $('#demo-dp-txtinput input').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    function countryroute(country_id){
        var city_route = $('#city_route').val();
        $.get(city_route+'/'+country_id, function(datas, status){
            $(".city_div").html(datas);
        });
     };
</script>
<style type="text/css">
    .datepicker {
        z-index: 99999 !important;
    }
</style>

<?php if(@$dataTable != null): ?>
    <?php echo @$dataTable->scripts(); ?>

<?php endif; ?>