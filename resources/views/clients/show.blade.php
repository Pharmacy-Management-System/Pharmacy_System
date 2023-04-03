<div class="modal fade" id="show-client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clint Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p><strong>Image:</strong></p>
                    <img id="image" src="" alt="">
                </div>
                <div class="mb-3">
                    <p><strong>Name:</strong> <span id="name"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Email:</strong> <span id="email"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>National ID:</strong> <span id="national-id"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Gender:</strong> <span id="gender"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Phone:</strong> <span id="phone"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Date of Birth:</strong> <span id="date-of-birth"></span></p>
                </div>
                <table class="table table-striped  table-bordered" id="client-addresses">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                var imagePath = "{{ asset('storage/clients_Images/:image_name') }}".replace(':image_name',
                    response.client.avatar_image);
                $('#image').attr('src', imagePath);
                $('#name').text(response.user.name)
                $('#email').text(response.user.email)
                $('#national-id').text(response.client.id)
                $('#gender').text(response.client.gender)
                $('#phone').text(response.client.phone)
                $('#date-of-birth').text(response.client.date_of_birth)
                var table_body =$('#client-body-addresses');
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
                        </tr>
                        `;
                        table_body.append(record);
                }
                $("#client-addresses").append(table_body);

            }
        });
    }
</script>