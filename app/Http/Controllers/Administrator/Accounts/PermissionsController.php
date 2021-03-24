<?php

namespace App\Http\Controllers\Administrator\Accounts;

use App\Model\Administrator\Accounts\Module;
use App\Model\Administrator\Accounts\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.accounts.permissions.index');
    }

    public function actionsList(Request $request){
        $actionsArray = [];
        $routes = \Route::getRoutes();
        foreach($routes->getRoutes() as $key => $route){
            if(@$route->action['module'] != null){
                if(@$route->action['module'] == $request->module){
                    if(!in_array(@$route->action['action'],$actionsArray) && @$route->action['action'] != null){
                        $actionsArray[] = $route->action['action'];
                    }
                }
            }
        }
        $module_id = Module::module_slug_to_id($request->module);
        $permissions = Permission::where(['permission_for'=>'admin','module_id'=>$module_id,'role_id'=>$request->role])->get();
        $existingRouteActions = [];
        foreach($permissions as $key => $permission){
            $existingRouteActions[] = $permission['route_action'];
        }
        $dataArray = [
            'actions' => $actionsArray,
            'module' => $module_id,
            'role' => $request->role,
            'permissions' => $existingRouteActions
        ];
        
        return view('administrator.accounts.permissions.actions-list',$dataArray);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Permission::where(['permission_for'=>$request->permission_for,'module_id'=>$request->module_id,'role_id'=>$request->role])->delete();
        foreach($request->actions as $key => $action){
            $model = new Permission;
            $model->permission_for = $request->permission_for;
            $model->module_id = $request->module_id;
            $model->role_id = $request->role;
            $model->route_action = $key;
            $model->permission = $action;
            $model->save();
        }
        Session::flash('success','Permissions Saved!|Permissions saved successfully!');
        return back();
    }

}
