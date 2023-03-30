@extends('layouts.app')

@section('content')

<section class="content container">

    @if (session('error'))
        <div id ="alert-message" class="alert alert-danger my-4 alert-dismissible">
            {{ session('error') }}
            <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('success'))
        <div id ="alert-message" class="alert alert-success my-4 mb-0 alert-dismissible">
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
    function showDeleteModal(event) {
        event.preventDefault();
        event.stopPropagation();
        let deleteBtnModal = document.querySelector("#deletePharmacy");
        deleteBtnModal.onclick = function() {
            event.target.closest("form").submit();
        }
    }
    function showEditModal(event) {
        event.preventDefault();
        event.stopPropagation();
        var pharmacyId = event.target.id;
        $.ajax({
            url: "{{ route('pharmacies.show', ':id') }}".replace(':id', pharmacyId),
            method: "GET",
            success: function(response) {
                $('#pharmacyId').val(response.pharmacy[0].id)
                $('#pharmacyName').val(response.pharmacy[0].name)
                $('#pharmacyAddress').val(response.pharmacy[0].address)
            }
        });
        var route = "{{ route('pharmacies.update', ':id') }}".replace(':id', pharmacyId);
        document.getElementById("edit-pharmacy-form").action = route;
    }
</script>
@endpush
