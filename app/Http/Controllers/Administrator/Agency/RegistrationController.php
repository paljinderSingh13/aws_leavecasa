<?php

namespace App\Http\Controllers\Administrator\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agency;
use Auth;
use Hash;

class RegistrationController extends Controller
{
    //


    public function agent_list(){


		$data = Agency::all();

		
        return view('administrator.agency.index', compact('data') );
    } 

public function registration(Request $request){


	$request->validate(['name'=>'required',
						'address'=>'required',
						'state'=>'required',
						'city'=>'required',
						'contact_no'=>'required',
						'sub_domain'=>'required|unique:agencies',
						'email'=>'required|unique:agencies',
						'password'=>'required',
						'image' => 'required|max:10000|mimes:jpg,png,jpeg'
						]);


	if($request->hasFile('image')){

		$file =	$request->file('image');
		$image_name = $file->getClientOriginalName();
		$path = public_path().'/images/agency/'.$request->sub_domain;
		$file->move($path , $image_name);
	}

	$a =	new Agency();
	$a->fill($request->all());
	$a->sub_domain = $request->sub_domain;
	if($request->hasFile('image')){
			$a->file_path = '/images/agency/'.$request->sub_domain;
			$a->image = $image_name;

		}
	$a->password = Hash::make($request->password);
	$a->save();

	return redirect()->route('admin.agency.list');
}


	public function status($id , $status){

		if($status ==1){
			$status = 0;
		} else{
			$status = 1;

		}
			Agency::where('id', $id)->update(['status'=>$status]);
		return redirect()->route('admin.agency.list');

	}

	public function edit($id){
		// dd($id);
			$data = Agency::where('id', $id)->first();
			return view('administrator/agency.edit',compact('data')); 
	}
	public function update(Request $request){

		$a =Agency::find($request['id'])->fill($request->all());

		if($request->hasFile('image')){

		$file =	$request->file('image');
		$image_name = $file->getClientOriginalName();
		$path = public_path().'/images/agency/'.$request->sub_domain;
		$file->move($path , $image_name);
		$a->file_path = '/images/agency/'.$request->sub_domain;
		$a->image = $image_name;

		}

		$a->save();
		return redirect()->route('admin.agency.list');
		// dd($request->all());
	}

	public function delete(Request $request){
        $model = Agency::find($request['id']);
        if($model != null){
            $model->delete();
            \Session::flash('success','Success|Agency deleted successfully!');
            return back();
        }else{
            \Session::flash('error','Error|Unable to delete Agency. Try again!');
            return back();
        }
    }
}
