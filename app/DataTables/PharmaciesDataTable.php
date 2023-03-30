<?php

namespace App\DataTables;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use PhpParser\Node\Stmt\Return_;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PharmaciesDataTable extends DataTable
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
            ->addColumn('Area',function(Pharmacy $pharmacy){
                return $pharmacy->area->name;
            })
            ->addColumn('Owner Name',function(Pharmacy $pharmacy){
                return $pharmacy->user->name;
            })
            ->addColumn('Owner Email',function(Pharmacy $pharmacy){
                return $pharmacy->user->email;
            })
            ->addColumn(
                'action',
                '
                <div class="d-flex flex-row justify-content-center btn-group btn-group-toggle" data-toggle="buttons">
                    <div class="d-flex flex-row gap-2">
                        <div>
                            <button type="button" class="btn btn-success rounded" onclick="showEditModal(event)" id="{{$pharmacy_id}}" data-bs-toggle="modal" data-bs-target="#editPharmacyModal">
                                Edit
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary rounded" onclick="showPharmacyModal(event)" id="show-{{$pharmacy_id}}" data-bs-toggle="modal" data-bs-target="#showPharmacyModal">
                                Show
                            </button>
                        </div>
                        <div>
                            <form method="post" class="delete_item" action="{{Route("pharmacies.destroy",$pharmacy_id)}}">
                                @csrf
                                @method("DELETE")
                                <button type="button" class="btn btn-danger rounded delete-pharmacy" onclick="showDeleteModal(event)" id="delete_{{$pharmacy_id}}" data-bs-toggle="modal" data-bs-target="#deletePharmacyModal">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>'
            )
            ->setRowId('pharmacy_id');
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
            ->setTableId('pharmacies-table')
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
            Column::make('avatar')->addClass('text-center')->title('Image'),
            Column::make('pharmacy_id')->addClass('text-center')->title('ID'),
            Column::make('Owner Name')->addClass('text-center'),
            Column::make('Owner Email')->addClass('text-center'),
            Column::make('Area')->addClass('text-center'),
            Column::make('priority')->addClass('text-center')->title('Priority'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Pharmacy_' . date('YmdHis');
    }
}