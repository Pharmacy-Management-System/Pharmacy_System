@extends('layouts.app')

@section('content')

<section class="content">
    <div class="container-fluid">

        {{ $dataTable->table() }}
    </div><!--/. container-fluid -->

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Doctor Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>National ID</th>
                        <td id="national_id"></td>
                    </tr>
                    <tr>
                        <th>Pharmacy ID</th>
                        <td id="pharmacy_id"></td>
                    </tr>
                    <tr>
                        <th>Is Banned</th>
                        <td id="is_banned"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var viewModal = document.querySelector('#viewModal');
  viewModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var nationalId = button.dataset.nationalId;
    var pharmacyId = button.dataset.pharmacyId;
    var isBanned = button.dataset.isBanned;
    var modal = event.target;
    modal.querySelector('#national_id').textContent = nationalId;
    modal.querySelector('#pharmacy_id').textContent = pharmacyId;
    modal.querySelector('#is_banned').textContent = isBanned;
  });
});


</script>

@endsection

@push('scripts')
{{ $dataTable->scripts() }}
@endpush
