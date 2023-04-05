<?php

namespace App\DataTables;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
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

        ->addColumn('Pharmacy Name', function (Pharmacy $pharmacy) {
            return $pharmacy->pharmacy_name;
        })
        ->addColumn('Avatar',function(Pharmacy $pharmacy){
            return '<img src="'. asset("storage/pharmacies_Images/".$pharmacy->avatar_image) .'" width="40" class="img-circle" align="center" />';
        })
        ->addColumn('Total Orders', function (Pharmacy $pharmacy) {
            return DB::table('orders')->where('pharmacy_id',$pharmacy->id)
                                             ->where('status','Delivered')->count();
        })
        ->addColumn('Total Revenue', function (Pharmacy $pharmacy) {
            return DB::table('orders')->where('pharmacy_id',$pharmacy->id)
                                             ->where('status','Delivered')->sum('price') . ' $';
        })
        ->rawColumns(['Avatar'])
        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pharmacy $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pharmacy $model): QueryBuilder
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
                    Column::computed('Avatar')->addClass('text-center')->addClass('align-middle'),
                    Column::computed('Pharmacy Name')->addClass('text-center')->addClass('align-middle'),
                    Column::computed('Total Orders')->addClass('text-center')->addClass('align-middle'),
                    Column::computed('Total Revenue')->addClass('text-center')->addClass('align-middle')
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