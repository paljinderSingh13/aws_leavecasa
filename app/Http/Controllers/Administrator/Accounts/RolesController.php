<?php

namespace App\Http\Controllers\Administrator\Accounts;

use Illuminate\Http\Request;
use App\DataTables\Administrator\Accounts\RolesDatatable;
use App\Model\Administrator\Accounts\AdminUserRole;
use App\Http\Controllers\Controller;
use Session;
class RolesController extends Controller
{
    public function index(RolesDatatable $datatable){

        return $datatable->render('administrator.accounts.roles.index');
    }
    
    /**
     * Crete New Role
     * @return [type] [description]
     */
    public function create(){
        return view('administrator.accounts.roles.create');
    }

    /**
     * Save New Role
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Rahul
     */
    public function save(Request $request){
        $this->validateRole($request);
        $model = new AdminUserRole;
        $model->fill($request->all());
        $model->save();
        Session::flash('success','Success|Role creates successfully!');
        return redirect()->route('roles.list');
    }

    /**
     * To validate role post request
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    protected function validateRole($request){
        $rules = [
            'role_name' => 'required'
        ];
        $this->validate($request,$rules);
    }

    /**
     * Edit existing role
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id){
        $model = AdminUserRole::find($id);
        return view('administrator.accounts.roles.edit',['model'=>$model]);
    }

    /**
     * Update existing user role
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id){
        $this->validateRole($request);
        $model = AdminUserRole::find($id);
        $model->fill($request->all());
        $model->save();
        Session::flash('success','Success|Role updated successfully!');
        return redirect()->route('roles.list');
    }

    /**
     * Delete role
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id){
        if($id != 4){
            $model = AdminUserRole::find($id);
            $model->delete();
            Session::flash('success','Success|Role deleted successfully!');
            return redirect()->route('roles.list');
        }else{
            Session::flash('error','Error|You can\'t delete super admin role!');
        }
    }
}
