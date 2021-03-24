<style type="text/css">
  
   .activ{
    background-color: #425174;
    color: white;
  }

  .remov{
    display: none;
  }
</style>

<div class="row mdb" id="hotels-tab">
  <div class="row">
    <div class="col offset-l3 mt1">
  <span class="hcolor f22w200 fs-m16 fs-s16"><i class=" fas fa-hotel"></i>&nbsp;Book Domestic and International hotels</span></div>
  
</div>
  <div class="container "> 
            
    <input type="hidden" id="city_code" value="{{route('city.code')  }}">
    <input type="hidden" id="city_search_route" value="{{route('search.city')  }}">
    <input type="hidden" id="hotel_search_route" value="{{route('hotels.results')  }}">
    <input type="hidden" id="flight_city_route" value="{{route('flight.city')  }}">
    <input type="hidden" id="flight_city_code_route" value="{{route('flight.citycode')  }}">
    <input type="hidden" id="bus_city_source_route" value="{{route('bus.city')  }}">
    <input type="hidden" id="bus_city_id_route" value="{{route('bus.city.id')  }}">
    <input type="hidden" id="bus_destination" value="{{route('bus.destination')  }}">
      <form  action="{{ route('hotels.results') }}" method="post" class="col s12 l12"  autocomplete="off">
        {{ csrf_field() }}

            <input  id="code" name="code" type="hidden" >
            <input  id="country_code" name="country_code" type="hidden" >
        <div class="row ">
          <div class="col s12 l3  offset-l1 mt2">          
          <div class="input-field">
            <input autocomplete="off"  id="city" name="city" type="text" class="validate city" required>   
             <img style="float: right;position: absolute;left: 206px;top: -22px; display:none" id='cityL' class="ajax-loader" width="100px" src="http://rpg.drivethrustuff.com/shared_images/ajax-loader.gif"/>        
            <label for="city">City,Hotel</label>
          </div>
        </div>
       
      <div class="col s6 l2 mt2">
        <div class="input-field">
           <input id="checkin" name="checkin" type="text" class="validate" required>
           <label for="checkin">Check In</label>
        </div>
      </div>

      <div class="col s6 l2 mt2">
        <div class="input-field">
          <input id="checkout" name="checkout" type="text" class="validate" required>
          <label for="checkout">Check Out</label>
        </div>
      </div>
      <div class="col s6 l2 mt3">
        <div class="input-field testo">
         <span  class="ad_ageW"> <span id='adultCount'> 2</span>  Adults, <span id='childCount'> 0</span> Child</span>
        </div>
      </div>
      <div class="input-field col s6 l2 mt4">
             <button class="btn li-red Fbutn" type="submit">Search
            <i class="material-icons right">search</i>
          </button>
      </div></div>
    <div class="card adlt-cl-bx  z-depth-4" style="display:none;">
      <div class="row card-title">
        <div class="col l4">Rooms</div>
        <div class="col l3">Adults</div>
        <div class="col l3">Children</div>
      </div>
      <div class="card-content">
      
        <div class="row ditto row1" id="room_detail">
          <div class="row rom">
          <div class="col l4 fs15 "><b>Room 1</b> </div>
          <div class="col l3 ">
             <select name="adults[]" class="adult browser-default adult_sel"  onchange="adultCount(this.value)">
            <option value="1">01</option>
            <option selected="selected" value="2">02</option>
            <option value="3">03</option>
            <option value="4">04</option>
            <option value="5">05</option>
          </select>
          </div>
          
          <div class="col l3">
             <select name="children[]" class="children browser-default child_sel" onchange="childCount(this.value)">
            <option value="0" selected="selected">00</option>
            <option value="1" >01</option>
            <option value="2">02</option>
            <option value="3">03</option>
          </select>
          <input type="hidden" class="room_no" value="1">
          </div>
           </div>
            <div class="row"><div class="childs" id="child1">
            </div></div>
                
      </div></div>
         <div class="card-action ">
          <a class=" btn-small  li-red add_room">ADD ROOM</a>
           <a class="btn-small li-red " id="done">Done</a> 
        </div>
    </div>
        
      

      </form>
    </div></div>
