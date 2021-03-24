@extends('frontend.layout.materialize')
@section('content')

<div class="row">
	<nav class="white box-shadow-none nav-extended" role="navigation">
<div class="nav-content container" id="navbarcontent">
      <ul class="tabs tabs-default">
        <li class="tab"><a class="li-text-red active" href="#hotels-tab"><i class="tiny fas fa-hotel"></i>&nbsp;&nbsp;HOTELS</a></li>
        <li class="tab"><a class="li-text-red" href="#flights-tab"><i class="tiny fas fa-plane-departure"></i>&nbsp;&nbsp;FLIGHTS</a></li>
        <li class="tab"><a class="li-text-red" href="#bus-tab"><i class="tiny fas fa-bus"></i>&nbsp;&nbsp;BUS</a></li>
        <li class="tab"><a class="li-text-red" href="#flight-status">FLIGHT STATUS</a></li>
      </ul>
    </div> 
</nav>
       <div class="row">
	 @include('frontend.component.hotel_search')
	 </div>
	  <!-- <div id="result">	  	
	  </div> -->
	  <div class="row">
	 @include('frontend.component.destination')
	 </div>
	  <div class="row rpic ">
	 @include('frontend.component.whyus')
	 </div>
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
                  $("#departure1").prop('required',true);
                    $('.round_trip').fadeIn(300);
                    $('.one_way_round').show();
                    $('.multi_city_div').hide();
                }else if($(this).val() == 'one_way'){
                  $("#departure1").prop('required',false);
                    $('.round_trip').fadeOut(300);
                    $('.one_way_round').show();
                    $('.multi_city_div').hide();
                }else{
                  $("#departure1").prop('required',false);
                    $('.multi_city_div').show();
                    $('.one_way_round').hide();
                }
            });
        });
         $('.testo').click(function() {
          $('.adlt-cl-bx').toggle();
          });


         /*add room*/

$(document).on('click','.ad_age',function(){

  ad_age =  parseInt($(this).text()); 
  $(this).addClass('activ').siblings().removeClass('activ');
  $(this).siblings('.adult').val(ad_age);

  } );

  
$(document).on('click','.ch_age',function(){

  ch_age =  $(this).text();
  
  room_no = $(this).siblings('.room_no').val();
  console.log(room_no);
  child="";
  $(this).addClass('activ').siblings().removeClass('activ');
  for (var i =1; i <= ch_age; i++) {
     child += '<div  class="input-field col l2 s3">';
    // child +=  '<div class="col l3">'+i+'</div>';
    child += '<input class="blue-grey-text center-align" placeholder="< 12" type="text" name="ch_age['+room_no+'][]">';

    
    // child +=  '<div class="divider col l12"></div>';
    child += '</div>';
  }

//childs

  $(this).siblings('.childs').html(child);

} );
 

   $(".add_room").on('click', function(){

      $('.close').addClass('hide');
        rom_no = $(".rom").length + 1;
        html = "<div class='main' id='rom'><div class='row rom'> <h6 class='col l3 fs15 offset-l1 offset-s1 s11 mt0'><b>Room "+ rom_no+ "</b> </h6></div><div class='row room_detail'> <h6 class='col l4 fs15 offset-l1 offset-s1 s11 mt0'> Adult <span class='grey-text'>(12+ yrs)</span></h6></div><div class='row room_detail'> <div class='col l6 offset-l1 offset-s1 s11 mt0'> <a class=' ad_age p1 mr3'> 1 </a> <a class='ad_age p1 mr3 activ'> 2 </a> <a class='ad_age p1 mr3 '> 3 </a> <a class='ad_age p1 mr3'> 4 </a> <a class='ad_age p1 mr3'> 5 </a> <a class='ad_age p2 mr3'> 6 </a> <input class='adult' type='hidden' value='2' name='adults[]'> </div></div><div class='row room_detail'> <h6 class='col l5 fs16 offset-l1 offset-s1 s11 mt0'>Children <span class='grey-text'>(1-12)</span></h6></div><div class='row room_detail'> <div class='col l11 offset-l1  offset-s1 s11 mt0'> <a class='ch_age active p1 mr3 '> 0 </a> <a class='ch_age p1 mr3'> 1 </a> <a class='ch_age p1 mr3'> 2 </a> <a class='ch_age p1 mr3'> 3 </a> <input type='hidden' class='room_no' value='"+rom_no +"'> <input class='children' type='hidden' value='0' name='children[]'> <div class='childs'> </div><a id=''+rom_no+'' class='close back_'+rom_no+''> <i class='material-icons right-align'>close </i> </a></div></div></div>";
          $('#room_detail').append(html);

   })

 $(document).on('click','.close',function(){

      // back_remove = this.id - 1;
      // $('#'+back_remove).removeClass('hide');
    $(this).parent().parent().parent().remove();
 });

  
// $('#iblock').addClass('animated bounceInRight');

 var i=2;
 var j=4;
 var date = new Date();
     $("#add_row").click(function(){
      $('#citydiv'+i).html("<div class='input-field col s6 l2 nxt top'><input  id='leave"+i+"' name='from[]' type='text' class='validate flight_city to'><label class='tol' for='leave"+i+"'>Leaving From </label></div><div class='fromp input-field col s6 l2'><input name='to[]' id='going"+i+"' type='text' class='validate flight_city from'><label   for='going"+i+"'>Going To</label></div><div class='input-field col s6 l2'><input id='departure"+i+"' name='depart[]' type='text' class='datepicker' validate'><label for='departure"+i+"'>Departing On</label></div><div class='input-field col s6 l2'><a class='btn-floating btn-large waves-effect waves-light red' id='delete_row'><i class='material-icons right'>delete</i></a></div>");

      if (i<6) {
         $('#citydiv0').prepend('<div class="row topp" id="citydiv'+(i+1)+'"></div>');
         i++; 
         j++;
    };


    $('.datepicker').datepicker({
                    defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    minDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    autoClose:true
                  });
     
       

  });
      $('.multi_city_div').on('click','#delete_row',function() {
  $(this).parent().parent().remove();
});

   $("#done").click(function(){
    $(".adlt-cl-bx").hide();
     });  



    </script>
@endsection 