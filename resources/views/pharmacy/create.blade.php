<!-- Create Pharmacy Modal -->
<div class="modal fade" id="createPharmacyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Pharmacy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('pharmacies.store') }}" id="create-pharmacy-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="createPharmacyId" class="form-label">ID</label>
                        <input name="id" class="form-control" id="createPharmacyId" value="">
                    </div>
                    <div class="mb-3">
                        <label for="createPharmacyName" class="form-label">Owner Name</label>
                        <input name="name" class="form-control" id="createPharmacyName" value="">
                    </div>
                    <div class="mb-3">
                        <label for="createPharmacyEmail" class="form-label">Owner Email</label>
                        <input name="email" class="form-control" id="createPharmacyEmail" value="">
                    </div>
                    <div class="mb-3">
                        <label for="createPharmacyPassword" class="form-label">Password</label>
                        <input name="password" class="form-control" type="password" id="createPharmacyPassword" value="">
                    </div>
                    <div class="mb-3">
                        <label for="createPharmacyPriority" class="form-label">Priority</label>
                        <input name="priority" class="form-control" id="createPharmacyPriority" value="">
                    </div>
                    <div class="mb-3">
                        <label for="createPharmacyArea" class="form-label">Area</label>
                        <select name="area_id" id="createPharmacyArea" class="form-control">
                            <option value="" disabled selected hidden></option>
                            @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->User->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input name="avatar_image" type="file" class="form-control" id="avatar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script>
    function showCreateModal(event) {
            event.preventDefault();
            event.stopPropagation();
            $('#createPharmacyID').val("");
            $('#createPharmacyName').val("");
            $('#createPharmacyEmail').val("");
            $('#createPharmacyArea').val("");
            $('#createPharmacyPriority').val("");
        }
</script> --}}
