@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-success rounded me-2" data-bs-toggle="modal"
        data-bs-target="#createOrder">Create New Order</button>
</div>

<div class="container-fluid">
    {{ $dataTable->table() }}
</div>
@include('order.create')

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
       
    </script>
@endpush
