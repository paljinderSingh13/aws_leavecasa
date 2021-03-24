<?php

namespace App\Http\Controllers\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use App\Agency;


class LoginController extends Controller
{
    //
     // protected $guard = 'guest';

     public function __construct()
    {
        $this->middleware('guest:agency')->except('logout');
    }

    public function show_login(){


        return view('agency.login'); 
    // 	$data = ['name'=>"paljinder", 'image'=>"img.jpg", 'address'=>"address 123", 'state'=>"punjab", 'city'=>13, 'contact_no'=>123, 'email'=>"agency@gmail.com",  'gst_no'=>13, 'status'=>1];

    // 			$a =	new Agency();
				// $a->fill($data);
				// $a->password = Hash::make(123456);
				// $a->save(); Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])
    	//Auth::guard('agency')->attempt(['email'=>'agency@gmail.com','password'=>123456]);
    			//dd('here');
    }

    public function check_login(Request $request){

        

        if(Auth::guard('agency')->attempt(['email'=>$request->email,'password'=>$request->password])){
           
            return back();//redirect()->route('agency.markup');
        }else{

            return back();
        }



    }

    public function agency(){

    	dump(Auth::guard('agency')->check());
    }

    public function logout(){

        Auth::guard('agency')->logout();
        return redirect()->route('agency.login');
    }
}
