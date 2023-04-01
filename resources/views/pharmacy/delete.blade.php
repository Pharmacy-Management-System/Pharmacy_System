<!--Delete Pharmacy Modal-->
<div class="modal fade" id="deletePharmacyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="staticBackdropLabel">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are You Sure to Delete this Record?</h5>
                <p class="fw-light">NOTE THAT: There is May be Many Records depend on this Record.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="deletePharmacy" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- restore moadal -->
<div class="modal fade" id="restorePharmacyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="staticBackdropLabel">
                    <i class="bi bi-exclamation-triangle-fill text-success me-2"></i>Warning
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are You Sure to Restore this Record?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="restore" type="button" class="btn btn-success">Restore</button>
            </div>

        </div>
    </div>
</div>

<!--Script-->
<script>
    function showDeleteModal(event) {
        event.preventDefault();
        event.stopPropagation();
        let deleteBtnModal = document.querySelector("#deletePharmacy");
        deleteBtnModal.onclick = function() {
            event.target.closest("form").submit();
        }
    }
    function restoreDeletedPharmacy(event) {
            event.preventDefault();
            event.stopPropagation();
            let restoreBtnModal = document.querySelector("#restore");
            restoreBtnModal.onclick = function() {
                event.target.closest("form").submit();
            }
        }
</script>