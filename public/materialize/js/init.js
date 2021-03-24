(function($){
  $(function(){

    $('.sidenav').sidenav();
      $('select').formSelect();

  }); // end of document ready
})(jQuery); // end of jQuery name space

$(document).ready(function(){
    $('.collapsible').collapsible();
    $('.tooltipped').tooltip();
    $('ul.tabs').tabs();
  });


$(document).on('click','.read', function(){
	$(this).parent('span').siblings('span').removeClass('hide');
	$(this).parent('span').addClass('hide');
})


$(document).on('keypress','input', function(){
       $(this).removeClass('error');
       $(this).siblings('label').removeClass('red-text');
       $(this).siblings('span.helper-text').remove();
    });

 $(document).on('keypress','input', function(){
       $(this).removeClass('error');
       $(this).siblings('label').removeClass('red-text');
       $(this).siblings('span.helper-text').remove();
    });    
// $(document).on('click','#city', function(){
// 	city = $("#city").val();
// 	alert(city);
// });