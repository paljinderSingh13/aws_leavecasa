$(function(){
    // $('.bus_details').dataTable();
    $('body').on('click','.seat_details',function(){
        window.selectedSeats = {};
        window.price = 0
        var elem = $(this);
        var boardingPoints = $(this).data('boarding-points');
        alert(boardingPoints);
        var dropingTimes = $(this).data('droping-points');
        var source = $(this).data('source');
        var destination = $(this).data('destination');
        $(this).prop('disabled',true).text('Loading...');
        var busId = $(this).data('id');
        $.ajax({
            type:'GET',
            url: APP_URL+'/administrator/booking/bus/seat/details/'+busId,
            data:{
                boarding_points: boardingPoints,
                droping_time: dropingTimes,
                source: source,
                destination: destination
            },
            success: function(result){
                $('.modal_content').html(result);
                $('#demo-default-modal').modal('show');
                elem.prop('disabled',false).text('Book Now');
                $('.add-tooltip').tooltip();
            } 
        });
    });

    $('body').on('click','.confirm_booking',function(e){
        e.preventDefault();
        if($('input[name=seats_selected]').val().trim() == ''){
            $.niftyNoty({
                type: 'danger',
                container : 'floating',
                title : 'Error',
                message : 'Please select at least one seat!',
                closeBtn : true,
                timer : 10000,
            });
            return false;
        }else{
            $('#confirm_booking').submit();
        }
    });
});