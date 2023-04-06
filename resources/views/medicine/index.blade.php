@extends('layouts.app')

@section('title')
/ Medicines
@endsection

@section('content')
    <section class="content container">
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

        @if (session('error'))
            <div class="alert alert-danger p-2 mt-3 ">
                {{ session('error') }}
            </div>
        @endif

        @role('admin')
         <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-success rounded me-2" onclick="createmodalShow(event)" data-bs-toggle="modal"
                data-bs-target="#create">Create New Medicine</button>
        </div>
        @endrole


        <div class="container-fluid">
            {{ $dataTable->table() }}
        </div>

        @include('medicine.delete')
        @include('medicine.create')
        @include('medicine.edit')
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        function createmodalShow(event) {
            event.preventDefault();
            event.stopPropagation();
            $('#create_medName').val("")
            $('#create_medType').val("")
            $('#create_medQuntity').val("")
            $('#create_medPrice').val("")
        }

        function editmodalShow(event) {
            event.preventDefault();
            event.stopPropagation();
            $('#edit_medName').val("")
            $('#edit_medType').val("")
            $('#edit_medQuntity').val("")
            $('#edit_medPrice').val("")
            var itemId = event.target.id;
            $.ajax({
                url: "{{ route('medicines.show', ':id') }}".replace(':id', itemId),
                method: "GET",
                success: function(response) {
                    $('#edit_medName').val(response.medicine[0].name)
                    $('#edit_medType').val(response.medicine[0].type)
                    $('#edit_medQuntity').val(response.medicine[0].quantity)
                    $('#edit_medPrice').val(response.medicine[0].price)
                }
            });
            var route = "{{ route('medicines.update', ':id') }}".replace(':id', itemId);
            document.getElementById("edit-form").action = route;
        }

        function deletemodalShow(event) {
            event.preventDefault();
            event.stopPropagation();
            let deleteBtnModal = document.querySelector("#delete");
            deleteBtnModal.onclick = function() {
                event.target.closest("form").submit();
            }
        }
        setTimeout(function() {
            $('.alert-success').fadeOut();
        }, {{ session('timeout') }});
    </script>

@endpush
