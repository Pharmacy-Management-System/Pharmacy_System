@extends('layouts.app')

@section('title')
/ Client Addresses
@endsection

@section('content')
    <section class="content">

        <div class="container">
            {{ $dataTable->table() }}
        </div>

    </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
