<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('areas.store')}}" id="create-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col-12 mb-2">
                        <label for="countryId" class="form-label visually-hidden">Country</label>
                        <select name="country_id" id="create_countryId" class="form-control">
                            <option value="" disabled selected hidden>Choose Country...</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="areaId" class="form-label visually-hidden">Postal Code</label>
                        <input name="id" class="form-control" id="create_areaId" placeholder="Postal Code" value="" required>
                    </div>
                    <div class="mb-2 col-12">
                        <label for="areaName" class="form-label visually-hidden">Area Name</label>
                        <input name="name" class="form-control" id="create_areaName" placeholder="Area Name" value="" required>
                    </div>
                    <div class="mb-2 col-12">
                        <label for="areaAddress" class="form-label visually-hidden">Area Address</label>
                        <input name="address" class="form-control" id="create_areaAddress" placeholder="Area Address" value="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--script-->
<script>
    function createmodalShow(event) {
            event.preventDefault();
            event.stopPropagation();
            $('#create_areaId').val("")
            $('#create_countryId').val("")
            $('#create_areaName').val("")
            $('#create_areaAddress').val("")
        }
</script>
