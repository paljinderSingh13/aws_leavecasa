@extends('frontend.layout.materialize')
@section('content')

<section id="content">
    <div class="container"> 
        <div class="row">
    <form class="col s12" method="post" action="{{ route('bus.block') }}">
      <div class="row">
        <div class="input-field col s6">          

          <input  class="validate black-text" type="text" value="{{$req_data['bus_id']}}" name="availableTripId">
          <input class="validate black-text" type="text"  value="{{$req_data['boarding_point']}}"  name="boardingPointId">
          <input class="validate black-text" type="text"class="validate black-text"    value="{{$req_data['droping_point']}}" name="destination">
          <input class="validate black-text" type="text"   value="{{$req_data['source']}}" name="source">

          
            <input placeholder="Placeholder" name="inventoryItems[0][fare]"  value="{{$req_data['total_price']}}" id="fare" type="text" class="validate black-text">
            <input placeholder="Placeholder" name="inventoryItems[0][ladiesSeat]" value="false" id="ladiesSeat" type="text" class="validate black-text">
            <input placeholder="Placeholder" name="inventoryItems[0][seatName]"   value="{{$req_data['seats_selected']}}" val  id="seatName" type="text" class="validate black-text">

            "passenger": {
                "address": "some address",
                "age": "21",
                "email": "test@redbus.in",
                "gender": "MALE",
                "idNumber": "ID123",
                "idType": "PAN_CARD",
                "mobile": "9898989898",
                "name": "test",
                "primary": "true",
                "title": "Mr"
            },
            "seatName": "U2"
          <input placeholder="Placeholder" name="inventoryItems[0][passenger]['name']" id="name" type="text" class="validate  black-text">

          <label for="name"> Name</label>
        </div>

        <div class="row">
        <div class="input-field col s12">
          <input placeholder="Placeholder" value="true" name="inventoryItems[0][passenger]['primary']" id="title" type="text" class="validate  black-text">
          <label for="title">primary</label>
        </div>
      </div>

        <div class="row">
        <div class="input-field col s12">
          <input placeholder="Placeholder" value="true" name="inventoryItems[0][passenger]['address']" id="address" type="text" class="validate  black-text">
          <label for="title">address</label>
        </div>
      </div>



        <div class="row">
        <div class="input-field col s12">
          <input placeholder="Placeholder" value="Mr" name="inventoryItems[0][passenger]['title']" id="title" type="text" class="validate  black-text">
          <label for="title">Titile</label>
        </div>
      </div>


        <div class="input-field col s6">
          <input placeholder="Placeholder" name="inventoryItems[0][passenger]['age']" id="age" type="text" class=" black-text validate">
          <label for="age">Age</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Placeholder" value="MALE" name="inventoryItems[0][passenger]['gender']" id="gender" type="text" class="validate  black-text">
          <label for="disabled">Gender</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Placeholder" value="PAN_CARD" name="inventoryItems[0][passenger]['idType']" id="idType" type="text" class="validate  black-text">
          <label for="password">idType</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Placeholder" name="inventoryItems[0][passenger]['idNumber']" id="idNumber" type="text" class="validate  black-text">
          <label for="email">idNumber</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="input-field inline">
          <input placeholder="Placeholder"  name="inventoryItems[0][passenger]['email']" id="email" type="text" class="validate  black-text">
            <label for="email_inline">Email</label>
          </div>
        </div>
      </div>
       <div class="col s12">
          <div class="input-field inline">
          <input type="submit" class="button">
          </div>
        </div>
    </form>
  </div>
    </div>  


</section>

@endsection