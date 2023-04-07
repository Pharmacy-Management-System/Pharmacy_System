<?php

namespace App\DataTables;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientsDataTable extends DataTable
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
            ->addColumn('avatar',function(Client $client){
                return '<img src="'. asset("storage/clients_Images/".$client->avatar_image) .'" width="40" class="img-circle" align="center" />';
            })
            ->addColumn(
                'actions',
                '
                <div class="d-flex flex-row justify-content-center btn-group btn-group-toggle" data-toggle="buttons">
                    <div class="d-flex flex-row gap-1">
                        <button type="button" class="btn btn-info rounded me-2" onclick="clientaddressshowmodalShow(event)" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#show-addresses">Addresses</button>
                        <button type="button" class="btn btn-success rounded me-2" onclick="clienteditmodalShow(event)" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#client-edit">Edit</button>
                        <button type="button" class="btn btn-primary rounded me-2" onclick="clientshowmodalShow(event)" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#show-client">Show</button>
                        <form method="post" class="delete_item me-2"  action="{{Route("clients.destroy",$id)}}">
                            @csrf
                            @method("DELETE")
                            <button type="button" class="btn btn-danger rounded delete-client" onclick="clientdeletemodalShow(event)" id="delete_{{$id}}" data-bs-toggle="modal" data-bs-target="#client-del-model">Delete</button>
                        </form>
                    </div>
                </div>
                '
            )
            ->addColumn('name', function (Client $client) {
                return $client->user->name;
            })
            ->addColumn('email', function (Client $client) {
                return $client->user->email;
            })
            ->addColumn('Gender', function (Client $client) {
                if($client->gender === 'Female') {
                    return '<img src="'. asset("dist/img/icons/Female-icon.png") .'" width="30" class="img-circle" align="center" />';
                }
                else{
                    return '<img src="'. asset("dist/img/icons/Male-icon.png") .'" width="30" class="img-circle" align="center" />';
                }
            })
            ->rawColumns(['actions','Gender','avatar'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model): QueryBuilder
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
            ->setTableId('clients-table')
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
            Column::computed('avatar')->addClass('text-center')->addClass('align-middle'),
            Column::computed('id', 'National ID')->addClass('text-center')->addClass('align-middle'),
            Column::computed('name', 'Name')->addClass('text-center')->addClass('align-middle'),
            Column::computed('email', 'Email')->addClass('text-center')->addClass('align-middle'),
            Column::make('phone')->addClass('text-center')->addClass('align-middle'),
            Column::computed('Gender')->addClass('text-center')->addClass('align-middle'),
            Column::computed('actions')
                ->printable(false)
                ->width(50)
                ->addClass('text-center')
                ->addClass('align-middle')

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Clients_' . date('YmdHis');
    }
}