@extends('layouts.app')

@section('content')
    <section class="content">

        <div class="container-fluid">
            {{-- {{@dd( $dataTable->table())}} --}}
            {{ $dataTable->table() }}
        </div>
  
    </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
