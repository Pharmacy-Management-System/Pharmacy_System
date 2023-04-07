<?php

namespace App\DataTables;

use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Hoa\Console;
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

            ->addColumn('Name', function (Doctor $doctor) {
                return $doctor->user->name;
            })
            ->addColumn('Email', function (Doctor $doctor) {
                return $doctor->user->email;
            })
            ->addColumn('Assigned Pharmacy', function (Doctor $doctor) {
                return $doctor->pharmacy->pharmacy_name;
            })
            ->addColumn('avatar',function(Doctor $doctor){
                return '<img src="'. asset("storage/doctors_Images/".$doctor->avatar_image) .'" width="40" class="img-circle" align="center" />';
            })
            ->addColumn('Created At', function (Doctor $doctor) {
                return $doctor->created_at->format('Y-m-d');
            })
            ->addColumn(
                'actions',
                '<div class="d-flex flex-row justify-content-center btn-group btn-group-toggle" data-toggle="buttons">
                                <div class="d-flex flex-row gap-2">
                                    <div>
                                        <button type="button" class="btn btn-success rounded" onclick="editmodalShow(event)" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#edit">Edit</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary rounded" onclick="doctorshowmodalShow(event)" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#show-doctor">Show</button>
                                    </div>
                                    @if(!Auth::user()->hasRole("doctor"))
                                    <div>
                                        <form method="post" class="delete_item" action="{{Route("doctors.destroy",$id)}}">
                                            @csrf
                                            @method("DELETE")
                                            <button type="button" class="btn btn-danger rounded delete-area" onclick="deletemodalShow(event)" id="delete_{{$id}}" data-bs-toggle="modal" data-bs-target="#del-model">Delete</button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                          </div>'
            )
            ->addColumn('is_banned', function (Doctor $doctor) {
                if($doctor->user->isBanned()) {
                    return '<img src="'. asset("dist/img/icons/Success-Mark-icon.png") .'" width="30" class="img-circle" align="center" />';
                }
                else{
                    return '<img src="'. asset("dist/img/icons/Failed-Mark-icon.png") .'" width="30" class="img-circle" align="center" />';
                }
            })
            ->addColumn('Ban/UnBan', function (Doctor $doctor) {
                $buttonText = $doctor->user->isBanned() ? 'Unban' : 'Ban';
                $buttonClass = $doctor->user->isBanned() ? 'btn-success' : 'btn-danger';
                $formMethod = $doctor->user->isBanned() ? 'unban' : 'ban';
                $formAction = route('doctors.'.$formMethod, $doctor->id);

                return '
                    <form method="POST" action="'.$formAction.'">
                        '.csrf_field().'
                        <button type="submit" class="btn '.$buttonClass.'">'.$buttonText.'</button>
                    </form>
                ';
            })
            ->rawColumns(['avatar', 'actions','is_banned','Ban/UnBan'])
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
        $user = auth()->user();
        if ($user->hasRole('pharmacy')) {
            $pharmacyId = $user->pharmacy->id;
            return $model->newQuery()->where('pharmacy_id', $pharmacyId)->withBanned();
        }
        elseif($user->hasRole('admin')){
            return $model->newQuery()->withBanned();
        }else{
            return $model->newQuery()->where('user_id', $user->id);
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
            ->setTableId('doctors-table')
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


    public function getColumns(): array
    {
        $columns = [
            Column::make('avatar')->addClass('text-center')->addClass('align-middle'),
            Column::make('id')->title('National ID')->addClass('text-center')->addClass('align-middle'),
            Column::computed('Name')->addClass('text-center')->addClass('align-middle'),
            Column::computed('Email')->addClass('text-center')->addClass('align-middle'),
            Column::computed('Created At','Created At')->addClass('text-center')->addClass('align-middle')->width(100)
            ];
        if (auth()->user()->hasRole('admin')) {
            $columns[] = Column::computed('Assigned Pharmacy')->addClass('text-center')->addClass('align-middle');
            $columns[] = Column::computed('is_banned','Is Banned')->addClass('text-center')->addClass('align-middle');
            $columns[] = Column::computed('Ban/UnBan')->addClass('text-center')->addClass('align-middle');
        }
        elseif (Auth::user()->hasRole('pharmacy')) {
            $columns[] = Column::computed('is_banned','Is Banned')->addClass('text-center')->addClass('align-middle');
            $columns[] = Column::computed('Ban/UnBan')->addClass('text-center')->addClass('align-middle');
        }

        $columns[] = Column::computed('actions')->addClass('align-middle')->addClass('text-center');

        return $columns;
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
