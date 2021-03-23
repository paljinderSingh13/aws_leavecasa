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

<div class="col s6 card offset-s3"> 
  <div id="login-form">
      <h4 class="center"> Login</h4>
    <form method="post" action="{{ route('login.customer') }}">
            {{csrf_field()}}
        <input type="hidden" name="redirect" value="{{ route('flight.details') }}">
        <input type="text" name="email">
        <input type="password" name="password">
           <button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
    </form>
    <a onclick="openSignup()" id="signup"> Sign up</a>
</div>

<div id="reg" style="display: none">
    <h4 class="center"> Sign Up</h4>
    <form method="post" action="{{ route('cust.reg') }}">
        {{ csrf_field() }}
  <div class="row">
    <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">user</i>
          <input class="black-text" id="name"  name="name" type="text"  >
          <label for="name">Name</label>
        </div>
      </div>

    <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input class="black-text" name="email"  type="text"  >
          <label class="black-text" for="email">email</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <input class="black-text" name="password"  type="password" class="validate">
          <label class="black-text" for="password">Password</label>
        </div>
      </div>


       <div class="row">
        <div class="input-field col s12">
          <input class="black-text" id="phone"  name="mobile" type="text" class="validate">
          <label class="black-text" for="phone"> Phone</label>
        </div>
      </div>

       <button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>


        <a onclick="openLogin()" id=""> login</a>
    </div>
  </div>
</form>

 <input type="text" name="email">
<input type="password" name="password">
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
        
          <input  class="validate black-text" type="text" value="{{$req_data['markup_price']}}" name="markup_price">
          <input  class="validate black-text" type="hidden" value="{{$req_data['bus_id']}}" name="availableTripId">
          <input class="validate black-text" type="hidden"  value="{{$req_data['boarding_point']}}"  name="boardingPointId">
          <input class="validate black-text" type="hidden" class="validate black-text"    value="{{$req_data['droping_point']}}" name="destination">
          <input class="validate black-text" type="hidden"   value="{{$req_data['source']}}" name="source">
           <input  name="total_fare"  value="{{$req_data['total_fare']}}"  type="hidden" class="validate black-text">
          <div class="card"> 
          @foreach($seats_data as $key => $value)
          <div class="card-content">
          <h5> Seat No. {{ $value}}</h5>
          <div class="row lform">
            <input  name="inventoryItems[{{$key}}][fare]"  value="{{$req_data['total_price']}}" id="fare{{$key}}" type="hidden" class="validate black-text">
            <input  name="inventoryItems[{{$key}}][ladiesSeat]" value="false" id="ladiesSeat{{$key}}" type="hidden" class="validate black-text">
            <input  name="inventoryItems[{{$key}}][seatName]"   value="{{$value}}" val  id="seatName{{$key}}" type="hidden" class="validate black-text">

        
        <div class="input-field col s3 lform">
          <input  value="Mr" name="inventoryItems[{{$key}}][passenger][title]" id="title{{$key}}" type="text" class="validate ">

          @if($key==0)
          <input  value="true" name="inventoryItems[{{$key}}][passenger][primary]"  type="hidden" >
          @else
          <input  value="false" name="inventoryItems[{{$key}}][passenger][primary]"  type="hidden" >

          @endif
          <label for="title">Title</label>
        </div>
      
           
        <div class="input-field col s3 lform">
          <input value="Paljinder" name="inventoryItems[{{$key}}][passenger][name]" id="name{{$key}}" type="text" class="validate  black-text">
          <label for="name"> Name</label>
        </div>
        
         
        <div class="input-field col s3 lform">
          <input value="MALE" name="inventoryItems[{{$key}}][passenger][gender]" id="gender{{$key}}" type="text" class="validate">
          <label for="gender">Gender</label>
        </div>
    
        
         
        <div class="input-field col s3 lform">
          <input value="30" name="inventoryItems[{{$key}}][passenger][age]" id="age{{$key}}" type="text" class="  validate">
          <label for="age">Age</label>
        </div>
    </div>
  </div>
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