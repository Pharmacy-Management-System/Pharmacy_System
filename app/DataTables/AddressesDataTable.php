<?php

namespace App\DataTables;

use App\Models\Address;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AddressesDataTable extends DataTable
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
            ->addColumn('action', 'addresses.action')
            ->addColumn('client-name', function (Address $address) {
                return $address->client->user->name;
            })
            ->addColumn('client-email', function (Address $address) {
                return $address->client->user->email;
            })
            ->addColumn('area-id', function (Address $address) {
                return $address->area->id;
            })
            ->addColumn('area-name', function (Address $address) {
                return $address->area->name;
            })
            ->addColumn('is_main', function (Address $address) {
                 if($address->is_main) {
                    return '<img src="'. asset("dist/img/icons/Success-Mark-icon.png") .'" width="30" class="img-circle" align="center" />';
                }
                else{
                    return '<img src="'. asset("dist/img/icons/Failed-Mark-icon.png") .'" width="30" class="img-circle" align="center" />';
                }
            })
            ->rawColumns(['is_main'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Address $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Address $model): QueryBuilder
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
            ->setTableId('addresses-table')
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
            Column::computed('id','ID')->addClass('text-center')->addClass('align-middle'),
            Column::computed('client-name', 'Client Name')->addClass('text-center')->addClass('align-middle'),
            Column::computed('client-email', 'Client Email')->addClass('text-center')->addClass('align-middle'),
            Column::computed('area-id', 'Postal Code')->addClass('text-center')->addClass('align-middle'),
            Column::computed('area-name', 'Area Name')->addClass('text-center')->addClass('align-middle'),
            Column::make('street_name')->addClass('text-center')->addClass('align-middle'),
            Column::make('building_number')->addClass('text-center')->addClass('align-middle'),
            Column::make('floor_number')->addClass('text-center')->addClass('align-middle'),
            Column::make('flat_number')->addClass('text-center')->addClass('align-middle'),
            Column::computed('is_main')->addClass('text-center')->addClass('align-middle'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Addresses_' . date('YmdHis');
    }
}