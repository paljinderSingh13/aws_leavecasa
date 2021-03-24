<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 17-04-2018
 * Time: 15:22
 */

namespace App\Helpers;
use App\Model\Administrator\Accounts\AdminUserMeta As UserMeta;

class AdminUserMeta
{

    public function putAdminUserMeta(Array $dataArray, $recordId):boolean{
        foreach($dataArray as $key => $columns){
            $model = UserMeta::firstOrNew(['user_id'=>$recordId, 'column_key' => $key]);
            $model->save();
        }
        return true;
    }
}