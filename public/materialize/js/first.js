$(document).ready(function(){

$.get('/get_city_data/'+32, function(city_data, status){
        $('.city_autocomplete').autocomplete({
        	data:city_data,
	      	minLength:3,
	      	limit:7
        }); 
    });
});