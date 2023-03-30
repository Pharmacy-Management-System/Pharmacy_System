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
    <!-- delete moadal -->
    <div class="modal fade" id="del-model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Waring</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="delete" type="button" class="btn btn-danger">Delete</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="edit-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nationalId" class="form-label">National ID</label>
                            <input name="national_id" class="form-control" id="nationalId" value="">
                        </div>
                        <div class="mb-3">
                            <label for="pharName" class="form-label">Pharmacy Name</label>
                            <select name="pharmacy_id" class="form-select" id="pharName">
                                @foreach ($pharmacies as $pharmacy)
                                <option value="{{ $pharmacy->id }}">{{ $pharmacy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="banned" class="form-label">Is banned?</label>
                            <input name="is_banned" class="form-control" id="banned" value="">
                        </div>

                        <div class="mb-3">
                            <label for="Avatar" class="form-label">Avatar</label>
                            <input name="avatar" class="form-control" id="Avatar" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary text-white">Edit</button>
                    </div>
                </form>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger pb-0 ">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

</section>

@endsection

@push('scripts')
{{ $dataTable->scripts() }}

<script>
    function deletemodalShow(event) {
        event.preventDefault();
        event.stopPropagation();
        let deleteBtnModal = document.querySelector("#delete");
        deleteBtnModal.onclick = function() {
            event.target.closest("form").submit();
        }
    }

    function editmodalShow(event) {
        event.preventDefault();
        event.stopPropagation();
        var itemId = event.target.id;
        $.ajax({
            url: "{{ route('doctors.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                $('#nationalId').val(response.doctor[0].national_id)
                $('#pharName').val(response.doctor[0].pharmacy_id)
                $('#banned').val(response.doctor[0].is_banned)
                $('#avatar').val(response.doctor[0].avatar)
            }
        });
        var route = "{{ route('doctors.update', ':id') }}".replace(':id', itemId);
        document.getElementById("edit-form").action = route;
    }
</script>
@endpush
