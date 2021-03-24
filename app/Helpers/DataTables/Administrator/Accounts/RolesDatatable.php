<?php

namespace App\DataTables\Administrator\Accounts;

use App\Model\Administrator\Accounts\AdminUserRole;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RolesDatatable extends DataTable
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
            ->addColumn('action', function($model){
                return view('administrator.accounts.roles._action',['model'=>$model]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AdminUserRole $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AdminUserRole $model)
    {
        return $model->newQuery()->select($this->getColumns());
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
                            ['width'=>'20%','targets'=>[0]],
                            ['width'=>'20%','targets'=>[1]],
                            ['width'=>'20%','targets'=>[2]],
                            ['width'=>'20%','targets'=>[3]]
                            
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
            'role_name',
            'description',
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
        return 'administratoraccountsrolesdatatable_' . time();
    }
    
}
