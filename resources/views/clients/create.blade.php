<div class="modal fade" id="create-client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('clients.store')}}" id="create-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row g-3">
                    <div class="col-md-12 ">
                        <label for="avatar" class="form-label">Upload Image </label>
                        <input name="avatar_image" class="form-control" type="file" id="avatar" accept=".jpg,.png">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-name" class="form-label">Name</label>
                        <input name="name" class="form-control" id="client-name" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-email" class="form-label">Email</label>
                        <input name="email" class="form-control" id="client-email" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-password" class="form-label">Password</label>
                        <input name="password" class="form-control" id="client-password" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-id" class="form-label">Natioanl ID</label>
                        <input name="id" class="form-control" id="client-id" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-phone" class="form-label">Phone Number</label>
                        <input name="phone" class="form-control" id="client-phone" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-birthdate" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth" id="client-birthdate" min="1860-01-01" max="2023-01-01"/>
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-gender" class="form-label">Gender</label>
                        <select name="gender" id="client-gender" class="form-select "
                            aria-label="Default select example">
                            <option selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6 ">
                        <label for="postal" class="form-label">Postal Code</label>
                        <select name="area_id" id="postal" class="form-select " aria-label="Default select example">
                            <option selected>Select Area</option>
                            @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 ">
                        <label for="street" class="form-label">Street Name</label>
                        <input name="street_name" class="form-control" id="street" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="building" class="form-label">Building Number</label>
                        <input name="building_no" class="form-control" id="building" value="">
                    </div>
                    <div class="col-md-6">
                        <label for="floor" class="form-label">Floor Number</label>
                        <input name="floor_number" class="form-control" id="floor" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="flat" class="form-label">Flat Number</label>
                        <input name="flat_number" class="form-control" id="flat" value="">
                    </div>
                    <div class="col-md-6  ms-4">
                        <input class="form-check-input" name="is_main" type="checkbox" id="main" value="1">
                        <label class="form-check-label" for="gridCheck">
                            Main Street
                        </label>
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

@push('scripts')
<script>

</script>
@endpush