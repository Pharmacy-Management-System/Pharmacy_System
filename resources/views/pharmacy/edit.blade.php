<!--Edit Pharmacy Modal-->
<div class="modal fade" id="editPharmacyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Pharmacy Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-pharmacy-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body row gy-2 gx-3 align-items-center">
                    <div class="col-md-6 mb-2">
                        <label for="pharmacyId" class="form-label">Owner ID</label>
                        <input name="id" class="form-control" id="pharmacyId" value="">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="name" class="form-label">Owner Name</label>
                        <input name="name" class="form-control" id="name" value="">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="email" class="form-label">Owner Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="email-icon">@</span>
                            <input name="email" class="form-control" id="email" aria-describedby="email-icon" value=""> 
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" class="form-control" id="password" value="">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="area_id" class="form-label">Area Name</label>
                        <select name="area_id" id="areaSelect" class="form-control"></select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="priority" class="form-label">Priority</label>
                        <input name="priority" class="form-control" id="priority" value="">
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input name="avatar" type="file" class="form-control" id="avatar" value="">
                    </div>
                </div>
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
    function showEditModal(event) {
        event.preventDefault();
        event.stopPropagation();
        var pharmacyId = event.target.id;
        $.ajax({
            url: "{{ route('pharmacies.show', ':id') }}".replace(':id', pharmacyId),
            method: "GET",
            success: function(response) {
                console.log(response)
                $('#pharmacyId').val(response.pharmacy.id);
                $('#priority').val(response.pharmacy.priority);
                $('#name').val(response.user.name);
                $('#email').val(response.user.email);
                var areaSelect = $('#areaSelect');
                areaSelect.empty();
                $.each(response.areas, function(index, area) {
                    var option = $('<option>').val(area.id).text(area.name);
                    if (area.id === response.pharmacy.area_id) {
                        option.attr('selected', 'selected');
                    }
                    areaSelect.append(option);
                });
                areaSelect.val(response.pharmacy.area_id);
                // $('#avatar').val(response.pharmacy.avatar_image);
            }
        });
        var route = "{{ route('pharmacies.update', ':id') }}".replace(':id', pharmacyId);
        document.getElementById("edit-pharmacy-form").action = route;
    }
</script>
