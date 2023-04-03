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
            ->addColumn(
                'action',
                '
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <button type="button" class="btn btn-primary rounded me-2" onclick="orderShow(event)" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#showOrder">show</button>
                <button type="button" class="btn btn-success rounded me-2"  id="{{$id}}" onclick="editmodalShow(event)" data-bs-toggle="modal" data-bs-target="#modEdit">edit</button>
                <form method="post" class="delete_item me-2" action="{{Route("orders.destroy",$id)}}">
                        @csrf
                        @method("DELETE")
                        <button type="button" class="btn btn-danger rounded delete-area" onclick="deleteOrderModel(event)" data-bs-toggle="modal" data-bs-target="#delOrder">delete</button>
                    </form>
                </div>'
            )
            ->addColumn('Pharmacy', function (Order $order) {
                return $order->pharmacy->pharmacy_name;
            })
            ->addColumn('name', function (Order $order) {
                return $order->user->name;
            })
            ->addColumn('doctor_id', function (Order $order) {
                return $order->doctor->user->name;
            })
            // ->addColumn('order_med', function (Order $order) {
            //     return $order->medicines;
            // })
            // ->addColumn('medicine', function (Order $order) {
            //     foreach ($order->medicines as $medicine) {
            //         $medicines[] = $medicine->name;
            //     }
            //     return $medicines;
            // })
            // ->addColumn('quantity', function (Order $order) {
            //     foreach ($order->medicines as $medicine) {
            //         $medicines[] = $medicine->pivot->quantity ;
            //     }
            //     return  $medicines;
            // })

            // ->addColumn('total Price', function (Order $order) {
            //     $totalPrice=0;
            //     foreach ($order->medicines as $medicine) {
            //         $totalPrice += ($medicine->price)*($medicine->pivot->quantity) ;
            //     }
            //     return  $totalPrice;
            // })
            ->addColumn('is_insured', function (Order $order) {
                return $order->is_insured ? 'yes' : 'no';
            })

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
            return $model->newQuery()->whereHas('pharmacy', function ($query) {
                $query->where('doctor_id', Auth::user()->doctor->id);
            });
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
            // Column::computed('order_med'),
            Column::make('id'),
            Column::computed('name')->title('client name'),
            Column::make('status'),
            Column::computed('is_insured')->title('insured'),
            Column::computed('doctor_id')->title('doctor'),
            // Column::make('delivering_address'),
            // Column::computed('medicine'),
            // Column::computed('quantity'),
            Column::make('price'),
        ];
        if (Auth::user()->hasRole('admin')) {
            $columns = array_merge($columns, [
                Column::make('creator_type')->title('Creator'),
                Column::computed('Pharmacy'),
            ]);
        }
        $columns[] = Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width(60)
        ->addClass('text-center');

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
