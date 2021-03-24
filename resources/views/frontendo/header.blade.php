
<div class="row navbar-fixed">

  <h1> HHHelloo </h1>
<nav class="white box-shadow-none navbar-fixed" role="navigation">
      <div class="nav-wrapper container">

        <a id="logo-container" href="{{ route('index') }}" class="brand-logo mdb-text">

        <img src="/images/logo1.png" alt="Leavecasa" class="mt1" width="150px"/></a>
         <a href="#" data-target="nav-mobile" class="button-collapse hide-on-med-and-up sidenav-trigger mdb-text"><i class="material-icons">menu</i>
        </a>
        <ul class="right hide-on-med-and-down uc f20w500">
          <li><a class="mdb-text " href="/">Home  hhhhhhhh </a></li>
          <li><a class="mdb-text " href="">About</a></li>
		@if(Auth::guard('customer')->check())
          <li><a class="mdb-text " href="{{ route('customer.account') }}">My Account</a></li>{{-- 
          <li><a class="mdb-text " href="javascript:void(0)" style="cursor: default;">|</a></li> --}}
          <li><a class="mdb-text " href="{{ route('logout.customer') }}">Logout</a></li>
          @endif
          @if(!Auth::guard('customer')->check())
           <li><a class="mdb-text " href="javascript:login()" class="soap-popupbox modal-trigger">LOGIN</a></li>
          {{--  <li><a class="mdb-text " href="{{ route('login.user') }}" class="soap-popupbox">LOGIN</a></li> --}}
           <li><a class="mdb-text " href="javascript:signup()" class="soap-popupbox">SIGNUP</a></li>
          @endif          
          <li><a class="mdb-text " href="">Contact us </a></li>
        </ul>      </div>
     
        <ul id="nav-mobile" class="sidenav uc fw200">
          <li><a class="mdb-text" href="/"><i class="tiny fas fa-home"></i>Home</a></li>
          <li><a class="mdb-text" href=""><i class="tiny fas fa-info-circle"></i>About</a></li>
    @if(Auth::guard('customer')->check())
          <li><a class="mdb-text" href="{{ route('customer.account') }}"><i class="tiny fas fa-user"></i>My Account</a></li>
          <li><a class="mdb-text" href="javascript:void(0)" style="cursor: default;">|</a></li>
          <li><a class="mdb-text" href="{{ route('logout.customer') }}"><i class="tiny fas fa-sign-out-alt"></i>Logout</a></li>
          @endif
          @if(!Auth::guard('customer')->check())
           <li><a class="mdb-text" href="#travelo-login" class="soap-popupbox"><i class="tiny fas fa-sign-in-alt"></i>LOGIN</a></li>
           <li><a class="mdb-text" href="#travelo-signup" class="soap-popupbox"><i class="tiny fas fa-user"></i>SIGNUP</a></li>
          @endif          
          <li><a class="mdb-text" href=""><i class="tiny fas fa-address-book"></i>Contact us </a></li>
        </ul>
       
      
</nav>

   </div>
   @include('frontend.component.login_signup')
  