<?php

namespace App\DataTables;

use App\Models\Area;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
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
            ->addColumn('Pharmacy', function (Order $order) {
                if ($order->pharmacy) {
                    return $order->pharmacy->pharmacy_name;
                }
                else return " ";
            })
            ->addColumn('name', function (Order $order) {
                return $order->user->name;
            })
            ->addColumn('doctor_id', function (Order $order) {
                if(isset($order->doctor)){
                    return $order->doctor->user->name;
                }
                else {
                    return " ";
                }
            })
            ->addColumn('is_insured', function (Order $order) {
                if($order->is_insured ) {

                    return '<img src="'. asset("dist/img/icons/Success-Mark-icon.png") .'" width="30" class="img-circle" align="center" />';
                }
                else{
                    return '<img src="'. asset("dist/img/icons/Failed-Mark-icon.png") .'" width="30" class="img-circle" align="center" />';
                }
            })
            ->addColumn('actions', function (Order $order) {
                if($order->status == "New" || $order->status == "Processing"){
                    return "
                    <div class='d-flex flex-row justify-content-center btn-group btn-group-toggle' data-toggle='buttons'>
                            <div class='d-flex flex-row gap-2'>
                                <div>
                                    <button type='button' class='btn btn-success rounded' onclick='editmodalShow(event)' id='" . $order->id . "' data-bs-toggle='modal' data-bs-target='#modEdit'>
                                        Edit
                                    </button>
                                </div>
                                <div>
                                    <button type='button' class='btn btn-primary rounded' onclick='orderShow(event)' id='" . $order->id . " 'data-bs-toggle='modal' data-bs-target='#showOrder'>
                                        Show
                                    </button>
                                </div>
                                <div>
                                    <button type='button' class='btn btn-danger rounded delete-pharmacy' onclick='deleteOrderModel(event)'
                                            id='" . $order->id . "' data-bs-toggle='modal' data-bs-target='#delOrder'>
                                            Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    ";
                }else{
                    return "
                    <div class='d-flex flex-row justify-content-center btn-group btn-group-toggle' data-toggle='buttons'>
                            <div class='d-flex flex-row gap-2'>
                                <div>
                                    <button type='button' class='btn btn-success rounded' onclick='editmodalShow(event)' id='" . $order->id . "' data-bs-toggle='modal' data-bs-target='#modEdit' disabled>
                                        Edit
                                    </button>
                                </div>
                                <div>
                                    <button type='button' class='btn btn-primary rounded' onclick='orderShow(event)' id='" . $order->id . " 'data-bs-toggle='modal' data-bs-target='#showOrder'>
                                        Show
                                    </button>
                                </div>
                                <div>
                                    <button type='button' class='btn btn-danger rounded delete-pharmacy' onclick='deleteOrderModel(event)'
                                            id='" . $order->id . "' data-bs-toggle='modal' data-bs-target='#delOrder' disabled>
                                            Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    ";
                }
    })
    ->rawColumns(['actions','is_insured'])
->setRowId('id');
    }

    public function query(Order $model): QueryBuilder
    {
        if (Auth::user()->hasRole('pharmacy')) {
            return $model->newQuery()->where('pharmacy_id', Auth::user()->pharmacy->id);
        }
        elseif(Auth::user()->hasRole('admin')){
            return $model->newQuery();
        }
        elseif (Auth::user()->hasRole('doctor')) {
            return $model->newQuery()->where('pharmacy_id', Auth::user()->doctor->pharmacy_id);
        }


    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('orders-table')
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
            Column::computed('name')->title('client Name'),
            Column::make('status')->addClass('text-center')->addClass('align-middle'),
            Column::computed('is_insured')->addClass('text-center')->addClass('align-middle'),
            Column::computed('doctor_id')->title('doctor'),
            Column::make('price')->addClass('text-center')->addClass('align-middle'),
        ];
        if (Auth::user()->hasRole('admin')) {
            $columns = array_merge($columns, [
                Column::make('creator_type')->title('Creator')->addClass('text-center')->addClass('align-middle'),
                Column::computed('Pharmacy')->addClass('text-center')->addClass('align-middle'),
            ]);
        }
        $columns[] = Column::computed('actions')
        ->printable(false)
        ->width(60)
        ->addClass('text-center')
        ->addClass('align-middle');

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
