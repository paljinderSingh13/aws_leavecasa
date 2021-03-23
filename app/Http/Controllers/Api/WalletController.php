<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wallets;
use App\Helpers\PaymentProcess;

/**
 * 
 */
class WalletController extends Controller
{
	
	public function  creadit(Request $request){
		

		 	$balance =  $this->balance($request->customer_id);
            $wallet = new Wallets();
            $wallet->credited = $request['credited'];
            $wallet->customer_id = $request['customer_id'];
            $wallet->available_balance = $balance +  $request['credited'];
            $wallet->type = "credited by wallet";
            $wallet->save();
            if(!empty($wallet->id)){
            	return response()->json(['message'=>"successfully add in amount"]);
            }else{

            	return response()->json(['message'=>"something goes wrong"]);
            	
            }

            

	}

	public function  debited(Request $request){

		 	$balance =  $this->balance($request->customer_id);



            $wallet = new Wallets();
            $wallet->debited = $request->debit_money;
            $wallet->customer_id = $request->customer_id;
            $wallet->available_balance = $balance - $request->debit_money;
            $wallet->type = $request->type;
            $wallet->booking_id = $request->booking_id;
            $wallet->save();

           if(!empty($wallet->id)){
            	return response()->json(['message'=>"successfully debit amount"]);
            }else{

            	return response()->json(['message'=>"something goes wrong"]);
            	
            }
		

	}


	public function  balance($cid){
		
		
		$wallet =	Wallets::select('available_balance')->where('customer_id', $cid);
	 	if($wallet->exists()){
	    	 $available_balance = $wallet->orderBy('id','desc')->first()->available_balance;
	    	 if(empty($available_balance)){
	    	 	$available_balance =0;
	    	 }
	    	return $available_balance;
	 	}

	 return 0;
   

	}

	public function  detail($cid){

		$wallet = 	Wallets::where('customer_id', $cid);
		if($wallet->exists()){
			$wallet = $wallet->get();
			return response()->json(['data'=>$wallet]);
		}
		return response()->json(['message'=>"no trasaction existed"]);
		
	}






}