<?php

namespace App\Http\Middleware;

use Closure;
use App\Agency;
use Session;
use App\Model\Administrator\Agency\AgencyMarkup;


class CheckSubdomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // dd($request->agency);

       $agency =  Agency::where('sub_domain',$request->agency);

       // dd($agency->exists());

       if($agency->exists()){
            
          $data = $agency->first();


          Session::put('agency_id', $data->id);
          Session::put('agency_name', $data->name);
          Session::put('agency_image',$data->image);
          Session::put('agency_image_path',$data->file_path);

          $mark = AgencyMarkup::find(1);
          Session::put('agency_hotel_markup',$mark['markup_hotel']);
          Session::put('agency_flight_markup',$mark['markup_flight']);
          Session::put('agency_bus_markup',$mark['markup_bus']);

          // dd($mark);

          //dump(Session::has('agency_image'), Session::get('agency_image'));
         
       }else{

          dump("not register agency");
          dd('restriced ');
       }
        return $next($request);
    }
}
