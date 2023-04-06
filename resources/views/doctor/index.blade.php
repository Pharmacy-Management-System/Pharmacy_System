@extends('layouts.app')

@section('title')
/ Doctors
@endsection

@section('content')

<section class="content container">

    @if (session('error'))
        <div id ="alert-message" class="alert alert-danger my-4 alert-dismissible">
            {{ session('error') }}
            <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger pb-0 alert-dismissible">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
    </div>
    @endif

    @if(session('success'))
        <div id ="alert-message" class="alert alert-success mb-4 mb-0 alert-dismissible">
            {{ session('success') }}
            <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="container-fluid">
    @role('admin|pharmacy')
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-success rounded me-2" onclick="createmodalShow(event)" data-bs-toggle="modal" data-bs-target="#create">Add New Doctor</button>
        </div>
    @endrole
        {{ $dataTable->table() }}
    </div>


    <!-- Create Doctor Moadal -->
    @include('doctor.create')

    <!-- Show Doctor Moadal -->
    @include('doctor.show')

    <!-- Edit Doctor Moadal -->
    @include('doctor.edit')

    <!-- Delete Doctor Moadal -->
    @include('doctor.delete')


</section>

@endsection


@push('scripts')
{{ $dataTable->scripts() }}
<script>
setTimeout(function() {
            $('.alert-success').fadeOut();
        }, {{ session('timeout') }});
</script>
@endpush


