@extends('frontend.layout.materialize')
@section('content')

<section id="content">
   <div class="row mdb p1 "> 
    @php
      $searchB = session()->get('searchBus');      
      @endphp
    <div class="col s12">
     <p class="f28w100 white-text mt0 mb0"><i class="fas fa-bus  prefix white-text"></i> {{ App\Model\BusBookingSource::city_code_to_name($searchB['bus_from']) }} to {{ App\Model\BusBookingSource::city_code_to_name($searchB['bus_to']) }}<span> On {{ $searchB['journey_date']}}</span></p>
 </div></div>
    <div class="container"> 

    
    <div class="row">
      @if(!Auth::guard('customer')->check())

    @if($errors->any())
        <div class="col l8 m9 s12"> 
          <h4 class="red-text">{{$errors->first()}}</h4>
        </div>
    @endif
  <script type="text/javascript">
    
    function openSignup(){
        regist = document.getElementById('reg');
        login = document.getElementById('login-form');
        login.style.display  = "none";
        regist.style.display = "block";
    }

     function openLogin(){
        regist = document.getElementById('reg');
        login = document.getElementById('login-form');
        login.style.display  = "block";
        regist.style.display = "none";
    }
</script>

<div class="col s6 card offset-s3 lform"> 
  <div id="login-form">
      <h4 class="center"> Login</h4>
    <form method="post" action="{{ route('login.customer') }}">
            {{csrf_field()}}
        <input type="hidden" name="redirect" value="{{ route('flight.details') }}">
        <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="fEmail" type="text" autocomplete="off" name="email" required>
          <label for="fEmail" class="center-align">Email</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="fpassword" type="password" name="password" autocomplete="off" required>
          <label for="fpassword" class="">Password</label>
        </div>
      </div>
        <div class="row">
        <div class="input-field col  s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col offset-s2 s8" >Login</button>
        </div>
      </div>
           
    </form>
    <div class="row">
        <div class="input-field col s6 m6 l6">
          <p class="margin medium-small"> <a onclick="openSignup()">Register Now!</a></p>
        </div>
      </div>
  {{--   <a onclick="openSignup()" id="signup"> Sign up</a> --}}
</div>

<div id="reg" style="display: none">
    <h4 class="center"> Sign Up</h4>
    <form method="post" action="{{ route('cust.reg') }}">
        {{ csrf_field() }}
  <div class="row">
    <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">person_outline</i>
          <input class="black-text" id="name"  name="name" type="text"  >
          <label for="name">Name</label>
        </div>
      </div>

    <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input class="black-text" name="email"  type="text" id="emal" >
          <label class="black-text" for="emal">email</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input class="black-text" name="password"  type="password" class="validate" id="pswd">
          <label class="black-text" for="pswd">Password</label>
        </div>
      </div>


       <div class="row">
        <div class="input-field col s12">
           <i class="material-icons prefix pt-2">lock_outline</i>
          <input class="black-text" id="phone"  name="mobile" type="text" class="validate">
          <label class="black-text" for="phone"> Phone</label>
        </div>
      </div>
    <div class="row">
        <div class="input-field col  s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col offset-s2 s8" >Sign Up</button>
        </div>
      </div>
     <div class="row">
          <p class="margin medium-small"><a onclick="openLogin()">Already have an account? Login</a></p>        
      </div>
       {{--  <a onclick="openLogin()" id=""> login</a> --}}
    </div>
  </div>
</form>

{{--  <input type="text" name="email">
<input type="password" name="password"> --}}
</div>
</div>
 </div>  
