@extends('frontend.layout.materialize')
@section('content')
<section>
<div class="container">
@if($errorMessage==false)
<div class="row">
  <div class="center-align white">
@php
dump($detail);
@endphp
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