<!-- flight form-->
<div class="row mdb" id="flights-tab" style="display:none;">
  
  <div class="container">
    
   <div class="row">
      <form  action="{{ route('flight.search') }}" class="col s12 l12">
        {{ csrf_field() }}

        <input type="hidden" name="action" value="flight">
          <div class="row  p2">
            <div class="col l5  m6 s12 mt1">
            <span class="hcolor center-align f22w200"><i class=" fas fa-plane-departure"></i>&nbsp;Book Flight Tickets </span></div>
           <div class="col m6 s12 l6 mt1">
              <div class="form-group row">
                  <input type="radio" id="radio-btn-1"  class="float-radio" name="trip_type" checked="checked" value="one_way">
                  <label class="lab-btn  radio-inline" for="radio-btn-1">One Way</label>

                  <input type="radio" id="radio-btn-2" class="float-radio"  name="trip_type" value="round">
                  <label class="lab-btn  radio-inline" for="radio-btn-2">Round Trip</label>

                  <input type="radio" id="radio-btn-3" class="float-radio"  name="trip_type" value="multi_city">
                  <label class="lab-btn  radio-inline" for="radio-btn-3">Multi City</label>
              </div>
          </div>
         </div>
        <div class="row one_way_round">
          <div class="input-field col s6 l2">           
            <input  id="leave1" type="text" name="from" class="validate flight_city" required>
            <label for="leave1" class="label-tst">Leaving From</label>
          </div>
          <div class="input-field col s6 l2">
            <input id="to1" type="text" name="to" class=" validate flight_city" required>
            <label for="to1">Going To</label>
          </div> 

          <div class="input-field col s6 l2">
            <input name="depart" id="depart" type="text" class="validate" required>
            <label for="depart">Departing On</label>
          </div>

          <div class="input-field col s6 l2 round_trip" style="display: none;">
            <input name="returning" id="return" type="text" class="validate" >
            <label for="return">Returning On</label>
          </div>         
           
           <div class="input-field col s6 l1 ch_text">
            <select id="adult_s" name="adult" data-type="1">
            <option  selected="selected" value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
            <option value="4">04</option>
            <option value="5">05</option>
            <option value="6">06</option>
            <option value="7">07</option>
            <option value="8">08</option>
            <option value="9">09</option>
          </select>
          <label for="adult_s">Adults </label>
          </div>

            <div class="input-field col s6 l1 ch_text">
            <select id="child_s" name="child" data-type="2">
            {{-- <option value="" disabled selected>Kids</option> --}}
            <option selected="selected" value="0">00</option>
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
          </select>
          <label for="child_s">Kids <12 </label>
          </div>

          <div class="input-field col s6 l1 ch_text">
            <select id="infants_s" name="infants" data-type="3">
            {{-- <option value="" disabled selected>Infants</option> --}}
            <option selected="selected" value="0">00</option>
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
          </select>
          <label for="infants_s">Infants <2</label>
          </div>

           <div class="input-field col s6 l2 ch_text">
            <select name="FlightCabinClass">
            
            <option value="2">Economy</option>
            <option value="3">Premium Economy</option>
            <option value="4">Business</option>
            <option value="5">Premium Business</option>
            <option value="6">First Class</option>
          </select>
          <label>Passenger/ Class</label>
          </div>



      <div class="input-field col s6 l2">
            <button class="btn li-red Fbutn" type="submit" > Search
            <i class="material-icons right">search</i>
          </button>
      </div>
    
        </div>
      </form>
          
        
        <div class="row multi_city_div" style="display: none;">
           <form  action="{{ route('flight.search') }}" class="col s12 l12">
        {{ csrf_field() }}
          <input type="hidden" name="trip_type" value="multi_city">
        <input type="hidden" name="action" value="flight">
         <div class="row">
          <div class="input-field col s6 l2">
           
            <input  id="leave" name="from[]" type="text" class="validate flight_city" required>
            
            <label for="leave">Leaving From </label>
          </div>
          <div class="input-field col s6 l2">
            <input name="to[]" id="going" type="text" class="validate flight_city from" required>
            <label for="going">Going To</label>
          </div> 

          <div class="input-field col s6 l2">
            <input id="departure" name="depart[]" type="text" class="validate" required>
            <label for="departure">Departing On</label>
          </div>
             <div class="input-field col s6 l1 ch_text">
            <select name="adult" id="adult">            
            <option value="1" selected="selected">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
            <option value="4">04</option>
            <option value="5">05</option>
            <option value="6">06</option>
            <option value="7">07</option>
            <option value="8">08</option>
            <option value="9">09</option>
          </select>
          <label for="adult">Adults </label>
          </div>

            <div class="input-field col s6 l1 ch_text">
            <select name="child" id="child">
            <option value="0" selected="selected">00</option>
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
          </select>
          <label for="child">Kids </label>
          </div>

          <div class="input-field col s6 l1 ch_text">
            <select name="infants" id="infants">
            <option value="0" selected="selected">00</option>
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
          </select>
          <label for="infants"> Infants</label>
          </div>

          <div class="input-field col s6 l2 ch_text">
            <select name="FlightCabinClass">
            <option value="2">Economy</option>
            <option value="3">Premium Economy</option>
            <option value="4">Business</option>
            <option value="5">Premium Business</option>
            <option value="6">First Class</option>
          </select>
          <label>Passenger/ Class</label>
          </div> 
           

        </div>
          <div class="row topp" id="citydiv0">
           <div class="input-field col s6 l2">
            <input  id="leave0" name="from[]" type="text" class="validate flight_city to" required>
            <label id="leave_label" for="leave0">Leaving From </label>
          </div>

          <div class="input-field col s6 l2 fromp">
            <input name="to[]" id="going0" type="text" class="validate flight_city from" required>
            <label for="going0">Going To</label>
          </div> 

          <div class="input-field col s6 l2">
            <input id="departure0" name="depart[]" type="text" class="validate" required>
            <label for="departure0">Departing On</label>
          </div> 
      </div>
      <div class="row"><div class="input-field col s6 l2">
            <a class="btn li-red" id="add_row">
            Add 
          </a>
      </div>  <div class="input-field col s6 l2">
            <button class="btn li-red Fbutn" type="submit" > Search
            <i class="material-icons right">search</i>
          </button>
      </div></div>
      </form>
       </div> 
      
    </div>    
  </div></div>
  

