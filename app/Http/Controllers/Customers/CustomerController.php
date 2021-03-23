<?php
namespace App\Http\Controllers\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use Hash;
use Session;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Model\FlightLogs;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{
    protected function vlidateRegisterPost($request){
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:customers',
            'password' => 'required',
            'mobile' => 'required|unique:customers',
            'address' => 'required'
        ];

        $this->validate($request,$rules);
    }


public function air_booking_history(){

    $data = FlightLogs::where('customer_id', Auth::guard('customer')->id())->get();
  //  $data1 = BusLogs::where('customer_id', Auth::guard('customer')->id())->get();
    //dump($data->toArray());

    return view('frontend.pages.booking_history',['data'=>$data]);

    

}


    public function create(Request $request){
        $this->vlidateRegisterPost($request);
        $model = new Customer;
        $model->fill($request->except(['password']));
        $model->password = Hash::make($request->password);
        $model->save();
        Session::put('client_id',$model->id);
        Session::flash('success','Customer registered successfully!');
        if($request->has('redirect_to')){
            return redirect()->route($request->redirect_to);
        }else{
            return back();
        }
    }

    protected function validateLoginByEmailPost($request){
        $rules = [];
        if($request->login_email == null && $request->login_mobile == null){
            $rules['login_email'] = 'required';
        }

        $this->validate($request,$rules);
    }

    public function loginByEmailOrMobile(Request $request){
        $this->validateLoginByEmailPost($request);
        $mobile = false;
        $email = false;
        if($request->login_email != null){
            $model = Customer::where('email',$request->login_email)->first();
            $email = true;
        }else{
            $model = Customer::where('mobile',$request->login_mobile)->first();
            $mobile = true;
        }
        if($model != null){
            Session::put('client_id',$model->id);
            return redirect()->route($request->redirect_to);
        }else{
            if($mobile){
                return back()->withErrors(['login_mobile'=>'User having this number not found!'])->withInput($request->all());
            }else{
                return back()->withErrors(['login_email'=>'User with this email not found!'])->withInput($request->all());
            }
        }
    }


    // public function logout(){
    //     Auth::guard('customer')->logout();
    //     return redirect()->route('index');
    // }

    public function myAccount(Request $request){
        if($request->isMethod('post')){
            $model = Customer::find(Auth::guard('customer')->user()->id);
            $model->name = $request->first_name.' '.$request->last_name;            
            $model->mobile = $request->mobile;
            if($request->dob != ''){
                $model->dob = Carbon::parse($request->dob)->format('Y-m-d');
            }
            $model->city = $request->city;
            $model->address = $request->address;
            $model->save();
            Session::flash('success','Profile updated successfully!');
        }
        $model = Auth::guard('customer')->user();
        $explodedName = explode(' ',$model->name);
        $model->first_name = $explodedName[0];

        if(!empty($explodedName[1])){
            $model->last_name = $explodedName[1];
        }
        return view('website.pages.account.myaccount',['model'=>$model]);
    }

    // Api Functions
    public function registerUser(Request $request){
        $validate = $this->validateCustomerCreate($request);
        if ($validate->fails()) {            
            return response()->json([
                'status' => 422,
                'errors' => $validate->errors()
            ]);
        }
        $api_token = str_random(60);
        $model = new Customer;
        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = Hash::make($request->password);
        $model->api_token = $api_token;
        $model->mobile = $request->mobile;
        $model->address = 'Null';
        $model->save();
        return response()->json([
            'status' => 200,
            'message' => 'User Register successfully!',
            'token' => $api_token
        ]);        
    }

    public function customerLogin(Request $request){
        $validate = $this->validateLogin($request);
        if ($validate->fails()) {            
            return response()->json([
                'status' => 422,
                'errors' => $validate->errors()
            ],422);
        }

        $model = Customer::where(['email'=>$request->email])->first();

        if($model == null){
            return response()->json([
                'status' => 403,
                'message' => 'Wrong user details!'
            ],403);
        }

        if(Hash::check($request->password,$model->password)){
            return response()->json([
                'status' => 200,
                'message' => 'User logined successfully!',
                'token' => $model->api_token
            ],200);
        }else{
            return response()->json([
                'status' => 403,
                'message' => 'Wrong user details!'
            ],403);
        }
    }

    protected function validateLogin($request){
        return Validator::make($request->all(), [
          'email' => 'required',
          'password' => 'required'
        ]);
    }

    protected function validateCustomerCreate(Request $request){
        return Validator::make($request->all(), [
          'email' => 'required|unique:customers',
          'name' => 'required',
          'password' => 'required',
          'mobile' => 'required'
        ]);
    }

    public function RegisterUserWebsite(){
        return view('website.pages.register');
    }

    public function registerNewCustomerWebsite(Request $request){
        
        $validate = $this->validateCustomerCreate($request);
        if ($validate->fails()) {            
            return response()->json([
                'status' => 422,
                'message' => $validate->errors()->first()
            ]);
        }
        $api_token = str_random(60);
        $model = new Customer;
        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = Hash::make($request->password);
        $model->api_token = $api_token;
        $model->mobile = $request->mobile;
        $model->address = 'Null';
        $model->save();
        Session::flash('success','Customer registered successfully!');
        return response()->json([
            'status' => 200,
            'message' => 'User Register Successfully!',
            'token' => $api_token
        ]); 
    }

    public function loginUserWebsite(){
        return view('website.pages.login');
    }


    public function register(Request $request){


        
        $validate = $this->validateCustomerCreate($request);
        if ($validate->fails()) {            
            
            return back()->withInput(Input::all());
        }
        $api_token = str_random(60);
        $model = new Customer;
        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = Hash::make($request->password);
        $model->api_token = $api_token;
        $model->mobile = $request->mobile;
        $model->address = 'Null';
        $model->save();

          if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){

            return back();
          }
    }



    public function login(Request $request){

// dd($request->all());

        if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){

            // if(!empty(['redirect'])){
            //     return redirect($request['redirect']);
            // }
            return back();
        }


        return back()->withErrors(['msg'=> 'Invalid Credential']);
    }

    public function loginUser(Request $request){
      //return response()->json(['data'=>$request->all()]);
       // dd($request->all());
     
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

         $this->validate($request,$rules);

        if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
           
            // return redirect()->route('customer.account');
           return response()->json(['status' => 'success', 'message' =>'Login Success' ]);
        }else{
           return response()->json(['status' => 'success', 'message' =>'Invalid Credential' ]);
            // return back();
            // return 0;
        }
    }


    public function logout(){

        Auth::guard('customer')->logout();
        return back();
    }
}
