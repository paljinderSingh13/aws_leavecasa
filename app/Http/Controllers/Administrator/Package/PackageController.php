<?php

namespace App\Http\Controllers\Administrator\Package;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Package;
use App\Model\Administrator\Package\Country;
use App\Model\Administrator\Package\City;
use App\Model\Administrator\Package\Duration;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

          $country = Country::pluck('name','id');
          $duration = Duration::pluck('name','day');
          return view('administrator.packages.addPackages',compact('country','duration'));
    }

    public function get_city($country_id){

         $city = City::where(['status'=>1, 'country_id'=>$country_id])->pluck('name','id');
        return view('administrator.packages.city',compact('city','country_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
