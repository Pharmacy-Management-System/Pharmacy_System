
<div class="modal fade" id="editPharmacyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Pharmacy Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-pharmacy-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pharmacyId" class="form-label">Pharmacy ID</label>
                        <input name="pharmacy_id" class="form-control" id="pharmacyId" value="">
                    </div>
                    <div class="mb-3">
                        <label for="pharmacyName" class="form-label">Pharmacy Name</label>
                        <input name="name" class="form-control" id="pharmacyName" value="">
                    </div>
                    <div class="mb-3">
                        <label for="pharmacyAddress" class="form-label">Pharmacy Address</label>
                        <input name="address" class="form-control" id="pharmacyAddress" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Update</button>
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
