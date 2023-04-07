<?php

namespace App\DataTables;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MedicinesDataTable extends DataTable
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
            ->addColumn('Price', function (Medicine $medicine) {
                return $medicine->price . ' ¢ '  ;
            })
            ->addColumn(
                'actions',
                '
                @if (auth()->user()->hasRole("admin"))
                    <div class="d-flex flex-row justify-content-center btn-group btn-group-toggle" data-toggle="buttons">
                        <div class="d-flex flex-row gap-1">
                            <button type="button" class="btn btn-success rounded me-2"  onclick="editmodalShow(event)" id="{{$id}}"  data-bs-toggle="modal" data-bs-target="#edit_med">Edit</button>
                            <form method="post" class="delete_item" action="{{Route("medicines.destroy",$id)}}">
                                @csrf
                                @method("DELETE")
                                <button type="button" class="btn btn-danger rounded delete-area" onclick="deletemodalShow(event)" id="delete_{{$id}}" data-bs-toggle="modal" data-bs-target="#del_med">Delete</button>
                            </form>
                        </div>
                    </div>
                @endif'
            )
            ->rawColumns(['actions'])
            ->setRowId('id');
    }


    public function query(Medicine $model): QueryBuilder
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
            ->setTableId('medicine-table')
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
    public function getColumns(): array
    {
        $columns = [
            Column::computed('id','ID')->addClass('text-center')->addClass('align-middle'),
            Column::make('name')->title('Medicine Name')->addClass('text-center')->addClass('align-middle'),
            Column::make('type')->addClass('text-center')->addClass('align-middle'),
            Column::computed('quantity')->addClass('text-center')->addClass('align-middle'),
            Column::computed('Price')->addClass('text-center')->addClass('align-middle')
        ];
        if (auth()->user()->hasRole('admin')) {
            $columns[] = Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->addClass('align-middle');
        }

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Medicines_' . date('YmdHis');
    }
}
