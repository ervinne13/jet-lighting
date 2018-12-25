<?php

namespace App\DataTables;

use Illuminate\Support\Facades\DB;
use Jet\Domain\System\Service\Builder\TrackingNumberBuilder;
use Yajra\DataTables\Services\DataTable;

/**
 * Since we're not using eloquent in our domains/infra,
 * use eloquent directly here until we have an alternative.
 */
class TrackingNumbersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('is_active', function ($model) {              
                return view('lib.datatable.is-active-status-badge', ['isActive' => $model->is_active]);
            })
            ->editColumn('updated_at', function ($model) {
                return nullable_display_date($model->updated_at);        
            })
            ->addColumn('action', function($model) {
                return view('lib.datatable.static-actions', [
                    'id'    => $model->code,
                    'route' => '/tracking-numbers'
                ]);
            })
            ->rawColumns(['is_active', 'action']);
    }

    
    public function query()
    {
        $columns = array_column($this->getColumns(), 'name');
        $query = DB::table('tracking_numbers')
                ->leftJoin('modules', 'modules.code', '=', 'tracking_numbers.module_code')
                ->select(...$columns);
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])                    
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'title' => 'Tracking Code',
                'data'  => 'code',                
                'name'  => 'tracking_numbers.code',
            ],
            [
                'title' => 'Module',
                'data'  => 'name',                
                'name'  => 'modules.name',
            ],
            [
                'title' => 'Current Number',
                'data'  => 'current_number',                
                'name'  => 'tracking_numbers.current_number',
            ],
            [
                'title' => 'Status',
                'data'  => 'is_active',                
                'name'  => 'tracking_numbers.is_active',
            ],
            [
                'title' => 'Last Updated',
                'data'  => 'updated_at',                
                'name'  => 'tracking_numbers.updated_at',
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'TrackingNumbers_' . date('YmdHis');
    }
}
