@extends('frontend.layout.materialize')
@section('content')
@if(Auth::guard('customer')->check())
<div class="row mdb p1 ">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="javascript:void(0)" class="breadcrumb">My Account</a>
        <a href="javascript:void(0)" class="breadcrumb">Wallet</a>
      </div>
    </div>       
    </div> 

<script type="text/javascript">
    
    function openWallet() {
  var x = document.getElementById("wallet");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
  <section id="content" class="gray-area">
        <div class="container">
            <div id="main">
               
                     <div class="card">
                       
                        <div id="wishlist" class="tab-pane fade card-content  p1">
                            <h5>Your Wallet</h5>
                            <div class="row">
                                <div class="col m3">                                    
                                    <i class="material-icons medium green-text">account_balance_wallet</i>
                                    <div class="details">
                                        <h6 class="box-title">Available Amount</h6>
                                        <label class="price-wrapper">
                                            <span class="price-per-unit">&#8377; {{ $balance }}</span>
                                        </label>
                                    </div>                                    
                                </div>
                                <div class="col m4">
                                    <a href="javascript:void(0)" onclick="openWallet()" class="btn  btn-medium mdb">Add Amount To Wallet</a>
                                </div>
                                
                                 <div class="col m4 card mt-0" id="wallet" style="display:none">
                                   <form method="post" action="{{route('wallet.save')}}" class="card-content p4">
                                    {{csrf_field()}}
                                     Amount <input type="text" name="credited"> 
                                     <input type="submit" name="">
                                     </form>
                                </div>
                            </div>
                        </div>
                        <!--</div>-->
                    
                </div>
            </div>
        </div>
       
    </section>
@endif
@endsection
