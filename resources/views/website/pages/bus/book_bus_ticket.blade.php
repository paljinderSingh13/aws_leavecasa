@extends('frontend.layout.materialize')

@section('content')



<section id="content">

<div class="container">

@if($errorStatus == false) 	

		@php
		//dump($req_data);

			$detail = $req_data['inventoryItems'][0]['passenger'];

		@endphp

<div class="row">
	<div class="col m10 offset-l1">
		<div id="basic-form" class="card card card-default scrollspy">
        <div class="card-content lform">
          <h3 class="center" style="margin-top: 0px;">Payment</h3>
         <form method="post" action="{{route('bus.payment')}}">
			{{csrf_field()}}
			<input type="hidden" value="{{csrf_token()}}" name="_token">
		   <input type="hidden" value="{{$res['BlockKey']}}" name="block_key">
            <div class="row">
              <div class="input-field col s12">
                <input type="text" id="name" autocomplete="off" value="{{$detail['name']}}" name="name">
                <label for="name" class="">Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="emailt" type="email" value="{{$detail['email']}}" name="email">
                <label for="emailt" class="">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="address" value="{{$detail['address']}}" name="address" type="text">
                <label for="address" class="">Address</label>
              </div>
            </div>
             <div class="row">
              <div class="input-field col s12">
                <input id="price" type="text" value="{{$req_data['total_fare']}}" name="price">
                <label for="price" class="">Price</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="markup" value="{{$req_data['markup_price']}}" name="markup_price" type="text">
                <label for="markup" class="">Markup</label>
              </div>
            </div>
              <div class="row">
                <div class="input-field col s12 l6">
                  <button class="btn mdb right" type="submit" name="action">Proceed To Payment
                    <i class="material-icons right">send</i>
                  </button>
                </div>
                 {{-- <div class="input-field col s12 l6">
                <a href="{{route('bus.ticket',['block'=>$res['BlockKey']])}}" class="btn li-red Fbutn"> test without payment Book Ticket</a>
                </div> --}}


                @if(!empty($wallet))                
                <div class="input-field col s12 l6">
                <button class="btn mdb" type="submit" name="wallet" value="wallet_money"> Use wallet
                    <i class="material-icons right">account_balance_wallet</i>
                  </button>
                </div>

                  
                @endif
              </div>
            
          </form>
        </div>
      </div>
		

	

	 </div>

</div>

@else

<div class="row">

  <div class="center-align white">

      <img src="{{ asset('/images/not_found.gif') }}" class="bg-gif-404" alt="">

      <h3 class="error-code m-0">{{ $errorMessage }}</h3>

      <a class="btn li-red Fbutn waves-effect waves-light mdb gradient-shadow mb-4" href="{{ route('index')}}">Back

        TO Home</a>

    </div> 

</div>

@endif

</div>





</section>

@endsection