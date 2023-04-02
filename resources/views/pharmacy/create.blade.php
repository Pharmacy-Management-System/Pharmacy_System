<!-- Create Pharmacy Modal -->
<div class="modal fade" id="createPharmacyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Pharmacy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  method="POST" action="{{ route('pharmacies.store') }}" id="create-pharmacy-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row gy-2 gx-3 align-items-center">
                    <div class="col-md-12 mb-2">
                        <label for="createPharmacyName" class="form-label visually-hidden">Pharmacy Name</label>
                        <input name="pharmacy_name" type="text" class="form-control" id="createPharmacyName" placeholder="Pharmacy Name" value="">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="createPharmacyId" class="form-label visually-hidden">ID</label>
                        <input name="id" class="form-control" id="createPharmacyId" placeholder="Pharmacy Owner ID" value="">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="createPharmacyOwnerName" class="form-label visually-hidden">Owner Name</label>
                        <input name="name" type="text" class="form-control" id="createPharmacyOwnerName" placeholder="Pharmacy Owner Name" value="">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="createPharmacyEmail" class="form-label visually-hidden">Owner Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="email-icon">@</span>
                            <input name="email" type="email" class="form-control" id="createPharmacyEmail" aria-describedby="email-icon" placeholder="Pharmacy Owner Email" value="">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="createPharmacyPassword" class="form-label visually-hidden">Password</label>
                        <input name="password" class="form-control" type="password" id="createPharmacyPassword" placeholder="Password" value="">
                    </div>
                    <div class="col-12 mb-2">
                        <label for="createPharmacyPriority" class="form-label visually-hidden">Priority</label>
                        <input name="priority" class="form-control" id="createPharmacyPriority" placeholder="Priority" value="">
                    </div>
                    <div class="col-12 mb-2">
                        <label for="createPharmacyArea" class="form-label visually-hidden">Area</label>
                        <select name="area_id" id="createPharmacyArea" class="form-control">
                            <option value="" disabled selected hidden>Choose Area...</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="createPharmacyAvatar" class="form-label visually-hidden">Avatar</label>
                        <input name="avatar_image" type="file" class="form-control" id="createPharmacyAvatar" placeholder="Avatar Image">
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

