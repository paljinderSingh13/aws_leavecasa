<?php
namespace App\Http\Controllers\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 
 */
class DashboardController  extends Controller
{
	
	

	public function index(){

		// dd(1223);

		return view('agency.dashboard');
	}
}