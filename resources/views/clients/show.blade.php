<div class="modal fade" id="show-client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p><strong>Name:</strong> <span id="name"></span></p>
                    </div>
                    <div class="mb-3">
                        <label for="areaName" class="form-label">Area Name</label>
                        <input name="name" class="form-control" id="areaName" value="">
                    </div>
                    <div class="mb-3">
                        <label for="areaAddress" class="form-label">Area Address</label>
                        <input name="address" class="form-control" id="areaAddress" value="">
                    </div>
                </div>
        </div>
    </div>
</div>

<script>
    function clientshowmodalShow(event){
            var itemId = event.target.id;
            $.ajax({
                url: "{{ route('clients.show', ':id') }}".replace(':id', itemId),
                method: "GET",
                success: function(response) {
                    console.log(response)
                    $('#name').val(response.user[0]['name'])
                    /*$('#areaName').val(response.area[0].name)
                    $('#areaAddress').val(response.area[0].address) */
                }
            }); 
    }
</script>