@else


 @php
     $data = session()->get('selected_bus');

   

 @endphp

   <div class="row ">
   
    <form method="post" action="{{ route('bus.block') }}"> 
     {{csrf_field()}}
        <h5>Bus Passenger Details {{$req_data['markup_price']}}</h5>
        
          <input  class="validate black-text" type="hidden" value="{{$req_data['markup_price']}}" name="markup_price">
          <input  class="validate black-text" type="hidden" value="{{$req_data['bus_id']}}" name="availableTripId">
          <input class="validate black-text" type="hidden"  value="{{$req_data['boarding_point']}}"  name="boardingPointId">
          <input class="validate black-text" type="hidden" class="validate black-text"    value="{{$req_data['droping_point']}}" name="destination">
          <input class="validate black-text" type="hidden"   value="{{$req_data['source']}}" name="source">
           <input  name="total_fare"  value="{{$req_data['total_fare']}}"  type="hidden" class="validate black-text">
          <div class="card"> 

            @php
              $ikey = 0;

             
            @endphp
          @foreach($req_data['seat'] as $key => $value)

          @php
            $seats =  explode(',',  $value);
          @endphp
          <div class="card-content p1">
          <h6> Seat No. {{ $key}}   
          @if($seats[1]==="true")
           Lady Seat
          @endif

         @if(!empty($seats[2]))

            Sleeper Seat

         @endif

        </h6>
          <div class="row lform">
            <input  name="inventoryItems[{{$ikey}}][fare]"  value="{{$seats[0]}}" id="fare{{$ikey}}" type="hidden" class="validate black-text">
            <input  name="inventoryItems[{{$ikey}}][ladiesSeat]" value="{{$seats[1]}}" id="ladiesSeat{{$ikey}}" type="hidden" class="validate black-text">
            <input  name="inventoryItems[{{$ikey}}][seatName]"   value="{{$key}}" val  id="seatName{{$ikey}}" type="hidden" class="validate black-text">

        
        <div class="input-field col s3 lform">
         {{--  <input  value="Mr" name="inventoryItems[{{$ikey}}][passenger][title]" id="title{{$ikey}}" type="text" class="validate " required> --}}
          @if($ikey==0)
          <input  value="true" name="inventoryItems[{{$ikey}}][passenger][primary]"  type="hidden" >
          @else
          <input  value="false" name="inventoryItems[{{$ikey}}][passenger][primary]"  type="hidden" >

          @endif
          <select id="title{{$ikey}}"  name="inventoryItems[{{$ikey}}][passenger][title]">
            <option  selected="selected" value="Mr">Mr.</option>
            <option value="Mrs">Mrs.</option>
            <option value="Ms">Ms.</option>
          </select>         
          <label for="title{{$ikey}}">Title</label>
        </div>
        
           
         
       
      
           
        <div class="input-field col s3 lform">
          <input  name="inventoryItems[{{$ikey}}][passenger][name]" id="name{{$ikey}}" type="text" class="validate  black-text" required>
          <label for="name{{$ikey}}"> Name</label>
        </div>
        
         
       {{--  <div class="input-field col s3 lform">
          <input  name="inventoryItems[{{$ikey}}][passenger][gender]" id="gender{{$ikey}}" type="text" class="validate">
          <label for="gender{{$ikey}}">Gender</label>

        </div> --}}
         <div class="input-field col s3 lform">
            <select id="gender{{$ikey}}" name="inventoryItems[{{$ikey}}][passenger][gender]">
            <option  selected="selected" value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
          <label for="gender{{$ikey}}">Gender </label>
          </div>
    
        
         
        <div class="input-field col s3 lform">
          <input  name="inventoryItems[{{$ikey}}][passenger][age]" id="age{{$ikey}}" type="text" class="  validate" required>
          <label for="age{{$ikey}}">Age</label>
        </div>
    </div>
  </div>
    @php
 $ikey++;
@endphp
      @endforeach
      </div>
    
      <h5>Contact Detail</h5>
      <div class="card lform">
        <div class="card-content">
         <span class="red-text">Your ticket will be sent to these details</span>
        

        <div class="row ">
        <div class="input-field col s3 lform">
          <input value="amritsar" name="inventoryItems[0][passenger][address]" id="address" type="text" class="validate  black-text">
          <label for="address">Address</label>
        </div>
     
      
        <div class="input-field col s3 lform">
          <input value="PAN_CARD" name="inventoryItems[0][passenger][idType]" id="idType" type="text" class="validate">
          <label for="idType">IdType</label>
      </div>
      
        <div class="input-field col s3 lform">
          <input value="H123" name="inventoryItems[0][passenger][idNumber]" id="idNumber" type="text" class="validate">
          <label for="idNumber">IdNumber</label>
      </div>
      
        <div class="input-field col s3 lform">
          <input value="paljinder3@gmail.com"  name="inventoryItems[0][passenger][email]" id="emails" type="email" class="validate">
            <label for="emails">Email</label>
          </div>
        </div>
      <div class="row">
          <div class="input-field ">
          <input type="submit" value="Continue To Book" class="btn li-red Fbutn">
          </div>
        </div>
    </div>
  </div>
    </form>
    </div>

  @endif
  
   
</div>

</section>



@endsection