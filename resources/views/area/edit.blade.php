<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Area Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="countrySelect" class="form-label">Country</label>
                        <select name="country_id" id="countrySelect" class="form-control"></select>
                    </div>
                    <div class="mb-2">
                        <label for="areaId" class="form-label">Postal Code</label>
                        <input name="id" class="form-control" id="edit_areaId" value="">
                    </div>
                    <div class="mb-2">
                        <label for="areaName" class="form-label">Area Name</label>
                        <input name="name" class="form-control" id="edit_areaName" value="">
                    </div>
                    <div class="mb-2">
                        <label for="areaAddress" class="form-label">Area Address</label>
                        <input name="address" class="form-control" id="edit_areaAddress" value="">
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

<!--script-->
<script>
    function editmodalShow(event) {
            event.preventDefault();
            event.stopPropagation();
            $('#edit_areaId').val("")
            $('#edit_areaName').val("")
            $('#edit_areaAddress').val("")
            var itemId = event.target.id;
            id = event.target.id;
            $.ajax({
                url: "{{ route('areas.show', ':id') }}".replace(':id', itemId),
                method: "GET",
                success: function(response) {
                    $('#edit_areaId').val(response.area[0].id)
                    $('#edit_areaName').val(response.area[0].name)
                    $('#edit_areaAddress').val(response.area[0].address)
                    var countrySelect = $('#countrySelect');
                    countrySelect.empty();
                    $.each(response.countries, function(index, country) {
                        var option = $('<option>').val(country.id).text(country.name);
                            console.log(response.area[0].country_id)
                        if (country.id === response.area[0].country_id) {
                            option.attr('selected', 'selected');
                        }
                        countrySelect.append(option);
                    });
                    countrySelect.val(response.area[0].country_id);
                    }
            });
            var route = "{{ route('areas.update', ':id') }}".replace(':id', itemId);
            document.getElementById("edit-form").action = route;
    }
</script>

