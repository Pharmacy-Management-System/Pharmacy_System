<div class="modal fade" id="edit_med" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Medicine Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="medName" class="form-label">Medicine Name</label>
                        <input name="name" class="form-control" id="edit_medName" value="">
                    </div>
                    <div class="mb-3">
                        <label for="medType" class="form-label">Medicine Type</label>
                        <input name="type" class="form-control" id="edit_medType" value="">
                    </div>
                    <div class="mb-3">
                        <label for="medQuntity" class="form-label">Medicine Quantity</label>
                        <input name="quantity" class="form-control" id="edit_medQuntity" value="">
                    </div>
                    <div class="mb-3">
                        <label for="medPrice" class="form-label">Price of one Item</label>
                        <input name="price" class="form-control" id="edit_medPrice" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
