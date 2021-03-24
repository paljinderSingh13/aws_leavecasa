
$(document).ready(function(){



	$('.tooltipped').tooltip();
	city = $("#city").val();
 	$.get('/get_city_data/'+32, function(city_data, status){
        $('input.city_autocomplete').autocomplete({
        	data:city_data,
	      	minLength:2,
	      	limit:7,
	      	onAutocomplete:function(event){
	      		city = $("#city").val()
	      		autocomplete_search();
	      		get_data();
	      	}
        }); 
    });

    if(city!=""){
		autocomplete_search();
		get_data();
    } 
	
});

function autocomplete_search(){
	$('input.autocomplete').val('');
	$.get('/get_city_hospital_dr_clinic_autocomplete/'+city, function(res, status){
		$('input.autocomplete').autocomplete({
	      data: res ,
	      limit:7,
	      minLength:2,
	      onAutocomplete:function(event){
	      	get_data();
	      	}
	    });
	 console.log(res);
 	});
	
} 

function get_data(){
	search = $("#search").val();
	city = $("#city").val();
	$.get('/get_result/'+city+'/'+search, function(res, status){
 		$("#result").html(res);
	});
}



function get_opd_schedule(org_id, user_id){
$("#opd_schedule"+org_id+''+user_id).slideUp();
	$.get('/get_opd_schedule/'+org_id+'/'+user_id, function(res, status){
 		$("#opd_schedule"+org_id+''+user_id).append(res);
 		
	});

	$('.tooltipped').tooltip();
}

$(document).on('click','#search', function(){

	$("#hotel_search_route").val();

	var data = $('form').serialize();
	$.post('url', data);

});


$(document).on('click','.opd_schedule', function(){
	
	var ids = $(this).attr('id');
	var ic = $(this).attr('ic');
	var text =  $('.icon_'+ids).html();
	
	if(ic==0){

		 $('.icon_'+ids).text('keyboard_arrow_down');
		 $(this).attr('ic',1);

	}else{
		
		$('.icon_'+ids).text('chevron_right');
		$(this).attr('ic',0);
	}

	$("#opd_schedule"+ids).slideToggle();
});





// country state city data
// 
