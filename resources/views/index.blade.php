@extends('layouts.app')

@section('content')

<section class="content">
<<<<<<< HEAD
    <div class="container-fluid">
=======
      <div class="container-fluid0">
        {{ $dataTable->table()}}     
      </div><!--/. container-fluid -->
>>>>>>> 46aade38f77959de3611cb8ef7443cfbd8697923

        {{ $dataTable->table() }}
    </div><!--/. container-fluid -->

    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal tijgjhtle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
{{ $dataTable->scripts() }}
@endpush
