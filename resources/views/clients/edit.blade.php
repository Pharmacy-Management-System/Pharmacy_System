<div class="modal fade" id="client-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Client Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body row g-3">
                    <div class="col-md-6 ">
                        <label for="client-name" class="form-label">Name</label>
                        <input name="name" class="form-control client-input" id="client-edit-name" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-email" class="form-label">Email</label>
                        <input name="email" class="form-control client-input" id="client-edit-email" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-id" class="form-label">Natioanl ID</label>
                        <input name="id" class="form-control client-input" id="client-edit-id" value="" readonly>
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-birthdate" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control client-input" name="date_of_birth"
                            id="client-edit-birthdate" min="1860-01-01" max="2023-01-01" value="" />
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-gender" class="form-label">Gender</label>
                        <select name="gender" id="client-edit-gender" class="form-select "
                            aria-label="Default select example">
                            <option selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-phone" class="form-label">Phone Number</label>
                        <input name="phone" class="form-control client-input" id="client-edit-phone" value="">
                    </div>
                    <div class="col-md-12 ">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input name="avatar_image" class="form-control client-input" type="file" id="edit-avatar"
                            accept=".jpg,.png">
                    </div>
                </div>
                <input name="user_id" class="form-control client-input" id="userid" value="" hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="show-addresses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Client Address Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success rounded me-2 mb-4" onclick="createnewaddress(event)"
                        data-bs-toggle="modal" data-bs-target="#create-address">Add New Address</button>
                </div>
                <table class="table table-striped  table-bordered" id="client-editAddresses">
                    <thead>
                        <tr>
                            <th scope="col">Postal Code</th>
                            <th scope="col">Area Name</th>
                            <th scope="col">Street Name</th>
                            <th scope="col">Building Number</th>
                            <th scope="col">Floor Number</th>
                            <th scope="col">Flat Number</th>
                            <th scope="col">Main Street</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="client-edit-addresses"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="address-cancel" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="address-del-model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                <button id="delete-address" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="address-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="address-edit-form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body row g-3">
                    <div class="col-md-6 ">
                        <label for="postal" class="form-label">Area Name</label>
                        <select name="area_id" id="postal" class="form-select"
                            aria-label="Default select example">
                            <option selected>Select Area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 ">
                        <label for="street" class="form-label">Street Name</label>
                        <input name="street_name" class="form-control client-input" id="street" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="building" class="form-label">Building Number</label>
                        <input name="building_number" class="form-control client-input" id="building"
                            value="">
                    </div>
                    <div class="col-md-6">
                        <label for="floor" class="form-label">Floor Number</label>
                        <input name="floor_number" class="form-control client-input" id="floor" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="flat" class="form-label">Flat Number</label>
                        <input name="flat_number" class="form-control client-input" id="flat" value="">
                    </div>
                    <div class="col-md-6  ms-4">
                        <input class="form-check-input client-input" name="is_main" type="checkbox" id="main"
                            value="">
                        <label class="form-check-label" for="gridCheck">
                            Main Street
                        </label>
                    </div>
                </div>
                <input name="user_id" class="form-control client-input" id="userid" value="" hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="create-address" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('addresses.store') }}" id="create-form"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body row g-3">
                    <div class="col-md-6 ">
                        <label for="postal" class="form-label">Area Name</label>
                        <select name="area_id" id="postal" class="form-select "
                            aria-label="Default select example">
                            <option selected>Select Area</option>
                            @foreach ($areas as $area)
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
                        <input name="building_number" class="form-control" id="building" value="">
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
                        <input class="form-check-input" name="is_main" type="checkbox" id="main"
                            value="1">
                        <label class="form-check-label" for="gridCheck">
                            Main Street
                        </label>
                    </div>
                </div>
                <input name="client_id" class="form-control client-input" id="clientId" value="" hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function clientaddressshowmodalShow(event) {
        var itemId = event.target.id;
        $('#clientId').val(itemId)
        $('#client-edit-addresses').empty();
        $.ajax({
            url: "{{ route('clients.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                console.log(response.addresses)
                var table_body = $('#client-edit-addresses')
                for (var address of response.addresses) {
                    var mainStreet = (address.is_main) ? "yes" : "no"
                    var record = `
                        <tr>
                            <td>${address.area_id}</td>
                            <td>${address.area_name}</td>
                            <td>${address.street_name}</td>
                            <td>${address.building_number}</td>
                            <td>${address.floor_number}</td>
                            <td>${address.flat_number}</td>
                            <td>${mainStreet}</td>
                            <td>
                             <button type="button" class="btn btn-success rounded" onclick="clientaddresseditmodalShow(event)" id="${address.id}" data-bs-toggle="modal" data-bs-target="#address-edit">edit</button>
                             <form method="post" class="delete_item" id="address-delete-form" action="" style="display:inline-block;">
                               @csrf
                               @method('DELETE')
                               <button type="button" class="btn btn-danger rounded delete-client" onclick="deleteAddress(event)" id="${address.id}" data-bs-toggle="modal" data-bs-target="#address-del-model">delete</button>
                             </form>
                            </td>
                        </tr>
                        `;
                    table_body.append(record);
                }
                $("#client-editAddresses").append(table_body);
            }
        })

    }

    function clientaddresseditmodalShow(event) {
        $('#address-cancel').trigger("click");
        var itemId = event.target.id;
        $('.client-input').val("")
        $.ajax({
            url: "{{ route('addresses.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                var address = response.address[0]
                $('#postal').val(address.area_id)
                $('#street').val(address.street_name)
                $('#building').val(address.building_number)
                $('#floor').val(address.floor_number)
                $('#flat').val(address.flat_number)
                $('#main').prop('checked', address.is_main);
                $('#main').val('checked', address.is_main);
            }
        });
        var route = "{{ route('addresses.update', ':id') }}".replace(':id', itemId);
        document.getElementById('address-edit-form').action = route;
    }

    function deleteAddress(event) {
        $('#address-cancel').trigger("click");
        event.preventDefault();
        event.stopPropagation();
        let deleteBtnModal = document.querySelector("#delete-address");
        deleteBtnModal.onclick = function() {
            var id = event.target.id;
            var route = "{{ route('addresses.destroy', ':id') }}".replace(':id', id);
            document.getElementById('address-delete-form').action = route;
            event.target.closest("form").submit();
        }
    }

    function createnewaddress(event) {
        $('#address-cancel').trigger("click");
    }

    function clienteditmodalShow(event) {
        var itemId = event.target.id;
        $('.client-input').val("")
        $('#client-edit-addresses').empty();
        $.ajax({
            url: "{{ route('clients.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {

                //$('#image').text(response.client.image)
                $('#client-edit-name').val(response.user.name)
                $('#client-edit-email').val(response.user.email)
                $('#client-edit-id').val(response.client.id)
                $('#client-edit-gender').val(response.client.gender)
                $('#client-edit-phone').val(response.client.phone)
                $('#client-edit-birthdate').val(response.client.date_of_birth)
                $('#edit-userid').val(response.user.id)
            }
        });

        var route = "{{ route('clients.update', ':id') }}".replace(':id', itemId);
        document.getElementById('edit-form').action = route;
    }

    setTimeout(function() {
        $('.alert-success').fadeOut();
    }, {{ session('timeout') }});
</script>
