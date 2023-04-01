<!-----------Show modal------------>
<div class="modal fade" id="show-doctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Doctor Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                <div class="mb-3 flex-column justify-content-center align-items-center">
                    <img id="doctorImage" src="" alt="Doctor Image" class="animation__wobble img-circle elevation-2" height="100" width="100">
                </div>
                <div class="mb-3">
                    <p><strong>Name:</strong> <span id="doctorName"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Email:</strong> <span id="doctorEmail"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>National ID:</strong> <span id="national-id"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Assigned Pharmacy:</strong> <span id="pharmacy"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Is Banned:</strong> <span id="is-banned"></span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    function doctorshowmodalShow(event) {
        var itemId = event.target.id;
        $('span').text("");
        $.ajax({
            url: "{{ route('doctors.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                $('#doctorName').text(response.users.find(user => user.id === response.doctor.user_id).name);
                $('#doctorEmail').text(response.users.find(user => user.id === response.doctor.user_id).email);
                $('#national-id').text(response.doctor.id)
                $('#is-banned').text(response.doctor.is_banned ? 'yes' : 'no')
                var pharmacy = response.pharmacies.find(pharmacy => pharmacy.id === response.doctor.pharmacy_id);
                var pharmacyName = response.users.find(user => user.id === pharmacy.user_id).name;
                $('#pharmacy').text(pharmacyName)
                var imagePath = "{{ asset('storage/doctors_Images/:image_name') }}".replace(':image_name', response.doctor.avatar_image);
                $('#doctorImage').attr('src', imagePath);
            }
        });
    }
</script>
