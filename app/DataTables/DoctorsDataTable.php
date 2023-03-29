<?php

namespace App\DataTables;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DoctorsDataTable extends DataTable
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
        ->addColumn('action', function ($row) {
            $button = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" ';
            $button .= 'data-national-id="'.$row->national_id.'" ';
            $button .= 'data-pharmacy-id="'.$row->pharmacy_id.'" ';
            $button .= 'data-national-id="'.$row->national_id.'" ';
            $button .= 'data-pharmacy-id="'.$row->pharmacy_id.'" ';
            $button .= 'data-is-banned="'.($row->is_banned ? 'Yes' : 'No').'" ';
            $button .= '>View</button>';
            return $button;
        })
        ->setRowId('national_id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Doctor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Doctor $model): QueryBuilder
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
                    ->setTableId('doctors-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
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
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('national_id'),
            Column::make('pharmacy_id'),
            Column::make('is_banned'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Doctors_' . date('YmdHis');
    }
}
