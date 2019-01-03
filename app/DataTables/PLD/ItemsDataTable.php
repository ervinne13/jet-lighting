<?php

namespace App\DataTables\PLD;

use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class ItemsDataTable extends DataTable
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
            ->editColumn('image_url', function ($model) {
                return view('modules.pld.items.image-column', ['imageUrl' => $model->image_url]);
            })
            ->addColumn('action', function($model) {
                return view('lib.datatable.static-actions', [
                    'id'    => $model->code,
                    'route' => '/pld/items'
                ]);
            })
            ->rawColumns(['image_url', 'action']);
    }

    
    public function query()
    {
        $query = DB::table('items')
                ->leftJoin('item_categories', 'items.category_id', '=', 'item_categories.id')
                ->select(
                    'items.code', 
                    'items.name as item_name',
                    'items.image_url',
                    'item_categories.name as category_name',
                    'items.updated_at'                    
                );
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
                'title' => 'Item Code',
                'data'  => 'code',                
                'name'  => 'items.code',
            ],
            [
                'title' => 'Name',
                'data'  => 'item_name',                
                'name'  => 'items.name as item_name',
            ],
            [
                'title' => 'Preview',
                'data'  => 'image_url',                
                'name'  => 'items.image_url',
            ],
            [
                'title' => 'Category',
                'data'  => 'category_name',                
                'name'  => 'item_categories.name as category_name',
            ],
            [
                'title' => 'Last Updated',
                'data'  => 'updated_at',                
                'name'  => 'items.updated_at',
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
        return 'Items' . date('YmdHis');
    }
}
