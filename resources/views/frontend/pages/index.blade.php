@extends('frontend.layout.materialize')
@section('content')

    @include('frontend.component.slider')
    @include('frontend.component.hotel_search')
	   @include('frontend.component.homecontent')
@endsection 
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

          function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
  }
          
            $('input[name=trip_type]').click(function(){
                if($(this).val() == 'round'){
                    $('.round_trip').fadeIn(300);
                    $('.one_way_round').show();
                    $('.multi_city_div').hide();
                    $('#one_way_round').find(":input").prop("disabled", false);
                    $('#multi_city_div').find(":input").prop("disabled", true);
                }else if($(this).val() == 'one_way'){
                    $('.round_trip').fadeOut(300);
                    $('.one_way_round').show();
                    $('.multi_city_div').hide();
                    $('#one_way_round').find(":input").prop("disabled", false);
                    $('#multi_city_div').find(":input").prop("disabled", true);
                }else{
                    $("#return").prop('required',false);
                    $('.multi_city_div').show();
                    $('.one_way_round').hide();
                    $('.one_way_round').find(":input").prop("disabled", true);
                    $('#multi_city_div').find(":input").prop("disabled", false);

                }
            });
        });
         
var getradio=$('input[name=trip_type]:checked').val();
if(getradio=='one_way'){
  $('#multi_city_div').find(":input").prop("disabled", true);
}

       
  
$(document).on('change','.children',function(){

  ch_age =  $(this).val();
  room_no = $(this).siblings('.room_no').val();
  child=""; 
  
  for (var i =1; i <= ch_age; i++) {
     child += '<div  class="search_item col-sm-2 form-group">';
    child += '<input class="form-control" placeholder="< 12" type="text" name="ch_age['+room_no+'][]">';  
    child += '</div>';
  }

//childs

  $('#child'+room_no).html(child);

} ); 

   $(".add_room").on('click', function(){

      $('.close').addClass('hide');
        rom_no = $(".rom").length + 1;
        // alert(rom_no);
        html = "<div class='main row"+ rom_no+ "' id='rom'><div class='row rom'><div class='col l4 fs15 '>R"+ rom_no+ "</div><div class='col l3 '> <select name='adults[]' class='adult browser-default adult_sel' onchange='adultCount(this.value)'><option value='1'>01</option><option selected='selected' value='2'>02</option><option value='3'>03</option><option value='4'>04</option><option value='5'>05</option> </select></div><div class='col l3'> <select name='children[]' class='children browser-default child_sel' onchange='childCount(this.value)'><option selected='selected' value='0'>00</option><option value='1'>01</option><option value='2'>02</option><option value='3'>03</option> </select> <input type='hidden' class='room_no' value='"+rom_no +"'></div><div class='col l2 clos"+rom_no+"'> <a class='close row"+rom_no+"'> <i class='material-icons right-align'>close </i> </a></div></div><div class='row'><div class='childs form-row' id='child"+rom_no+"' ></div></div></div>";
          $('#room_detail').append(html);
          adultCount();
          childCount();

   })

 $(document).on('click','.close',function(){
 rom_no = $(".rom").length + 1;
    $(this).parent().parent().parent().remove();

    adultCount();
    childCount();
 });
 var i=0;
 var date = new Date();
     $("#add_row").click(function(){
     

      if (i<3) {
          i++;
         $("<div class='row topp extras' id='citydiv"+(i)+"'> <div class='search_item col-md-3 nxt top'> <label>Leaving From </label> <input id='leave"+i+"' name='from[]' type='text' class='validate flight_city to search_input'> </div><div class='search_item col-md-3 fromp'> <label>Going To</label> <input name='to[]' id='going"+i+"' type='text' class='validate flight_city from search_input'> </div><div class='search_item col-md-3'> <label>Departing On</label> <input id='departure"+i+"' name='depart[]' type='text' class='text validate search_input' > </div><div class='search_item col-md-2 mt-5'><a class='deleteR ' id='delete_row "+i+" '><i class='material-icons right '>delete</i></a></div></div>").insertAfter($('[id^="citydiv"]').last());
    };
   
   $('#departure'+i) .datepicker({
                    defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    minDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    autoClose:true
                  });
     

 

  });
      $('.multi_city_div').on('click','.deleteR',function() {
  $(this).parent().parent().remove();i--;
});

//      $('.multi_city_div').on('click','.remove',function() {
//   $(this).parent().remove();
// });
     

   $("#done").click(function(){
    $(".adlt-cl-bx").hide();
     });  

$(document).ready(function(){
  $("form").on("submit", function(){
    $(".loader").fadeIn();
  });//submit
});
                  $('.value-plus').on('click', function(){
                    var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
                    divUpd.text(newVal);
                  });

                  $('.value-minus').on('click', function(){
                    var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
                    if(newVal>=1) divUpd.text(newVal);
                  });



        $('.flightD').click(function() {
          $('.numofppl').toggle();
          });


$('.adlt-cl-bx').click(function(e) {
    e.stopPropagation();
});

      // $('.ad_ageW').click(function() {
      //    $('.adlt-cl-bx').toggle();   
      //     });  

    </script>

     
@endsection 