<!-- bus form-->

<div class="row mdb" id="bus-tab" style="display:none;">
  <div class="row">
    <div class="col offset-l3 mt1">
  <span class="hcolor f22w200 center-align"><i class=" fas fa-bus"></i>&nbsp;Book Online Bus Tickets</span></div></div>
  <div class="container">
   <div class="row">
     {!! Form::open(['route'=>'bus.search','autocomplete'=>'off' ]) !!}
          {!! Form::hidden('action','bus') !!}
          {{-- {!! Form::hidden('bus_from',null) !!}
          {!! Form::hidden('bus_to',null) !!} --}}
        {{-- {{ csrf_field() }} --}}

        <input type="hidden" name="bus_from" id="bus_dep">
        <input type="hidden" name="bus_to" id="bus_arv">
        <div class="row">
          
           <div class="col s6 l3 mt2">
            
            <div class="input-field">   
              <input   id="bus_from" type="text" class="validate" required autocomplete="off">            
              <label for="bus_from">LEAVING FROM</label>
            </div>
          </div>
          <div class="col s6 l3 mt2">
            
            <div class="input-field">
              <input  id="bus_where" type="text" class="validate" required autocomplete="off">            
              <label for="bus_where">GOING TO</label>
            </div>
          </div>
          
          <div class="col s6 l3 mt2">
          
          <div class="input-field">
            <input  name="journey_date" id="bcheckin" type="text" class="validate" required>
            <label for="bcheckin">JOURNEY DATE</label>
          </div> 
        </div>

      <div class="col s16 l3 mt3">
          <div class="input-field">
            <button class="btn  li-red Fbutn" type="submit" >Search
            <i class="material-icons right">search</i>
          </button>
        </div>
      </div>
        </div>
      {{-- </form> --}}
      {!! Form::close() !!}
    </div>


    
  </div>
