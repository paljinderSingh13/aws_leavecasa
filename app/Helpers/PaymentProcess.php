<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 08-05-2018
 * Time: 07:52
 */

namespace App\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;
use App\Helpers\TransactionRequest;
use App\Model\PaymentRequest;
use App\Model\Wallets;
use Auth;


class PaymentProcess{

    protected $transRequest;


    // https://payment.atomtech.in/paynetz/epi/fts?login=197&pass=Test@123&ttype=NBFundTransfer&prodid=ACME_B2C&amt=1&txncurr=INR&txnscamt=0&clientcode=007&txnid=123&custacc=1234567890&date=21/08/2019&ru=http://127.0.0.1:8000/book_info

    public function __construct(){
        $this->transRequest = new TransactionRequest();
        $this->transRequest->setMode("live");
        $this->transRequest->setLogin(62125);
        $this->transRequest->setPassword("ACME@123");
        $this->transRequest->setProductId("ACME_B2C");
        $this->transRequest->setTransactionCurrency("INR");
    }

    public static function wallet_balance(){
         $wallet =  Wallets::select('available_balance')->where('customer_id', Auth::guard('customer')->id());
        if($wallet->exists()){
             $available_balance = $wallet->orderBy('id','desc')->first()->available_balance;
             if(empty($available_balance)){
                $available_balance =0;
             }
            return $available_balance;
        }
     return 0;


    }
public static function debit_wallet_balance($debit_money , $type=null){

            $balance = self::wallet_balance();

            $wallet = new Wallets();
            $wallet->debited = $debit_money;
            $wallet->customer_id = Auth::guard('customer')->id();
            $wallet->available_balance = $balance - $debit_money;
            if(!empty($type)){
                $wallet->type = $type;
            }else{
                $wallet->type = "Air Ticket";
            }
            if(!empty($booking_id)){
                $wallet->booking_id = $booking_id;

            }
            $wallet->save();

            return $wallet->id;
}




    public static function process($optionsArray){
        $object = new self;
        $requestId = $object->putRequestIntoDatabase($optionsArray);
        // dd($optionsArray['return_to'].'&processing_id='.$requestId);
        $optionsArray['return_to'] = $optionsArray['return_to'];//.'/'.$requestId;
        $object->transRequest->setAmount($optionsArray['amount']);
        $object->transRequest->setTransactionAmount($optionsArray['amount']);
        $object->transRequest->setReturnUrl($optionsArray['return_to']);
        $object->transRequest->setClientCode($optionsArray['client_code']);
        $object->transRequest->setTransactionId($optionsArray['transaction_id']);
        $object->transRequest->setTransactionDate($optionsArray['transaction_date']);
        $customerDetails = $optionsArray['customer_details'];
        $object->transRequest->setCustomerName($customerDetails['customer_name']);
        $object->transRequest->setCustomerEmailId($customerDetails['customer_email']);

        if(!empty($customerDetails['customer_mobile'])){
            $object->transRequest->setCustomerMobile($customerDetails['customer_mobile']);
        }
        
        $object->transRequest->setCustomerBillingAddress($customerDetails['billing_address']);
        $object->transRequest->setCustomerAccount($customerDetails['customer_account_id']);
        $object->transRequest->setReqHashKey("d67e3cad147adab333");
        $url = $object->transRequest->getPGUrl();
        return $url;
    }

    protected function putRequestIntoDatabase($optionsArray){
        $model = new PaymentRequest;
        $model->payment_for = 'flight_book_for_admin';
        $model->amount_to_pay = $optionsArray['amount'];
        $model->transaction_id = $optionsArray['transaction_id'];
        $model->transaction_date = \Carbon\Carbon::now()->format('Y-m-d');
        $model->customer_id = $optionsArray['customer_details']['customer_account_id'];
        $model->request_send = json_encode($optionsArray);
        $model->save();
        return $model->id;
    }

}