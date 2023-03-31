<div class="modal fade" id="show-client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Area</h5>
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
                    <div class="mb-3">
                        <p><strong>Postal Code:</strong> <span id="postal-code"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Area Name:</strong> <span id="area-name"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Area Address:</strong> <span id="area-address"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Street Name:</strong> <span id="street-name"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Building Number:</strong> <span id="building-number"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Flat Number:</strong> <span id="flat-number"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Floor Number:</strong> <span id="floor-number"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Is Main:</strong> <span id="is-main"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
        </div>
    </div>
</div>

<script>
    function clientshowmodalShow(event){
            var itemId = event.target.id;
            $('sapn').text("")
            $.ajax({
                url: "{{ route('clients.show', ':id') }}".replace(':id', itemId),
                method: "GET",
                success: function(response) {
                    var imagePath = "{{ asset('storage/clients_Images/:image_name') }}".replace(':image_name', response.client.avatar_image);
                    $('#image').attr('src', imagePath);
                    $('#name').text(response.user.name)
                    $('#email').text(response.user.email)
                    $('#national-id').text(response.client.id)
                    $('#gender').text(response.client.gender)
                    $('#phone').text(response.client.phone)
                    $('#date-of-birth').text(response.client.date_of_birth)
                    $('#postal-code').text(response.client.area_id)
                    $('#area-name').text(response.area.name)
                    $('#area-address').text(response.area.address)
                    $('#street-name').text(response.client.street_name)
                    $('#building-number').text(response.client.building_no)
                    $('#flat-number').text(response.client.flat_number)
                    $('#floor-number').text(response.client.floor_number)
                    $('#is-main').text(response.client.is_main)
                }
            }); 
    }
</script>
