<?php

namespace App\Http\Controllers\Administrator\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return view('administrator.dashboard.dashboard');
    }
}
