@extends('layouts.app')

@section('content')
    <section class="content">
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
        {{-- delete Error --}}
        {{-- when delete area related to other records --}}
        @if (session('error'))
            <div class="alert alert-danger p-2 mt-3 ">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-success rounded me-2" onclick="createmodalShow(event)" data-bs-toggle="modal"
                data-bs-target="#create">Create New Area</button>
        </div>
        <div class="container-fluid">
            {{ $dataTable->table() }}
        </div>
        @include('areas.create')
        @include('areas.delete')
        @include('areas.edit')
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        function createmodalShow(event) {
            event.preventDefault();
            event.stopPropagation();
            $('#create_areaId').val("")
            $('#create_areaName').val("")
            $('#create_areaAddress').val("")
        }

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
            $('#edit_areaId').val("")
            $('#edit_areaName').val("")
            $('#edit_areaAddress').val("")
            var itemId = event.target.id;
            $.ajax({
                url: "{{ route('areas.show', ':id') }}".replace(':id', itemId),
                method: "GET",
                success: function(response) {
                    $('#edit_areaId').val(response.area[0].area_id)
                    $('#edit_areaName').val(response.area[0].name)
                    $('#edit_areaAddress').val(response.area[0].address)
                }
            });
            var route = "{{ route('areas.update', ':id') }}".replace(':id', itemId);
            document.getElementById("edit-form").action = route;
        }
        setTimeout(function() {
            $('.alert-success').fadeOut();
        }, {{ session('timeout') }});
    </script>
@endpush
