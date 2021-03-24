$(function(){
    var dateFormat = $('.datePicker').data('format');
    $('.datePicker').datepicker({
        format: dateFormat
    });
    if($('.success').text().trim() != ''){
        var exploded = $('.success').text().trim().split('|');
        $.niftyNoty({
            type: 'success',
            container : 'floating',
            title : exploded[0],
            message : exploded[1],
            closeBtn : true,
            timer : 2500,
        });
    } 
    if($('.danger').text().trim() != ''){
        var exploded = $('.danger').text().trim().split('|');
        $.niftyNoty({
            type: 'danger',
            container : 'floating',
            title : exploded[0],
            message : exploded[1],
            closeBtn : true,
            timer : 10000,
        });
    }
    if($('.info').text().trim() != ''){
        var exploded = $('.info').text().trim().split('|');
        $.niftyNoty({
            type: 'info',
            container : 'floating',
            title : exploded[0],
            message : exploded[1],
            closeBtn : true,
            timer : 2500,
        });
    }

    $('.payment_from').change(function(){
        var payment_status = $(this).is(':checked');
        if(payment_status == true){
            $('.payment_process').attr('action',APP_URL+'/administrator/booking/book/flight/now');
            $('.process_button').html('Book Flight Now');
        }else{
            $('.payment_process').attr('action',APP_URL+'/administrator/booking/process/payment');
            $('.process_button').html('Process Payment');
        }
    });

    try{
        new Switchery(document.getElementById('demo-sw-clr1'), {color:'#489eed'});
        new Switchery(document.getElementById('demo-sw-checked'));
    }catch(e){

    }

    //Ajax Work For Permissions Module

    $('body').on('change','input[name=select_all]', function(){
       if($(this).is(':checked')){
           for(var i = 0; i < Object.keys(switcheryArray).length; i++){
               switcheryArray[i].setPosition(true);
           }
       }else{
           for(var i = 0; i < Object.keys(switcheryArray).length; i++){
               switcheryArray[i].setPosition(true);
           }
       }
    });

    $('.set_permissions').click(function(e){
        $('.permission-actions').hide();
        var elem = $(this);
        if($('select[name=role]').val().trim() == '' || $('select[name=module]').val() == ''){
            $.niftyNoty({
                type: 'danger',
                container : 'floating',
                title : 'Validation Error',
                message : 'Please Select Role and Module First!',
                closeBtn : true,
                timer : 2500,
            });
            return false;
        }
        var role = $('select[name=role]').val();
        var module = $('select[name=module]').val();
        $('.show_hide_loader').show();
        elem.prop('disabled', true);
        $.ajax({
            type: 'GET',
            url: APP_URL+'/administrator/accounts/actions-list',
            data: {role:role,module:module},
            success: function(result){
                $('.permission-actions').html(result);
                $('.permission-actions').show();
                new Switchery(document.getElementById('select_all'));
                var elems = Array.prototype.slice.call(document.querySelectorAll('.switchry'));
                var index = 0;
                window.switcheryArray = {};
                elems.forEach(function(html) {
                    switcheryArray[index] = new Switchery(html);
                    index++;
                });
                $('.show_hide_loader').hide();
                elem.prop('disabled', false);
            }
        });
    });

    //End Here


    $('#add_more_country').click(function(e){
     
     var countryList= JSON.parse($('#cuntryList').val());
     var DurationList=JSON.parse($('#DurationList').val());
     country_data = ' <div id="country_html"><div class="country-group">'+
     '<div style="border:1px solid #7a878e61; padding: 12px;"> <div class="row" >'+
     '<div class="col-md-6"> <div class="form-group">'+
     ' <label class="control-label">Country</label> '+
     '<select class="form-control country" name="countries_id[]" onchange="countryroute(this.value)"><option selected="selected" value="">Choose Country </option>';
     $.each(countryList, function(index,value){        
        country_data += '<option value="'+index+'">'+value+'</option>';
      });
     country_data +='</select></div></div><div class="col-md-6"> '+
     '<div class="form-group"> <label class="control-label">Country Duration</label>'+
     ' <select class="form-control duration" name="duration[]"><option selected="selected" value="">Duration </option>';
     $.each(DurationList, function(i,values){        
        country_data += '<option value="'+i+'">'+values+'</option>';
      });
     country_data +='</select> </div></div></div><div class="city_group"> '+
     '<div class="row city_data" > <div class="col-md-6"> '+
     ' <div class="form-group city_div"> <label class="control-label">City</label>'+
     ' <select class="form-control cities_id" name="cities_id[]"><option selected="selected" value="">Choose City</option></select> '+
     '</div></div><div class="col-md-6"> <div class="form-group"> <label class="control-label"> City Duration </label>'+
     ' <select class="form-control duration" name="duration[]"><option selected="selected" value="">Duration </option>';
     $.each(DurationList, function(Di,Dvalue){        
        country_data += '<option value="'+Di+'">'+Dvalue+'</option>';
      });
     country_data +=' </select> </div></div></div></div><a href="javascript:void(0)" class="add_city"> Add More City</a> </div></div></div>';
      $(".country-group").append(country_data);

    });

     

$('.add_city').click(function(e){
    city_data = $('.city_data').html();
   $(this).siblings('.city_group').append(city_data);
    // $('.city_group').append(city_data);
}); 



    $('#demo-cs-multiselect').chosen({width:'100%'});


    // Flight Search Ajax
    $('.searchFlight').click(function(e){
        $('.search-results').hide();
        var elem = $(this);
        elem.prop('disabled',true);
        e.preventDefault();
        $('.search-spinner, .search-background').show();
        var token = $('input[name=_token]').val();
        var from = $('select[name=from]').val();
        var to = $('select[name=to]').val();
        var adult_count = $('select[name=adult_count]').val();
        var childs_count = $('select[name=childs_count]').val();
        var departure = $('input[name=departure]').val();
        var arrival = $('input[name=arrival]').val();
        $.ajax({
            type:'POST',
            url:APP_URL+'/administrator/apisettings/flight-search-api',
            data: {_token:token,from:from,to:to,adult_count:adult_count,childs_count:childs_count,departure:departure,arrival:arrival},
            success: function(result){
                $('.search-spinner, .search-background').hide();
                $('.search-results').html(result);
                $('.search-results').show();
                elem.prop('disabled',false);
                $(".add-tooltip").tooltip();
                xEditable();
                flightSearchDatatable();
            },error: function(error){
                alert('Error while getting data, please try again!');
                $('.search-spinner, .search-background').hide();
                elem.prop('disabled',false);
                console.log(error);
            }
        });
    });


    $('.reload_list').click(function(){
        // $('.total_amount').html('');
        $.ajax({
            type: 'GET',
            url: APP_URL+'/administrator/booking/customers-list',
            data:{},
            success: function(result){
                $('.customers_list').html('');
                var count = 0;
                $.each(result.pass_list, function(key,value){
                    var content = '';
                    content = `<tr>
                                    <td>`+value.first_name+' '+value.last_name+`</td>
                                    <td>`+value.email+`</td>
                                    <td>`+((value.gender == 1)?'Male':'Female')+`</td>
                                    <td>`+value.contact_number+`</td>
                                    <td>`+value.city+`</td>
                                    <td>
                                        <a href="javascript:;" class="delete_customer" data-index="`+key+`"><i class="fa fa-trash-o"></i></a>
                                    </td>
                               </tr>`;
                    $('.customers_list').append(content);
                    count++;
                });
                /*var single_amount = $('input[name=single_amount]').val();
                $('.total_amount').html('&#8377; '+single_amount*count);*/
            } 
        });
    });

    $('body').on('click','.delete_customer', function(){
        var index = $(this).data('index');
        if(confirm('Are you sure to delete?')){
            $.ajax({
                type: 'GET',
                url: APP_URL+'/administrator/booking/customer/delete/'+index,
                data:{},
                success: function(result){
                    $('.customers_list').html('');
                    var count = 0;
                    $.each(result.pass_list, function(key,value){
                        var content = '';
                        content = `<tr>
                                        <td>`+value.first_name+' '+value.last_name+`</td>
                                        <td>`+value.email+`</td>
                                        <td>`+((value.gender == 1)?'Male':'Female')+`</td>
                                        <td>`+value.contact_number+`</td>
                                        <td>`+value.city+`</td>
                                        <td>
                                            <a href="javascript:;" class="delete_customer" data-index="`+key+`"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                   </tr>`;
                        $('.customers_list').append(content);
                        count++;
                    });
                    var single_amount = $('input[name=single_amount]').val();
                    $('.total_amount').html('&#8377; '+single_amount*count);
                } 
            });
        }
    });



    $('.add_passenger').click(function(){
        var searched_passengers = $('input[name=total_passengers]').val();
        var added_customers = $('.customers_list tr').length;
        if(searched_passengers == added_customers || added_customers > searched_passengers){
            $.niftyNoty({
                type: 'danger',
                container : 'floating',
                title : 'Customers Error',
                message : 'You have added maximum passengers!',
                closeBtn : true,
                timer : 2500,
            });  
            return false;         
        }
        
        $.ajax({
            type: 'GET',
            url: APP_URL+'/administrator/booking/customer-details',
            data: {},
            success: function(result){
                bootbox.dialog({
                    title: "Customer Details",
                    message:result,
                    size: "large",
                    buttons: {
                        success: {
                            label: "Add To List",
                            className: "btn-purple",
                            callback: function() {
                                var data_array = {};
                                var errorStatus = false;
                                $('.customer_details').each(function(){
                                    if($(this).val() == ''){
                                        $(this).parent('div').addClass('has-error');
                                        errorStatus = true;
                                    }else{
                                        data_array[$(this).attr('name')] = $(this).val();
                                    }
                                    if($(this).attr('name') == 'contact_number' && $(this).val().length != 10){
                                        $.niftyNoty({
                                            type: 'danger',
                                            container : 'floating',
                                            title : 'Error',
                                            message : 'Please enter correct mobile number!',
                                            closeBtn : true,
                                            timer : 2500,
                                        });  
                                    }
                                });
                                if(errorStatus == true){
                                    return false;
                                }
                                $.ajax({
                                    type: 'POST',
                                    url: APP_URL+'/administrator/booking/insert-customer',
                                    data:{
                                        _token: CSRF_TOKEN,
                                        data: data_array
                                    },
                                    success: function(result){
                                        $('.customers_list').html('');
                                        var count = 0;
                                        $.each(result.pass_list, function(key,value){
                                            var content = '';
                                            content = `<tr>
                                                            <td>`+value.first_name+' '+value.last_name+`</td>
                                                            <td>`+value.email+`</td>
                                                            <td>`+((value.gender == 1)?'Male':'Female')+`</td>
                                                            <td>`+value.contact_number+`</td>
                                                            <td>`+value.city+`</td>
                                                            <td>
                                                                <a href="javascript:;" class="delete_customer" data-index="`+key+`"><i class="fa fa-trash-o"></i></a>
                                                            </td>
                                                       </tr>`;
                                            $('.customers_list').append(content);
                                        });
                                        /*var single_amount = $('input[name=single_amount]').val();
                                        $('.total_amount').html('&#8377; '+single_amount*count);*/
                                        $.niftyNoty({
                                            type: 'purple',
                                            icon : 'fa fa-check',
                                            message : "Customer added in list",
                                            container : 'floating',
                                            timer : 4000
                                        });
                                        bootbox.hideAll();
                                    } 
                                });
                            }
                        }
                    }
                });
            } 
        });
        
        $(".demo-modal-radio").niftyCheck();
    });

    $('.flght_adult_count').keyup(function(){
        /*var adult_count = $(this).val();
        $('.flight_infant').val(adult_count);*/
    });

    /**
     *   Flight Booking Js
     */

    $('.flight_infant').keyup(function(){
        if($(this).val().trim() == ''){
            $(this).val(0);
        } 
    });

    $('body').on('click','.click_for_flight_details', function(){
        var flight_details = $(this).parent('td').find('flight_details_array').val();
    });

    //Flight search for booking
    $('.searchFlightForBooking').click(function(e){
        $('.search-results').hide();
        var elem = $(this);
        elem.prop('disabled',true);
        e.preventDefault();
        $('.search-spinner, .search-background').show();
        var token = $('input[name=_token]').val();
        var from = $('select[name=from]').val();
        var to = $('select[name=to]').val();
        var adult_count = $('input[name=adult_count]').val();
        var child_count = $('input[name=child_count]').val();
        var infant = $('input[name=infant]').val();
        var direct_flight = $('select[name=direct_flight]').val();
        var journey_type = $('select[name=journey_type]').val();
        var cabin_class = $('select[name=cabin_class]').val();
        var departure_date = $('input[name=departure_date]').val();
        var arrival_date = $('input[name=departure_date]').val();
        var return_date = $('input[name=return_date]').val();
        var markup_included = $('select[name=include_markup]').val();
        $('select').each(function(){
            if($(this).val().trim() == ''){
                var message = 'Please enter '+$(this).attr('name');
                switch($(this).attr('name')){
                    case'from':
                        var message = 'Please Select Source!'
                    break;

                    case'to':
                        var message = 'Please Select Destination!'
                    break;
                }
                $.niftyNoty({
                    type: 'danger',
                    container : 'floating',
                    title : 'Fill Required',
                    message : message,
                    closeBtn : true,
                    timer : 2500,
                });
                return false;
            } 
        });
        if(adult_count == '' || adult_count == 0){
            $.niftyNoty({
                type: 'danger',
                container : 'floating',
                title : 'Fill Required',
                message : 'Eneter correct Adult Count!',
                closeBtn : true,
                timer : 2500,
            });
            elem.prop('disabled',false);
            $('input[name=adult_count]').focus();
            $('.search-spinner, .search-background').hide();
            return false;
        }
        if(infant > adult_count){
            $.niftyNoty({
                type: 'danger',
                container : 'floating',
                title : 'Enter Correct',
                message : 'Eneter correct Infant Count!',
                closeBtn : true,
                timer : 2500,
            });
            elem.prop('disabled',false);
            $('input[name=infant]').focus();
            $('.search-spinner, .search-background').hide();
            return false;
        }
        if($('.datePicker').val() == ''){
            $.niftyNoty({
                type: 'danger',
                container : 'floating',
                title : 'Enter Dates',
                message : 'Eneter correct Dates!',
                closeBtn : true,
                timer : 2500,
            });
            elem.prop('disabled',false);
            $('.search-spinner, .search-background').hide();
            return false;
        }
        $.ajax({
            type:'POST',
            url:APP_URL+'/administrator/booking/search-flight',
            data: {
                    _token:token,
                    from: from,
                    to: to,
                    adult_count: adult_count,
                    child_count: child_count,
                    infant: infant,
                    direct_flight: direct_flight,
                    journey_type: journey_type,
                    cabin_class: cabin_class,
                    departure_date: departure_date,
                    arrival_date: arrival_date,
                    return_date: return_date,
                    markup_included: markup_included
                },
            success: function(result){
                $('.search-spinner, .search-background').hide();
                $('.search-results').html(result);
                $('.search-results').show();
                elem.prop('disabled',false);
                $(".add-tooltip").tooltip();
                xEditable();
                flightSearchDatatable();
            },error: function(error){
                error = JSON.parse(error.responseText);
                if(error.status == false){
                    $.niftyNoty({
                        type: 'danger',
                        container : 'floating',
                        title : 'Flight Error',
                        message : error.message,
                        closeBtn : true,
                        timer : 5000,
                    });
                }
                // alert('Error while getting data, please try again!');
                $('.search-spinner, .search-background').hide();
                elem.prop('disabled',false);
            }
        });
    });


    function flightSearchDatatable(){
        $.fn.dataTableExt.afnFiltering.push(
            function( settings, data, dataIndex ) {
                var min = parseInt( $('#min').val(), 10 );               
                var max = parseInt( $('#max').val(), 10 );
                var price = parseFloat( data[3].replace('₹','') ) || 0; // use data for the age column
                var airline = $('select[name=airlines]').val();
                var airlineData = data[0];
                airlineData = airlineData.split('.')[0];

                if ( ( isNaN( min ) && isNaN( max ) ) || ( isNaN( min ) && price <= max ) || ( min <= price   && isNaN( max ) ) || ( min <= price   && price <= max ) )
                {
                    if( airline === '' || airlineData === airline)
                    {
                        return true;
                    }else{
                        return false;
                    }
                }
                return false;
            }
        );      
        var table = $('.flight-search').DataTable();
      //  alert(table);
        $('body').on('keyup','#min, #max',function() {
            table.draw();
        });

        $('body').on('change','select[name=airlines]', function(){

            table.draw();
        })
    }

    $('#journey_type').change(function(){
        if($(this).val() == '2'){
            $('.return_date').show();
        }else{
            $('.return_date').hide();
        }
    });

    function xEditable(){
        $.fn.editable.defaults.url = "/post";
        /*$.fn.editable.defaults.params = function (params) {
            params._token = $('._token').text();
            return params;
        };*/
        $(".demo-editable-username").editable({
            url: APP_URL+"/administrator/apisettings/set-flight-markup",
            type: "text",
            params: function(params){
                var data = {};
                data['airline'] = $(this).data('airline');
                data['flight_number'] = $(this).data('flightnumber');
                data['airlinecode'] = $(this).data('airlinecode');
                data['from'] = $(this).data('from');
                data['to'] = $(this).data('to');
                data['_token'] = $('._token').text();
                data['value'] = params.value;
                data['type'] = 'rupee';
                return data;
            },
            pk: 1,
            name: "extra_commission",
            title: "Enter extra amount"
        });

        $(".percentage").editable({
            url: APP_URL+"/administrator/apisettings/set-flight-markup",
            type: "text",
            params: function(params){
                var data = {};
                data['airline'] = $(this).data('airline');
                data['flight_number'] = $(this).data('flightnumber');
                data['airlinecode'] = $(this).data('airlinecode');
                data['from'] = $(this).data('from');
                data['to'] = $(this).data('to');
                data['_token'] = $('._token').text();
                data['value'] = params.value;
                data['type'] = 'percent';
                return data;
            },
            pk: 1,
            name: "extra_commission",
            title: "Enter extra percent"
        });
    }
    $('body').on('click', '.setVisibility', function(){
        var visibleStatus = $(this).data('visible');
        var elem = $(this);
        var data = {
            airline: $(this).data('airline'),
            airlinecode: $(this).data('airlinecode'),
            flightnumber: $(this).data('flightnumber'),
            from: $(this).data('from'),
            to: $(this).data('to'),
            visible: $(this).data('visible')
        };

        $.ajax({
            type: 'POST',
            url: APP_URL+'/administrator/apisettings/flight-visibility',
            data: {status: visibleStatus, _token: $('._token').text(),data: data},
            success: function(){
                if(visibleStatus === true){
                    elem.data('visible',false);
                    elem.removeClass('fa-eye').removeClass('green').addClass('fa-eye-slash').addClass('red');
                }else{
                    elem.data('visible',true);
                    elem.removeClass('fa-eye-slash').removeClass('red').addClass('fa-eye').addClass('green');
                }
            }
        });
    }).on('click','.setAmountBy', function(){
        var amountBy = $(this).data('by');
        var elem = $(this);
        var data = {
            airline: $(this).data('airline'),
            airlinecode: $(this).data('airlinecode'),
            flightnumber: $(this).data('flightnumber'),
            from: $(this).data('from'),
            to: $(this).data('to'),
            visible: $(this).data('visible')
        };

        $.ajax({
            type: 'POST',
            url: APP_URL+'/administrator/apisettings/set-amount-by',
            data:{amount_by:amountBy, _token:$('._token').text(),data:data},
            success: function(result){
                if(amountBy === 'percent'){
                    elem.data('by','rupee');
                    elem.removeClass('fa-percent').addClass('fa-rupee');
                }else{
                    elem.data('by','percent');
                    elem.removeClass('fa-rupee').addClass('fa-percent');
                }
            }
        });
    }).on('click','input[name=clear_filter]','click', function(){
        $('#min,#max,select[name=airlines]').val('');
        $('select[name=airlines]').change();
    });

    $('body').on('click','.second_journey_type tr', function(){
        $(this).parents('.booking_tables').find('tr').each(function(){
            $(this).find('td').css('border-left','none');
        });
        $(this).find('td:first').css('border-left','5px solid green');
        var trace = $(this).data('trace');
        var flight_data = JSON.stringify($(this).data('flight_data'));
        var amount = $(this).data('amount');
        $(this).parents('.booking_tables').find('.traceid').val(trace);
        $(this).parents('.booking_tables').find('.flight_details').val(flight_data);
        $(this).parents('.booking_tables').find('.total_amount').val(amount);
    });


    //Hotel Booking JS
    if(CURRENT_ROUTE === 'hotel.markups'){
        $('.search-spinner, .search-background').show();
        $.ajax({
            type:'GET',
            url: APP_URL+'/administrator/apisettings/countries-list',
            data: {},
            success: function(result){
                var countries = JSON.parse(result);
                var options = '<option value="">Select Country</option>';
                $.each(countries.countries, function(key,value){
                    options += '<option value="'+value.code+'|'+value.name+'" data-code3="'+value.code3+'">'+value.name+'</option>';
                });
                $('.country-list').html(options);
                $('.search-spinner, .search-background').hide();
            }
        });

        $('.country-list').change(function(){
            var elem = $(this);
            $('.search-spinner, .search-background').show();
            $('.load_text').text('Getting cities list..');
            $.ajax({
                type:'GET',
                url: APP_URL+'/administrator/apisettings/cities-list/',
                data:{country_code:elem.val()},
                success: function(result){
                    var cities = JSON.parse(result);
                    var options = '<option value="">Select City</option>';
                    $.each(cities.cities, function(key,value){
                        options += '<option value="'+value.code+'|'+value.name+'" >'+value.name+'</option>';
                    });
                    $('.cities-list').html(options);
                    $('.search-spinner, .search-background').hide();
                }
            });
        });
    }
      

        $('.busSource').change(function(){
          // var code= $('#bus_dep').val();
          
            var elem = $(this);
            $('.search-spinner, .search-background').show();
            $('.load_text').text('Getting Destination list..');
            $.ajax({
                type:'GET',
                url: APP_URL+'/administrator/apisettings/bus_destination/',
                data:{source:elem.val()},
                success: function(result){
                   //var cities = JSON.stringify(result);

                console.log(result.cities.length);
                   var options = '<option value="">Select City</option>';
                    if(result.cities.length >0){
                      $.each(result.cities, function(key,value){                   
                        options += '<option value="'+value.id+'" >'+value.name+'</option>';                    
                    });       

                    }
                   else{  
                   options+= '<option value="'+result.cities.id+'" >'+result.cities.name+'</option>';
               }

                    $('.busDestination').html(options);
                    $('.search-spinner, .search-background').hide();
                }
            });
        });
});

 $(document).ready(function(){
          function countryroute(country_id){
        var city_route = $('#city_route').val();
        alert(city_route);
        $.get(city_route+'/'+country_id, function(datas, status){
            $(".city_div").html(datas);
        });
     };
        });