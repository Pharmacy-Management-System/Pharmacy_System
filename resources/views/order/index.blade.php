@extends('layouts.app')

@section('content')

<div class="container-fluid">
    {{ $dataTable->table() }}
</div>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
