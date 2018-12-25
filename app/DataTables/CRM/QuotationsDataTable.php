<?php

namespace App\DataTables\CRM;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class QuotationsDataTable extends DataTable
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
            ->editColumn('updated_at', function ($model) {
                return nullable_display_date($model->updated_at);        
            })
            ->addColumn('action', function($model) {
                return view('lib.datatable.static-actions', [
                    'id'    => $model->document_number,
                    'route' => '/crm/client-companies'
                ]);
            })
            ->rawColumns(['is_active', 'action']);
    }

    
    public function query()
    {
        $query = DB::table('quotations')
                ->select(...$this->getColumns());
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
            'document_number',
            'name',
            'contact_person',
            'contact_number',
            'ref_client_document_number',
            'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ClientCompanies_' . date('YmdHis');
    }
}
