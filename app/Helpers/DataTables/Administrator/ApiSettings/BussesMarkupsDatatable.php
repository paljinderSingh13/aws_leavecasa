<?php

namespace App\DataTables\Administrator\ApiSettings;

use App\Model\Administrator\ApiSettings\BussesMarkup;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class BussesMarkupsDatatable extends DataTable
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

        return $dataTable->addColumn('action', function($model){
            return view('administrator.api_settings.bus-booking._action',['model'=>$model]);
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Model\Administrator\ApiSettings\BussesMarkup $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BussesMarkup $model)
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
                    ['width'=>'15%','targets'=>[2]],
                    ['width'=>'20%','targets'=>[3]]

                ],
                'responsive' => true,
                'fixedHeader' => true,
                // 'keys' => true,
                'select' => true,
                'autoFill' => true,
                'colReorder' => true
                // 'rowReorder' => true
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
            'source',
            'destination',
            'amount_by',
            'amount_or_percent',
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
        return 'administratorapisettingsbussesmarkupsdatatable_' . time();
    }
}
