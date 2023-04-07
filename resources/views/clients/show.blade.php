<div class="modal fade" id="show-client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Client Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                <div class="flex-column justify-content-center align-items-center mb-3">
                    <img id="image" class="animation__wobble img-circle elevation-2" src="" alt="Client-Avatar" height="100"
                        width="100">
                </div>
                <ul class="nav nav-pills nav-sidebar flex-column justify-content-center align-items-center gap-1 my-2" data-widget="treeview" role="menu" data-accordion="false" style="font-family: nunito;">
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/ID-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>National ID: </strong><span id="national-id"></span>
                        </span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Name-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>Name: </strong><span id="name"></span>
                        </span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Email-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>Email: </strong><span id="email"></span>
                        </span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Gender-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>Gender: </strong><span id="gender"></span>
                        </span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Phone-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>Phone Number: </strong><span id="phone"></span>
                        </span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Date-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>Date of Birth: </strong><span id="date-of-birth"></span>
                        </span>
                    </li>
                </ul>
                <table class="table table-striped text-center table-bordered" id="client-addresses" style="font-family: nunito;">
                    <thead>
                        <tr>
                            <th scope="col">Postal Code</th>
                            <th scope="col">Area Name</th>
                            <th scope="col">Street Name</th>
                            <th scope="col">Building Number</th>
                            <th scope="col">Floor Number</th>
                            <th scope="col">Flat Number</th>
                            <th scope="col">Main Street</th>
                        </tr>
                    </thead>
                    <tbody id="client-body-addresses"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function clientshowmodalShow(event) {
        var itemId = event.target.id;
        $('sapn').text("")
        $('#client-body-addresses').empty();
        $.ajax({
            url: "{{ route('clients.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                console.log(response.addresses);
                var imagePath = "{{ asset('storage/clients_Images/:image_name') }}".replace(':image_name',response.client.avatar_image);
                $('#image').attr('src', imagePath);
                $('#name').text(response.user.name)
                $('#email').text(response.user.email)
                $('#national-id').text(response.client.id)
                $('#gender').text(response.client.gender)
                $('#phone').text(response.client.phone)
                $('#date-of-birth').text(response.client.date_of_birth)
                var table_body =$('#client-body-addresses');
                for (var address of response.addresses) {
                    var mainStreet = (address.is_main) ?
                    '<img src="/dist/img/icons/Success-Mark-icon.png" width="30" class="img-circle" align="center" />'
                    : '<img src="/dist/img/icons/Failed-Mark-icon.png" width="30" class="img-circle" align="center" />'
                    var record = `
                        <tr>
                            <td>${address.area_id}</td>
                            <td>${address.area_name}</td>
                            <td>${address.street_name}</td>
                            <td>${address.building_number}</td>
                            <td>${address.floor_number}</td>
                            <td>${address.flat_number}</td>
                            <td>${mainStreet}</td>
                        </tr>
                        `;
                        table_body.append(record);
                }
                $("#client-addresses").append(table_body);

            }
        });
    }
</script>
