<?php

namespace App\DataTables;

use App\Models\Area;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AreasDataTable extends DataTable
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
        ->addColumn('Country',function(Area $area){
            return  DB::table('countries')->where('id',$area->country_id)->first()->name;
        })
            ->addColumn(
                'actions',
                '<div class="d-flex flex-row justify-content-center btn-group btn-group-toggle" data-toggle="buttons">
                                <div class="d-flex flex-row gap-2">
                                    <div>
                                        <button type="button" class="btn btn-success rounded" onclick="editmodalShow(event)" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#edit">Edit</button>
                                    </div>
                                    <div>
                                        <form method="post" class="delete_item" action="{{Route("areas.destroy",$id)}}">
                                            @csrf
                                            @method("DELETE")
                                            <button type="button" class="btn btn-danger rounded delete-area" onclick="deletemodalShow(event)" id="delete_{{$id}}" data-bs-toggle="modal" data-bs-target="#del-model">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>'
            )

            ->rawColumns(['actions','Country'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Area $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Area $model): QueryBuilder
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
            ->setTableId('areas-table')
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
        return [
            Column::make('id')->addClass('text-center')->addClass('align-middle')->title('Postal Code'),
            Column::computed('Country')->addClass('text-center')->addClass('align-middle'),
            Column::make('name')->addClass('text-center')->addClass('align-middle'),
            Column::make('address')->addClass('text-center')->addClass('align-middle'),
            Column::computed('actions')
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->addClass('align-middle'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Areas_' . date('YmdHis');
    }
}