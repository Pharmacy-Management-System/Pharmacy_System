<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('medicines.store') }}" id="create-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="medName" class="form-label visually-hidden">Medicine Name</label>
                        <input name="name" class="form-control" id="create_medName" placeholder="Medicine Name" value="">
                    </div>
                    <div class="mb-2">
                        <label for="medType" class="form-label visually-hidden">Medicine Type</label>
                        <input name="type" class="form-control" id="create_medType" placeholder="Medicine Type" value="">
                    </div>
                    <div class="mb-2">
                        <label for="medQuntity" class="form-label visually-hidden">Medicine Quantity</label>
                        <input name="quantity" class="form-control" id="create_medQuntity" placeholder="Medicine Quantity" value="">
                    </div>
                    <div class="mb-2">
                        <label for="medPrice" class="form-label visually-hidden">Price Per One Item</label>
                        <input name="price" class="form-control" id="create_medPrice" placeholder="Price Per One Item" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
