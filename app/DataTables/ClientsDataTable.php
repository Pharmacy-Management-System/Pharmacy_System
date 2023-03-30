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
            ->addColumn(
                'action',
                '
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <button type="button" class="btn btn-success rounded me-2" onclick="editmodalShow(event)" id="{{$area_id}}" data-bs-toggle="modal" data-bs-target="#edit">edit</button>
                <button type="button" class="btn btn-primary rounded me-2" onclick="clientshowmodalShow(event)" id="{{$national_id}}" data-bs-toggle="modal" data-bs-target="#show-client">delete</button>

                    <form method="post" class="delete_item me-2"  action="{{Route("clients.destroy",$national_id)}}">
                        @csrf
                        @method("DELETE")
                        <button type="button" class="btn btn-danger rounded delete-client" onclick="clientdeletemodalShow(event)" id="delete_{{$national_id}}" data-bs-toggle="modal" data-bs-target="#client-del-model">delete</button>
                    </form>
                </div>
                '
            )
            ->addColumn('name', function (Client $client) {
                return $client->user->name;
            })
            ->addColumn('email', function (Client $client) {
                return $client->user->email;
            })
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
            Column::computed('name', 'Name'),
            Column::computed('email', 'Email'),
            Column::make('gender'),
            Column::make('phone'),
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
        return 'Clients_' . date('YmdHis');
    }
}
