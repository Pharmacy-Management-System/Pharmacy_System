<?php

namespace App\DataTables;

use App\Models\Pharmacy;
use Attribute;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\Attributes\Node\Attributes;
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
            ->addColumn('Area', function (Pharmacy $pharmacy) {
                return $pharmacy->area->name;
            })
            ->addColumn('Owner Name', function (Pharmacy $pharmacy) {
                return $pharmacy->user->name;
            })
            ->addColumn('Owner Email', function (Pharmacy $pharmacy) {
                return $pharmacy->user->email;
            })
            ->addColumn('avatar', function (Pharmacy $pharmacy) {
                return '<img src="' . asset("storage/pharmacies_Images/" . $pharmacy->avatar_image) . '" width="40" class="img-circle" align="center" />';
            })
            ->addColumn('actions', function (Pharmacy $pharmacy) {
                if (Auth::user()->hasRole('admin')) {
                    if ($pharmacy->deleted_at) {
                        return "
                        <div class='d-flex flex-row justify-content-center btn-group btn-group-toggle' data-toggle='buttons'>
                                <div class='d-flex flex-row gap-2'>
                                    <div>
                                        <form method='GET' class='restore_item' action='" . Route('pharmacies.restore', $pharmacy->id) . "'>
                                            <button type='submit' class='btn btn-success rounded' onclick='restoreDeletedPharmacy(event)' id='" . $pharmacy->id . " 'data-bs-toggle='modal' data-bs-target='#restorePharmacyModal'>
                                                Restore
                                            </button>
                                        </form>
                                    </div>
                                </div>
                        </div>";
                    } else {
                        return "
                        <div class='d-flex flex-row justify-content-center btn-group btn-group-toggle' data-toggle='buttons'>
                            <div class='d-flex flex-row gap-2'>
                                <div>
                                    <button type='button' class='btn btn-success rounded' onclick='showEditModal(event)' id='" . $pharmacy->id . "' data-bs-toggle='modal' data-bs-target='#editPharmacyModal'>
                                        Edit
                                    </button>
                                </div>
                                <div>
                                    <button type='button' class='btn btn-primary rounded' onclick='showPharmacyModal(event)' id='" . $pharmacy->id . " 'data-bs-toggle='modal' data-bs-target='#showPharmacyModal'>
                                        Show
                                    </button>
                                </div>
                                <div>
                                    <button type='button' class='btn btn-danger rounded delete-pharmacy' onclick='showDeleteModal(event)'
                                            id='" . $pharmacy->id . "' data-bs-toggle='modal' data-bs-target='#deletePharmacyModal'>
                                            Delete
                                    </button>
                                </div>
                            </div>
                        </div>";
                    }
                }
                if (Auth::user()->hasRole('pharmacy')) {

                    return "
                        <div class='d-flex flex-row justify-content-center btn-group btn-group-toggle' data-toggle='buttons'>
                            <div class='d-flex flex-row gap-2'>
                                <div>
                                    <button type='button' class='btn btn-success rounded' onclick='showEditModal(event)' id='" . $pharmacy->id . "' data-bs-toggle='modal' data-bs-target='#editPharmacyModal'>
                                        Edit
                                    </button>
                                </div>
                                <div>
                                    <button type='button' class='btn btn-primary rounded' onclick='showPharmacyModal(event)' id='" . $pharmacy->id . " 'data-bs-toggle='modal' data-bs-target='#showPharmacyModal'>
                                        Show
                                    </button>
                                </div>
                            </div>
                        </div>";
                    }

                })
            ->rawColumns(['avatar', 'actions'])
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
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return $model->newQuery()->withTrashed();
        } else if ($user->hasRole('pharmacy')) {
            return $model->newQuery()->where('user_id', $user->id)->withTrashed();
        }
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
    public function getColumns()
    {
        return [
            Column::computed('avatar')->addClass('text-center')->addClass('align-middle')->title('Avatar'),
            Column::make('pharmacy_name')->addClass('text-center')->addClass('align-middle')->title('Name'),
            Column::make('id')->addClass('text-center')->addClass('align-middle')->title('ID'),
            Column::computed('Owner Name')->addClass('text-center')->addClass('align-middle'),
            Column::computed('Owner Email')->addClass('text-center')->addClass('align-middle'),
            Column::computed('Area')->addClass('text-center')->addClass('align-middle'),
            Column::make('priority')->addClass('text-center')->addClass('align-middle')->title('Priority'),
            Column::computed('actions')
                ->printable(false)
                ->width(60)
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
        return 'Pharmacy_' . date('YmdHis');
    }
    }