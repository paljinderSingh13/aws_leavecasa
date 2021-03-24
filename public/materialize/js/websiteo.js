var $ = jQuery;
$(function(){
   $('.search_flight').click(function(e){
        e.preventDefault();
        var trip_type = $('input[name=trip_type]:checked').val();
        if(trip_type == 'round'){
            console.log($('input[name=returning]').val());
            if($('input[name=returning]').val().trim() == ''){
                $.notify("Return date required on round trip!", "error");
                return false;
            }
            $('#flight_search').submit();
        }

        if(trip_type == 'one_way'){
            $('#flight_search').submit();
        }
        if(trip_type == 'multi_city'){
            var errorStatus = false;
            $('.multi_city_div input').each(function(){
                if($(this).val() == ''){
                    errorStatus = true;
                } 
            });
            if(errorStatus == true){
                $.notify("All fileds are required", "error");
                return false;
            }
            $('#flight_search_multi').submit();
        }
   });


   $('.show_flight_details').click(function(){
        $(this).parents('.single_flight_details').find('.fl_details').fadeToggle(200);
   });

   $('.add_more_flight').click(function(){
        if($('.multi_city').length <= 6){
            var clonedDiv = $(this).parents('.multi_city').clone();
            $('.appended_row').append(clonedDiv);
            $('.add_more_flight:last').removeClass('add_more_flight btn-primary').addClass('btn-danger remove_div').find('i').removeClass('fa-plus').addClass('fa-minus');
            $('.multi_city:last').find('input').val('');
            $('.multi_city:last').find('.datepicker-wrap').html('<input class="input-text full-width" placeholder="mm/dd/yy" autocomplete="off" name="depart[]" type="text">');
            datePicker();
            runTypehead();
        }
   });

   $('body').on('click','.remove_div', function(){
        $(this).parent('div').parent('.multi_city').remove();
   });

   $('body').on('click','.seat_details',function(){
    
        window.selectedSeats = {};
        window.price = 0
        var elem = $(this);
        var boardingPoints = $(this).data('boarding-points');
        var dropingTimes = $(this).data('droping-points');
        var source = $(this).data('source');
        var destination = $(this).data('destination');
        var record = $(this).data('record');
        $(this).prop('disabled',true).text('Loading...');
        var busId = $(this).data('id');
        $.ajax({
            type:'GET',
            url: APP_URL+'/bus/seat/details/'+busId,
            data:{
                boarding_points: boardingPoints,
                droping_time: dropingTimes,
                source: source,
                destination: destination,
                record: record
            },
            success: function(result){
                $('.modal_content').html(result);
                $('#demo-default-modal').modal().modal('open');
                elem.prop('disabled',false).text('Book Now');
                $('.add-tooltip').tooltip();
            } 
        });
    });

   $('#hotel_country').change(function(){
   		$('.full-screen-loader').fadeIn(200);
   		$.ajax({
   			type:'GET',
   			url:APP_URL+'/hotel/cities/',
   			data: {
   				country: $(this).val()
   			},
   			success: function(result){
   				var html = '<option value="">Select city</option>';
   				$.each(result.cities, function(key,value){
   					html += '<option value="'+key+'">'+value+'</option>';
   				});
   				var dest = '<option value="">Select destination</option>';
   				$.each(result.destinations, function(key,value){
   					dest += '<option value="'+key+'">'+value+'</option>';
   				});
   				$('#cities').html(html);
   				$('#destinations').html(dest);
   				$('.full-screen-loader').fadeOut(200);
   			}
   		});
   });
   $('.add-more-rooms').click(function(){
   		var cloneDiv = $('.rooms-details:first').clone();
   		$('.rooms-list').append(cloneDiv);
   });

  // 

});