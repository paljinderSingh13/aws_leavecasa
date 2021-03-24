<?php

namespace App\Http\Controllers\Administrator\Employee;

use App\Model\Administrator\Employee\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index(){
        $model = Employee::orderBy('id','asc')->get();
        return view('administrator.employee.index',['model'=>$model]);
    }

    public function create(){
        return view('administrator.employee.create');
    }

    protected function validateEmployeeRequest($request, $from = 'create'){
        $rules = [
            'employee_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'bio' => 'required',
            'designation' => 'required'
        ];
        if($from == 'create'){
            $rules['password'] = 'required';
        }

        $this->validate($request,$rules);
    }

    public function saveEmployee(Request $request){
        $this->validateEmployeeRequest($request);
        $model = new Employee;
        $model->fill($request->except(['password']));
        $model->password = \Hash::make($request->password);
        $model->save();
        \Session::flash('success','Success|Employee created successfully!');
        return redirect()->route('employee.list');
    }
    
    public function edit($id){
        $model = Employee::find($id);
        return view('administrator.employee.edit',['model'=>$model]);
    }

    public function update(Request $request, $id){
        $this->validateEmployeeRequest($request,'update');
        $model = Employee::find($id);
        $model->fill($request->except(['password']));
        if($request->has('password') && $request->pasword != null){
            $model->password = \Hash::make($request->password);
        }
        $model->save();
        \Session::flash('success','Success|Employee updated successfully!');
        return redirect()->route('employee.list');

    }
}
