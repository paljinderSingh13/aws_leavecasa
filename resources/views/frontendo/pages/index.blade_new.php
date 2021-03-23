@extends('frontend.layout.materialize')
@section('content')
  
  <link href="{{ asset(env('FPATH').'materialize/css/style2.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>

 
<nav class="white box-shadow-none nav-extended" role="navigation">
<div class="nav-content container" id="navbarcontent">
<ul class="tabs tabs-default">
<li class="tab"><a class="li-text-red active" href="#hotels-tab"><i class="tiny fas fa-hotel"></i>&nbsp;&nbsp;HOTELS</a></li>
<li class="tab"><a class="li-text-red" href="#flights-tab"><i class="tiny fas fa-plane-departure"></i>&nbsp;&nbsp;FLIGHTS</a></li>
<li class="tab"><a class="li-text-red" href="#bus-tab"><i class="tiny fas fa-bus"></i>&nbsp;&nbsp;BUS</a></li>
<li class="tab"><a class="li-text-red" href="#visa-status">VISA</a></li>
<li class="tab"><a class="li-text-red" href="#flight-status">FLIGHT STATUS</a></li>
</ul>
</div> 
</nav>   
   @include('frontend.component.hotel_search')
 </div>
	  <div class="row">
	 @include('frontend.component.destination')
	 </div>
	  <div class="row rpic ">
	 @include('frontend.component.whyus')
	 </div>
    <div class="row global-map-area mobile-section parallax">
   @include('frontend.component.offer')
   </div>

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

$(window).scroll(function() {
    $('#iblock').each(function() {
      if (isScrolledIntoView(this) === true) {
        $(this).addClass('bounceInRight');
      }
    });
    $('#itext').each(function() {
      if (isScrolledIntoView(this) === true) {
        $(this).addClass('bounceInLeft');
      }
    });
  });
          
            $('input[name=trip_type]').click(function(){
                if($(this).val() == 'round'){
                  $("#return").prop('required',true);
                    $('.round_trip').fadeIn(300);
                    // $('#round_type').show();
                    $('.one_way_round').show();
                    $('.multi_city_div').hide();
                }else if($(this).val() == 'one_way'){
                  $("#return").prop('required',false);
                    $('.round_trip').fadeOut(300);
                    $('.one_way_round').show();
                    $('.multi_city_div').hide();
                    // $('#round_type').hide();
                }else{
                  $("#return").prop('required',false);
                    $('.multi_city_div').show();
                    $('.one_way_round').hide();
                    // $('#round_type').hide();
                }
            });
        });
         $('.testo').click(function() {
          $('.adlt-cl-bx').toggle();
          });


       
  
$(document).on('change','.children',function(){

  ch_age =  $(this).val();
  room_no = $(this).siblings('.room_no').val();
  child="";
  
  for (var i =1; i <= ch_age; i++) {
     child += '<div  class="input-field col l2 s3 mt-0">';
    child += '<input class="blue-grey-text center-align" placeholder="< 12" type="text" name="ch_age['+room_no+'][]">';  
    child += '</div>';
  }

//childs

  $('#child'+room_no).html(child);

} ); 

   $(".add_room").on('click', function(){

      // $('.close').addClass('hide');
        rom_no = $(".rom").length + 1;
        // alert(rom_no);
        html = "<div class='main row"+ rom_no+ "' id='rom'><div class='row rom'><div class='col l4 fs15 '><b>Room "+ rom_no+ "</b></div><div class='col l3 '> <select name='adults[]' class='adult browser-default adult_sel' onchange='adultCount(this.value)'><option value='1'>01</option><option selected='selected' value='2'>02</option><option value='3'>03</option><option value='4'>04</option><option value='5'>05</option> </select></div><div class='col l3'> <select name='children[]' class='children browser-default child_sel' onchange='childCount(this.value)'><option selected='selected' value='0'>00</option><option value='1'>01</option><option value='2'>02</option><option value='3'>03</option> </select> <input type='hidden' class='room_no' value='"+rom_no +"'></div><div class='col l2 clos"+rom_no+"'> <a class='close row"+rom_no+"'> <i class='material-icons right-align'>close </i> </a></div></div><div class='row'><div class='childs' id='child"+rom_no+"' ></div></div></div>";
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
         $("<div class='row topp' id='citydiv"+(i)+"'><div class='input-field col s6 l2 nxt top'><input  id='leave"+i+"' name='from[]' type='text' class='validate flight_city to'><label class='tol' for='leave"+i+"'>Leaving From </label></div><div class='fromp input-field col s6 l2'><input name='to[]' id='going"+i+"' type='text' class='validate flight_city from'><label   for='going"+i+"'>Going To</label></div><div class='input-field col s6 l2'><input id='departure"+i+"' name='depart[]' type='text' class='text' validate'><label for='departure"+i+"'>Departing On</label></div><div class='input-field col s6 l2'><a class='btn-floating btn-large waves-effect waves-light red deleteR' id='delete_row"+i+"'><i class='material-icons right'>delete</i></a></div></div>").insertAfter($('[id^="citydiv"]').last());
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

// $(document).ready(function(){
//   $("form").on("submit", function(){
//     $(".loader1").fadeIn();
//   });//submit
// });
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


    </script>

     
@endsection 