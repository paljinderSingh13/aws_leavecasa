<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',['uses'=>'Customers\CustomerController@registerUser']);
Route::post('login',['uses'=>'Customers\CustomerController@customerLogin']);

// Route::get('search/flight',['uses'=>'']);
Route::get('airport/codes',['uses'=>'Api\FlightApiController@getAirpotCodes']);

// Route::post('flights/search',['uses'=>'Api\ApiController@searchFlightResult']);
Route::post('flights/search',['uses'=>'Api\FlightApiController@searchResults']);
Route::post('flights/advance-search',['uses'=>'Api\FlightApiController@advance_flight_search']);
Route::post('flight/lcc-ticket',['uses'=>'Api\FlightApiController@lcc_ticket']);
Route::post('flight/non-lcc-book',['uses'=>'Api\FlightApiController@non_lcc_book']);
Route::post('flight/non-lcc-ticket',['uses'=>'Api\FlightApiController@non_lcc_ticket']);
Route::post('flight/fare_rule_quote_ssr',['uses'=>'Api\FlightApiController@fare_rule_quote_ssr']);

//Busses
Route::get('/bus/cities',['uses'=>'Api\BusApiController@getBusCities']);
Route::post('/bus/search',['uses'=>'Api\BusApiController@busSearch']);
Route::post('/bus/seat/layout',['uses'=>'Api\BusApiController@busLayout']);
Route::post('/bus/ticket/block',['uses'=>'Api\BusApiController@block_token']);
Route::post('/bus/ticket/final',['uses'=>'Api\BusApiController@final_ticket']);
Route::get('/bus/ticket/detail/{tin}',['uses'=>'Api\BusApiController@ticket_detail']);

//User Wallet
Route::get('wallet/amount/{user_id}',['uses'=>'Api\ApiController@getWalletAmount']);
Route::post('update_wallet',['uses'=>'Api\ApiController@updateWallet']);

// Hotel API
// Route::get('hotel/countries',['uses'=>'Api\ApiController@getCountries']);
// Route::get('hotel/cities/{country}',['uses'=>'Api\ApiController@citiesList']);



//end new
// Route::post('search/hotel',['uses'=>'Api\ApiController@getHotelsList']);
//hotel api
Route::post('search/hotel',['uses'=>'Api\HotelApiController@getHotelsList']);
Route::post('hotel_detail',['uses'=>'Api\HotelApiController@hotel_detail']);
Route::get('hotel_images/{hcode}',['uses'=>'Api\HotelApiController@hotel_images']);
Route::post('hotel-cancellation-policy',['uses'=>'Api\HotelApiController@cancelation_policy']);
Route::get('hotel-detail/{bref}',['uses'=>'Api\HotelApiController@book_detail']);
Route::get('hotel-booking-cancellation/{bref}',['uses'=>'Api\HotelApiController@cancel_hotel_booking']);
Route::get('hotel-city-search/{search}',['uses'=>'Api\HotelApiController@city_data']);

Route::post('recheck',['uses'=>'Api\HotelApiController@recheck']);
Route::post('final-book',['uses'=>'Api\HotelApiController@final_book']);
