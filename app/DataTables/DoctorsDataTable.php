<?php

namespace App\DataTables;

use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;
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
        ->addColumn(
            'action',
            '
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <button type="button" class="btn btn-success rounded me-2" onclick="editmodalShow(event)" id="{{$national_id}}" data-bs-toggle="modal" data-bs-target="#edit">edit</button>
            <button class="btn btn-primary rounded me-2" id="option_a2"> show </button>
                <form method="post" class="delete_item me-2"  id="option_a3" action="{{Route("doctors.destroy",$national_id)}}">
                    @csrf
                    @method("DELETE")
                    <button type="button" class="btn btn-danger rounded delete-area" onclick="deletemodalShow(event)" id="delete_{{$national_id}}" data-bs-toggle="modal" data-bs-target="#del-model">delete</button>
                </form>
            </div>'
        )
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
        return $model->newQuery()->with('pharmacy.user');
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
        Column::make('national_id'),
        Column::make('pharmacy.user.name')->label('Assigned Pharmacy'),
        Column::make('doctor.user.email')->label('email'),
        Column::make('is_banned'),
        Column::make('avatar'),
        Column::computed('action')
              ->exportable(false)
              ->printable(false)
              ->width(60)
              ->addClass('text-center'),
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
