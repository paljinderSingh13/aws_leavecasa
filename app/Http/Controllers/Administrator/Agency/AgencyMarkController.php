<?php

namespace App\Http\Controllers\Administrator\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrator\Agency\AgencyMarkup;

class AgencyMarkController extends Controller
{
    //

	public function index(){

		$data = AgencyMarkup::find(1);
		// dd($data);
		return view('administrator.agency.markup',compact('data'));
	}

	public function store(Request $request){


		// dd($request->all());

		 AgencyMarkup::find(1)->fill($request->all())->save();

		 return back();

	}


	
}
