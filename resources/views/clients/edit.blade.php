<div class="modal fade" id="client-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body row g-3">
                    <div class="col-md-12 ">
                        <label for="avatar" class="form-label">Upload Image </label>
                        <input name="avatar_image" class="form-control client-input" type="file" id="avatar"
                            accept=".jpg,.png">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-name" class="form-label">Name</label>
                        <input name="name" class="form-control client-input" id="client-name" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-email" class="form-label">Email</label>
                        <input name="email" class="form-control client-input" id="client-email" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-id" class="form-label">Natioanl ID</label>
                        <input name="id" class="form-control client-input" id="client-id" value="" readonly>
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-birthdate" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control client-input" name="date_of_birth"
                            id="client-birthdate" min="1860-01-01" max="2023-01-01" value="" />
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
                        <label for="client-phone" class="form-label">Phone Number</label>
                        <input name="phone" class="form-control client-input" id="client-phone" value="">
                    </div>
                    {{-- <div class="col-md-6 ">
                        <label for="postal" class="form-label">Postal Code</label>
                        <select name="area_id" id="postal" class="form-select" aria-label="Default select example">
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
                        <input name="building_no" class="form-control client-input" id="building" value="">
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
                    </div> --}}
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
                <input name="user_id" class="form-control client-input" id="userid" value="" hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white" onclick="editForm(event)">Edit</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    function deleteAddress(event) {
        event.preventDefault();
        event.stopPropagation();
        var del_btn = event.target;
        if (del_btn.getAttribute("data-clicked") == "false") {
            del_btn.classList.replace("btn-danger", "btn-info");
            del_btn.setAttribute("data-clicked", true);
            del_btn.innerHTML = "Un-delete";
        } else {
            del_btn.classList.replace("btn-info", "btn-danger");
            del_btn.setAttribute("data-clicked", false);
            del_btn.innerHTML = "delete";
        }
    }
    function editForm(event)
    {
      
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
                $('#client-name').val(response.user.name)
                $('#client-email').val(response.user.email)
                $('#client-id').val(response.client.id)
                $('#client-gender').val(response.client.gender)
                $('#client-phone').val(response.client.phone)
                // $('#postal').val(response.client.area_id)
                // $('#street').val(response.client.street_name)
                // $('#building').val(response.client.building_no)
                // $('#floor').val(response.client.floor_number)
                // $('#flat').val(response.client.flat_number)
                // $('#main').prop('checked', response.client.is_main);
                // $('#main').val('checked', response.client.is_main);
                $('#client-birthdate').val(response.client.date_of_birth)
                $('#userid').val(response.user.id)
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
                             <button type="button" class="btn btn-success rounded">edit</button>
                             <form method="post" class="delete_item" id="option_a3" action="${address.id}" style="display:inline-block;">
                               @csrf
                               @method('DELETE')
                              <button  data-clicked="false" type="button" class="btn btn-danger rounded"onclick="deleteAddress(event)">delete</button>
                             </form>
                            </td>    
                        </tr>
                        `;
                    table_body.append(record);
                }
                $("#client-editAddresses").append(table_body);
            }
        });

        var route = "{{ route('clients.update', ':id') }}".replace(':id', itemId);
        document.getElementById('edit-form').action = route;

    }
</script>
