@extends('frontend.layout.materialize')
@section('content')
 <div class="row mdb p1">
        <div class="col offset-l1 l5 s12">
            <p class="f28w100 white-text mt0 mb0">View Your Booking</p>
        </div>
       </div> 
   <div class="container"> 
   <div class="row lform">
    <div class="col card offset-l3 l5 mt4"> 
     <div class="card-content"> 
 <span class="card-title valign center">Hotel Booking</span>


<form  action="{{ route('book.status') }}" method="post" id="booking_status">
 {{ csrf_field() }} 

     
        <div class="row">
        <div class="input-field">
        <input id="bref" name="bref" type="text" class="validate" required>
          <label for="bref">Reference ID</label>
        </div>
      </div>

      <div class="row valign center">
               <button class="btn li-red " type="submit">Submit
            <i class="material-icons right">search</i>
          </button>
        </div>
      </div>
   
</form>	</div></div> </div></div>
@endsection