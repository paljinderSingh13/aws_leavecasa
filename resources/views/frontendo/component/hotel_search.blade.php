<style type="text/css">

.activ{
background-color: #425174;
color: white;
}
.remov{
display: none;
}
.ui-autocomplete-loading {
background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat;
</style>
<div class="super_container">
  <header class="header">
    <nav class="main_nav">
      <div class="container">
        <div class="row">
          <div class="col main_nav_col d-flex flex-row align-items-center justify-content-start">
            <div class="logo_container">
              <div class="logo"><a href="#"><img src="https://leavecasa.com/images/logo1.png" alt=""></a></div>
            </div>
            <div class="main_nav_container ml-auto">
              <ul class="main_nav_list">
                <li class="main_nav_item"><a href="#">home</a></li>
                <li class="main_nav_item"><a href="">about us</a></li>
                <li class="main_nav_item"><a href="javascript:login()" >login</a></li>
                <li class="main_nav_item"><a href="javascript:signup()">register</a></li>
                <li class="main_nav_item"><a href="">contact</a></li>
                <li class="main_nav_item"><a href="">more</a></li>
              </ul>
            </div>
            <div class="content_search ml-lg-0 ml-auto">
            </div>
            <div class="hamburger">
              <i class="fa fa-bars trans_200"></i>
            </div>
            
          </div>
        </div>
      </div>
    </nav>
  </header>
  <div class="menu trans_500">
    <div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
      <div class="menu_close_container"><div class="menu_close"></div></div>
      <div class="logo menu_logo"><a href="#"><img src="{{ url('images/90.png') }}" alt=""></a></div>
      <ul>
        <li class="menu_item"><a href="#">home</a></li>
        <li class="menu_item"><a href="about.html">about us</a></li>
        <li class="menu_item"><a href="javascript:login()" >login</a></li>
        <li class="menu_item"><a href="javascript:signup()">register</a></li>
        <li class="menu_item"><a href="contact.html">contact</a></li>
        <li class="menu_item"><a href="contact.html">more</a></li>
      </ul>
    </div>
  </div>
  <div class="home">
    
    <div class="home_slider_container">
      
      <div class="owl-carousel owl-theme home_slider">
        <!-- Slider Item -->
        <div class="owl-item home_slider_item">
          <div class="home_slider_background" style="background-image:url(public/images/bg.jpg)"></div>
          <div class="home_slider_content text-center">
            <div class="home_slider_content_inner" data-animation-in="flipInX" data-animation-out="animate-out fadeOut">
              <h1>discover</h1>
              <h1>the world</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Search -->
  <div class="search">
    <div class="search_inner">
      <!-- Search Contents -->
      
      <div class="container fill_height no-padding">
        <div class="row fill_height no-margin">
          <div class="col fill_height no-padding">
            <input type="hidden" id="city_code" value="{{route('city.code')  }}">
            <input type="hidden" id="city_search_route" value="{{route('search.city')  }}">
            <input type="hidden" id="hotel_search_route" value="{{route('hotels.results')  }}">
            <input type="hidden" id="flight_city_route" value="{{route('flight.city')  }}">
            <input type="hidden" id="flight_city_code_route" value="{{route('flight.citycode') }}">
            <input type="hidden" id="bus_city_source_route" value="{{route('bus.city')  }}">
            <input type="hidden" id="bus_city_id_route" value="{{route('bus.city.id')  }}">
            <input type="hidden" id="bus_destination" value="{{route('bus.destination')  }}">
            <!-- Search Tabs -->
            <div class="search_tabs_container">
              <div class="search_tabs d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                <div class="search_tab active d-flex flex-row align-items-center justify-content-lg-center justify-content-start"><img src="images/photo/suitcase.png" alt=""><span>hotel</span></div>
                <div class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start"><img src="images/photo/bus.png" alt="">Bus</div>
                <div class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start"><img src="images/photo/departure.png" alt="">flights</div>
                <div class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start"><img src="images/photo/island.png" alt="">trips</div>
                <div class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start"><img src="images/photo/cruise.png" alt="">Visa</div>
              </div>
            </div>
            <!-- hotel Search Panel -->
            <div class="search_panel active">
              <form action="{{ route('hotels.results') }}" method="post" id="hotels-tab" class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                {{ csrf_field() }}
                <input  id="code" name="code" type="hidden" >
                <input  id="country_code" name="country_code" type="hidden">
                <div class="search_item col-md-3">
                  <label for="city">destination</label>
                  <input  id="city" name="city" type="text" class="validate city search_input" placeholder="City"   required>
                  {{-- <input type="text" id="city" class="destination search_input" required="required" > --}}
                </div>
                <div class="search_item col-md-2">
                  <label>check in</label>
                  <input type="text" id="checkin" class="check_in search_input " placeholder="YYYY-MM-DD" name="checkin">
                </div>
                <div class="search_item col-md-2">
                  <label>check out</label>
                  <input type="text" id="checkout" class="checkut search_input " placeholder="YYYY-MM-DD" name="checkout">
                </div>
                <div class="search_item col-md-2">
                  <label>Rooms & Guests </label>
                  <div class="ad_ageW" style="margin-bottom: 0px;"><span id='adultCount'> 2</span>  Adults, <span id='childCount'> 0</span> Child</div>
                </div>
                <div class="search_item col-md-3">
                  <button class="button search_button">search<span></span><span></span><span></span></button></div>
                  <div class="card adlt-cl-bx" style="display: none;">
                    <div class="row card-header">
                      <div class="col">Rooms</div>
                      <div class="col">Adults</div>
                      <div class="col">Children</div>
                      <div class="col"></div>
                    </div>
                    <div class="card-body">
                      <div class="ditto row1" id="room_detail">
                        <div class="row rom">
                          <div class="col fs15">R1</div>
                          <div class="col">
                            <select name="adults[]" class="adult browser-default adult_sel"  onchange="adultCount(this.value)">
                              <option value="1">01</option>
                              <option selected="selected" value="2">02</option>
                              <option value="3">03</option>
                              <option value="4">04</option>
                              <option value="5">05</option>
                            </select>
                          </div>
                          
                          <div class="col">
                            <select name="children[]" class="children browser-default child_sel" onchange="childCount(this.value)">
                              <option value="0" selected="selected">00</option>
                              <option value="1" >01</option>
                              <option value="2">02</option>
                              <option value="3">03</option>
                            </select>
                            <input type="hidden" class="room_no" value="1">
                          </div>
                          <div class="col"></div>
                        </div>
                        
                        <div class="row"><div class="childs form-row" id="child1">
                        </div></div>
                        
                      </div></div>
                      <div class="row card-footer">
                        <div class="col"><a href="javascript:void(0)" class=" add_room">Add Room</a></div>
                        <div class="col"><a href="javascript:void(0)" class="" id="done">Apply</a></div>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- Bus Search Panel -->
                <div class="search_panel">
                  <form action="{{ route('bus.search') }}" id="bus_tab" class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start" method="post">
                    {{ csrf_field() }}
                    <input name="action" type="hidden" value="bus">
                    {{--     {!! Form::open(['route'=>'bus.search','autocomplete'=>'off' ]) !!}
                    {!! Form::hidden('action','bus') !!} --}}
                    
                    <input type="hidden" name="bus_from" id="bus_dep">
                    <input type="hidden" name="bus_to" id="bus_arv">
                    <div class="search_item col-md-3">
                      <label>Leaving From</label>
                      <input type="text" class="search_input" id="bus_from" required="required">
                    </div>
                    <div class="search_item col-md-3">
                      <label>Going To</label>
                      <input type="text" class="search_input" id="bus_where" required="required">
                    </div>
                    <div class="search_item col-md-3">
                      <label>Journey Date</label>
                      {{-- <input type="text" class="checkut search_input" placeholder="YYYY-MM-DD"> --}}
                      <input  name="journey_date" id="bcheckin" type="text" class="validate search_input" placeholder="YYYY-MM-DD" required>
                    </div>
                    
                    <button class="button search_button" type="submit" >search<span></span><span></span><span></span></button>
                  </form>
                </div>
                <!-- Flight Search Panel -->
                <div class="search_panel">
                  <form action="{{ route('flight.search') }}" method="post" id="flights-tab" class="search_panel_content">
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="flight">
                    <div class="tab-content-inner">
                      <div class="row">
                        <input type="radio" id="radio-btn-1"  class="float-radio" name="trip_type" checked="checked" value="one_way">
                        <label class="lab-btn  radio-inline" for="radio-btn-1">One Way</label>
                        <input type="radio" id="radio-btn-2" class="float-radio"  name="trip_type" value="round">
                        <label class="lab-btn  radio-inline" for="radio-btn-2">Round Trip</label>
                        <input type="radio" id="radio-btn-3" class="float-radio"  name="trip_type" value="multi_city">
                        <label class="lab-btn  radio-inline" for="radio-btn-3">Multi City</label>
                      </div>
                    </div>
                    
                    <div class="row one_way_round">
                      <div class="search_item col-md-2">
                        <label>Leaving From</label>
                        <input  id="leave_o" type="text" name="from" class="validate flight_city search_input" required>
                      </div>
                      <div class="search_item col-md-2">
                        <label>Going To</label>
                        <input id="to_o" type="text" name="to" class=" validate flight_city search_input" required>
                      </div>
                      <div class="search_item col-md-2">
                        <label>Departing</label>
                        <input name="depart" id="depart_o" type="text" class="validate search_input" placeholder="YYYY-MM-DD" required>
                      </div>
                      <div class="search_item col-md-2 round_trip" style="display: none">
                        <label>Returning</label>
                        <input name="returning" id="return" type="text" class="validate search_input" placeholder="YYYY-MM-DD" >
                      </div>
                      <div class="search_item col-md-1 ch_text">
                        <label>adults</label>
                        <select id="adult_s" name="adult" data-type="1" class="dropdown_item_select search_input">
                          <option  selected="selected" value="1">01</option>
                          <option value="2">02</option>
                          <option value="3">03</option>
                          <option value="4">04</option>
                          <option value="5">05</option>
                          <option value="6">06</option>
                          <option value="7">07</option>
                          <option value="8">08</option>
                          <option value="9">09</option>
                        </select>
                      </div>
                      <div class="search_item col-md-1 ch_text">
                        <label>Child</label>
                        <select id="child_s" name="child" data-type="2" class="dropdown_item_select search_input">
                          <option value="0">00</option>
                          <option value="1">01</option>
                          <option value="2">02</option>
                          <option value="3">03</option>
                        </select>
                      </div>
                      <div class="search_item col-md-1 ch_text">
                        <label>Infant</label>
                        <select id="infants_s" name="infants" data-type="3" class="dropdown_item_select search_input">
                          <option value="0">00</option>
                          <option value="1">01</option>
                          <option value="2">02</option>
                          <option value="3">03</option>
                        </select>
                      </div>
                      <div class="search_item col-md-2 mt-3">
                        <button class="button search_button Fbutn" type="submit">search<span></span><span></span><span></span></button>
                      </div>
                    </div>
                  {{-- </form> --}}
                  <div class="row multi_city_div" style="display: none" id="multi_city_div">
                    {{-- <form  action="{{ route('flight.search') }}" class="justify-content-start mt-5">
                      {{ csrf_field() }}
                      <input type="hidden" name="trip_type" value="multi_city">
                      <input type="hidden" name="action" value="flight"> --}}
                      <div class="container">
                        <div class="row">
                          <div class="search_item col-md-3">
                            <label>Leaving From</label>
                            <input  id="leave" name="from[]" type="text" class="validate flight_city search_input" required>
                          </div>
                          <div class="search_item col-md-3">
                            <label>Going To</label>
                            <input name="to[]" id="going" type="text" class="validate flight_city from search_input" required>
                          </div>
                          <div class="search_item col-md-3">
                            <label>Departing</label>
                            <input id="departure" name="depart[]" type="text" class="validate search_input" placeholder="YYYY-MM-DD" required>
                          </div>
                          <div class="search_item col-md-1 ch_text">
                            <label>adults</label>
                            <select name="adult" id="adult" class="dropdown_item_select search_input">>
                              <option value="1" selected="selected">01</option>
                              <option value="2">02</option>
                              <option value="3">03</option>
                              <option value="4">04</option>
                              <option value="5">05</option>
                              <option value="6">06</option>
                              <option value="7">07</option>
                              <option value="8">08</option>
                              <option value="9">09</option>
                            </select>
                          </div>
                          <div class="search_item col-md-1 ch_text">
                            <label>Child</label>
                            <select name="child" id="child" class="dropdown_item_select search_input">>
                              <option value="0" selected="selected">00</option>
                              <option value="1">01</option>
                              <option value="2">02</option>
                              <option value="3">03</option>
                            </select>
                          </div>
                          <div class="search_item col-md-1 ch_text">
                            <label>Infant</label>
                            <select name="infants" id="infants" class="dropdown_item_select search_input">>
                              <option value="0" selected="selected">00</option>
                              <option value="1">01</option>
                              <option value="2">02</option>
                              <option value="3">03</option>
                            </select>
                          </div>
                        </div>
                        <div class="row topp extras" id="citydiv0">
                          <div class="search_item col-md-3">
                            <label>Leaving From </label>
                            <input  id="leave0" name="from[]" type="text" class="validate flight_city to search_input" required>
                          </div>
                          <div class="search_item col-md-3 fromp">
                            <label>Going To</label>
                            <input name="to[]" id="going0" type="text" class="validate flight_city from search_input" required>
                          </div>
                          <div class="search_item col-md-3">
                            <label>Departing On</label>
                            <input id="departure0" name="depart[]" type="text" class="validate search_input" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="search_item col-md-3 col-sm-6">
                            <a class="button search_button" id="add_row" >Add </a>
                          </div>
                          <div class="search_item col-md-3 col-sm-6">
                            <button class="button search_button Fbutn" type="submit">search<span></span><span></span><span></span></button>
                          </div>
                        </div>
                        
                      </div> </div>
                    </form>
                  </div>
                  <!-- Search Panel -->
                  <div class="search_panel">
                    <form action="#" id="search_form_4" class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                      <div class="search_item col-md-2">
                        <div>destination</div>
                        <input type="text" class="destination search_input" required="required">
                      </div>
                      <div class="search_item col-md-2 ">
                        <div>check in</div>
                        <input type="text" class="check_in search_input" placeholder="YYYY-MM-DD">
                      </div>
                      <div class="search_item col-md-2">
                        <div>check out</div>
                        <input type="text" class="checkut search_input" placeholder="YYYY-MM-DD">
                      </div>
                      <div class="search_item col-md-1">
                        <div>adults</div>
                        <select name="adults" id="adults_4" class="dropdown_item_select search_input">
                          <option>01</option>
                          <option>02</option>
                          <option>03</option>
                        </select>
                      </div>
                      <div class="search_item col-md-1">
                        <div>children</div>
                        <select name="children" id="children_4" class="dropdown_item_select search_input">
                          <option>0</option>
                          <option>02</option>
                          <option>03</option>
                        </select>
                      </div>
                      <button class="button search_button">search<span></span><span></span><span></span></button>
                    </form>
                  </div>
                  <div class="search_panel">
                    <form action="#" id="search_form_5" class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                      <div class="search_item col-md-2">
                        <div>destination</div>
                        <input type="text" class="destination search_input" required="required">
                      </div>
                      <div class="search_item col-md-2">
                        <div>check in</div>
                        <input type="text" class="check_in search_input" placeholder="YYYY-MM-DD">
                      </div>
                      <div class="search_item col-md-2">
                        <div>check out</div>
                        <input type="text" class="checkut search_input" placeholder="YYYY-MM-DD">
                      </div>
                      <div class="search_item col-md-1">
                        <div>adults</div>
                        <select name="adults" id="adults_5" class="dropdown_item_select search_input">
                          <option>01</option>
                          <option>02</option>
                          <option>03</option>
                        </select>
                      </div>
                      <div class="search_item col-md-1">
                        <div>children</div>
                        <select name="children" id="children_5" class="dropdown_item_select search_input">
                          <option>0</option>
                          <option>02</option>
                          <option>03</option>
                        </select>
                      </div>
                      <button class="button search_button">search<span></span><span></span><span></span></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Intro -->
        
        <section class="feature_part ">
          <div class="container">
            <div class="row align-items-center justify-content-between">
              <div class="col-lg-7 col-sm-12">
                <div class="feature_img">
                  <img src="{{ url('images/tousI/about_img.png') }}" alt="">
                </div>
              </div>
              <div class="col-lg-5 col-sm-12">
                <div class="feature_part_text">
                  <img src="https://colorlib.com/preview/theme/tourbi/img/section_tittle_img.png" alt="#">
                  <h2>Amazing tour</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                    ipsum suspendisse ultrices gravida Risus commodo viverra maecenas
                  accumsan lacus vel facilisis. </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="intro">
          <div class="container">
            <div class="row">
              <div class="col">
                <h2 class="intro_title text-center">We have the best tours</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-10 offset-lg-1">
                <div class="intro_text text-center">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu convallis tortor. Suspendisse potenti. In faucibus massa arcu, vitae cursus mi hendrerit nec. </p>
                </div>
              </div>
            </div>
            <div class="row intro_items">
              <!-- Intro Item -->
              <div class="col-lg-4 intro_col">
                <div class="intro_item">
                  <div class="intro_item_overlay"></div>
                  <!-- Image by https://unsplash.com/@dnevozhai -->
                  <div class="intro_item_background" style="background-image:url('images/tousI/himachal.jpg')"></div>
                  <div class="intro_item_content d-flex flex-column align-items-center justify-content-center">
                    <div class="intro_date">May 25th - June 01st</div>
                    {{--  <div class="button intro_button"><div class="button_bcg"></div><a href="#">see more<span></span><span></span><span></span></a></div> --}}
                    <div class="intro_center text-center">
                      <h1>Himachal</h1>
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- Intro Item -->
              <div class="col-lg-4 intro_col">
                <div class="intro_item">
                  <div class="intro_item_overlay"></div>
                  <!-- Image by https://unsplash.com/@hellolightbulb -->
                  <div class="intro_item_background" style="background-image:url('images/tousI/delhi.jpg')"></div>
                  <div class="intro_item_content d-flex flex-column align-items-center justify-content-center">
                    <div class="intro_date">May 25th - June 01st</div>
                    {{-- <div class="button intro_button"><div class="button_bcg"></div><a href="#">see more<span></span><span></span><span></span></a></div> --}}
                    <div class="intro_center text-center">
                      <h1>Delhi</h1>
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- Intro Item -->
              <div class="col-lg-4 intro_col">
                <div class="intro_item">
                  <div class="intro_item_overlay"></div>
                  <!-- Image by https://unsplash.com/@willianjusten -->
                  <div class="intro_item_background" style="background-image:url('images/tousI/goa.jpg')"></div>
                  <div class="intro_item_content d-flex flex-column align-items-center justify-content-center">
                    <div class="intro_date">May 25th - June 01st</div>
                    {{--  <div class="button intro_button"><div class="button_bcg"></div><a href="#">see more<span></span><span></span><span></span></a></div> --}}
                    <div class="intro_center text-center">
                      <h1>Goa</h1>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="text-center footer">
          <div class="footer-above">
            <div class="container">
              <div class="row">
                <div class="footer-col col-md-12">
                  <ul class="list-inline">
                    <li class="footer_social_item"><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                    <li class="footer_social_item"><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                    <li class="footer_social_item"><a href="javascript:void(0)"><i class="fa fa-facebook-f"></i></a></li>
                    <li class="footer_social_item"><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
                    <li class="footer_social_item"><a href="javascript:void(0)"><i class="fa fa-flickr"></i></a></li>
                  </ul>
                </div>
              </div>
              <hr class="mt1" style="border-color: #2662a5">
              <div class="row">
                <div class="footer-col col-md-12">
                  <img src="https://leavecasa.com/images/logo1.png" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="footer-below mt-4">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <span class="copy-text">Copyright &copy;<script>document.write(new Date().getFullYear());</script> <a href="JavaScript:Void(0)" class="text-danger">leavecasa travel private limited  </a> &nbsp; | &nbsp; All Rights Reserved |  Powered By <a href="JavaScript:Void(0)" class="text-danger">DilemmasDiluted</a></span>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 footer-content">
                  <p>With our reasonably priced packages and well-thought itineraries, we bring people who want to travel the world and expand their horizons closer to their dreams. We offer so much more than just affordable packages and destination information.</p>
                </div>
              </div>
            </div>
          </div>
          
        </footer>
        <div class="copyright">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="footer_nav_container d-flex flex-row align-items-center justify-content-lg-center">
                  <div class="footer_nav">
                    <ul class="list-inline">
                      <li class="footer_nav_item"><a href="#">home</a></li>
                      <li class="footer_nav_item"><a href="about.html">about us</a></li>
                      <li class="footer_nav_item"><a href="about.html">services</a></li>
                      <li class="footer_nav_item"><a href="about.html">Portfolio</a></li>
                      <li class="footer_nav_item"><a href="offers.html">offers</a></li>
                      <li class="footer_nav_item"><a href="contact.html">contact</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>