<div class="modal fade" id="delOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="staticBackdropLabel">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Warning
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are You Sure to Delete this Record?</h5>
                <p class="fw-light">NOTE THAT: There is May be Many Records depend on this Record.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="post" class="delete_item me-2" id="delete_order" >
                    @csrf
                    @method('DELETE')
                    <button id="delete" type="submit" class="btn btn-danger">Delete</button>
                </form>

            </div>

        </div>
    </div>
</div>

<script>
    function deleteOrderModel(event) {
        event.preventDefault();
        event.stopPropagation();
        var selectedorderId = event.target.id;
        console.log(selectedorderId);
       var deleteRoute = "{{ Route('orders.destroy', ':id') }}".replace(':id', selectedorderId);

        document.getElementById("delete_order").action =  deleteRoute ;
    }
</script>
