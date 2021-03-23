@extends('frontend.layout.materialize1')
@section('content')
    <div class="row">
    <div class="col s12 center-align white">
      <img src="https://45.114.142.192/admin_new/public/images/error-2.png" class="bg-image-404" alt="">
      <h1 class="error-code m-0">Sorry ! No Result Found</h1>
      <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="{{ route('index')}}">Back
        TO Home</a>
    </div>
</div>
@endsection