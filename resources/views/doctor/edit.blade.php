<!--Edit Doctor Modal-->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Doctor Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body row gy-2 gx-3 align-items-center">

                    <div class="col-md-6 mb-2">
                        <label for="nationalIdEdit" class="form-label">National ID</label>
                        <input name="id" class="form-control" id="nationalIdEdit" value="" readonly>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="nameEdit" class="form-label">Name</label>
                        <input name="name" class="form-control" id="nameEdit" value="">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="passwordEdit" class="form-label">Password</label>
                        <input name="password" class="form-control" id="passwordEdit" value="" type="password">
                    </div>

                    @role('admin|pharmacy')
                    <div class="col-md-6 mb-2">
                        <label for="emailEdit" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="email-icon">@</span>
                            <input name="email" class="form-control" id="emailEdit" type="email" id="emailEdit" aria-describedby="email-icon" value="">
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="pharmacy_id" class="form-label">Assigned Pharmacy</label>
                        <select name="pharmacy_id" id="pharmacyEdit" class="form-control"></select>
                    </div>
                    <div class="col-md-12 mb-2 mx-3 form-check">
                        <input name="is_banned" class="form-check-input" id="bannedEdit" type="checkbox" value="">
                        <label for="bannedEdit" class="form-check-label">Is banned?</label>
                    </div>
                    @endrole

                    @role('doctor')
                    <div class="col-md-6 mb-2">
                        <label for="emailEdit" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="email-icon">@</span>
                            <input name="email" class="form-control" id="emailEdit" type="email" id="emailEdit" aria-describedby="email-icon" value="" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="pharmacy_id" class="form-label">Assigned Pharmacy</label>
                        <select name="pharmacy_id" id="pharmacyEdit" class="form-control" readonly></select>
                    </div>
                    <div class="col-md-12 mb-2 mx-3 form-check" hidden>
                        <input name="is_banned" class="form-check-input" id="bannedEdit" type="checkbox" value="">
                        <label for="bannedEdit" class="form-check-label">Is banned?</label>
                    </div>
                    @endrole

                    <div class="col-md-12 mb-2">
                        <label for="avatarEdit" class="form-label">Avatar</label>
                        <input type="file" name="avatar_image" class="form-control" id="avatarEdit" value="">
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

<!--Script-->
<script>
    function editmodalShow(event) {
        event.preventDefault();
        event.stopPropagation();
        var itemId = event.target.id;
        $.ajax({
            url: "{{ route('doctors.show', ':id') }}".replace(':id', itemId),
            method: "GET",

            success: function(response) {
                console.log(response)
                $('#nationalIdEdit').val(response.doctor.id);
                $('#bannedEdit').prop('checked', response.doctor.is_banned == 1);
                $('#userid').val(response.users.find(user => user.id === response.doctor.user_id).id);
                $('#nameEdit').val(response.users.find(user => user.id === response.doctor.user_id).name);
                $('#emailEdit').val(response.users.find(user => user.id === response.doctor.user_id).email);
                var pharmacySelect = $('#pharmacyEdit');
                pharmacySelect.empty();
                $.each(response.pharmacies, function(index, pharmacy) {
                    var pharmacyName = pharmacy.pharmacy_name;
                    var option = $('<option>').val(pharmacy.id).text(pharmacyName);
                    if (pharmacy.id === response.doctor.pharmacy_id) {
                        option.attr('selected', 'selected');
                    }
                    pharmacySelect.append(option);
                });
                pharmacySelect.val(response.doctor.pharmacy_id);
                $('#avatarEdit').val(response.doctor.avatar_image);
                $('#avatarEdit').trigger('change');
            }

        });
        var route = "{{ route('doctors.update', ':id') }}".replace(':id', itemId);
        document.getElementById("edit-form").action = route;
    }
</script>
