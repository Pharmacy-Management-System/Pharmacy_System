@extends('layouts.app')

@section('content')

<section class="content">
    {{-- when delete doctor related to other records --}}
    @if (session('error'))
    <div class="alert alert-danger p-2 mt-3 ">
        {{ session('error') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger pb-0">
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
    <div class="container-fluid">
        {{-- {{@dd( $dataTable->table())}} --}}
        {{ $dataTable->table() }}
    </div>
    <div class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
            Create
        </button>
    </div>
    <!-- delete moadal -->
    @include('doctors.delete')

    <!-- Create Modal -->
    @include('doctors.create')

    <!-- edit moadal -->
    @include('doctors.edit')
    <!------Show modal----->
    @include('doctors.show')

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
