<?php

namespace App\Http\Controllers\Administrator\ApiSettings;

use App\DataTables\Administrator\ApiSettings\HotelMakrupsDataTable;
use App\Model\Administrator\ApiSettings\HotelsMarkup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;

class HotelApiController extends Controller
{
    public function index( ){
        return view('administrator.api_settings.hotel-booking.search');
    }

    public function search(Request $request){
        //
    }

    public function getCountriesList(Request $request){
        $client = new Client();
        $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/countries',[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        return $res->getBody()->getContents();
    }

    public function getCitiesList(Request $request){
        $country = explode('|',$request->country_code);
        $client = new Client();
        $res = $client->request('GET','http://api-sandbox.grnconnect.com/api/v3/cities?country='.$country[0],[
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'b12092d579e8795a77c3abe759d6185f',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'application/json'
            ],
        ]);
        return $res->getBody()->getContents();
    }

    protected  function validateMarkupRequest($request){
        $rules = [
            'country' => 'required',
            'cities' => 'required',
            'amount_by' => 'required',
            'amount' => 'required',
            'visibility' => 'required',
            'ratting' => 'required'
        ];

        $this->validate($request,$rules);
    }

    public function saveMarkup(Request $request){
        $this->validateMarkupRequest($request);
        $model = new HotelsMarkup;
        $country = explode('|',$request->country);
        $city = explode('|',$request->cities);
        $model->country = $country[1];
        $model->country_code = $country[0];
        $model->city = $city[1];
        $model->city_code = $city[0];
        $model->destination = '';
        $model->amount_by = $request->amount_by;
        $model->amount = $request->amount;
        $model->visibility = $request->visibility;
        $model->star_ratting = $request->ratting;
        $model->save();
        \Session::flash('success','Success|Markup Saved Successfully!');
        return back();
    }

    public function deleteMarkup($id){
        $model = HotelsMarkup::find($id);
        $model->delete();
        \Session::flash('success','Success|Markup deleted successfully!');
        return back();
    }
}
