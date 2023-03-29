@extends('layouts.app')

@section('content')

<section class="content">
      <div class="container-fluid">
        {{-- {{@dd( $dataTable->table())}} --}}
        {{ $dataTable->table() }}
      </div>
      <!-- delete moadal -->
    <div class="modal fade" id="del-model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel"><i
                            class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Waring</h5>
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
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Area</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="POST" id="edit-form" enctype="multipart/form-data" >
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="areaId" class="form-label">Area ID</label>
                            <input name="areaId" class="form-control" id="areaId"
                                value="" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="areaName" class="form-label">Area Name</label>
                            <input name="areaName" class="form-control" id="areaName"
                                value="" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="areaAddress" class="form-label">Area Address</label>
                            <input name="areaAddress" class="form-control" id="areaAddress"
                                value="" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary text-white">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>

@endsection

@push('scripts')
{{ $dataTable->scripts() }}

<script>
    function deletemodalShow(event){
        event.preventDefault();
        event.stopPropagation();
        let deleteBtnModal = document.querySelector("#delete");
            deleteBtnModal.onclick = function() {
                event.target.closest("form").submit();
        }
    }

    function editmodalShow(event){
        event.preventDefault();
        event.stopPropagation();
        var itemId = event.target.id;        
        $.ajax({
            url: "{{ route('areas.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                $('#areaId').val(response.area[0].area_id)
                $('#areaName').val(response.area[0].name)
                $('#areaAddress').val(response.area[0].address)
            }
        });
        var route="{{ route('areas.show', ':id') }}".replace(':id', itemId);
        document.getElementById("edit-form").action = route;
    }
</script>


@endpush