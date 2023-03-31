@extends('layouts.app')

@section('content')
    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger pb-0 ">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-success rounded me-2" onclick="createmodalShow(event)" data-bs-toggle="modal"
                data-bs-target="#create-client">Create New Client</button>
        </div>
        <div class="container-fluid">
            {{-- {{@dd( $dataTable->table())}} --}}
            {{ $dataTable->table() }}
        </div>
        @include('clients.delete')
        @include('clients.show')
        @include('clients.edit')
        @include('clients.create')
    </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        function createmodalShow(event) {
            event.preventDefault();
            event.stopPropagation();
            $('input').val("")
        }
        
    </script>
@endpush
