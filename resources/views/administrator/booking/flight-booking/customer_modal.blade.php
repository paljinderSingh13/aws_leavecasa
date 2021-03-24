<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="adult_count">Mr/Ms.</label>
            {!! Form::select('title',['Mr'=>'Mr','Ms'=>'Ms'],null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">First Name</label>
            {!! Form::text('first_name',null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Last Name</label>
            {!! Form::text('last_name',null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Email</label>
            {!! Form::text('email',null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Address Line</label>
            {!! Form::textarea('address_line',null,['class'=>'form-control customer_details','id'=>'adult_count','rows'=>5]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="adult_count">Date of Birth</label>
            {!! Form::text('date_of_birth',null,['class'=>'form-control customer_details datePicker','id'=>'adult_count','data-format'=>'yyyy-mm-dd']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Gender</label>
            {!! Form::select('gender',['1'=>'Male','2'=>'Female'],null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Passport No</label>
            {!! Form::text('passport_no',null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Passport Expiry</label>
            {!! Form::text('passport_expiry',null,['class'=>'form-control customer_details datePicker','id'=>'adult_count','data-format'=>'yyyy-mm-dd']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Contact No</label>
            {!! Form::text('contact_number',null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Is Lead Pax?</label>
            {!! Form::select('isleadpax',['true'=>'True','false'=>'False'],null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="adult_count">City</label>
            {!! Form::text('city',null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Country</label>
            {!! Form::text('country',null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
        <div class="form-group">
            <label for="adult_count">Nationality</label>
            {!! Form::text('nationality',null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
        </div>
    </div>
</div>
<script type="text/javascript">
    var dateFormat = $('.datePicker').data('format');
    $('.datePicker').datepicker({
        format: dateFormat
    });
</script>