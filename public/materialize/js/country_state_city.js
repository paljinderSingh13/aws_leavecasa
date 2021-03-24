


$(document).ready(function(){

$.get('/country', function(datas, status){
     $("#co").autocomplete({
        data:datas,
        minLength:3,
        onAutocomplete:function(){
            co = $("#co").val();
            state_data(co);
        },
        limit:8

    });
});


});


function state_data(co){
 
 $.get( 'http://opd.com/state_data/'+co,function(state, status){
        // $("#cid").val(state.country_id);
        $("#state_data").autocomplete({
            data:state.state_data,
            minLength:2,
            onAutocomplete:function(){
                state_name = $('#state_data').val();
                city_data();
            },
            limit:5

        })
    });
}



function city_data(){
    $.get('http://opd.com/city_data/'+state_name, function(city,status){
        // $('#sid').val(city.state_id);
        $('#city_data').autocomplete({
            data:city.city,
            minLength:2,
            limit:5
        });

    });
}
   

    function state(cid){
       $.get('/state/'+cid, function(data, status){
        $("#state").html(data);
        });
    }

    function city(sid){
        $.get('/city/'+sid, function(data, status){
        $("#city").html(data);
        });
    }

    $(document).on('change','.country', function(){
        var cid = $(this).val();
        state(cid);
    });

    $(document).on('change','.state', function(){
        var sid = $(this).val();
        city(sid);
    });
