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

<div class="search">
    <div class="search_inner">
      
      <div class="container fill_height no-padding">
        <div class="row fill_height no-margin">
          <div class="col fill_height no-padding">
            <input type="hidden" id="city_code" value="<?php echo e(route('city.code')); ?>">
            <input type="hidden" id="city_search_route" value="<?php echo e(route('search.city')); ?>">
            <input type="hidden" id="hotel_search_route" value="<?php echo e(route('hotels.results')); ?>">
            <input type="hidden" id="flight_city_route" value="<?php echo e(route('flight.city')); ?>">
            <input type="hidden" id="flight_city_code_route" value="<?php echo e(route('flight.citycode')); ?>">
            <input type="hidden" id="bus_city_source_route" value="<?php echo e(route('bus.city')); ?>">
            <input type="hidden" id="bus_city_id_route" value="<?php echo e(route('bus.city.id')); ?>">
            <input type="hidden" id="bus_destination" value="<?php echo e(route('bus.destination')); ?>">
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
              <form action="<?php echo e(route('hotels.results')); ?>" method="post" id="hotels-tab" class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                <?php echo e(csrf_field()); ?>

                <input  id="code" name="code" type="hidden" >
                <input  id="country_code" name="country_code" type="hidden">
                <div class="search_item col-md-3">
                  <label for="city">destination</label>
                  <input  id="city" name="city" type="text" class="validate city search_input" placeholder="City"   required>
                  
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
                  <div class="ad_ageW mb-0 " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span id='adultCount'> 2</span>  Adults, <span id='childCount'> 0</span> Child</div>
                 <div class="dropdown-menu adlt-cl-bx p-0">
                  <div class="card ">
                    <div class="row card-header">
                      <div class="col">Room</div>
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
                        
                        <div class="row"><div class="childs form-row mt-2 mb-2" id="child1">
                        </div></div>
                        
                      </div></div>
                      <div class="row card-footer">
                        <div class="col"><a href="javascript:void(0)" class=" add_room">Add Room</a></div>
                        <div class="col"><a href="javascript:void(0)" class="" id="done">Apply</a></div>
                      </div>
                    </div>
                    </div> 
              </div>
                <div class="search_item col-md-3">
                  <button class="button search_button">search<span></span><span></span><span></span></button></div>
                 
                  </form>
                </div>
                <!-- Bus Search Panel -->
                <div class="search_panel">
                  <form action="<?php echo e(route('bus.search')); ?>" id="bus_tab" class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input name="action" type="hidden" value="bus">
                    
                    
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
                      
                      <input  name="journey_date" id="bcheckin" type="text" class="validate search_input" placeholder="YYYY-MM-DD" required>
                    </div>
                    
                    <button class="button search_button" type="submit" >search<span></span><span></span><span></span></button>
                  </form>
                </div>
                <!-- Flight Search Panel -->
                <div class="search_panel">
                  <form action="<?php echo e(route('flight.search')); ?>" method="post" id="flights-tab" class="search_panel_content">
                    <?php echo e(csrf_field()); ?>

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
                  <div class="row multi_city_div" style="display: none" id="multi_city_div">
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
        
        
