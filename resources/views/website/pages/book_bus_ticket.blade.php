@extends('frontend.layout.materialize')

@section('content')



<section id="content">

<div class="container">

@if($errorStatus == false) 	

		<a href="{{route('bus.ticket',['block'=>$res['BlockKey']])}}" class="btn li-red Fbutn"> test without payment Book Ticket</a>




		@php
		dump( $wallet);

			//dump($req_data);

			$detail = $req_data['inventoryItems'][0]['passenger'];

		@endphp



<div class="row">



	<div class="col m10">

	 

		<form method="post" action="{{route('bus.payment')}}">

			{{csrf_field()}}

		



		<input type="hidden" value="{{csrf_token()}}" name="_token">

		<input type="hidden" value="{{$res['BlockKey']}}" name="block_key">

		<input type="text" value="{{$detail['email']}}" name="email">

		<input type="text" value="{{$detail['name']}}" name="name">

		<input type="text" value="{{$detail['address']}}" name="address">

		<input type="text" value="{{$req_data['markup_price']}}" name="markup_price">
		<input type="text" value="{{$req_data['total_fare']}}" name="price">

		<input type="submit" class="btn" value="Proceed To Payment">



		</form>

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