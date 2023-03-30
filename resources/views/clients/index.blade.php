@extends('layouts.app')

@section('content')
    <section class="content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- when delete area related to other records --}}
        @if (session('error'))
            <div class="alert alert-danger p-2 mt-3 ">
                {{ session('error') }}
            </div>
        @endif
        <div class="container-fluid">
            {{-- {{@dd( $dataTable->table())}} --}}
            {{ $dataTable->table() }}
        </div>
        @include('clients.delete')
        @include('clients.show')
    </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