</div>

<div class="row mdb" id="visa-status" style="display:none;">
  <div class="row">
    <div class="col offset-l3 mt1">
  <span class="hcolor f22w200 center-align"><i class=" fas fa-plane"></i>&nbsp;Select And Book VISA for countries around the world</span></div></div>
  <div class="container">
   <div class="row">
      <form class="col s12 l12">
        {{ csrf_field() }}
        <div class="row">
           <div class="col s6 l2 mt2">
          <div class="input-field">              
            <input  id="vlocation" type="text" class="validate" required>            
            <label for="vlocation">Your Location</label>
          </div></div>
          <div class="col s6 l2 mt2">
          <div class="input-field">              
            <input  id="vdestination" type="text" class="validate" required>            
            <label for="vdestination">Destination</label>
          </div></div>
          <div class="col s6 l2 mt2">
          <div class="input-field">             
            <input  id="vdeparture" type="text" class="validate" required>            
            <label for="vdeparture">Departure</label>
          </div></div>
         <div class="col s6 l2 mt2">
          <div class="input-field">
            <input id="vreturn" type="text" class="validate" required>
            <label for="vreturn">Return</label>
          </div> </div>
          <div class="col s6 l2 mt2 ch_text ">
            <div class="input-field">
          <select name="traveller" id="traveller">           
            <option value="1" selected="selected">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
          </select>
          <label for="traveller">Traveller</label>
              </div>
          </div>
               <div class="col s6 l2 mt3">
          
          <div class="input-field">
            <button class="btn li-red Fbutn" type="submit" name="action">Search
            <i class="material-icons right">search</i>
          </button>
      </div>
        </div></div>
      </form>
    </div>    
  </div>
</div>


<!-- flight-status form-->

<div class="row mdb" id="flight-status" style="display:none;">
  <div class="row">
    <div class="col offset-l3 mt1">
  <span class="hcolor f22w200 center-align"><i class=" fas fa-plane"></i>&nbsp;Check Flight Status Here</span></div></div>
  <div class="container">
   <div class="row">
      <form class="col s12 l12">
        {{ csrf_field() }}
        <div class="row">
          <div class="col s6 l3 mt2">
          <div class="input-field">
              
            <input  id="from" type="text" class="validate" required>            
            <label for="from">Leaving From</label>
          </div></div>
          <div class="col s6 l3 mt2">
          <div class="input-field">             
            <input  id="where" type="text" class="validate" required>            
            <label for="where">Going To</label>
          </div></div>
         <div class="col s6 l2 mt2">
          <div class="input-field">
            <input id="checke" type="text" class="datepicker5 validate" required>
            <label for="checke">Check In</label>
          </div> </div>
          <div class="col s6 l2 mt2">
          <div class="input-field">
              
            <input  id="flight" type="text" class="validate" required>            
            <label for="flight">Flight Number</label>
          </div></div>

      <div class="col s6 l2 mt3">
          
          <div class="input-field">
            <button class="btn li-red Fbutn" type="submit" name="action">Search
            <i class="material-icons right">search</i>
          </button>
      </div>
        </div>
      </form>
    </div>


    
  </div>
</div>










