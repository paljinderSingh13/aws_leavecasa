@extends('frontend.layout.materialize')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'v2.9/css/nifty.min.css') }}">
@php
use Illuminate\Support\Str;
$sess=Session::get('search_request');
@endphp
@if(!Auth::guard('customer')->check())
 @include('frontend.pages.register-login')
@else
@endif
@endsection
