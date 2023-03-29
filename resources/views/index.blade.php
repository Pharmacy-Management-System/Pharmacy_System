@extends('layouts.app')

@section('content')

<section class="content">
      <div class="container-fluid">
        {{-- {{@dd( $dataTable->table())}} --}}
        {{ $dataTable->table() }}
      </div><!--/. container-fluid -->

      <div class="modal" id="modal12" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
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