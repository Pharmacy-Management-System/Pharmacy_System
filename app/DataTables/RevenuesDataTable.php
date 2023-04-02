<?php

namespace App\DataTables;

use App\Models\Pharmacy;
use App\Models\Revenue;
use Attribute;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use League\CommonMark\Extension\Attributes\Node\Attributes;
use PhpParser\Node\Stmt\Return_;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RevenuesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

        ->addColumn('Pharmacy Name', function (Revenue $revenue) {
            return $revenue->pharmacy->user->name;
        })
        ->addColumn('Avatar',function(Revenue $revenue){
            return '<img src="'. asset("storage/pharmacies_Images/".$revenue->pharmacy->avatar_image) .'" width="40" class="img-circle" align="center" />';
        })
        ->rawColumns(['Avatar'])
        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Revenue $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Revenue $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('revenues-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns()
    {
        return [
                    Column::computed('Avatar')->addClass('text-center'),
                    Column::computed('Pharmacy Name')->addClass('text-center'),
                    Column::make('total_order')->addClass('text-center')->title('Total Order'),
                    Column::make('total_revenue')->addClass('text-center')->title('Total Revenue')
                ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Revenue_' . date('YmdHis');
    }
}
