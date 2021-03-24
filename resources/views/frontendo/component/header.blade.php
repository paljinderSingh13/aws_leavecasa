<div class="row navbar-fixed">
        

     

<nav class="white box-shadow-none navbar-fixed" role="navigation">
      <div class="nav-wrapper container">

        @if(Session::has('agency_image_path'))

        <a id="logo-container" href="{{ route('index') }}" class="brand-logo mdb-text"><img src="{{Session::get('agency_image_path')}}/{{Session::get('agency_image')}}" alt="Leavecasa" class="mt1" width="40px"/></a>

       

        @else
          <a id="logo-container" href="{{ route('index') }}" class="brand-logo mdb-text"><img src="/images/logo1.png" alt="Leavecasa" class="mt1" width="150px"/></a>

        @endif


         <a href="#" data-target="nav-mobile" class="button-collapse hide-on-med-and-up sidenav-trigger mdb-text"><i class="material-icons">menu</i>
        </a>
        <ul class="right hide-on-med-and-down uc f20w500">
          <li><a class="mdb-text " href="/">Home</a></li>
          <li><a class="mdb-text " href="">About</a></li>
          @if(Auth::guard('customer')->check())
          <li><a class='dropdown-trigger mdb-text' id="dropdowner1" href='javascript:void(0)' data-target='dropdown3'>My Account<i class="tiny fas fa-caret-down"></i></a></li>
          <li><a class="mdb-text " href="{{ route('logout.customer') }}">Logout</a></li>
          @endif
          @if(!Auth::guard('customer')->check())
           <li><a class="mdb-text sel_tab" href="javascript:login()" >LOGIN</a></li>
           <li><a class="mdb-text sel_tab" href="javascript:signup()" >SIGNUP</a></li>
          @endif
          <li><a class="mdb-text " href="">Contact us </a></li>
          <li><a class='dropdown-trigger mdb-text' id="dropdowner" href='javascript:void(0)' data-target='dropdown2'>More<i class="tiny fas fa-caret-down"></i></a></li>
        </ul></div>     
        <ul id="nav-mobile" class="sidenav uc fw200">
          <li><a class="mdb-text" href="/"><i class="tiny fas fa-home"></i>Home</a></li>
          <li><a class="mdb-text" href=""><i class="tiny fas fa-info-circle"></i>About</a></li>
       @if(Auth::guard('customer')->check())
          <li><a class="mdb-text" href="{{ route('customer.account') }}"><i class="tiny fas fa-user"></i>My Account</a></li>
          <li><a class="mdb-text" href="{{ route('air.booking.history') }}"><i class="tiny fas fa-user"></i>Booking History</a></li>
          <li><a class="mdb-text" href="{{ route('logout.customer') }}"><i class="tiny fas fa-sign-out-alt"></i>Logout</a></li>
          @endif
          @if(!Auth::guard('customer')->check())
          <li><a class="mdb-text sel_tab" href="javascript:login()" class="soap-popupbox modal-trigger"><i class="tiny fas fa-user"></i>LOGIN</a></li>
          <li><a class="mdb-text sel_tab" href="javascript:signup()" class="soap-popupbox"><i class="tiny fas fa-user"></i>SIGNUP</a></li>
          @endif          
          <li><a class="mdb-text" href=""><i class="tiny fas fa-address-book"></i>Contact us </a></li>
        </ul>
</nav>
<ul id='dropdown2' class='dropdown-content dropdown2'>
            <li><a href="javascript:void(0)" onclick="window.location='{{ route('check.status') }}'">Hotel Booking</a></li> 
            <li><a href="javascript:void(0)" onclick="window.location='{{ route('check.status') }}'">Flight Booking</a></li> 
            <li><a href="javascript:void(0)" onclick="window.location='{{ route('check.status') }}'">Bus Booking</a></li></ul> 

 <ul id='dropdown3' class='dropdown-content dropdown2'>
       <li><a href="javascript:void(0)" onclick="window.location='{{route('wallet') }}'">Wallet</a></li>
            <li><a href="javascript:void(0)" onclick="window.location='{{ route('air.booking.history') }}'">Booking</a></li>            
             <li><a href="javascript:void(0)" onclick="window.location='{{ route('wallet.detail') }}'">Transaction</a></li>
  </ul>              
</div>