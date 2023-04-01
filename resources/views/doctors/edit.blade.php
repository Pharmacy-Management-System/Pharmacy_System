    <!-- edit moadal -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="edit-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nationalIdEdit" class="form-label">National ID</label>
                            <input name="id" class="form-control" id="nationalIdEdit" value="" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nameEdit" class="form-label">name</label>
                            <input name="name" class="form-control" id="nameEdit" value="">
                        </div>
                        <div class="mb-3">
                            <label for="emailEdit" class="form-label">email</label>
                            <input name="email" class="form-control" id="emailEdit" value="">
                        </div>
                        <div class="mb-3">
                            <label for="passwordEdit" class="form-label">password</label>
                            <input name="password" class="form-control" id="passwordEdit" value="">
                        </div>
                        <div class="mb-3">
                            <label for="pharmacy_id" class="form-label">Pharmacy Name</label>
                            <select name="pharmacy_id" id="pharmacyEdit" class="form-control">
                                <!-- options go here -->
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="bannedEdit" class="form-label">Is banned?</label>
                            <input name="is_banned" class="form-control" id="bannedEdit" value="">
                        </div>

                        <div class="mb-3">
                            <label for="avatarEdit" class="form-label">Avatar</label>
                            <input type="file" name="avatar_image" class="form-control" id="avatarEdit" value="">
                        </div>
                    </div>
                    <input name="user_id" class="form-control client-input" id="userid" value="" hidden>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary text-white">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    $('#bannedEdit').val(response.doctor.is_banned);
                    $('#userid').val(response.users.find(user => user.id === response.doctor.user_id).id);
                    $('#nameEdit').val(response.users.find(user => user.id === response.doctor.user_id).name);
                    $('#emailEdit').val(response.users.find(user => user.id === response.doctor.user_id).email);
                    var pharmacySelect = $('#pharmacyEdit');
                    pharmacySelect.empty();
                    $.each(response.pharmacies, function(index, pharmacy) {
                        var pharmacyName = response.users.find(user => user.id === pharmacy.user_id).name;
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
