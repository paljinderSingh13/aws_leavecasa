<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wallets;
use App\Helpers\PaymentProcess;
use App\Helpers\TransactionResponse;
use Auth;
use Session;
use Carbon\Carbon;

class WalletController extends Controller
{


    public  function add_wallet_from(){

         $balance =  $this->wallet_balance();

           return view('frontend.pages.add_wallet_form',['balance'=>$balance]); 


    } 
    //
    public function save(Request $request){

    	$customer = Auth::guard('customer')->user();
    	$data =	[ 'credited'=>$request['credited'],'type'=>'wallet'];
    	Session::put('wallet_credit', $data);
		  //return redirect()->route('wallet.pay.res');

    	

    		$paymentOptions = [];
            $paymentOptions['payment_for'] ="wallet";
            $paymentOptions['amount'] = $request['credited'];//$request->price;
            $paymentOptions['return_to'] = route('wallet.pay.res');
            $paymentOptions['client_code'] =  13;//$customer_id;
            $paymentOptions['transaction_id'] = md5(rand(100222,999999)*1000);
            $paymentOptions['transaction_date'] = Carbon::now()->format('d/m/Y h:m:s');
            $paymentOptions['customer_details']['customer_name'] = $customer['name'];
            $paymentOptions['customer_details']['customer_email'] =$customer['email'];
            $paymentOptions['customer_details']['customer_mobile'] = 99915482378;//$customer['contact'];
            $paymentOptions['customer_details']['billing_address'] = "amritsar";//$request['AddressLine1'];
            $paymentOptions['customer_details']['customer_account_id'] = $customer['id'];
            $url = PaymentProcess::process($paymentOptions);
    		return redirect($url);
            
        
    }

    public function wallet_payment_response(Request $request){



// 			$wallet_credit = Session::get('wallet_credit');
// 	        $wallet = new Wallets();
// 	        $wallet->credited = $wallet_credit['credited'];
// 	        $wallet->customer_id = Auth::guard('customer')->id();
// 	        $wallet->available_balance = $balance +  $wallet_credit['credited'];
//           $wallet->type = "credited by wallet";
// 	        $wallet->save();


//           return redirect()->route('wallet.detail');



// dd('wallet ',$request->all());
    	  if($request['f_code'] == 'Ok'){

            $balance =  $this->wallet_balance();
    	  	$wallet_credit = Session::get('wallet_credit');
            $wallet = new Wallets();
            $wallet->credited = $wallet_credit['credited'];
            $wallet->customer_id = Auth::guard('customer')->id();
            $wallet->available_balance = $balance +  $wallet_credit['credited'];
            $wallet->type = "credited by wallet";
            $wallet->save();
            return redirect()->route('wallet.detail');
    	  }
        
       

    }

    public function wallet_balance(){

	    $wallet =	Wallets::select('available_balance')->where('customer_id', Auth::guard('customer')->id());
	 	if($wallet->exists()){
	    	 $available_balance = $wallet->orderBy('id','desc')->first()->available_balance;
	    	 if(empty($available_balance)){
	    	 	$available_balance =0;
	    	 }
	    	return $available_balance;
	 	}
	 return 0;
    }


    public function my_wallet_account(){

      // dd(Auth::guard('customer')->id());
     $detail = Wallets::orderBy('id','desc')->where(['customer_id'=>Auth::guard('customer')->id()])->get();

    return view('frontend.pages.wallet_detail',['detail'=>$detail]);



    }
}
