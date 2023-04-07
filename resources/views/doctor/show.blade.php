<div class="modal fade" id="show-doctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Doctor Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                <div class="flex-column justify-content-center align-items-center mb-3">
                    <img id="doctorAvatar" class="animation__wobble img-circle elevation-2" src="" alt="doctor-Avatar" height="100"
                        width="100">
                </div>
                <ul class="nav nav-pills nav-sidebar flex-column justify-content-center align-items-center gap-1" data-widget="treeview" role="menu" data-accordion="false" style="font-family: nunito;">
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Name-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>Name: </strong><span id="doctorName"></span>
                        </span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Email-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>Email: </strong><span id="doctorEmail"></span>
                        </span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/ID-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>National ID: </strong><span id="national-id"></span>
                        </span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Pharmacy-Name-icon.png" class="nav-icon">
                        <span class="border-container">
                            <strong>Assigned Pharmacy: </strong><span id="pharmacy"></span>
                        </span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="" class="nav-icon" id="is-banned">
                        <span class="border-container">
                            <strong>Banned </strong>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!--Script-->
<script>
    function doctorshowmodalShow(event) {
        var itemId = event.target.id;
        $.ajax({
            url: "{{ route('doctors.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                $('#doctorName').text(response.users.find(user => user.id === response.doctor.user_id).name);
                $('#doctorEmail').text(response.users.find(user => user.id === response.doctor.user_id).email);
                $('#national-id').text(response.doctor.id);
                var checkIcon = response.doctor.is_banned ? "{{ asset('dist/img/icons/Success-Mark-icon.png') }}" : "{{ asset('dist/img/icons/Failed-Mark-icon.png') }}"
                $('#is-banned').attr('src', checkIcon);
                var pharmacyName = response.pharmacies.find(pharmacy => pharmacy.id === response.doctor.pharmacy_id).pharmacy_name;
                $('#pharmacy').text(pharmacyName)
                var imagePath = "{{ asset('storage/doctors_Images/:image_name') }}".replace(':image_name', response.doctor.avatar_image);
                $('#doctorAvatar').attr('src', imagePath);
            }
        });
    }
</script>
