<?php

namespace App\DataTables\Administrator\Accounts;

use App\Model\Administrator\Accounts\AdminSubadminUser;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SubAdminDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable
            ->editColumn('role_id', function($model){
                return $model->role->role_name;
            })
            ->editColumn('is_whitelist', function($model){
                if($model->is_whitelist == 1){
                    return 'Yes';
                }else{
                    return 'No';
                }
            })
            ->addColumn('action', function($model){
                return view('administrator.accounts.sub-admins._action',['model'=>$model]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AdminSubadminUser $model)
    {
        return $model->newQuery()->with(['role'])->select($this->getColumns());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $columns = $this->getColumns();
        unset($columns[0]);
        $columns[3] = ['name'=>'role_id','title'=>'Role','data'=>'role_id'];
        return $this->builder()
            ->columns($columns)
            ->minifiedAjax('')
            ->addAction(['width' => '80px'])
            ->parameters([
                'dom'     => 'Bflrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend'=>'csv','className'=>'btn btn-default'],
                    ['extend'=>'excel','className'=>'btn btn-default'],
                    ['extend'=>'print','className'=>'btn btn-default']
                ],
                'columnDefs' => [
                    ['width'=>'8%','targets'=>[0]],
                    ['width'=>'20%','targets'=>[1]],
                    ['width'=>'13%','targets'=>[2]],
                    ['width'=>'15%','targets'=>[3]]

                ],
                'responsive' => true,
                'fixedHeader' => true,
                'select' => true,
                'autoFill' => true,
                'colReorder' => true
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
            'email',
            'role_id',
            'is_whitelist',
            'contact_no',
            'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'administratoraccountssubadmin_' . time();
    }
}
