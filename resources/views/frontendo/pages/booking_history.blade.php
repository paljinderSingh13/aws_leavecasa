@extends('frontend.layout.materialize')
@section('content')
<div class="row mdb p1 ">
   <div class="nav-wrapper">
      <div class="col s12">
         <a href="javascript:void(0)" class="breadcrumb">My Account</a>
         <a href="javascript:void(0)" class="breadcrumb">Bookings</a>
      </div>
   </div>
</div>
<div class="container">
   <div class="main">
      <div class="col s8 offset-s2">
         <div >
            <ul class="tabs">
                <li class="tab col s3"><a class="active" href="#Fhistory">Flights</a></li>
               <li class="tab col s3"><a href="#Hhistory">Hotels</a></li>
               <li class="tab col s3 "><a href="#Bhistory">Bus</a></li>
               <li class="tab col s3"><a href="#Bvisa">Visa</a></li>
            </ul>
         </div>
         <div id="Fhistory" class="col s12">
            <ul class="collapsible">
               @foreach($data as $key =>$val)
               @php
               $detail = json_decode($val['booking_detail'], true);
              // dump($detail);
               @endphp
               <li>
                  
                  
                      @foreach($detail as $dkey => $dval)  
                      
                      @if(empty($dval['Response']['Error']['ErrorCode']))
                       @foreach($dval['Response']['Response']['FlightItinerary']['Segments'] as $skey => $sval)
                     
                      @php
                        $departTime = $sval['StopPointDepartureTime'];
                        $departTime = explode('T',$departTime);
                        $date = \Carbon\Carbon::parse($departTime[0]);
                        $time = \Carbon\Carbon::parse($departTime[1]);
                      @endphp
                        <div class="collapsible-header valign wrapper"><i class="material-icons ">flight_takeoff </i>{{ $sval['Origin']['Airport']['CityName'] }} to {{ $sval['Destination']['Airport']['CityName'] }}&nbsp;&nbsp;<span class=" right-align">On {{  $date->format('d-m-Y') }}</span></div>
                       
                    @endforeach 
                    @php
                        $createDate = $val['created_at'];
                        $createDate = explode(' ',$createDate);
                        $Cdate = \Carbon\Carbon::parse($createDate[0]);
                        $Ctime = \Carbon\Carbon::parse($createDate[1]);
                      @endphp        
                        <div class="collapsible-body">
                        <ul class="collection">
                        <table class="collection-item">
                         <tr>
                             <td>PNR Number</td>
                             <td>{{ $dval['Response']['Response']['PNR'] }} </td>
                         </tr>  
                         <tr>
                             <td>Booking Number</td>
                             <td>{{ $dval['Response']['Response']['BookingId'] }} </td>
                         </tr>
                         <tr>
                             <td>Booking Date</td>
                             <td>{{  $Cdate->format('d-m-Y') }} </td>
                         </tr> 
                        </table>    
                       
                        </ul>
                        </div>
                          @endif
                        @endforeach
                    
               </li>
               @endforeach
            </ul>
         </div>
         <div id="Hhistory" class="col s12"   style="display:none">
          <ul class="collapsible">
             <li>
                <div class="collapsible-header"><i class="material-icons">filter_drama</i>NO RECORD FOUND</div>
                <div class="collapsible-body"><span>NO RECORDS</span></div>
             </li>
             </ul>
         </div>
         <div id="Bhistory" class="col s12" style="display:none">
             <ul class="collapsible">
             <li>
                <div class="collapsible-header"><i class="material-icons">filter_drama</i>NO RECORD FOUND</div>
                <div class="collapsible-body"><span>NO RECORDS</span></div>
             </li>
             </ul>
         </div>
         <div id="Bvisa" class="col s12" style="display:none">
             <ul class="collapsible">
                <li>
                 <div class="collapsible-header"><i class="material-icons">filter_drama</i>NO RECORD FOUND</div>
                 <div class="collapsible-body"><span>NO RECORDS</span></div>
                </li>
                </ul>
         </div>
         
      </div>
   </div>
</div>
@endsection