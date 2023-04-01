@extends('layouts.app')

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
        {{ $dataTable->table() }}
    </div>

    <!-- Delete Pharmacy Moadal -->
    @include('pharmacy.delete')

    <!-- Show Pharmacy Moadal -->
    @include('pharmacy.show')

    <!-- Edit Pharmacy Moadal -->
    @include('pharmacy.edit')

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
