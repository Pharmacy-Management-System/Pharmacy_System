<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('areas.store')}}" id="create-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="areaId" class="form-label">Postal Code</label>
                        <input name="id" class="form-control" id="create_areaId" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="areaName" class="form-label">Area Name</label>
                        <input name="name" class="form-control" id="create_areaName" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="areaAddress" class="form-label">Area Address</label>
                        <input name="address" class="form-control" id="create_areaAddress" value="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Create</button>
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