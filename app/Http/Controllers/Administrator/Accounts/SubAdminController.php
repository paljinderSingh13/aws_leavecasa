<?php

namespace App\Http\Controllers\Administrator\Accounts;

use App\DataTables\Administrator\Accounts\SubAdminDataTable;
use App\Model\Administrator\Accounts\AdminSubadminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SubAdminController extends Controller
{
    /**
     * @param SubAdminDataTable $dataTable
     * @return mixed
     */
    public function index(SubAdminDataTable $dataTable){

        return $dataTable->render('administrator.accounts.sub-admins.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('administrator.accounts.sub-admins.create');
    }

    /**
     * @param $request
     * @param null $from
     */
    protected function validateSubadminRequest($request, $from = null){
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:admin_subadmin_users,email',
            'role_id' => 'required',
            'contact_no' => 'required',
            'password' => 'required|min:8'
        ];
        if($from == 'update'){
            $rules['email'] = 'required';
            unset($rules['password']);
        }

        $this->validate($request,$rules);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request){
        $this->validateSubadminRequest($request);
        $model = new AdminSubadminUser;
        if($request->has('is_whitelist') && $request->is_whitelist == 'yes'){
            $model->is_whitelist = true;
        }else{
            $model->is_whitelist = false;
        }
        $model->fill($request->except(['password','is_whitelist']));
        $model->password = \Hash::make($request->password);
        $model->save();
        Session::flash('Success','Success|Sub-Admin created successfully!');
        return redirect()->route('subadmin.list');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $model = AdminSubadminUser::find($id);
        return view('administrator.accounts.sub-admins.edit',['model'=>$model]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id){
        $this->validateSubadminRequest($request,'update');
        $model = AdminSubadminUser::find($id);
        if($request->has('is_whitelist') && $request->is_whitelist == 'yes'){
            $model->is_whitelist = true;
        }else{
            $model->is_whitelist = false;
        }
        $model->fill($request->except(['password','is_whitelist']));
        if($request->has('password') && $request->password != null){
            $model->password = \Hash::make($request->password);
        }
        $model->save();
        Session::flash('Success','Success|Sub-Admin updated successfully!');
        return redirect()->route('subadmin.list');
    }


    public function delete($id){
        //Functionality done after sometime
    }
}
