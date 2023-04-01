@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-success rounded me-2" onclick="createmodalShow(event)" data-bs-toggle="modal"
        data-bs-target="#create-order">Create New Order</button>
</div>

<div class="container-fluid">
    {{ $dataTable->table() }}
</div>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
