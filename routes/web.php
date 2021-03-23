<?php
/*
|--------------------------------------------------------------------------
| Web Routes---------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServicePro
|-----------------------------------------vider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['domain' => '{agency}.leavecasa.com'], function () {

    Route::group(['middleware'=>'subdomain'], function(){



        Route::get('/', 'website\WebsiteController@index')->middleware('agency');


        Route::group(['namespace'=>'Agency','prefix'=>'agency'], function(){

            Route::get('login', 'LoginController@show_login')->name('agency.login');
            Route::post('login', 'LoginController@check_login')->name('agency.login.check');
            Route::get('logout', 'LoginController@logout')->name('agency.logout');
            Route::get('ag', 'LoginController@agency')->middleware('agency')->name('agency');
            Route::get('dashboard', 'DashboardController@index')->middleware('agency')->name('dashboard');

        //hotel Markup
        
            Route::get('agent', 'AgenyHotelMarkup@index')->name('agency.markup');
        });
     });
});



Route::get('bus-book','website\BusCitySourceController@book');//->name('wallet');//->middleware('customer');
Route::get('con/{block}','website\BusCitySourceController@confirmTicket')->name('bus.ticket');//->name('wallet');//->middleware('customer');

// route::group(['middleware'=>['web',] ])
Route::get('wallet','website\WalletController@add_wallet_from')->name('wallet');//->middleware('customer');

Route::post('wallet-save', 'website\WalletController@save')->name('wallet.save');
Route::get('wallet-detail', 'website\WalletController@my_wallet_account')->name('wallet.detail');
//Route::get('wallet-ba', 'website\WalletController@my_wallet_account')->name('wallet.detail');


Route::get('booking-history', 'Customers\CustomerController@air_booking_history')->name('air.booking.history');
Route::post('cust-register', 'Customers\CustomerController@register')->name('cust.reg');


Route::any('wallet_payment_response/{res?}','website\WalletController@wallet_payment_response')->name('wallet.pay.res');
Route::any('payment_response/{res?}','website\WebsiteController@payment_response')->name('pay');
Route::any('flight-ticket-payment-wallet/{amount}','website\FlightController@ticket_by_wallet')->name('use.wallet.flight');
Route::any('flight_payment_response/{res?}','website\FlightController@flight_payment_response')->name('flight.pay');


Route::get('city_list','HotelDataController@city_list');
Route::get('get_hotel/{ccode}','HotelDataController@get_hotel')->name('gethotel');
Route::group(['namespace'=>'Administrator','prefix'=>'administrator'], function(){

    Route::get('/agency-register', function(){

        return view('administrator.agency.agency');
    })->name('add-agency');

//Package 
   
    Route::get('/packages',['as'=>'packages.add','uses'=>'Package\PackageController@index']);
     Route::post('package-add','Package\PackageController@store')->name('package.store');
     Route::get('get_cities/{country_id?}','Package\PackageController@get_city')->name('country.city');

    Route::post('agency-registration', 'Agency\RegistrationController@registration')->name('admin.agency.registration');
    Route::get('agency-edit/{id}', 'Agency\RegistrationController@edit')->name('admin.agency.edit');
    Route::post('agency-update', 'Agency\RegistrationController@update')->name('admin.agency.update');
    Route::get('agency-list', 'Agency\RegistrationController@agent_list')->name('admin.agency.list');
    Route::get('agency-status/{id}/{status}', 'Agency\RegistrationController@status')->name('admin.agency.status');
     Route::get('/agency-delete/{id}', 'Agency\RegistrationController@delete')->name('admin.agency.delete');
     Route::get('/agency-markup', 'Agency\AgencyMarkController@index')->name('admin.agency.markup');
     Route::post('/agency-markup-save', 'Agency\AgencyMarkController@store')->name('admin.agency.markstore');


    Route::group(['middleware'=>'auth'], function(){

        Route::get('/',['as'=>'dashboard','uses'=>'Dashboard\DashboardController@index']);
        
        Route::group(['namespace'=>'Accounts','prefix'=>'accounts'], function(){

            Route::group(['module'=>'role'], function(){
                //Roles
                Route::get('/roles',['as'=>'roles.list','uses'=>'RolesController@index','action'=>'view-roles']);
                Route::get('/role/create',['as'=>'create.role','uses'=>'RolesController@create', 'action'=>'create-role']);
                Route::post('/role/save',['as'=>'save.role','uses'=>'RolesController@save','action'=>'create-role']);
                Route::get('/role/edit/{id}',['as'=>'edit.role','uses'=>'RolesController@edit','action'=>'edit-role']);
                Route::put('/role/update/{id}',['as'=>'update.role','uses'=>'RolesController@update', 'action'=>'edit-role']);
                Route::get('/role/delete/{id}',['as'=>'delete.role','uses'=>'RolesController@delete', 'action'=>'delete-role']);
            });

            Route::group(['module'=>'sub-admin'], function(){
                //SubAdmin
                Route::get('/subadmins',['as'=>'subadmin.list','uses'=>'SubAdminController@index', 'action'=>'view-subadmin']);
                Route::get('/subadmin/create',['as'=>'subadmin.create','uses'=>'SubAdminController@create', 'action'=>'create-subadmin']);
                Route::post('/subadmin/save',['as'=>'save.subadmin','uses'=>'SubAdminController@save', 'action'=>'create-subadmin']);
                Route::get('/subadmin/edit/{id}',['as'=>'edit.subadmin','uses'=>'SubAdminController@edit', 'action'=>'edit-subadmin']);
                Route::put('/subadmin/update/{id}',['as'=>'update.subadmin','uses'=>'SubAdminController@update', 'action'=>'edit-subadmin']);
                Route::get('/subadmin/delete/{id}',['as'=>'delete.subadmin','uses'=>'SubAdminController@delete', 'action'=>'delete-subadmin']);
            });
            Route::group(['module'=>'permissions'], function(){
                //Permissions
                Route::get('/permissions/{role_id?}',['as'=>'permissions.list','uses'=>'PermissionsController@index','action'=>'view-permissions']);
                Route::post('/permissions/save',['as'=>'save.permissions','uses'=>'PermissionsController@store','action'=>'save-permissions']);
                //Ajax Routes
                Route::get('/actions-list',['as'=>'actions.list','uses'=>'PermissionsController@actionsList']);
            });

        });

      

        Route::group(['namespace'=>'Employee', 'prefix'=>'employees'], function(){
            Route::group(['module'=>'employees'], function(){
                //Employees
                Route::get('/',['as'=>'employee.list','uses'=>'EmployeeController@index','action'=>'employees-list']);
                Route::get('/create',['as'=>'create.employee','uses'=>'EmployeeController@create','action'=>'employee-create']);
                Route::post('/save-employee',['as'=>'save.employee','uses'=>'EmployeeController@saveEmployee','action'=>'employee-craete']);
                Route::get('/edit/{id}',['as'=>'edit.employee','uses'=>'EmployeeController@edit','action'=>'employee-edit']);
                Route::put('/update/{id}',['as'=>'update.employee','uses'=>'EmployeeController@update','action'=>'employee-edit']);
            });
        });

        Route::group(['namespace'=>'Booking','prefix'=>'booking'], function(){
            Route::group(['module'=>'flight-booking'], function(){
                Route::get('book-flight',['as'=>'book.flight','uses'=>'FlightBookingController@index','action'=>'book-flight']);
                Route::post('booking',['as'=>'booking.flight','uses'=>'FlightBookingController@bookingFlight']);
                Route::match(['get','post'],'book/now',['as'=>'book.flight.now','uses'=>'FlightBookingController@bookFlight']);
                Route::get('/booking/confirmation',['as'=>'booking.confirmation','uses'=>'FlightBookingController@bookingConfirmation']);
                Route::post('/process/payment',['as'=>'process.payment','uses'=>'FlightBookingController@processPayment']);
                Route::match(['get','post'],'/book/flight/now',['as'=>'book.flight.api','uses'=>'FlightBookingController@bookFlightNow']);
                Route::get('/booking/done/{booking_id}',['as'=>'flight.booking.done','uses'=>'FlightBookingController@bookingDone']);

                //Ajax Route
                Route::post('search-flight',['as'=>'search.flight.for.booking','uses'=>'FlightBookingController@searchForBooking']);
                Route::get('customer-details',['as'=>'customer.details','uses'=>'FlightBookingController@customerModal']);
                Route::post('insert-customer',['as'=>'insert.customer','uses'=>'FlightBookingController@insertToCustomersList']);
                Route::get('customers-list',['as'=>'customers.list','uses'=>'FlightBookingController@getCustomersList']);
                Route::get('customer/delete/{index}',['as'=>'delete.customer','uses'=>'FlightBookingController@deleteCustomer']);
            });
            Route::group(['module'=>'bus-booking'], function(){
                Route::match(['get','post'],'book-bus',['as'=>'book.bus','uses'=>'BusBookingController@index','action'=>'book-bus']);
                //Ajax
                Route::get('bus/seat/details/{bus_id}',['as'=>'bus.seat.details','uses'=>'BusBookingController@getSeatDetails']);

                Route::get('passenger/details',['as'=>'bus.passengers.details','uses'=>'BusBookingController@pasengerDetails']);
                Route::post('book/bus',['as'=>'book.bus.now','uses'=>'BusBookingController@bookBus']);
            });
        });

        Route::group(['namespace'=>'BookingStatus','prefix'=>'bookingstatus'], function(){
            Route::group(['module'=>'booking-status'], function(){
                Route::get('flight',['as'=>'booked.flights.list','uses'=>'BookingStatusController@bookedFlights','action'=>'flight-status']);
                Route::get('cancel-flight/{booking_id}/{source}',['as'=>'cancel.flight.booking','uses'=>'BookingStatusController@cancelFlight','action'=>'cancel-flight']);
            }); 
        });

        Route::group(['namespace'=>'ApiSettings','prefix'=>'apisettings'], function(){

            Route::group(['module'=>'flight-markup'], function(){

                Route::get('/flight-search',['as'=>'search.flight','uses'=>'FlightApiController@index','action'=>'flight-markup']);
                Route::post('/flight-search-api',['as'=>'search.flight.api','uses'=>'FlightApiController@searchFlight','action'=>'search-flight']);

                //Ajax Routes
                Route::post('/set-flight-markup',['as'=>'set.flight.markup','uses'=>'FlightApiController@setFlightMarkup']);
                Route::post('/flight-visibility',['as'=>'set.flight.visibility','uses'=>'FlightApiController@setFlightVisibility']);
                Route::post('/set-amount-by',['as'=>'set.amount.by','uses'=>'FlightApiController@setFlightAmountBy']);
            });

            Route::group(['module'=>'hotel-markup'], function(){
                Route::get('/hotel-markups',['as'=>'hotel.markups','uses'=>'HotelApiController@index','action'=>'hotel-markups']);
                Route::post('/save-markup',['as'=>'save.markup','uses'=>'HotelApiController@saveMarkup']);
                Route::get('/delete-markup/{id}',['as'=>'delete.markup','uses'=>'HotelApiController@deleteMarkup']);

                //Ajax
                Route::get('/countries-list',['as'=>'countries.list','uses'=>'HotelApiController@getCountriesList']);
                Route::get('/cities-list',['as'=>'cities.list','uses'=>'HotelApiController@getCitiesList']);
            });

            Route::group(['module'=>'bus-markup'], function(){
                Route::match(['get','post'],'/bus-markups',['as'=>'bus.markups','uses'=>'BusApiController@index','action'=>'bus-markups']);
                Route::get('/bus_destination',['as'=>'destination.list','uses'=>'BusApiController@get_bus_destination']);
                Route::post('/save/bus-markups',['as'=>'save.bus-markups','uses'=>'BusApiController@saveBusMarkup']);
                Route::get('/delete/bus-markup/{id}',['as'=>'delete.bus_markup','uses'=>'BusApiController@delete']);
            });
        });
        Route::match(['get','post'],'/payment/response/{next_route}',['as'=>'admin.payment.response','uses'=>'PaymentProcess\PaymentProcessController@paymentResponse']);
    });

    Route::get('login', ['as'=>'admin.login','uses'=>'Auth\LoginController@showLoginForm']);
    Route::post('login',['as'=>'login','uses'=>'Auth\LoginController@login']);
    Route::get('logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);
});

Route::group(['namespace'=>'Customers','prefix'=>'customers'], function(){
    Route::group(['module'=>'customers'], function(){
        Route::post('create',['as'=>'create.customer','uses'=>'CustomerController@create']); 
        Route::post('login_by_email',['as'=>'login.by.email.mobile','uses'=>'CustomerController@loginByEmailOrMobile']); 
        Route::post('login',['as'=>'login.customer','uses'=>'CustomerController@login']);
        Route::get('logout',['as'=>'logout.customer','uses'=>'CustomerController@logout']);
        Route::group(['middleware'=>'customer'], function(){
            Route::match(['get','post'],'myaccount',['as'=>'customer.account','uses'=>'CustomerController@myAccount']);
        });
    });
});


Route::group(['namespace'=>'website'], function(){
    //Route::post('/book_status','WebsiteController@check_status');
    Route::get('/check_status','WebsiteController@check_status')->name('check.status');
    Route::post('check_status','WebsiteController@hotel_book_status')->name('book.status');
     Route::get('/cancel-hotel-booking/{bref}','WebsiteController@cancel_hotel_booking')->name('cancel.hotel.book');
    Route::post('recheck-hotel/{parm?}','WebsiteController@hotel_recheck')->name('hotel.recheck');
    Route::get('flight_city/{parm?}','FlightController@flight_city')->name('flight.city');
    Route::get('flight_city_code/{parm?}','FlightController@city_code')->name('flight.citycode');
    
    Route::get('bus_city_source/{parm?}','BusCitySourceController@bus_city')->name('bus.city');
    Route::get('bus_destination/{parm?}','BusCitySourceController@get_bus_destination')->name('bus.destination');


    Route::get('bus_city_id/{parm?}','BusCitySourceController@get_city_id')->name('bus.city.id');
    Route::get('bus-pay-response','BusCitySourceController@pay_response')->name('bus.pay');

Route::post('bus-fare-payment','BusCitySourceController@bus_payment')->name('bus.payment');
    // Route::get('/book/{code}', ['uses'=>'WebsiteController@hotel_book'])->name('hotel.book');

    Route::match(['get','post'],'/book/hotel',['as'=>'book.customer.hotel.now','uses'=>'WebsiteController@hotel_payment']);

    Route::post('/payment', ['uses'=>'WebsiteController@payment'])->name('hotel.payment');
    
    Route::match(['get','post'],'/hotel-payment', ['uses'=>'WebsiteController@hotel_payment'])->name('hotel.final.book');
    //Route::match(['get','post'],'/book_info/{processing_id?}', ['uses'=>'WebsiteController@final_book'])->name('hotel.final.book');
   
    Route::post('/non-bundle-booking', ['uses'=>'WebsiteController@non_bundle_booking'])->name('hotel.nonbunde.book');



    Route::any('/confirm_book', ['uses'=>'WebsiteController@booking_confirm'])->name('hotel.confirm.book');
    Route::any('/book', ['uses'=>'WebsiteController@hotel_book'])->name('hotel.book');
    Route::get('/hotel/{sid}/{code}', ['uses'=>'WebsiteController@hotel_detail'])->name('hotel.detail');

    Route::get('/get_search/{parm?}', ['uses'=>'WebsiteController@search_data'])->name('search.city');
    Route::get('/get_code/{parm?}', ['uses'=>'WebsiteController@get_code'])->name('city.code');
    Route::get('/', ['as'=>'index','uses'=>'WebsiteController@index']);

    Route::match(['get','post'],'search/results',['as'=>'search.results','uses'=>'WebsiteController@searchResults']);
    Route::match(['get','post'],'search/bus',['as'=>'bus.search','uses'=>'BusCitySourceController@searchResults']);
    Route::match(['get','post'],'search/flight',['as'=>'flight.search','uses'=>'FlightController@searchResults']);

    Route::match(['get','post'],'advance-search/results',['as'=>'advance.search.results','uses'=>'FlightController@advance_search']);

    //Route::match(['get','post'],'flight/detail',['as'=>'flight.details','uses'=>'WebsiteController@flightDetails']);
    Route::match(['get','post'],'flight/detail',['as'=>'flight.details','uses'=>'FlightController@flightDetails']);
    // Route::match(['get','post'],'/book/flight/{book_status?}',['as'=>'book.customer.flight.now','uses'=>'WebsiteController@bookFlightNow']);
    Route::match(['get','post'],'/book/flight/{book_status?}',['as'=>'book.customer.flight.now','uses'=>'FlightController@bookFlightNow']);


    Route::get('flight/book/success',['as'=>'fight.book.success','uses'=>'WebsiteController@flightBookedSuccess']);
    
    
    
    
    Route::post('bus/seat/details/{bus_id}',['as'=>'bus.seat.details','uses'=>'BusCitySourceController@getSeatDetails']);
    Route::post('bus/block_key',['as'=>'bus.block','uses'=>'BusCitySourceController@generate_block_key']);
    Route::match(['get','post'],'/bus/passengers',['as'=>'bus.booking.passengers','uses'=>'BusCitySourceController@busBokingPassenger']);
   Route::match(['get','post'],'books/bus',['as'=>'webste.book.bus','uses'=>'BusCitySourceController@bookBus']);
    Route::match(['get','post'],'/hotel/results',['as'=>'hotels.results','uses'=>'WebsiteController@hotelsResults']);
});
// Route::get('signup',['as'=>'register.user','uses'=>'Customers\CustomerController@RegisterUserWebsite']);
Route::post('customer/register/save',['as'=>'customer.register','uses'=>'Customers\CustomerController@registerNewCustomerWebsite']);

// Route::get('login',['as'=>'login.user','uses'=>'Customers\CustomerController@loginUserWebsite']);
Route::post('login/user',['as'=>'login.user.account','uses'=>'Customers\CustomerController@loginUser']);




Route::match(['get','post'],'/bus-search',['as'=>'bus.api','uses'=>'FlightSearchController@searchForBusses']);
Route::get('hotel/cities',['as'=>'hotel.cities','uses'=>'Website\WebsiteController@getCities']);



Route::group(['namespace'=>'Agency','prefix'=>'agency'], function(){

        Route::get('login', 'LoginController@show_login')->name('agency.login');
        Route::post('login', 'LoginController@check_login')->name('agency.login.check');
        Route::get('logout', 'LoginController@logout')->name('agency.logout');
        Route::get('ag', 'LoginController@agency')->middleware('agency')->name('agency');

    //hotel Markup
    
        Route::get('agent', 'AgenyHotelMarkup@index')->name('agency.markup');

});

        //Users
        /*Route::get('users',['as'=>'list.users','uses'=>'UserController@index']);
        Route::get('users/create',['as'=>'list.users','uses'=>'UserController@create']);
        Route::post('user/save',['as'=>'save.user','uses'=>'UserController@save']);*/