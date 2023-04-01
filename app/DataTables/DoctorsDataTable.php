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
            <button type="button" class="btn btn-success rounded me-2" onclick="editmodalShow(event)" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#edit">edit</button>
            <button type="button" class="btn btn-primary rounded me-2" onclick="doctorshowmodalShow(event)" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#show-doctor">show</button>
            <form method="post" class="delete_item me-2"  id="option_a3" action="{{Route("doctors.destroy",$id)}}">
                    @csrf
                    @method("DELETE")
                    <button type="button" class="btn btn-danger rounded delete-area" onclick="deletemodalShow(event)" id="delete_{{$id}}" data-bs-toggle="modal" data-bs-target="#del-model">delete</button>
                </form>
            </div>'
            )
            ->addColumn('name', function (Doctor $doctor) {
                return $doctor->user->name;
            })
            ->addColumn('email', function (Doctor $doctor) {
                return $doctor->user->email;
            })
            ->addColumn('pharmacy', function (Doctor $doctor) {
                return $doctor->pharmacy->user->name;
            })
            ->setRowId('id');
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


    public function getColumns(): array
    {
        return [
            Column::computed('id', 'National ID'),
            //Column::make('id')->title('National ID'),
            Column::computed('name', 'Name'),
            //Column::make('user.name')->title('Name'),
            Column::computed('email', 'Email'),
            //Column::make('user.email')->title('Email'),
            Column::make('pharmacy','Assigned Pharmacy'),
            Column::make('is_banned'),
            Column::make('avatar_image'),
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
