<?php

namespace App\Http\Controllers\Administrator\PaymentProcess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PaymentRequest;
use Route;
use Session;
class PaymentProcessController extends Controller
{
    public function paymentResponse(Request $request){
        if($request->f_code == 'Ok'){
            $model = PaymentRequest::find($request->processing_id);
            $model->request_response = json_encode($request->all());
            $model->payment_status = 'success';
            $model->save();
            $actionMethods = '';
            $routeCollection = Route::getRoutes();
            foreach($routeCollection as $key => $value){
                if($value->getName() == 'book.flight.api'){
                    $action = $value->getAction()['controller'];
                    $actionMethods = explode('@',$action);
                }
            }
            $requestData = json_decode(Session::get('request'));
            $controllerObject = new $actionMethods[0];
            return redirect()->route('book.flight.api');
            $controllerObject->{$actionMethods[1]}();
            
        }elseif($request->f_code == 'F'){
            dd('Failed');
        }
    }
}
